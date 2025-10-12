# دليل تكامل بوابة الدفع Noon - ADVFood

## تم بنجاح! ✅

تم تكامل بوابة الدفع Noon في موقعك. الآن عندما يضغط المستخدم على "تأكيد الطلب" في صفحة `/checkout/{restaurant_id}` سيتم توجيهه إلى صفحة الدفع الخاصة بـ Noon.

---

## الإعدادات الحالية في ملف .env

البيانات التالية موجودة في ملف `.env`:

```env
NOON_API_KEY=7726cb7587c645c39b8f30059c353dd9
NOON_API_URL=https://api-test.sa.noonpayments.com
NOON_SUCCESS_URL=https://advfoodapp.clarastars.com/payment-success
NOON_FAILURE_URL=https://advfoodapp.clarastars.com/payment-failed
NOON_APPLICATION_ID=adv-food
NOON_BUSINESS_ID=adv_food
NOON_PAYMENT_MODE=test
NOON_APP_ID=adv-food
```

---

## كيف يعمل النظام؟

### 1️⃣ صفحة الطلب (Checkout)
- المستخدم يزور `/checkout/1` (حيث 1 هو رقم المطعم)
- يملأ بياناته (الاسم، الهاتف، العنوان)
- يضغط على "تأكيد الطلب"

### 2️⃣ إنشاء طلب الدفع
- يتم إنشاء طلب في قاعدة البيانات
- يتم التواصل مع Noon API لإنشاء طلب دفع
- يحصل النظام على رابط صفحة الدفع من Noon

### 3️⃣ التوجيه للدفع
- يتم توجيه المستخدم إلى صفحة الدفع الخاصة بـ Noon
- المستخدم يدخل بيانات بطاقته الائتمانية
- Noon يقوم بمعالجة الدفع

### 4️⃣ العودة بعد الدفع
- إذا نجح الدفع: يتم التوجيه إلى `/order-success/{order_id}`
- إذا فشل الدفع: يتم التوجيه إلى `/payment-failed/{order_id}`

---

## تجربة النظام (Test Mode)

### بطاقات اختبار:

**✅ للدفع الناجح:**
```
رقم البطاقة: 4111 1111 1111 1111
تاريخ الانتهاء: 12/25
CVV: 123
```

**❌ للدفع الفاشل:**
```
رقم البطاقة: 4000 0000 0000 0002
تاريخ الانتهاء: 12/25
CVV: 123
```

---

## خطوات التفعيل

### ✅ تم بالفعل:
1. ✓ إنشاء `NoonPaymentService` للتعامل مع API
2. ✓ تحديث `CustomerOrderController`
3. ✓ إضافة routes للـ callback
4. ✓ إضافة حقول الدفع في قاعدة البيانات
5. ✓ إضافة إعدادات Noon في `config/services.php`
6. ✓ إنشاء صفحة `PaymentFailed.vue`

### 📝 ما تحتاج تعمله:

#### 1. تأكد من البيانات في `.env`
البيانات موجودة بالفعل! لكن تأكد أنها صحيحة:
- `NOON_API_KEY` - المفتاح الخاص بك من Noon
- `NOON_APP_ID` - معرف التطبيق
- `NOON_BUSINESS_ID` - معرف العمل

#### 2. اختبر النظام
```bash
# افتح المتصفح وادخل على:
http://127.0.0.1:8000/checkout/1

# املأ البيانات واضغط "تأكيد الطلب"
# استخدم بطاقة الاختبار أعلاه
```

#### 3. عند الانتقال للـ Production
غير `NOON_PAYMENT_MODE` في `.env` من `test` إلى `live`:
```env
NOON_PAYMENT_MODE=live
```

---

## ملفات تم تعديلها/إنشاؤها

### PHP/Laravel:
1. `app/Services/NoonPaymentService.php` ✨ جديد
2. `app/Http/Controllers/CustomerOrderController.php` 🔄 محدث
3. `app/Models/CustomerOrder.php` 🔄 محدث
4. `config/services.php` 🔄 محدث
5. `routes/web.php` 🔄 محدث
6. `database/migrations/2025_10_12_051905_add_payment_fields_to_customer_orders_table.php` ✨ جديد

### Vue.js:
1. `resources/js/pages/PaymentFailed.vue` ✨ جديد

### Configuration:
1. `.env` 🔄 محدث
2. `.env.example` 🔄 محدث

---

## Routes الجديدة

```php
GET  /checkout/{restaurant}           - صفحة الطلب
POST /customer-orders                 - إنشاء طلب وتوجيه للدفع
GET  /payment-callback/{order}        - callback من Noon
GET  /payment-failed/{order}          - صفحة فشل الدفع
GET  /order-success/{order}           - صفحة نجاح الطلب
```

---

## استكشاف الأخطاء

### 🔴 المشكلة: "فشل في إنشاء عملية الدفع"
**الحل:**
```bash
# تأكد من صحة البيانات في .env
# تأكد من تشغيل:
php artisan config:clear
php artisan cache:clear
```

### 🔴 المشكلة: لا يتم التوجيه للدفع
**الحل:**
```bash
# نظف الـ routes cache:
php artisan route:clear
php artisan route:cache
```

### 🔴 المشكلة: خطأ في قاعدة البيانات
**الحل:**
```bash
# نفذ الـ migrations:
php artisan migrate
```

---

## فحص السجلات (Logs)

إذا حدث أي خطأ، افحص ملف السجل:
```bash
tail -f storage/logs/laravel.log
```

---

## الدعم والمساعدة

### 📚 التوثيق:
- [Noon Payments Docs](https://docs.noonpayments.com)
- ملف `NOON_PAYMENT_INTEGRATION.md` في المشروع

### 🔍 تتبع المشاكل:
- افحص `storage/logs/laravel.log` للأخطاء
- استخدم `dd()` أو `Log::info()` لتتبع البيانات

---

## ملاحظات أمنية ⚠️

1. **لا تشارك** `NOON_API_KEY` مع أحد
2. **احتفظ** بملف `.env` خارج نظام Git
3. **استخدم** HTTPS في Production
4. **اختبر** بشكل كامل في Test Mode أولاً

---

## الخطوات التالية 🚀

### 1. اختبار شامل
- جرب عملية الدفع الكاملة
- اختبر السيناريوهات المختلفة (نجاح/فشل)
- تأكد من تحديث حالة الطلبات بشكل صحيح

### 2. تخصيص الرسائل
- يمكنك تعديل رسائل الخطأ في `CustomerOrderController`
- يمكنك تخصيص صفحة `PaymentFailed.vue`

### 3. إضافة ميزات
- إضافة webhooks لمزيد من الموثوقية
- إضافة دعم لطرق دفع أخرى (Apple Pay, Mada)
- إضافة نظام استرجاع الأموال

---

## اتصل بنا

إذا واجهت أي مشاكل أو احتجت مساعدة:
- راجع ملف `NOON_PAYMENT_INTEGRATION.md`
- افحص السجلات في `storage/logs/laravel.log`
- راجع توثيق Noon: https://docs.noonpayments.com

---

## الخلاصة

✅ **تم التكامل بنجاح!**

الآن عندما يدوس المستخدم على "تأكيد الطلب" في `/checkout/1` سيتم:
1. إنشاء الطلب في قاعدة البيانات
2. إنشاء طلب دفع مع Noon
3. التوجيه إلى صفحة الدفع بالمبلغ المطلوب

**جرب الآن:** افتح `http://127.0.0.1:8000/checkout/1` واختبر النظام! 🎉


