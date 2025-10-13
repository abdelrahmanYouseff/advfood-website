# ✅ تحديث عنوان الموقع (Page Title)

## المشكلة
كان عنوان الصفحة في المتصفح يظهر "Laravel" أو "Welcome to AdvFood" بدلاً من "ADVFood - منصة طلب الطعام"

---

## الحل

تم تحديث العنوان في **3 ملفات**:

### 1. `resources/js/app.ts`
**قبل:**
```javascript
const appName = import.meta.env.VITE_APP_NAME || 'Welcome to AdvFood';
```

**بعد:**
```javascript
const appName = import.meta.env.VITE_APP_NAME || 'ADVFood - منصة طلب الطعام';
```

### 2. `resources/js/ssr.ts`
**قبل:**
```javascript
const appName = import.meta.env.VITE_APP_NAME || 'Welcome to AdvFood';
```

**بعد:**
```javascript
const appName = import.meta.env.VITE_APP_NAME || 'ADVFood - منصة طلب الطعام';
```

### 3. `config/app.php`
**قبل:**
```php
'name' => env('APP_NAME', 'Welcome to AdvFood'),
```

**بعد:**
```php
'name' => env('APP_NAME', 'ADVFood - منصة طلب الطعام'),
```

### 4. `resources/views/app.blade.php`
العنوان موجود بالفعل بشكل صحيح:
```html
<title inertia>ADVFood - منصة طلب الطعام</title>
```

---

## خطوات التطبيق

### على اللوكال:
```bash
# إعادة بناء ملفات JavaScript
npm run build

# أو في وضع التطوير
npm run dev
```

### على السيرفر:
```bash
# 1. رفع التحديثات
git pull origin main

# 2. إعادة بناء الملفات
npm run build

# 3. مسح الـ cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# 4. إعادة بناء cache للإنتاج
php artisan config:cache
```

---

## النتيجة

الآن عنوان الصفحة في المتصفح سيظهر:

### الصفحة الرئيسية:
```
ADVFood - منصة طلب الطعام
```

### الصفحات الأخرى (مع title محدد):
```
اسم الصفحة - ADVFood - منصة طلب الطعام
```

مثال:
- صفحة المطعم: `Delawa - ADVFood - منصة طلب الطعام`
- صفحة السلة: `Shopping Cart - ADVFood - منصة طلب الطعام`

---

## كيف يعمل؟

في Inertia.js، العنوان يتم تشكيله من:
```javascript
title: (title) => (title ? `${title} - ${appName}` : appName)
```

- إذا كانت الصفحة لها `title` محدد → `عنوان الصفحة - ADVFood - منصة طلب الطعام`
- إذا لم يكن هناك `title` → `ADVFood - منصة طلب الطعام`

---

## اختبار الحل

### 1. افتح الموقع في المتصفح
### 2. تحقق من Tab العنوان في المتصفح
### 3. يجب أن ترى: `ADVFood - منصة طلب الطعام`

---

## ملاحظة مهمة

إذا كان لديك متغير بيئة `VITE_APP_NAME` في ملف `.env`:
```bash
VITE_APP_NAME="ADVFood - منصة طلب الطعام"
```

يجب أن تعيد تشغيل `npm run dev` أو `npm run build` بعد تغيير أي متغير يبدأ بـ `VITE_`.

---

**تاريخ التحديث:** 2025-10-12  
**الحالة:** ✅ مكتمل

