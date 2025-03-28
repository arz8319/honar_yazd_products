<?php
namespace App\Controllers;

use App\Database;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\Order;
use App\Models\Review;
use App\Models\Discount;
use App\Models\Setting;

class AdminController {
    private $db;
    private $productModel;
    private $categoryModel;
    private $userModel;
    private $activityLogModel;
    private $orderModel;
    private $reviewModel;
    private $discountModel;
    private $settingModel;

    public function __construct($db) {
        $this->db = $db;
        $this->productModel = new Product($db);
        $this->categoryModel = new Category($db);
        $this->userModel = new User($db);
        $this->activityLogModel = new ActivityLog($db);
        $this->orderModel = new Order($db);
        $this->reviewModel = new Review($db);
        $this->discountModel = new Discount($db);
        $this->settingModel = new Setting($db);

        // چک کردن ورود ادمین
        if (!isset($_SESSION['admin_id']) && !in_array($_SERVER['REQUEST_URI'], ['/honar_yazd_products/admin/login', '/honar_yazd_products/admin/logout'])) {
            header('Location: /honar_yazd_products/admin/login');
            exit;
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $this->userModel->findByUsername($username);
            if ($user && password_verify($password, $user['password']) && $user['role'] === 'admin') {
                $_SESSION['admin_id'] = $user['id'];
                $this->activityLogModel->log($user['id'], 'login', 'Admin logged in');
                header('Location: /honar_yazd_products/admin');
                exit;
            } else {
                $error = "نام کاربری یا رمز عبور اشتباه است.";
            }
        }
        require_once 'views/admin/login.php';
    }

    public function logout() {
        $admin_id = $_SESSION['admin_id'];
        $this->activityLogModel->log($admin_id, 'logout', 'Admin logged out');
        session_destroy();
        header('Location: /honar_yazd_products/admin/login');
        exit;
    }

    public function dashboard() {
        $stats = [
            'total_products' => $this->productModel->count(),
            'total_categories' => $this->categoryModel->count(),
            'total_orders' => $this->orderModel->count(),
            'total_reviews' => $this->reviewModel->countPending(),
            'recent_logs' => $this->activityLogModel->getRecent(5),
        ];
        require_once 'views/admin/dashboard.php';
    }

    // مدیریت محصولات
    public function products() {
        $products = $this->productModel->getAll();
        $categories = $this->categoryModel->getAll();
        require_once 'views/admin/products.php';
    }

    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            $stock = $_POST['stock'];
            $attributes = $_POST['attributes'] ?? '[]';

            $images = [];
            if (!empty($_FILES['images']['name'][0])) {
                foreach ($_FILES['images']['name'] as $key => $name) {
                    if ($name) {
                        $tmp_name = $_FILES['images']['tmp_name'][$key];
                        $filename = time() . '_' . $name;
                        move_uploaded_file($tmp_name, 'uploads/' . $filename);
                        $images[] = $filename;
                    }
                }
            }

            $videos = [];
            if (!empty($_FILES['videos']['name'][0])) {
                foreach ($_FILES['videos']['name'] as $key => $name) {
                    if ($name) {
                        $tmp_name = $_FILES['videos']['tmp_name'][$key];
                        $filename = time() . '_' . $name;
                        move_uploaded_file($tmp_name, 'uploads/' . $filename);
                        $videos[] = $filename;
                    }
                }
            }

