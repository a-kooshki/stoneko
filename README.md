## Ehsnestone Static + PHP Contact Form

این پروژه به‌صورت مستقیم روی هاست لینوکس با cPanel قابل اجراست.

### راه‌اندازی روی cPanel
1. فایل‌های پروژه را داخل `public_html` آپلود کنید.
2. مطمئن شوید `send-message.php` کنار `index.html` قرار دارد.
3. در cPanel > **Select PHP Version**، PHP 7.4 یا بالاتر را فعال کنید.
4. در cPanel > **Email Accounts**، ایمیل `info@ehsnestone.com` را ایجاد کنید (یا به ایمیل مقصد دلخواه تغییر دهید).
5. در cPanel > **Email Deliverability** و **MX/SMTP** تنظیمات ایمیل را سالم نگه دارید تا `mail()` کار کند.

### تست سریع
- سایت را باز کنید.
- فرم تماس را پر کنید و ارسال بزنید.
- پیام موفقیت داخل فرم نمایش داده می‌شود و ایمیل باید به `info@ehsnestone.com` برسد.

### فایل‌های کلیدی
- `index.html`: رابط کاربری و ارسال فرم با `fetch` به `send-message.php`
- `send-message.php`: اعتبارسنجی ورودی‌ها و ارسال ایمیل با `mail()`


### فونت سفارشی (از فایل ZIP)
- فایل زیپ فونت را در مسیر `fonts/` اکسترکت کنید.
- برای فونت اصلی سایت یکی از این نام‌ها را بگذارید:
  - `fonts/ehsan-font.woff2` یا `fonts/ehsan-font.ttf`
- برای متن کنار لوگو (`EHSANSTONE`) دو فونت مجزا تعریف شده است:
  - فونت فارسی لوگو: `fonts/ehsanstone-fa.woff2` یا `fonts/ehsanstone-fa.ttf`
  - فونت انگلیسی لوگو: `fonts/ehsanstone-en.woff2` یا `fonts/ehsanstone-en.ttf`
- اگر این فایل‌ها موجود نباشند، سایت خودکار از فونت‌های جایگزین (`Vazirmatn` و `Inter`) استفاده می‌کند.
