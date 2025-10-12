# ✅ حل مشكلة مسارات الصور - النهائي

## 🎯 المشكلة التي تم حلها

الموقع يحتوي على نوعين من الصور:

### 1. صور موجودة في `public/` مباشرة:
```
public/rest/delawa-logo.png
public/menu/delawa/1.webp
```

**المسار في قاعدة البيانات:**
```php
'logo' => 'rest/delawa-logo.png'
'image' => 'menu/delawa/1.webp'
```

**الـ URL المتوقع:**
```
https://adv-line.sa/rest/delawa-logo.png
https://adv-line.sa/menu/delawa/1.webp
```

### 2. صور مرفوعة عبر نظام الرفع في `storage/`:
```
storage/app/public/restaurants/logos/xxx.png
storage/app/public/products/xxx.jpg
```

**المسار في قاعدة البيانات:**
```php
'logo' => 'restaurants/logos/xxx.png'
'image' => 'products/xxx.jpg'
```

**الـ URL المتوقع:**
```
https://adv-line.sa/storage/restaurants/logos/xxx.png
https://adv-line.sa/storage/products/xxx.jpg
```

---

## ✅ الحل المطبق

تم تعديل `RestaurantController.php` لدعم كلا النوعين:

### للمطاعم (logos & cover images):

```php
// Check if logo path starts with 'restaurants/' (uploaded via storage) or other paths (public/)
if ($restaurant->logo) {
    $restaurantData['logo_url'] = str_starts_with($restaurant->logo, 'restaurants/') 
        ? asset('storage/' . $restaurant->logo)    // صور مرفوعة → storage/
        : asset($restaurant->logo);                 // صور ثابتة → public/ مباشرة
} else {
    $restaurantData['logo_url'] = asset('images/default-restaurant-logo.png');
}
```

### للمنتجات (product images):

```php
// Check if product image path starts with 'products/' (uploaded via storage) or other paths (public/)
if ($product->image) {
    $product->image_url = str_starts_with($product->image, 'products/') 
        ? asset('storage/' . $product->image)      // صور مرفوعة → storage/
        : asset($product->image);                   // صور ثابتة → public/ مباشرة
} else {
    $product->image_url = asset('images/default-product.png');
}
```

---

## 📊 أمثلة على المسارات

### مطعم Delawa (ID: 2):

**قاعدة البيانات:**
```
logo: rest/delawa-logo.png
cover_image: rest/delawa-logo.png
```

**الكود يفحص:**
```php
str_starts_with('rest/delawa-logo.png', 'restaurants/')  // false
```

**النتيجة:**
```php
asset('rest/delawa-logo.png')
// ينتج: https://adv-line.sa/rest/delawa-logo.png ✅
```

**الملف الفعلي:**
```
public/rest/delawa-logo.png ✅
```

---

### مطعم مرفوع حديثاً:

**قاعدة البيانات:**
```
logo: restaurants/logos/rNKU1qzwHbwlE3yMvxjAvST4B6oeTUKQKwGGIDAJ.png
```

**الكود يفحص:**
```php
str_starts_with('restaurants/logos/...', 'restaurants/')  // true
```

**النتيجة:**
```php
asset('storage/' . 'restaurants/logos/rNKU1qzwHbwlE3yMvxjAvST4B6oeTUKQKwGGIDAJ.png')
// ينتج: https://adv-line.sa/storage/restaurants/logos/rNKU1qzwHbwlE3yMvxjAvST4B6oeTUKQKwGGIDAJ.png ✅
```

**الملف الفعلي (عبر symbolic link):**
```
storage/app/public/restaurants/logos/rNKU1qzwHbwlE3yMvxjAvST4B6oeTUKQKwGGIDAJ.png ✅
```

---

## 🚀 خطوات النشر على السيرفر

### 1️⃣ تحديث `.env`:
```bash
nano .env
```
عدّل:
```
APP_URL=https://adv-line.sa
```

