# اختبار صفحة الدفع - Test Checkout

## المشكلة التي كانت موجودة ✅ تم الحل

**الخطأ:** `Malformatted credentials` - بيانات الاعتماد غير صحيحة

**الحل:** تم تصليح طريقة إرسال الـ Authorization header في `NoonPaymentService.php`

---

## خطوات الاختبار الكاملة

### 1️⃣ تأكد من وجود منتجات

```bash
# افتح terminal
cd /Applications/XAMPP/xamppfiles/htdocs/advfood-website
php artisan tinker
```

ثم نفذ:
```php
// تحقق من وجود منتجات للمطعم 1
$products = App\Models\Product::where('restaurant_id', 1)->get();
echo "Products count: " . $products->count() . PHP_EOL;

// إذا لم يكن هناك منتجات، أضف منتج تجريبي:
if ($products->count() == 0) {
    App\Models\Product::create([
        'restaurant_id' => 1,
        'name' => 'منتج تجريبي',
        'description' => 'وصف المنتج',
        'price' => 50.00,
        'is_available' => true
    ]);
    echo "Product created!" . PHP_EOL;
}

// اطبع أول منتج
$product = App\Models\Product::where('restaurant_id', 1)->first();
echo "Product ID: " . $product->id . PHP_EOL;
echo "Product Name: " . $product->name . PHP_EOL;
echo "Product Price: " . $product->price . PHP_EOL;

exit
```

### 2️⃣ أضف منتج للـ Cart

افتح **Developer Console** في المتصفح (F12) واكتب:

```javascript
// تنظيف الـ cart أولاً
localStorage.removeItem('cart');

// إضافة منتج تجريبي (استبدل 1 برقم المنتج الفعلي)
const cart = [{
    id: 1,  // ID المنتج من الخطوة السابقة
    name: 'منتج تجريبي',
    price: 50,
    quantity: 2,
    restaurant_id: 1,
    image_url: '/images/default-product.png'
}];

localStorage.setItem('cart', JSON.stringify(cart));
console.log('Cart added:', cart);

// تحقق من الـ cart
console.log('Current cart:', JSON.parse(localStorage.getItem('cart')));
```

### 3️⃣ افتح صفحة Checkout

```
http://127.0.0.1:8000/checkout/1
```

### 4️⃣ املأ البيانات

- **الاسم**: عبدالرحمن
- **رقم الهاتف**: 0535815072
- **العنوان**: أي عنوان تجريبي

### 5️⃣ اضغط "تأكيد الطلب"

يجب أن يحدث:
1. Loading spinner يظهر
2. طلب يُرسل إلى `/customer-orders`
3. يتم التواصل مع Noon API
4. **إما:**
   - ✅ يتم التوجيه لصفحة الدفع
   - ❌ تظهر رسالة خطأ

### 6️⃣ تابع السجلات

في terminal آخر:
```bash
cd /Applications/XAMPP/xamppfiles/htdocs/advfood-website
tail -f storage/logs/laravel.log
```

---

## الطريقة الأسهل - استخدم صفحة المطعم

بدلاً من إضافة منتجات يدوياً:

### 1. افتح صفحة المطعم:
```
http://127.0.0.1:8000/restaurants/1
```

### 2. أضف منتجات إلى السلة من الصفحة

### 3. اضغط على "Checkout" أو "إتمام الطلب"

---

## ماذا تتوقع؟

### إذا نجح:
```
✅ يظهر loading
✅ في السجل: "Noon Payment Request"
✅ في السجل: "Noon Payment Response" مع status 200
✅ في السجل: "Redirecting to Noon payment page"
✅ يتم التوجيه لصفحة دفع Noon
```

### إذا فشل:
```
❌ رسالة خطأ في الصفحة
❌ في السجل: خطأ من Noon API
❌ تحقق من:
    - NOON_API_KEY صحيح في .env
    - الـ cart ليس فارغاً
    - البيانات المدخلة صحيحة
```

---

## مثال على تشغيل كامل:

```bash
# Terminal 1: شغل السيرفر
cd /Applications/XAMPP/xamppfiles/htdocs/advfood-website
php artisan serve

# Terminal 2: تابع السجلات
cd /Applications/XAMPP/xamppfiles/htdocs/advfood-website
tail -f storage/logs/laravel.log

# Terminal 3: افحص قاعدة البيانات
cd /Applications/XAMPP/xamppfiles/htdocs/advfood-website
php artisan tinker
>>> App\Models\CustomerOrder::latest()->first()
>>> exit

# المتصفح:
# 1. افتح http://127.0.0.1:8000/restaurants/1
# 2. أضف منتجات
# 3. اضغط Checkout
# 4. املأ البيانات
# 5. اضغط تأكيد
```

---

## Debug إذا لم يعمل:

### 1. افحص الـ Console في المتصفح (F12)
```javascript
// تحقق من الـ cart
console.log(localStorage.getItem('cart'))

// إذا كان null أو [], الـ cart فارغ!
```

### 2. افحص السجل:
```bash
tail -50 storage/logs/laravel.log
```

### 3. افحص الـ Network Tab
- شوف الـ request إلى `/customer-orders`
- شوف الـ response
- إذا كان error 500، افحص السجل

---

## بطاقات الاختبار في Noon:

بعد ما توصل لصفحة الدفع، استخدم:

**للدفع الناجح:**
```
Card: 4111 1111 1111 1111
Expiry: 12/25
CVV: 123
Name: Test User
```

**للدفع الفاشل:**
```
Card: 4000 0000 0000 0002
Expiry: 12/25
CVV: 123
Name: Test User
```

---

## ملخص الإصلاحات:

✅ تم تصليح Authorization header في NoonPaymentService  
✅ تم تنظيف الـ cache  
✅ تم التأكد من وجود المطعم رقم 1  

**الآن جرب مرة أخرى!** 🚀



