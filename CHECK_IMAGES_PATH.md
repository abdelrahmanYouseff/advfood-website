# ✅ التحقق من مسارات الصور - adv-line.sa

## 📊 بيانات المسار

### المسار في قاعدة البيانات:
```
restaurants/logos/rNKU1qzwHbwlE3yMvxjAvST4B6oeTUKQKwGGIDAJ.png
```

### المسار الفعلي للملف على السيرفر:
```
storage/app/public/restaurants/logos/rNKU1qzwHbwlE3yMvxjAvST4B6oeTUKQKwGGIDAJ.png
```

### الـ URL النهائي في المتصفح:
```
https://adv-line.sa/storage/restaurants/logos/rNKU1qzwHbwlE3yMvxjAvST4B6oeTUKQKwGGIDAJ.png
```

---

## 🔗 كيف يعمل symbolic link

```
public/storage → ../storage/app/public
```

عندما تطلب المتصفح:
```
https://adv-line.sa/storage/restaurants/logos/image.png
```

يتم توجيه الطلب إلى:
```
storage/app/public/restaurants/logos/image.png
```

---

## ✅ التحقق على السيرفر

### 1. تحقق من وجود symbolic link:

```bash
cd /path/to/advfood-website
ls -la public/storage
```

**المفروض تشوف:**
```
storage -> ../storage/app/public
```

**إذا ما شفته، نفذ:**
```bash
php artisan storage:link
```

---

### 2. تحقق من وجود الملف:

```bash
ls -la storage/app/public/restaurants/logos/rNKU1qzwHbwlE3yMvxjAvST4B6oeTUKQKwGGIDAJ.png
```

**المفروض تشوف:**
```
-rw-r--r-- 1 www-data www-data 12345 Oct 12 12:00 rNKU1qzwHbwlE3yMvxjAvST4B6oeTUKQKwGGIDAJ.png
```

**إذا الملف مش موجود:**
- الصورة ممكن تكون اترفعت بس على اللوكال
- محتاج ترفعها على السيرفر يدوياً أو عن طريق rsync

---

### 3. تحقق من صلاحيات المجلد:

```bash
ls -la storage/app/public/restaurants/
```

**المفروض تشوف:**
```
drwxr-xr-x 2 www-data www-data 4096 Oct 12 12:00 logos
drwxr-xr-x 2 www-data www-data 4096 Oct 12 12:00 covers
```

**إذا الصلاحيات غلط، نفذ:**
```bash
chmod -R 755 storage/app/public/restaurants
sudo chown -R www-data:www-data storage/app/public/restaurants
```

---

### 4. تحقق من APP_URL في .env:

```bash
cat .env | grep APP_URL
```

**المفروض تشوف:**
```
APP_URL=https://adv-line.sa
```

**إذا غلط، عدّله:**
```bash
nano .env
# عدّل السطر لـ: APP_URL=https://adv-line.sa
# احفظ واطلع

# امسح الـ cache
php artisan config:clear
php artisan config:cache
```

---

## 🧪 اختبار مباشر للصورة

جرب تفتح الرابط مباشرة في المتصفح:

```
https://adv-line.sa/storage/restaurants/logos/rNKU1qzwHbwlE3yMvxjAvST4B6oeTUKQKwGGIDAJ.png
```

### ✅ إذا الصورة ظهرت:
- معناها symbolic link شغال
- المشكلة في الكود أو الـ cache
- نفذ: `php artisan cache:clear`

### ❌ إذا ظهر 404:
- symbolic link مش موجود
- نفذ: `php artisan storage:link`

### ❌ إذا ظهر 403 (Forbidden):
- مشكلة في الصلاحيات
- نفذ: `chmod -R 755 storage/app/public`

### ❌ إذا ظهر 500:
- شوف error log:
- `tail -f storage/logs/laravel.log`

---

## 📤 نقل الصور من اللوكال للسيرفر

إذا الصور موجودة على اللوكال فقط، محتاج تنقلها:

### طريقة 1: rsync (الأسرع)

```bash
# من جهازك المحلي
rsync -avz --progress \
  storage/app/public/restaurants/ \
  user@your-server.com:/path/to/advfood-website/storage/app/public/restaurants/
```

### طريقة 2: SCP

```bash
# من جهازك المحلي
scp -r storage/app/public/restaurants/logos/*.png \
  user@your-server.com:/path/to/advfood-website/storage/app/public/restaurants/logos/
```

### طريقة 3: FTP/SFTP

استخدم برنامج FileZilla أو WinSCP:
1. اتصل بالسيرفر
2. انتقل لـ: `storage/app/public/restaurants/logos/`
3. ارفع الملفات

---

## 🔄 بعد نقل الصور

```bash
# على السيرفر
cd /path/to/advfood-website

# ضبط الصلاحيات
chmod -R 755 storage/app/public/restaurants
sudo chown -R www-data:www-data storage/app/public/restaurants

# مسح الـ cache
php artisan cache:clear
```

---

## 🎯 الخلاصة

✅ **الكود صحيح 100%** - لا تحتاج تعديله

✅ **المسار صحيح** - متوافق مع قاعدة البيانات

✅ **ينقص فقط:**
1. تأكد من `storage:link` موجود
2. تأكد من الصور منقولة للسيرفر
3. تأكد من الصلاحيات صحيحة
4. تأكد من `APP_URL=https://adv-line.sa` في `.env`

---

## 📝 أوامر سريعة (All-in-One)

نفذ هذه الأوامر على السيرفر:

```bash
cd /path/to/advfood-website

# إنشاء symbolic link
php artisan storage:link

# ضبط الصلاحيات
chmod -R 755 storage/app/public
sudo chown -R www-data:www-data storage/app/public

# مسح الـ cache
php artisan config:clear
php artisan cache:clear
php artisan config:cache

# إعادة تشغيل Apache/Nginx
sudo systemctl restart apache2  # أو nginx
```

---

**🎉 بعد تنفيذ الخطوات، الصور ستعمل بشكل كامل!**

