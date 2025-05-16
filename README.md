markdown
# ContactSphere

![ContactSphere Screenshot](screenshot.png) <!-- Anda bisa tambahkan screenshot nanti -->

ContactSphere adalah aplikasi manajemen kontak modern dengan fitur pengelompokan kontak dan kemampuan ekspor data. Dibangun dengan Laravel 11 dan Tailwind CSS.

## Fitur Utama

- 📁 Manajemen Kontak
    - CRUD Kontak (Nama, Email, Telepon, Alamat, Catatan)
    - Pencarian Kontak
    - Ekspor ke CSV
    - Avatar Otomatis
- 📂 Manajemen Grup
    - Buat/Mengedit grup kontak
    - Filter kontak berdasarkan grup
    - Deskripsi grup
- 🎨 UI Modern
    - Responsive Design
    - Gradien Warna Modern
    - Animasi Halus
    - Ikon Feather
- 🔒 Validasi Form
- 📊 Pagination

## Teknologi

- **Backend**: Laravel 12
- **Frontend**: Tailwind CSS, Blade Templates
- **Database**: MySQL
- **Lainnya**:
    - Feater Icons
    - Laravel Pagination
    - Laravel Validation

## Instalasi

1. Clone repository:
```bash
git clone https://github.com/username/ContactSphere.git
cd ContactSphere
Install dependencies:


composer install
npm install
Setup environment:

bash
cp .env.example .env
php artisan key:generate
Konfigurasi database di .env:

env
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
Migrasi database:

php artisan migrate --seed
Build assets:

npm run build
Jalankan server:

php artisan serve
