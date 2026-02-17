# إصلاح صور المطاعم على السيرفر

إذا كانت صورة الغلاف (أو أي صور أخرى) تظهر مكسورة على السيرفر، تحقق من التالي:

## 0. التأكد من وجود مجلد الصور الافتراضية

**مهم:** مجلد `public/images/` يجب أن يحتوي على الملفات:
- `default-restaurant-cover.png`
- `default-restaurant-logo.png`
- `default-product.png`

```bash
ls -la public/images/
```

إذا لم توجد، انسخها من المشروع المحلي أو من Git.

## 1. إنشاء رابط التخزين (مهم جداً)

الصور المرفوعة من لوحة التحكم تُحفظ في `storage/app/public/`. لعرضها يجب إنشاء رابط رمزي:

```bash
php artisan storage:link
```

إذا ظهر "link already exists" وتحقق أن الرابط معطل:
```bash
rm public/storage
php artisan storage:link
```

## 2. التحقق من ملف .env

```env
APP_URL=https://adv-line.sa
```

**مهم:** استخدم `https://` إذا كان الموقع يعمل على HTTPS. بعد التعديل:
```bash
php artisan config:clear
```

## 3. صلاحيات المجلدات

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## 4. تشخيص صورة الغلاف للمطعم 2

```bash
php artisan tinker --execute="
\$r = App\Models\Restaurant::find(2);
echo 'cover_image في DB: ' . (\$r->cover_image ?? 'null') . PHP_EOL;
echo 'الملف موجود؟ ' . (file_exists(storage_path('app/public/' . \$r->cover_image)) ? 'نعم' : 'لا') . PHP_EOL;
"
```

## 5. اختبار الرابط المباشر

افتح في المتصفح:
- `https://adv-line.sa/images/default-restaurant-cover.png`
- `https://adv-line.sa/storage/restaurants/covers/اسم_الملف.jpg` (استبدل باسم الملف من قاعدة البيانات)

إذا ظهر 404، الملف غير موجود أو المسار خاطئ.
