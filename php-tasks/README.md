# PHP Advanced Tasks — حلول كاملة

## كيف تشغّلها
1. ثبّت PHP 8 أو أعلى (أو XAMPP).
2. افتح الـ terminal داخل هاد المجلد:
   ```
   php -S localhost:8000
   ```
3. افتح `http://localhost:8000` بتشوف قائمة بكل التاسكات.

> مشروع 01 (Login/Signup) بيستخدم Bootstrap من CDN، يعني بدو إنترنت.

## المحتوى
| المجلد | الملف الأصلي | عدد التاسكات |
|---|---|---|
| `01-Form-Validation` | PHP Advanced - Form Validation | مشروع كامل (Landing, Signup, Login, Welcome, Admin) |
| `02-Super-Global-Variables` | PHP Advanced - Super Global Variables | 9 |
| `03-Cookies` | php_cookies_sessions_get_post (قسم Cookies) | 10 |
| `04-Sessions` | php_cookies_sessions_get_post (قسم Sessions) | 10 |
| `05-Superglobals-GET-POST-SESSION` | php_cookies_sessions_get_post (قسم Superglobals) | 10 |
| `06-File-Handling` | PHP Practical File Handling Tasks | 9 |

## ملاحظات مهمة
- الصور/التصميم لمشروع 01 مأخوذ من الصورة اللي بالملف (Hello There / Login / Sign up).
- أدمن مشروع 01: `admin@admin.com` / `Admin@12345` (من `includes/functions.php`).
- المستخدمين بينحفظوا بـ `users.json` (Associative array)، والباسوردات مخزنة مشفّرة بـ `password_hash`.
- شرط العمر بمشروع 01: 16 سنة أو أكثر.
- `task3_rename.php` بيعيد تسمية `config.txt` إلى `config.bak` (بعد أول تشغيل بتطلع رسالة الخطأ، وهاد المطلوب بالتاسك). لإعادة التجربة رجّع الاسم `config.txt`.
- `task9_delete_report.php?file=report1.pdf` بيحذف الملف فعلياً من `downloads/`.
