<?php
require_once __DIR__ . '/app/Database.php';

// کلاس پایه Migration
abstract class Migration {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    abstract public function up();
}

class Migrator {
    private $db;

    public function __construct() {
        $this->db = (new App\Database())->getConnection();
    }

    public function run() {
        // ایجاد جدول migrations اگه وجود نداشته باشه
        $this->db->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            migration_name TEXT NOT NULL,
            applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        // لیست فایل‌های migration
        $migrationFiles = glob(__DIR__ . '/migrations/*.php');
        sort($migrationFiles);

        foreach ($migrationFiles as $file) {
            $migrationName = basename($file);

            // چک کردن اینکه آیا این migration قبلاً اعمال شده یا نه
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM migrations WHERE migration_name = ?");
            $stmt->execute([$migrationName]);
            $count = $stmt->fetchColumn();

            if ($count == 0) {
                echo "Applying migration: $migrationName\n";
                require_once $file;

                // نام کلاس migration رو از نام فایل می‌سازیم
                $className = str_replace('.php', '', $migrationName); // 001_create_tables
                $className = preg_replace('/^\d+_/', '', $className); // create_tables
                $className = str_replace('_', ' ', $className); // create tables
                $className = ucwords($className); // Create Tables
                $className = str_replace(' ', '', $className); // CreateTables
                $className .= 'Migration'; // CreateTablesMigration

                if (class_exists($className)) {
                    $migration = new $className($this->db);
                    $migration->up();

                    // ثبت migration توی جدول
                    $stmt = $this->db->prepare("INSERT INTO migrations (migration_name) VALUES (?)");
                    $stmt->execute([$migrationName]);
                } else {
                    echo "Error: Class $className not found in $migrationName\n";
                }
            } else {
                echo "Migration already applied: $migrationName\n";
            }
        }

        echo "Migration completed!\n";
    }
}

$migrator = new Migrator();
$migrator->run();