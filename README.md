# Project Courses – Kurs Yönetim Sistemi

Bu proje, **İnternet Programcılığı** dersi kapsamında geliştirilmiş bir **Kurs Yönetim Sistemi** uygulamasıdır.  
Amaç; php web 8'i prensiplerini kullanılarak, kullanıcı etkileşimli ve veritabanı destekli bir web uygulaması geliştirmektir.

---

## 📌 Proje Amacı

Bu uygulama ile:

- Kursların sistem üzerinden yönetilmesi  
- Kullanıcı kayıt ve yetkilendirme işlemlerinin yapılması  
- Veritabanı ile etkileşimli bir yapı kurulması  
- Görsel programlama yaklaşımlarının pratikte uygulanması  

hedeflenmiştir.

---

## 🛠️ Kullanılan Teknolojiler

- **PHP** – Sunucu taraflı programlama  
- **MySQL** – Veritabanı yönetimi  
- **HTML5 / CSS3** – Arayüz geliştirme  
- **Bootstrap** – Responsive tasarım  
- **XAMPP** – Local server ortamı  
- **Git & GitHub** – Versiyon kontrol sistemi  

---

## ⚙️ Uygulama Özellikleri

- Kullanıcı kayıt ve giriş sistemi  
- Yetkilendirme (Authorization) kontrolü  
- Kurs ekleme, listeleme ve yönetme  
- Parçalı yapı (partials) ile modüler kodlama  
- Güvenli oturum (Session) yönetimi  

---

## 🗂️ Proje Yapısı

```text
project-courses/
│
├── partials/          # Navbar, başlık ve ortak bileşenler
├── authorize.php      # Yetkilendirme kontrolü
├── register.php       # Kullanıcı kayıt işlemleri
├── login.php          # Kullanıcı giriş işlemleri
├── index.php          # Ana sayfa
└── database/          # Veritabanı bağlantı dosyaları
