# 🚀 تعليمات النشر السريع - adv-line.sa

## ✅ التعديلات الجاهزة
تم إصلاح مشكلة الصور بالكامل! الآن يمكنك نشر الموقع على https://adv-line.sa

---

## 📦 خطوات النشر (نفذها بالترتيب)

### 1️⃣ على جهازك المحلي - رفع الكود

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/advfood-website

# تأكد من التعديلات
git status

# رفع التعديلات
git add .
git commit -m "Fix image URLs for production - adv-line.sa"
git push origin main
```

### 2️⃣ على السيرفر - تحديث ملف .env

**⚠️ مهم جداً:** افتح ملف `.env` على السيرفر وعدّل:

```bash
APP_URL=https://adv-line.sa
```

احفظ الملف وأغلقه.

### 3️⃣ على السيرفر - جلب التحديثات

```bash
# انتقل لمجلد المشروع
cd /path/to/advfood-website

# جلب آخر التحديثات
git pull origin main

# بناء ملفات JavaScript
npm run build
```

### 4️⃣ على السيرفر - تهيئة الصور

```bash
# إنشاء symbolic link للصور (مهم!)
php artisan storage:link

# ضبط الصلاحيات
chmod -R 755 storage
chmod -R 755 public/storage

# ضبط الملكية (اختر الأمر المناسب لسيرفرك)
sudo chown -R www-data:www-data storage public/storage
```

### 5️⃣ على السيرفر - مسح الـ Cache

```bash
# مسح كل أنواع الـ cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# إعادة بناء cache للإنتاج
php artisan config:cache
```

### 6️⃣ على السيرفر - إعادة تشغيل الخدمات

```bash
# إذا كنت تستخدم Apache:
sudo systemctl restart apache2

# إذا كنت تستخدم Nginx:
sudo systemctl restart nginx
sudo systemctl restart php8.2-fpm
```

---

## ✅ اختبار الحل

### افتح في المتصفح:
```
https://adv-line.sa/restaurants/2
```

### تحقق من:
1. ✅ صورة الكوفر تظهر بشكل صحيح
2. ✅ اللوجو في الـ Header يظهر
3. ✅ صور المنتجات تظهر
4. ✅ لا توجد أخطاء في Console (F12)

---

## 🔧 إذا لم تظهر الصور

### الحل السريع:
```bash
# على السيرفر
cd /path/to/advfood-website

# أعد إنشاء symbolic link
rm public/storage
php artisan storage:link

# امسح الـ cache
php artisan optimize:clear

# أعد تشغيل الخدمات
sudo systemctl restart apache2  # أو nginx
```

---

## 📝 ملاحظات مهمة

1. ✅ **لا تنسى تغيير `APP_URL` في `.env`** - هذا أهم شيء!
2. ✅ **تأكد من وجود شهادة SSL** على الدومين
3. ✅ **استخدم `https://` وليس `http://`** في `APP_URL`
4. ✅ **لا تضع `/` في نهاية الدومين**

---

## 📚 مزيد من التفاصيل

راجع الملفات التالية للمزيد من المعلومات:
- `IMAGES_FIX_COMPLETE.md` - شرح كامل للتغييرات
- `DOMAIN_SETUP.md` - تفاصيل إعداد الدومين

---

**🎉 بعد تنفيذ هذه الخطوات، سيعمل موقعك بشكل كامل على https://adv-line.sa**

