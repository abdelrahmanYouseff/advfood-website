# ✅ إصلاح مشكلة الصور - الحل الكامل

## المشكلة الأصلية
الصور كانت تظهر في اللوكال (`http://127.0.0.1:8000`) لكن لا تظهر على السيرفر (`https://adv-line.sa`)

## السبب
كان هناك URLs ثابتة (hardcoded) في الكود تشير إلى `http://127.0.0.1:8000` و `http://127.0.0.1:8002`

---

## ✅ التغييرات التي تمت

### 1. تحديث ملفات PHP (Backend)

#### `app/Http/Controllers/RestaurantController.php`
تم تغيير:
```php
// ❌ قبل
$restaurantData['logo_url'] = $restaurant->logo ? 'http://127.0.0.1:8000/' . ltrim($restaurant->logo, '/') : asset('images/default-restaurant-logo.png');
$restaurantData['cover_image_url'] = $restaurant->cover_image ? 'http://127.0.0.1:8000/' . ltrim($restaurant->cover_image, '/') : asset('images/default-restaurant-cover.png');

$product->image_url = $product->image ? 'http://127.0.0.1:8000/' . ltrim($product->image, '/') : asset('images/default-product.png');
```

إلى:
```php
// ✅ بعد
$restaurantData['logo_url'] = $restaurant->logo ? asset('storage/' . $restaurant->logo) : asset('images/default-restaurant-logo.png');
$restaurantData['cover_image_url'] = $restaurant->cover_image ? asset('storage/' . $restaurant->cover_image) : asset('images/default-restaurant-cover.png');

$product->image_url = $product->image ? asset('storage/' . $product->image) : asset('images/default-product.png');
```

### 2. تحديث ملفات Vue (Frontend)

تم تحديث جميع الملفات التالية لاستخدام مسارات نسبية بدلاً من URLs ثابتة:

#### ✅ `resources/js/components/AppLogo.vue`
```vue
<!-- ❌ قبل -->
<img :src="`http://127.0.0.1:8002/images/gatherus-logo-new.png?v=${Date.now()}`" />

<!-- ✅ بعد -->
<img :src="`/images/gatherus-logo-new.png?v=${Date.now()}`" />
```

#### ✅ `resources/js/components/AppLogoIcon.vue`
```vue
<!-- ❌ قبل -->
<img :src="`http://127.0.0.1:8002/images/gatherus-logo-new.png?v=${Date.now()}`" />

<!-- ✅ بعد -->
<img :src="`/images/gatherus-logo-new.png?v=${Date.now()}`" />
```

#### ✅ `resources/js/pages/Admin/Login.vue`
```vue
<!-- ❌ قبل -->
<img src="http://127.0.0.1:8002/images/gatherus-logo-new.png" />

<!-- ✅ بعد -->
<img src="/images/gatherus-logo-new.png" />
```

#### ✅ `resources/js/pages/auth/Register.vue`
```vue
<!-- ❌ قبل -->
<img src="http://127.0.0.1:8002/images/gatherus-logo-new.png" />

<!-- ✅ بعد -->
<img src="/images/gatherus-logo-new.png" />
```

#### ✅ `resources/js/pages/auth/Login.vue`
```vue
<!-- ❌ قبل -->
<img src="http://127.0.0.1:8002/images/gatherus-logo-new.png" />

<!-- ✅ بعد -->
<img src="/images/gatherus-logo-new.png" />
```

#### ✅ `resources/js/pages/Cart/Index.vue`
```vue
<!-- ❌ قبل -->
<img src="http://127.0.0.1:8002/images/gatherus-logo-new.png" />

<!-- ✅ بعد -->
<img src="/images/gatherus-logo-new.png" />
```

#### ✅ `resources/js/pages/Restaurants/Index.vue`
```vue
<!-- ❌ قبل -->
<img src="http://127.0.0.1:8002/images/gatherus-logo-new.png" />

<!-- ✅ بعد -->
<img src="/images/gatherus-logo-new.png" />
```

---

## 🚀 خطوات النشر على السيرفر

### 1️⃣ تحديث ملف `.env` على السيرفر

افتح ملف `.env` على السيرفر وعدّل الإعدادات التالية:

```bash
APP_NAME="AdvFood"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://adv-line.sa

# لا تضع / في نهاية URL
```

### 2️⃣ رفع التحديثات للسيرفر

```bash
# من جهازك المحلي
git add .
git commit -m "Fix image URLs to work with production domain"
git push origin main
```

### 3️⃣ على السيرفر، نفذ الأوامر التالية:

```bash
# جلب آخر التحديثات
cd /path/to/advfood-website
git pull origin main

# تثبيت الـ dependencies إذا تغيرت
composer install --no-dev --optimize-autoloader
npm install
npm run build

# إنشاء symbolic link للصور (مهم جداً!)
php artisan storage:link

# مسح الـ cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# إعادة بناء الـ cache للإنتاج
php artisan config:cache
php artisan route:cache
php artisan view:cache

# ضبط الصلاحيات
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 755 public/storage

# ضبط الملكية (اختر المناسب لسيرفرك)
# للـ Ubuntu/Debian:
sudo chown -R www-data:www-data storage bootstrap/cache public/storage

