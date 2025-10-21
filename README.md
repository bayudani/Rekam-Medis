# Sistem Informasi Rekam Medis Puskesmas

Aplikasi Sistem Informasi Rekam Medis untuk Puskesmas yang dibangun dengan Laravel 12 dan Filament 3. Sistem ini dirancang untuk memudahkan pengelolaan data rekam medis pasien, pendaftaran, jadwal dokter, dan administrasi puskesmas.

## Fitur Utama

### Manajemen Data
- **Manajemen Pasien**: Pendaftaran dan pengelolaan data pasien dengan nomor rekam medis otomatis (RM-XXX)
- **Rekam Medis**: Pencatatan lengkap rekam medis pasien termasuk:
  - Tanda vital (tekanan darah, nadi, respirasi, suhu, berat badan, tinggi badan)
  - Riwayat alergi dan penyakit dahulu
  - Pemeriksaan awal dan triase (emergency, urgent, non-urgent, false emergency)
  - Catatan perkembangan pasien
- **Manajemen Poli**: Pengelolaan poli/klinik di puskesmas
- **Jadwal Dokter**: Penjadwalan dan pengelolaan jadwal praktik dokter
- **Pendaftaran**: Sistem pendaftaran pasien dan antrian

### Panel Administrasi
- **Admin Panel**: Panel administrasi lengkap dengan Filament untuk mengelola seluruh data
- **Dashboard**: Dashboard dengan statistik dan grafik kunjungan pasien
- **User Management**: Pengelolaan user dan hak akses

### Fitur Website
- Halaman informasi tentang puskesmas
- Jadwal dokter untuk pasien
- Cara berobat di puskesmas
- Informasi kontak

### Export & Reporting
- Export data dalam berbagai format menggunakan Filament Export
- Generate PDF untuk laporan menggunakan Laravel DomPDF

## Teknologi yang Digunakan

- **Backend Framework**: Laravel 12
- **Admin Panel**: Filament 3.3
- **Frontend**: 
  - Livewire 3.6 & Volt
  - Tailwind CSS 3
  - Vite 7
- **Database**: SQLite (default), support MySQL/PostgreSQL
- **PDF Generation**: Laravel DomPDF
- **PHP Version**: ^8.2

## Persyaratan Sistem

- PHP >= 8.2
- Composer
- Node.js & NPM
- SQLite/MySQL/PostgreSQL
- Extension PHP yang diperlukan: PDO, mbstring, tokenizer, XML, ctype, JSON, BCMath

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/bayudani/Rekam-Medis.git
cd Rekam-Medis
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3. Konfigurasi Environment

```bash
# Copy file .env.example ke .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` sesuai dengan konfigurasi database Anda. Secara default menggunakan SQLite:

```env
DB_CONNECTION=sqlite
```

Untuk MySQL:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rekam_medis
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrasi Database

```bash
# Jalankan migrasi
php artisan migrate

# (Opsional) Jalankan seeder jika ada
php artisan db:seed
```

### 6. Build Assets

```bash
# Untuk development
npm run dev

# Untuk production
npm run build
```

### 7. Jalankan Aplikasi

```bash
# Menggunakan PHP built-in server
php artisan serve

# Atau menggunakan composer script (menjalankan server, queue, logs, dan vite secara bersamaan)
composer dev
```

Aplikasi akan berjalan di `http://localhost:8000`

Admin panel dapat diakses di `http://localhost:8000/admin`

## Penggunaan

### Membuat User Admin Pertama

```bash
php artisan make:filament-user
```

Ikuti prompt untuk membuat user admin pertama.

### Menjalankan Queue Worker

Jika aplikasi menggunakan jobs/queue:

```bash
php artisan queue:work
```

### Melihat Logs

```bash
php artisan pail
```

## Testing

```bash
# Jalankan tests
composer test

# Atau
php artisan test
```

## Struktur Database

Sistem ini memiliki beberapa tabel utama:
- `users`: Data user/pengguna sistem
- `pasiens`: Data pasien
- `polis`: Data poli/klinik
- `pendaftarans`: Data pendaftaran pasien
- `rekam_medis`: Data rekam medis pasien
- `jadwal_dokters`: Jadwal praktik dokter
- `catatan_perkembangans`: Catatan perkembangan kondisi pasien

## Kontribusi

Kontribusi selalu diterima! Silakan fork repository ini dan buat pull request untuk perubahan yang Anda inginkan.

## Lisensi

Aplikasi ini adalah open-source software yang dilisensikan di bawah [MIT license](https://opensource.org/licenses/MIT).

## Kontak & Dukungan

Jika Anda memiliki pertanyaan atau membutuhkan bantuan, silakan buat issue di repository ini.

---

Dibuat dengan ❤️ menggunakan Laravel dan Filament
