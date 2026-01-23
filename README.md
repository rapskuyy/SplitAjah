**Tentang Aplikasi**

SplitAjah adalah aplikasi web berbasis Laravel 11 dengan MySQL sebagai database yang dirancang untuk membantu pengguna mengelola grup, membagi data, dan fitur terkait lainnya sesuai kebutuhan penggunaan pada sistem web. Aplikasi ini di-deploy sebagai project web menggunakan Laravel dengan antarmuka dinamis dan fitur beragam sesuai kebutuhan user.

**Fitur Utama**

Berikut adalah fitur utama yang tersedia di aplikasi SplitAjah:

- Autentikasi Pengguna
- Manajemen Grup – buat, lihat, edit, hapus grup
- Transaksi atau pembagian item di dalam grup
- Detail Riwayat aktivitas pengguna
- Dashboard user friendly
- Dukungan multi-bahasa / localization (opsional bergantung konfigurasi)

**Cara Instalasi (Development)**

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di lokal:

1. Clone Repository
- git clone https://github.com/rapskuyy/SplitAjah.git
- cd SplitAjah

2. Install Dependencies
Install Composer
- composer install

Install npm
- npm install

3. Set Up Environment
Duplikasi file .env.example menjadi .env:
- cp .env.example .env

Buka .env lalu atur konfigurasi database:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=user_mysql
DB_PASSWORD=password_mysql

4. Generate Application Key
- php artisan key:generate

5. Migrate Database
- php artisan migrate
- php artisan db:seed

6. Jalankan Aplikasi
- php artisan serve
