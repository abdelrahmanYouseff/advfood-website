# Quick Start - اختبار الدفع عبر Noon

## ✅ تم التكامل بنجاح!

---

## خطوات الاختبار السريع

### 1️⃣ تشغيل الخادم
```bash
cd /Applications/XAMPP/xamppfiles/htdocs/advfood-website
php artisan serve
```

### 2️⃣ افتح المتصفح
```
http://127.0.0.1:8000/checkout/1
```

### 3️⃣ املأ النموذج
- **الاسم**: أي اسم
- **رقم الهاتف**: 0501234567
- **العنوان**: أي عنوان

### 4️⃣ اضغط "تأكيد الطلب"
سيتم توجيهك تلقائياً إلى صفحة الدفع الخاصة بـ Noon

### 5️⃣ استخدم بطاقة اختبار

**للدفع الناجح:**
```
Card Number: 4111 1111 1111 1111
Expiry: 12/25
CVV: 123
Name: Test User
```

**للدفع الفاشل:**
```
Card Number: 4000 0000 0000 0002
Expiry: 12/25
CVV: 123
Name: Test User
```

---

## المتغيرات الحالية في .env

```env
NOON_PAYMENT_MODE=test
NOON_APP_ID=adv-food
NOON_API_KEY=7726cb7587c645c39b8f30059c353dd9
NOON_BUSINESS_ID=adv_food
```

---

## مراقبة السجلات (Logs)

في terminal جديد، نفذ:
```bash
cd /Applications/XAMPP/xamppfiles/htdocs/advfood-website
tail -f storage/logs/laravel.log
```

ستشاهد:
- طلب الدفع إلى Noon
- رد Noon API
- عملية التوجيه
- نتيجة callback

---

## تدفق العملية

```
1. المستخدم يدخل على /checkout/1
   ↓
2. يملأ بيانات الطلب
   ↓
3. يضغط "تأكيد الطلب"
   ↓
4. النظام يُنشئ طلب في DB
   ↓
5. النظام يرسل request لـ Noon API
   ↓
6. Noon يرد بـ checkout URL
   ↓
7. توجيه المستخدم لصفحة Noon
   ↓
8. المستخدم يدفع
   ↓
9. Noon يُعيد المستخدم لـ /payment-callback/{order_id}
   ↓
10. النظام يتحقق من حالة الدفع
   ↓
11a. نجح → /order-success/{order_id}
11b. فشل → /payment-failed/{order_id}
```

---

## Routes المتاحة

```
GET  /checkout/1                  → صفحة الطلب
POST /customer-orders             → إرسال الطلب وإنشاء الدفع
GET  /payment-callback/{id}       → استقبال نتيجة الدفع
GET  /order-success/{id}          → صفحة النجاح
GET  /payment-failed/{id}         → صفحة الفشل
```

---

## التحقق من نجاح التكامل

### ✅ علامات النجاح:

1. **بعد الضغط على "تأكيد الطلب":**
   - يظهر loading
   - يتم التوجيه لصفحة Noon

2. **في صفحة Noon:**
   - شعار موقعك يظهر
   - المبلغ الصحيح معروض
   - معلومات الطلب صحيحة

3. **بعد الدفع:**
   - يتم التوجيه لصفحة النجاح/الفشل
   - حالة الطلب في DB محدثة

### ❌ علامات وجود مشكلة:

1. رسالة خطأ "فشل في إنشاء عملية الدفع"
   → تحقق من API Key في .env

2. صفحة بيضاء
   → افحص `storage/logs/laravel.log`

3. لا يتم التوجيه
   → نفذ `php artisan config:clear && php artisan route:cache`

---

## أوامر مفيدة

```bash
# تنظيف الـ cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# إعادة بناء cache
php artisan config:cache
php artisan route:cache

# مراقبة السجلات
tail -f storage/logs/laravel.log

# فحص قاعدة البيانات
php artisan tinker
>>> CustomerOrder::latest()->first()
>>> CustomerOrder::where('payment_status', 'paid')->count()
```

---

## التأكد من البيانات في DB

```bash
php artisan tinker
```

ثم:
```php
// آخر طلب
$order = \App\Models\CustomerOrder::latest()->first();

// معلومات الطلب
$order->order_number
$order->payment_status    // pending, paid, failed
$order->noon_order_id     // ID من Noon
$order->total             // المبلغ

// عدد الطلبات المدفوعة
\App\Models\CustomerOrder::where('payment_status', 'paid')->count()
```

---

## التحويل إلى Production

عندما تكون جاهزاً للنشر:

### 1. في `.env`:
```env
NOON_PAYMENT_MODE=live
NOON_APP_ID=your-live-app-id
NOON_API_KEY=your-live-api-key
NOON_BUSINESS_ID=your-live-business-id
```

### 2. تنظيف الـ cache:
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:cache
php artisan config:cache
```

### 3. اختبار على Production

---

## الدعم

### ملفات التوثيق:
- `NOON_PAYMENT_INTEGRATION.md` - توثيق تفصيلي كامل
- `NOON_PAYMENT_GUIDE_AR.md` - دليل بالعربية
- هذا الملف - دليل سريع

### تتبع الأخطاء:
- `storage/logs/laravel.log` - سجل Laravel
- Developer Console في المتصفح - أخطاء JavaScript

### تواصل مع Noon:
- [Noon Docs](https://docs.noonpayments.com)
- [Noon Support](https://noonpayments.com/support)

---

## 🎉 خلاص! جاهز للاختبار

افتح المتصفح على:
```
http://127.0.0.1:8000/checkout/1
```

وجرب الدفع!