            $this->productModel->create($title, $description, $price, $stock, $category_id, null, json_encode($images), json_encode($videos), $attributes);
            $this->activityLogModel->log($_SESSION['admin_id'], 'add_product', "Added product: $title");
            header('Location: /honar_yazd_products/admin/products');
            exit;
        }
        $categories = $this->categoryModel->getAll();
        require_once 'views/admin/add_product.php';
    }

    public function editProduct($id) {
        $product = $this->productModel->findById($id);
        if (!$product) {
            $_SESSION['error'] = "محصول موردنظر پیدا نشد.";
            header('Location: /honar_yazd_products/admin/products');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            $stock = $_POST['stock'];
            $attributes = $_POST['attributes'] ?? '[]';

            $images = json_decode($product['images'], true) ?: [];
            if (!empty($_FILES['images']['name'][0])) {
                foreach ($_FILES['images']['name'] as $key => $name) {
                    if ($name) {
                        $tmp_name = $_FILES['images']['tmp_name'][$key];
                        $filename = time() . '_' . $name;
                        move_uploaded_file($tmp_name, 'uploads/' . $filename);
                        $images[] = $filename;
                    }
                }
            }

            $videos = json_decode($product['videos'], true) ?: [];
            if (!empty($_FILES['videos']['name'][0])) {
                foreach ($_FILES['videos']['name'] as $key => $name) {
                    if ($name) {
                        $tmp_name = $_FILES['videos']['tmp_name'][$key];
                        $filename = time() . '_' . $name;
                        move_uploaded_file($tmp_name, 'uploads/' . $filename);
                        $videos[] = $filename;
                    }
                }
            }

            $this->productModel->update($id, $title, $description, $price, $stock, $category_id, null, json_encode($images), json_encode($videos), $attributes);
            $this->activityLogModel->log($_SESSION['admin_id'], 'edit_product', "Edited product: $title");
            $_SESSION['success'] = "محصول با موفقیت ویرایش شد.";
            header('Location: /honar_yazd_products/admin/products');
            exit;
        }
        $categories = $this->categoryModel->getAll();
        require_once 'views/admin/edit_product.php';
    }

    public function deleteProduct($id) {
        $product = $this->productModel->findById($id);
        if ($product) {
            $this->productModel->delete($id);
            $this->activityLogModel->log($_SESSION['admin_id'], 'delete_product', "Deleted product: {$product['title']}");
            $_SESSION['success'] = "محصول با موفقیت حذف شد.";
        } else {
            $_SESSION['error'] = "محصول موردنظر پیدا نشد.";
        }
        header('Location: /honar_yazd_products/admin/products');
        exit;
    }

    public function updatePrices() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['excel_file']) && $_FILES['excel_file']['tmp_name']) {
                // فرضاً از PhpSpreadsheet استفاده می‌کنیم (باید نصب بشه)
                // اینجا فقط منطق کلی رو می‌نویسم
                $file = $_FILES['excel_file']['tmp_name'];
                $data = []; // داده‌های اکسل رو بخون (نیاز به PhpSpreadsheet داره)
                foreach ($data as $row) {
                    $product_id = $row['product_id'];
                    $new_price = $row['price'];
                    $this->productModel->updatePrice($product_id, $new_price);
                }
                $this->activityLogModel->log($_SESSION['admin_id'], 'update_prices', 'Updated product prices via Excel');
            } elseif (isset($_POST['category_id']) && isset($_POST['percentage'])) {
                $category_id = $_POST['category_id'];
                $percentage = $_POST['percentage'];
                $this->productModel->updatePricesByCategory($category_id, $percentage);
                $this->activityLogModel->log($_SESSION['admin_id'], 'update_prices', "Updated prices for category #$category_id by $percentage%");
            }
            $_SESSION['success'] = "قیمت‌ها با موفقیت به‌روزرسانی شدند.";
            header('Location: /honar_yazd_products/admin/products');
            exit;
        }
        $categories = $this->categoryModel->getAll();
        require_once 'views/admin/update_prices.php';
    }

    // مدیریت سفارش‌ها
    public function orders() {
        $orders = $this->orderModel->getAll();
        require_once 'views/admin/orders.php';
    }

    public function viewOrder($id) {
        $order = $this->orderModel->findById($id);
        if (!$order) {
            $_SESSION['error'] = "سفارش موردنظر پیدا نشد.";
            header('Location: /honar_yazd_products/admin/orders');
            exit;
        }
        $items = $this->orderModel->getItems($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'];
            $this->orderModel->updateStatus($id, $status);
            $this->activityLogModel->log($_SESSION['admin_id'], 'update_order_status', "Updated order #$id status to $status");
            $_SESSION['success'] = "وضعیت سفارش با موفقیت به‌روزرسانی شد.";
            header('Location: /honar_yazd_products/admin/orders');
            exit;
        }
        require_once 'views/admin/view_order.php';
    }

    // مدیریت دسته‌بندی‌ها
    public function categories() {
        $categories = $this->categoryModel->getHierarchy();
        require_once 'views/admin/categories.php';
    }

    public function addCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $parent_id = $_POST['parent_id'] ?: null;
            $this->categoryModel->create($name, $parent_id);
            $this->activityLogModel->log($_SESSION['admin_id'], 'add_category', "Added category: $name");
            $_SESSION['success'] = "دسته‌بندی با موفقیت اضافه شد.";
            header('Location: /honar_yazd_products/admin/categories');
            exit;
        }
        $categories = $this->categoryModel->getAll();
        require_once 'views/admin/add_category.php';
    }

    public function editCategory($id) {
        $category = $this->categoryModel->findById($id);
        if (!$category) {
            $_SESSION['error'] = "دسته‌بندی موردنظر پیدا نشد.";
            header('Location: /honar_yazd_products/admin/categories');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $parent_id = $_POST['parent_id'] ?: null;
            $this->categoryModel->update($id, $name, $parent_id);
            $this->activityLogModel->log($_SESSION['admin_id'], 'edit_category', "Edited category: $name");
            $_SESSION['success'] = "دسته‌بندی با موفقیت ویرایش شد.";
            header('Location: /honar_yazd_products/admin/categories');
            exit;
        }
        $categories = $this->categoryModel->getAll();
        require_once 'views/admin/edit_category.php';
    }

    public function deleteCategory($id) {
        $category = $this->categoryModel->findById($id);
        if ($category) {
            $this->categoryModel->delete($id);
            $this->activityLogModel->log($_SESSION['admin_id'], 'delete_category', "Deleted category: {$category['name']}");
            $_SESSION['success'] = "دسته‌بندی با موفقیت حذف شد.";
        } else {
            $_SESSION['error'] = "دسته‌بندی موردنظر پیدا نشد.";
        }
        header('Location: /honar_yazd_products/admin/categories');
        exit;
    }

    // مدیریت نظرات
    public function reviews() {
        $reviews = $this->reviewModel->getAll();
        require_once 'views/admin/reviews.php';
    }

    public function manageReview($id) {
        $review = $this->reviewModel->findById($id);
        if (!$review) {
            $_SESSION['error'] = "نظر موردنظر پیدا نشد.";
            header('Location: /honar_yazd_products/admin/reviews');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['status'])) {
                $status = $_POST['status'];
                $this->reviewModel->updateStatus($id, $status);
                $this->activityLogModel->log($_SESSION['admin_id'], 'update_review_status', "Updated review #$id status to $status");
                $_SESSION['success'] = "وضعیت نظر با موفقیت به‌روزرسانی شد.";
            } elseif (isset($_POST['reply'])) {
                $reply = $_POST['reply'];
                $this->reviewModel->addReply($id, $_SESSION['admin_id'], $reply);
                $this->activityLogModel->log($_SESSION['admin_id'], 'reply_review', "Replied to review #$id");
                $_SESSION['success'] = "پاسخ با موفقیت ثبت شد.";
            }
            header('Location: /honar_yazd_products/admin/reviews');
            exit;
        }
        $replies = $this->reviewModel->getReplies($id);
        require_once 'views/admin/manage_review.php';
    }

    // مدیریت کاربران
    public function users() {
        $users = $this->userModel->getAll();
        require_once 'views/admin/users.php';
    }

    public function addUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role = $_POST['role'];
            $this->userModel->create($name, $username, $email, $password, $role);
            $this->activityLogModel->log($_SESSION['admin_id'], 'add_user', "Added user: $username");
            $_SESSION['success'] = "کاربر با موفقیت اضافه شد.";
            header('Location: /honar_yazd_products/admin/users');
            exit;
        }
        require_once 'views/admin/add_user.php';
    }

    public function editUser($id) {
        $user = $this->userModel->findById($id);
        if (!$user) {
            $_SESSION['error'] = "کاربر موردنظر پیدا نشد.";
            header('Location: /honar_yazd_products/admin/users');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];
            $role = $_POST['role'];
            $this->userModel->update($id, $name, $username, $email, $password, $role);
            $this->activityLogModel->log($_SESSION['admin_id'], 'edit_user', "Edited user: $username");
            $_SESSION['success'] = "کاربر با موفقیت ویرایش شد.";
            header('Location: /honar_yazd_products/admin/users');
            exit;
        }
        require_once 'views/admin/edit_user.php';
    }

    public function deleteUser($id) {
        $user = $this->userModel->findById($id);
        if ($user) {
            $this->userModel->delete($id);
            $this->activityLogModel->log($_SESSION['admin_id'], 'delete_user', "Deleted user: {$user['username']}");
            $_SESSION['success'] = "کاربر با موفقیت حذف شد.";
        } else {
            $_SESSION['error'] = "کاربر موردنظر پیدا نشد.";
        }
        header('Location: /honar_yazd_products/admin/users');
        exit;
    }

    // مدیریت تخفیف‌ها
    public function discounts() {
        $discounts = $this->discountModel->getAll();
        require_once 'views/admin/discounts.php';
    }

    public function addDiscount() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'] ?: null;
            $category_id = $_POST['category_id'] ?: null;
            $percentage = $_POST['percentage'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $this->discountModel->create($product_id, $category_id, $percentage, $start_date, $end_date);
            $this->activityLogModel->log($_SESSION['admin_id'], 'add_discount', "Added discount: $percentage%");
            $_SESSION['success'] = "تخفیف با موفقیت اضافه شد.";
            header('Location: /honar_yazd_products/admin/discounts');
            exit;
        }
        $products = $this->productModel->getAll();
        $categories = $this->categoryModel->getAll();
        require_once 'views/admin/add_discount.php';
    }

    public function editDiscount($id) {
        $discount = $this->discountModel->findById($id);
        if (!$discount) {
            $_SESSION['error'] = "تخفیف موردنظر پیدا نشد.";
            header('Location: /honar_yazd_products/admin/discounts');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'] ?: null;
            $category_id = $_POST['category_id'] ?: null;
            $percentage = $_POST['percentage'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $this->discountModel->update($id, $product_id, $category_id, $percentage, $start_date, $end_date);
            $this->activityLogModel->log($_SESSION['admin_id'], 'edit_discount', "Edited discount: $percentage%");
            $_SESSION['success'] = "تخفیف با موفقیت ویرایش شد.";
            header('Location: /honar_yazd_products/admin/discounts');
            exit;
        }
        $products = $this->productModel->getAll();
        $categories = $this->categoryModel->getAll();
        require_once 'views/admin/edit_discount.php';
    }

    public function deleteDiscount($id) {
        $discount = $this->discountModel->findById($id);
        if ($discount) {
            $this->discountModel->delete($id);
            $this->activityLogModel->log($_SESSION['admin_id'], 'delete_discount', "Deleted discount: {$discount['percentage']}%");
            $_SESSION['success'] = "تخفیف با موفقیت حذف شد.";
        } else {
            $_SESSION['error'] = "تخفیف موردنظر پیدا نشد.";
        }
        header('Location: /honar_yazd_products/admin/discounts');
        exit;
    }

    // گزارش‌ها
    public function reports() {
        $start_date = $_GET['start_date'] ?? date('Y-m-d', strtotime('-30 days'));
        $end_date = $_GET['end_date'] ?? date('Y-m-d');
        $sales_report = $this->orderModel->getSalesReport($start_date, $end_date);
        $top_products = $this->db->query("SELECT p.title, SUM(oi.quantity) as total_sold FROM order_items oi JOIN products p ON oi.product_id = p.id GROUP BY p.id ORDER BY total_sold DESC LIMIT 5")->fetchAll(\PDO::FETCH_ASSOC);
        require_once 'views/admin/reports.php';
    }

    // تنظیمات
    public function settings() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $site_name = $_POST['site_name'];
            $site_logo = $_POST['site_logo'];
            $admin_email = $_POST['admin_email'];
            $this->settingModel->set('site_name', $site_name);
            $this->settingModel->set('site_logo', $site_logo);
            $this->settingModel->set('admin_email', $admin_email);
            $this->activityLogModel->log($_SESSION['admin_id'], 'update_settings', 'Updated site settings');
            $_SESSION['success'] = "تنظیمات با موفقیت ذخیره شد.";
            header('Location: /honar_yazd_products/admin/settings');
            exit;
        }
        $settings = [
            'site_name' => $this->settingModel->get('site_name') ?? 'هنر یزد',
            'site_logo' => $this->settingModel->get('site_logo') ?? '',
            'admin_email' => $this->settingModel->get('admin_email') ?? '',
        ];
        require_once 'views/admin/settings.php';
    }
}