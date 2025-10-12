# إعداد الدومين للموقع - adv-line.sa

## الحل: تكوين APP_URL في ملف .env

### على السيرفر (https://adv-line.sa)

1. **افتح ملف `.env` على السيرفر** وعدّل السطر التالي:

```bash
APP_URL=https://adv-line.sa
```

2. **احذف الـ cache بعد التعديل:**

```bash
php artisan config:clear
php artisan cache:clear
php artisan config:cache
```

### على اللوكال (للتطوير)

في ملف `.env` المحلي، اتركه كما هو:

```bash
APP_URL=http://127.0.0.1:8000
```

## كيف يعمل؟

عندما تستخدم `asset()` في الكود، Laravel يستخدم قيمة `APP_URL` من ملف `.env` تلقائياً:

```php
// في الكود
asset('images/logo.png')

// سيصبح في السيرفر
https://adv-line.sa/images/logo.png

// سيصبح في اللوكال
http://127.0.0.1:8000/images/logo.png
```

## مثال كامل لملف .env على السيرفر

```bash
APP_NAME="AdvFood"
APP_ENV=production
APP_KEY=base64:your-app-key-here
APP_DEBUG=false
APP_TIMEZONE=Asia/Riyadh
APP_URL=https://adv-line.sa
APP_LOCALE=ar

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

CACHE_STORE=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

# ... باقي الإعدادات
```

## التحقق من الإعدادات

بعد تحديث الملف، تحقق من الإعدادات:

```bash
php artisan config:show app.url
```

يجب أن يظهر: `https://adv-line.sa`

## ملاحظات مهمة:

1. ✅ **لا تضع `/` في نهاية الـ URL**
   - صح: `https://adv-line.sa`
   - خطأ: `https://adv-line.sa/`

2. ✅ **استخدم `https://` وليس `http://`** (للأمان)

3. ✅ **بعد أي تعديل في `.env`، نفذ:**
   ```bash
   php artisan config:clear
   php artisan config:cache
   ```

4. ✅ **تأكد من أن شهادة SSL نشطة** على الدومين

## اختبار الحل

بعد التنفيذ، افتح صفحة المطعم:
- https://adv-line.sa/restaurants/2

وتحقق من مسار الصور في الـ HTML (اضغط F12 وافحص العنصر):
```html
<img src="https://adv-line.sa/storage/restaurants/covers/image.jpg">
```

## إذا استمرت المشكلة

1. **تحقق من ملف `.env` مرة أخرى**
   ```bash
   cat .env | grep APP_URL
   ```

2. **امسح جميع أنواع الـ cache**
   ```bash
   php artisan optimize:clear
   ```

3. **أعد تشغيل الخادم** (إذا كنت تستخدم Apache/Nginx)
   ```bash
   # Apache
   sudo systemctl restart apache2
   
   # Nginx
   sudo systemctl restart nginx
   sudo systemctl restart php8.2-fpm
   ```

4. **تحقق من صلاحيات الملفات**
   ```bash
   chmod 644 .env
   ```

## النتيجة المتوقعة

✅ جميع الصور ستستخدم الدومين الصحيح تلقائياً:
- `https://adv-line.sa/images/logo.png`
- `https://adv-line.sa/storage/restaurants/covers/image.jpg`
- `https://adv-line.sa/rest/delawa-logo.png`

✅ سيعمل نفس الكود على اللوكال والسيرفر بدون أي تعديلات إضافية

