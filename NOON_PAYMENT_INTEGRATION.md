# Noon Payment Gateway Integration

## نظرة عامة
تم تكامل بوابة الدفع Noon في موقع ADVFood للتعامل مع الدفعات الإلكترونية بشكل آمن.

## الملفات المضافة/المعدلة

### 1. Service Layer
- **`app/Services/NoonPaymentService.php`**: خدمة للتعامل مع Noon Payment API
  - إنشاء طلب دفع
  - التحقق من حالة الدفع
  - التعامل مع callback

### 2. Controller
- **`app/Http/Controllers/CustomerOrderController.php`**: تم تحديثه لدعم الدفع
  - إضافة `store()` method لإنشاء طلب وتوجيه للدفع
  - إضافة `paymentCallback()` للتحقق من نتيجة الدفع
  - إضافة `paymentFailed()` لعرض صفحة فشل الدفع

### 3. Model
- **`app/Models/CustomerOrder.php`**: إضافة حقول الدفع
  - order_number
  - payment_status
  - noon_order_id
  - payment_data
  - customer_email

### 4. Migration
- **`database/migrations/2025_10_12_051905_add_payment_fields_to_customer_orders_table.php`**

### 5. Routes
- **`routes/web.php`**: إضافة routes جديدة
  - `/payment-callback/{order}` - للتحقق من نتيجة الدفع
  - `/payment-failed/{order}` - لعرض صفحة فشل الدفع

### 6. Views
- **`resources/js/pages/PaymentFailed.vue`**: صفحة جديدة لعرض فشل الدفع

### 7. Configuration
- **`config/services.php`**: إضافة إعدادات Noon

## المتغيرات البيئية المطلوبة

أضف هذه المتغيرات إلى ملف `.env`:

```env
# Noon Payment Gateway
NOON_PAYMENT_MODE=test          # test أو live
NOON_APP_ID=your-app-id         # معرف التطبيق من Noon
NOON_API_KEY=your-api-key       # API Key من Noon
NOON_BUSINESS_ID=your-business-id  # معرف العمل من Noon
```

## كيفية الاستخدام

### 1. الحصول على بيانات الاعتماد من Noon
- قم بالتسجيل في [Noon Payments](https://noonpayments.com)
- احصل على API Key و Application ID من لوحة التحكم
- ضع البيانات في ملف `.env`

### 2. تفعيل Test Mode
- في البداية، استخدم `NOON_PAYMENT_MODE=test` للاختبار
- بعد التأكد من عمل كل شيء، غيرها إلى `live`

### 3. تدفق الدفع

1. المستخدم يملأ نموذج الطلب في `/checkout/{restaurant_id}`
2. عند الضغط على "تأكيد الطلب":
   - يتم إنشاء طلب في قاعدة البيانات
   - يتم إنشاء طلب دفع مع Noon
   - يتم توجيه المستخدم إلى صفحة الدفع الخاصة بـ Noon
3. المستخدم يدخل بيانات الدفع في صفحة Noon
4. بعد الدفع، يتم توجيه المستخدم إلى `/payment-callback/{order_id}`
5. يتم التحقق من حالة الدفع مع Noon
6. إذا نجح الدفع: توجيه إلى `/order-success/{order_id}`
7. إذا فشل الدفع: توجيه إلى `/payment-failed/{order_id}`

## حالات الطلب

### Payment Status
- `pending`: في انتظار الدفع
- `paid`: تم الدفع بنجاح
- `failed`: فشل الدفع

### Order Status
- `pending`: في انتظار التأكيد
- `confirmed`: تم تأكيد الطلب والدفع
- `cancelled`: تم إلغاء الطلب (فشل الدفع)

## Testing

### Test Cards (Noon Test Environment)
يمكنك استخدام هذه البطاقات للاختبار:

**Successful Payment:**
- Card Number: `4111 1111 1111 1111`
- Expiry: أي تاريخ مستقبلي
- CVV: أي 3 أرقام

**Failed Payment:**
- Card Number: `4000 0000 0000 0002`
- Expiry: أي تاريخ مستقبلي
- CVV: أي 3 أرقام

## API Endpoints المستخدمة

### Noon API Endpoints
- **Test URL**: `https://api-test.noonpayments.com`
- **Live URL**: `https://api.noonpayments.com`

### Endpoints:
1. **POST** `/payment/v1/order` - إنشاء طلب دفع
2. **GET** `/payment/v1/order/{orderId}` - الحصول على حالة الطلب

## الأمان

- يتم تخزين `API Key` في متغيرات البيئة وليس في الكود
- يتم التحقق من حالة الدفع من جانب الخادم (Server-side verification)
- لا يتم الوثوق بالمعلومات القادمة من المتصفح فقط

## Troubleshooting

### مشكلة: "فشل في إنشاء عملية الدفع"
- تحقق من صحة `NOON_API_KEY` و `NOON_APP_ID`
- تحقق من أن `NOON_PAYMENT_MODE` مضبوط صحيحاً (test/live)
- افحص ملف `storage/logs/laravel.log` للتفاصيل

### مشكلة: الدفع ينجح لكن لا يتم تحديث حالة الطلب
- تحقق من أن callback URL صحيح
- تحقق من أن الخادم يمكنه استقبال الطلبات من Noon

### مشكلة: خطأ في التوجيه بعد الدفع
- تأكد من أن الـ routes مسجلة بشكل صحيح
- نفذ `php artisan route:clear` و `php artisan route:cache`

## الدعم

للمزيد من المعلومات حول Noon Payments API:
- [Noon Payments Documentation](https://docs.noonpayments.com)
- [API Reference](https://docs.noonpayments.com/api)

## ملاحظات مهمة

1. **الأمان**: لا تشارك `NOON_API_KEY` مع أحد
2. **Test Mode**: اختبر بشكل كامل في Test Mode قبل الانتقال إلى Live Mode
3. **Logs**: احتفظ بسجل الأخطاء في `storage/logs/laravel.log`
4. **Webhooks**: يمكنك إضافة webhooks لاحقاً لاستقبال إشعارات من Noon

## التحديثات المستقبلية

يمكن إضافة:
- دعم طرق دفع أخرى (Apple Pay, Mada, etc.)
- نظام استرجاع الأموال (Refunds)
- تقارير مفصلة للمدفوعات
- Webhooks لمزيد من الموثوقية