# أو للـ CentOS/RHEL:
# sudo chown -R apache:apache storage bootstrap/cache public/storage

# أو للـ Nginx:
# sudo chown -R nginx:nginx storage bootstrap/cache public/storage
```

### 4️⃣ إعادة تشغيل الخدمات

```bash
# للـ Apache
sudo systemctl restart apache2

# أو للـ Nginx + PHP-FPM
sudo systemctl restart nginx
sudo systemctl restart php8.2-fpm  # عدّل رقم الإصدار حسب سيرفرك
```

---

## 🧪 التحقق من الحل

### 1. تحقق من الإعدادات:
```bash
php artisan config:show app.url
# يجب أن يظهر: https://adv-line.sa
```

### 2. تحقق من symbolic link:
```bash
ls -la public/storage
# يجب أن ترى: storage -> ../storage/app/public
```

### 3. تحقق من الصور في المتصفح:
- افتح: `https://adv-line.sa/restaurants/2`
- افتح Developer Tools (F12)
- افحص عنصر الصورة
- يجب أن ترى:
  ```html
  <img src="https://adv-line.sa/storage/restaurants/covers/image.jpg">
  ```

---

## 📝 كيف يعمل الحل؟

### المسارات النسبية في Vue
```vue
<!-- المسار النسبي -->
<img src="/images/logo.png" />
```
سيتحول تلقائياً إلى:
- في اللوكال: `http://127.0.0.1:8000/images/logo.png`
- في السيرفر: `https://adv-line.sa/images/logo.png`

### دالة `asset()` في Laravel
```php
asset('storage/image.jpg')
```
تستخدم قيمة `APP_URL` من `.env` تلقائياً:
- في اللوكال (`.env`): `http://127.0.0.1:8000/storage/image.jpg`
- في السيرفر (`.env`): `https://adv-line.sa/storage/image.jpg`

---

## 🎯 النتيجة

✅ جميع الصور ستعمل على:
- اللوكال: `http://127.0.0.1:8000`
- السيرفر: `https://adv-line.sa`

✅ لا حاجة لتعديل الكود عند النقل بين البيئات

✅ نفس الكود يعمل في كل مكان

---

## 🔍 استكشاف الأخطاء

### الصور لا تزال لا تظهر؟

#### 1. تحقق من الـ symbolic link:
```bash
# حذف الـ link القديم
rm public/storage

# إنشاء link جديد
ln -s ../storage/app/public public/storage

# أو استخدم artisan
php artisan storage:link
```

#### 2. تحقق من وجود الصور:
```bash
ls -la storage/app/public/restaurants/covers/
```

#### 3. تحقق من `.env`:
```bash
cat .env | grep APP_URL
# يجب أن يظهر: APP_URL=https://adv-line.sa
```

#### 4. امسح كل أنواع الـ cache:
```bash
php artisan optimize:clear
php artisan config:cache
```

#### 5. تحقق من صلاحيات Apache/Nginx:
```bash
# تأكد من أن Apache/Nginx يمكنه قراءة المجلدات
namei -l storage/app/public/restaurants/covers/
```

#### 6. تحقق من error logs:
```bash
# Laravel logs
tail -f storage/logs/laravel.log

# Apache logs
tail -f /var/log/apache2/error.log

# Nginx logs
tail -f /var/log/nginx/error.log
```

---

## 📋 ملخص التغييرات

| الملف | التغيير | الحالة |
|-------|----------|--------|
| `RestaurantController.php` | استخدام `asset()` بدل URL ثابت | ✅ |
| `AppLogo.vue` | مسار نسبي | ✅ |
| `AppLogoIcon.vue` | مسار نسبي | ✅ |
| `Admin/Login.vue` | مسار نسبي | ✅ |
| `auth/Register.vue` | مسار نسبي | ✅ |
| `auth/Login.vue` | مسار نسبي | ✅ |
| `Cart/Index.vue` | مسار نسبي | ✅ |
| `Restaurants/Index.vue` | مسار نسبي (صورتان) | ✅ |

**إجمالي الملفات المعدلة:** 8 ملفات  
**إجمالي التغييرات:** 10 تغييرات

---

## 💡 نصائح للمستقبل

1. ✅ **دائماً استخدم `asset()` في Laravel** للصور والملفات الثابتة
2. ✅ **دائماً استخدم مسارات نسبية في Vue** بدلاً من URLs مطلقة
3. ✅ **لا تضع URLs ثابتة في الكود** - استخدم المتغيرات والإعدادات
4. ✅ **تأكد من `APP_URL` صحيح** في ملف `.env` لكل بيئة
5. ✅ **استخدم `php artisan storage:link`** بعد رفع الموقع لأول مرة

---

## 📞 الدعم

إذا واجهت أي مشاكل:
1. تحقق من ملف `DOMAIN_SETUP.md` للتفاصيل الإضافية
2. راجع قسم "استكشاف الأخطاء" أعلاه
3. تحقق من error logs في السيرفر

---

**تاريخ التحديث:** 2025-10-12  
**الإصدار:** 1.0  
**الحالة:** ✅ مكتمل وجاهز للنشر