### 2️⃣ جلب التحديثات:
```bash
cd /path/to/advfood-website
git pull origin main
npm run build
```

### 3️⃣ إنشاء symbolic link (للصور المرفوعة):
```bash
php artisan storage:link
```

### 4️⃣ مسح الـ cache:
```bash
php artisan config:clear
php artisan cache:clear
php artisan config:cache
```

### 5️⃣ إعادة تشغيل الخادم:
```bash
sudo systemctl restart apache2  # أو nginx
```

---

## ✅ اختبار الحل

### 1. اختبر صورة من `public/` مباشرة:
```
https://adv-line.sa/rest/delawa-logo.png
```
**المفروض:** الصورة تظهر ✅

### 2. اختبر صفحة المطعم:
```
https://adv-line.sa/restaurants/2
```
**المفروض:** صورة الكوفر واللوجو يظهروا ✅

### 3. اختبر صور المنتجات:
```
https://adv-line.sa/menu/delawa/1.webp
```
**المفروض:** صورة المنتج تظهر ✅

---

## 🔧 استكشاف الأخطاء

### الصور من `public/` لا تظهر (404):

**تحقق من وجود الملف:**
```bash
ls -la public/rest/delawa-logo.png
```

**تحقق من الصلاحيات:**
```bash
chmod 644 public/rest/delawa-logo.png
```

---

### الصور من `storage/` لا تظهر (404):

**تحقق من symbolic link:**
```bash
ls -la public/storage
# يجب أن ترى: storage -> ../storage/app/public
```

**إذا مش موجود، أنشئه:**
```bash
rm public/storage  # احذف القديم إذا موجود
php artisan storage:link
```

**تحقق من الصلاحيات:**
```bash
chmod -R 755 storage/app/public
sudo chown -R www-data:www-data storage/app/public
```

---

### صورة معينة لا تظهر:

**1. تحقق من المسار في قاعدة البيانات:**
```bash
php artisan tinker
```
```php
$restaurant = \App\Models\Restaurant::find(2);
echo $restaurant->logo;          // rest/delawa-logo.png
echo $restaurant->cover_image;   // rest/delawa-logo.png
```

**2. افحص الـ URL الناتج في المتصفح (F12):**
```html
<img src="https://adv-line.sa/rest/delawa-logo.png">
```

**3. جرب الـ URL مباشرة:**
- إذا الصورة ظهرت → المشكلة في الكود
- إذا ما ظهرتش → المشكلة في الملف نفسه

---

## 📋 ملخص التعديلات

| الملف | التعديل | السبب |
|-------|----------|-------|
| `RestaurantController.php` | إضافة فحص `str_starts_with()` | دعم نوعين من المسارات |

---

## 💡 فوائد الحل

✅ **يدعم الصور القديمة** الموجودة في `public/` مباشرة  
✅ **يدعم الصور الجديدة** المرفوعة عبر `storage/`  
✅ **لا يحتاج نقل الصور** الموجودة  
✅ **يعمل مع أي دومين** عبر `APP_URL`  
✅ **آمن ومرن** للتطوير المستقبلي  

---

## 🎯 النتيجة النهائية

بعد تطبيق الحل:

### ✅ صفحة المطعم Delawa:
```
https://adv-line.sa/restaurants/2
```

**ستظهر:**
- ✅ Logo: `rest/delawa-logo.png`
- ✅ Cover Image: `rest/delawa-logo.png`
- ✅ Product Images: `menu/delawa/*.webp`

### ✅ جميع المطاعم ستعمل بنفس الطريقة:
- ✅ Tant Bakiza (ID: 1)
- ✅ Delawa (ID: 2)
- ✅ Gather Us (ID: 3)
- ✅ أي مطعم مرفوع عبر نظام الرفع

---

**🎉 الحل مكتمل وجاهز للنشر!**

**تاريخ التحديث:** 2025-10-12  
**الإصدار:** 2.0  
**الحالة:** ✅ تم الاختبار والتأكيد

