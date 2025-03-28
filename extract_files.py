import re
import os

# مسیر فایل چت (فایلی که متن چت رو توش کپی کردی)
chat_file = "chat.txt"
# مسیر خروجی برای ذخیره فایل‌ها (ریشه پروژه)
output_base_dir = "honar_yazd_products"

# دیکشنری برای ذخیره آخرین نسخه فایل‌ها
files_dict = {}

# متغیرهای کمکی برای جمع‌آوری محتوا
current_file = None
current_content = []
collecting = False

# خواندن فایل چت
try:
    with open(chat_file, "r", encoding="utf-8") as f:
        for line in f:
            line = line.strip()

            # شناسایی مسیر فایل
            file_match = re.match(r"#### FILE: (.+)", line)
            if file_match:
                current_file = file_match.group(1)
                continue

            # شروع جمع‌آوری محتوا
            if line == "#the_start_of_this_code":
                collecting = True
                current_content = []
                continue

            # پایان جمع‌آوری محتوا
            if line == "#the_end_of_this_code":
                collecting = False
                if current_file:
                    # ذخیره محتوا توی دیکشنری (فقط آخرین نسخه نگه داشته می‌شه)
                    files_dict[current_file] = "\n".join(current_content)
                current_file = None
                continue

            # جمع‌آوری خطوط محتوا
            if collecting:
                current_content.append(line)

except FileNotFoundError:
    print(f"خطا: فایل {chat_file} پیدا نشد. لطفاً مطمئن شو که فایل چت رو درست ذخیره کردی.")
    exit(1)
except Exception as e:
    print(f"خطا در خواندن فایل چت: {e}")
    exit(1)

# ذخیره فایل‌ها در مسیر خروجی
if not os.path.exists(output_base_dir):
    os.makedirs(output_base_dir)

for file_path, content in files_dict.items():
    try:
        # مسیر کامل فایل رو از honar_yazd_products جدا کنیم
        if file_path.startswith("honar_yazd_products/"):
            relative_path = file_path[len("honar_yazd_products/"):]
        else:
            relative_path = file_path

        # مسیر کامل فایل توی سیستم
        full_path = os.path.join(output_base_dir, relative_path)

        # ساخت دایرکتوری‌ها اگر وجود نداشته باشند
        os.makedirs(os.path.dirname(full_path), exist_ok=True)

        # ذخیره فایل
        with open(full_path, "w", encoding="utf-8") as f:
            f.write(content)
        print(f"فایل {full_path} با موفقیت ذخیره شد.")
    except Exception as e:
        print(f"خطا در ذخیره فایل {file_path}: {e}")

print(f"\nاستخراج فایل‌ها با موفقیت انجام شد! فایل‌ها در مسیر {output_base_dir} ذخیره شدند.")
print("برای اجرای پروژه، مراحل نصب رو طبق README.md دنبال کن.")