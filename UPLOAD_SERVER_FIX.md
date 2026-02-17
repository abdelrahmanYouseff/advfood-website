# إصلاح رفع الصور على السيرفر

إذا كانت الصور تعمل محلياً ولا تُسجّل في قاعدة البيانات على السيرفر، فالسبب غالباً أن **الملف لا يصل للسيرفر** بسبب حدود PHP أو Nginx.

---

## الخطوة 1: تشخيص سريع

بعد رفع التحديثات، افتح في المتصفح:

```
https://adv-line.sa/upload-check
```

سترى نتيجة توضح:
- `upload_max_filesize` و `post_max_size`
- هل مجلد storage قابل للكتابة
- اقتراحات للإصلاح

**احذف هذا المسار بعد حل المشكلة** (أو أضف حماية بصفحة مؤقتة).

---

## الخطوة 2: تعديل حدود PHP على Laravel Forge

1. ادخل إلى **Laravel Forge** → موقعك
2. من القائمة اختر **PHP** → **Edit PHP Version** أو **PHP Configuration**
3. عدّل أو أضف في `php.ini` أو من واجهة Forge:

```ini
upload_max_filesize = 10M
post_max_size = 12M
```

**مهم:** `post_max_size` يجب أن يكون أكبر من `upload_max_filesize`.

4. احفظ التعديلات وأعد تشغيل PHP إن طُلب منك ذلك.

---

## الخطوة 3: Nginx (على Forge)

إذا استمرت المشكلة، قد يكون سببها إعدادات Nginx:

1. في Forge → الموقع → **Files** → افتح Nginx config
2. داخل `server { ... }` تأكد من وجود:

```nginx
client_max_body_size 20M;
```

3. احفظ وأعد تشغيل Nginx.

---

## الخطوة 4: التحقق من السجلات

بعد محاولة رفع صورة:

```bash
tail -20 storage/logs/laravel.log
```

إذا ظهر: `Product create: no image file received` أو `Product update: large request but no image received` فهذا يعني أن الملف لم يصل بسبب حدود الطلب.

---

## الخطوة 5: صلاحيات التخزين

```bash
chmod -R 775 storage bootstrap/cache
chown -R forge:forge storage bootstrap/cache
```
