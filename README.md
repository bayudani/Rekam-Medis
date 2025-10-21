# 🏥 Rmedis - Sistem Informasi Rekam Medis

Aplikasi Sistem Informasi Rekam Medis berbasis web yang dibangun menggunakan Laravel 12, Filament 3.3, dan Livewire 3. Dirancang khusus untuk memudahkan pengelolaan data rekam medis pasien di fasilitas kesehatan.

[![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?logo=laravel)](https://laravel.com)
[![Filament](https://img.shields.io/badge/Filament-3.3-F59E0B)](https://filamentphp.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

---

## 📋 Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Tech Stack](#-tech-stack)
- [Prasyarat](#-prasyarat)
- [Instalasi](#-instalasi)
- [Konfigurasi](#-konfigurasi)
- [Penggunaan](#-penggunaan)
- [Struktur Database](#-struktur-database)
- [Role &amp; Permission](#-role--permission)
- [Screenshot](#-screenshot)
- [Troubleshooting](#-troubleshooting)
- [Contributing](#-contributing)
- [License](#-license)

---

## ✨ Fitur Utama

### 🔐 **Manajemen User & Akses**

- Multi-role system (Admin, Dokter, Perawat, Staff)
- Role-based access control (RBAC)
- User management dengan assignment poli

### 👥 **Manajemen Pasien**

- Registrasi pasien baru dengan No. RM otomatis
- Data lengkap pasien (identitas, kontak, alamat)
- Riwayat kunjungan pasien
- Pencarian dan filter data pasien

### 📅 **Pendaftaran & Jadwal**

- Pendaftaran kunjungan pasien
- Manajemen jadwal dokter
- Assign pasien ke poli/dokter
- Status tracking (Menunggu, Diperiksa, Selesai)

### 📝 **Rekam Medis Elektronik**

- **Asesmen Keperawatan** (SOAP format)

  - Anamnesis dan riwayat kesehatan
  - Tanda-tanda vital (TTV)
  - Penilaian risiko jatuh
  - Status psikologis & fungsional
- **Asesmen Medis**

  - Pemeriksaan fisik lengkap
  - Diagnosis (ICD-X)
  - Rencana terapi
  - Pemeriksaan penunjang
- **Form Khusus Poli Gigi**

  - Odontogram interaktif
  - Pemeriksaan gigi & mulut
- **Formulir Triase Pasien Gawat Darurat**

  - Initial assessment & triase primer
  - Triase sekunder (Resusitasi, Emergency, Urgent, Non-Urgent)
  - Tanda kehidupan & vital signs
  - Khusus untuk Ruang Tindakan

### 📊 **Catatan Perkembangan**

- SOAP notes untuk follow-up pasien
- Riwayat perkembangan kondisi pasien
- Timeline catatan medis

### 🏢 **Manajemen Poli/Unit**

- Konfigurasi poli/unit layanan
- Assignment dokter ke poli
- Poli khusus: Poli Gigi & Ruang Tindakan dengan form spesifik

### 📄 **Reporting & Export**

- Cetak rekam medis ke PDF
- Template PDF custom per poli
- Export data pasien
- Laporan kunjungan

---

## 🛠 Tech Stack

### **Backend**

- **Laravel 12** - PHP Framework
- **PHP 8.2+** - Programming Language
- **MySQL/PostgreSQL** - Database

### **Frontend & UI**

- **Filament 3.3** - Admin Panel Framework
- **Livewire 3.6** - Full-stack Framework
- **Tailwind CSS 3** - CSS Framework
- **Alpine.js** - Lightweight JavaScript

### **Packages**

- **barryvdh/laravel-dompdf** - PDF Generation
- **alperenersoy/filament-export** - Data Export
- **laravel/breeze** - Authentication
- **livewire/volt** - SFC Components

### **Development Tools**

- **Laravel Pint** - Code Style Fixer
- **Laravel Pail** - Log Viewer
- **PHPUnit** - Testing Framework
- **Vite** - Asset Bundler

---

## 📦 Prasyarat

Pastikan sistem Anda sudah memiliki:

- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.x & **NPM** >= 9.x
- **MySQL** >= 8.0 atau **PostgreSQL** >= 13
- **Git**

**Ekstensi PHP yang diperlukan:**

```
- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- Tokenizer
- XML
- GD atau Imagick
- DOM
```

---

## 🚀 Instalasi

### 1️⃣ Clone Repository

```bash
git clone https://github.com/username/rmedis.git
cd rmedis
```

### 2️⃣ Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3️⃣ Environment Setup

```bash
# Copy file environment
copy .env.example .env    # Windows
# atau
cp .env.example .env      # Linux/Mac

# Generate application key
php artisan key:generate
```

### 4️⃣ Database Configuration

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rmedis
DB_USERNAME=root
DB_PASSWORD=
```

### 5️⃣ Database Migration & Seeding

```bash
# Jalankan migration
php artisan migrate

# (Opsional) Jalankan seeder untuk data dummy
php artisan db:seed
```

### 6️⃣ Create Admin User

```bash
php artisan make:filament-user
```

Ikuti prompt untuk membuat user admin pertama.

### 7️⃣ Build Assets

```bash
npm run build        # Production
# atau
npm run dev          # Development dengan hot reload
```

### 8️⃣ Run Application

```bash
# Development (all-in-one: server + queue + logs + vite)
composer dev

# Atau jalankan manual:
php artisan serve    # http://localhost:8000
```

---

## ⚙️ Konfigurasi

### **Storage Link**

Untuk upload file (foto pasien, dokumen, dll):

```bash
php artisan storage:link
```

### **Queue Worker** (Jika menggunakan jobs)

```bash
php artisan queue:work
```

### **Scheduler** (Jika menggunakan cron jobs)

Tambahkan ke crontab:

```bash
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```

### **PDF Configuration**

Edit `config/dompdf.php` untuk kustomisasi PDF output (paper size, font, dll).

---

## 📖 Penggunaan

### **Akses Aplikasi**

- **URL**: `http://localhost:8000/admin`
- **Login** dengan kredensial admin yang sudah dibuat

### **Dashboard Admin**

Setelah login, Anda dapat mengakses:

- 👤 **User Management** - Kelola user dan role
- 🏥 **Data Pasien** - CRUD pasien
- 🗓️ **Pendaftaran** - Daftar kunjungan pasien
- 📋 **Rekam Medis** - Input dan lihat rekam medis (role: Dokter)
- 📊 **Catatan Perkembangan** - Follow-up pasien
- 🏢 **Poli/Unit** - Manajemen poli
- 📅 **Jadwal Dokter** - Atur jadwal praktik

### **Workflow Standar**

1. **Admin/Staff** → Daftarkan pasien baru di **Pasien**
2. **Admin/Staff** → Buat pendaftaran kunjungan di **Pendaftaran**
3. **Dokter** → Buka **Rekam Medis** → Isi asesmen (Keperawatan & Medis)
4. **Dokter** → Update status menjadi **Selesai**
5. **Dokter** → Cetak PDF rekam medis (jika perlu)
6. **Dokter** → Tambahkan **Catatan Perkembangan** untuk follow-up

### **Workflow Ruang Tindakan (IGD)**

1. **Admin/Staff** → Daftarkan pasien ke **Ruang Tindakan**
2. **Dokter** → Buka **Rekam Medis** → Isi **Formulir Triase Pasien Gawat Darurat**
3. **Dokter** → Tambahkan **Catatan Perkembangan** untuk monitoring

---

## 🗄️ Struktur Database

### **Tabel Utama**

#### `users`

User dan akses sistem

- `role`: admin, dokter, perawat, staff
- `poli_id`: Foreign key ke tabel poli

#### `pasiens`

Data pasien

- `no_rm`: Nomor Rekam Medis (Auto-generated)
- `nik`, `nama`, `tgl_lahir`, `jk`
- `alamat`, `no_telp`, `email`

#### `polis`

Poli/Unit layanan

- `nama_poli`: Nama poli/unit
- `kode_poli`: Kode unik poli

#### `pendaftarans`

Kunjungan pasien

- `pasien_id`, `poli_id`, `dokter_id`
- `status`: Menunggu, Diperiksa, Selesai
- **Asesmen Keperawatan**: TTV, anamnesis, dll
- **Asesmen Medis**: Diagnosa, terapi, ICD-X
- **Tindak Lanjut**: Rujukan internal/eksternal

#### `rekam_medis`

Formulir triase gawat darurat (Relasi ke `pendaftarans`)

- Khusus untuk Ruang Tindakan
- Data triase primer & sekunder
- Initial assessment & tanda vital

#### `catatan_perkembangans`

Follow-up pasien (Relasi ke `pendaftarans`)

- SOAP notes
- Timeline catatan medis

#### `jadwal_dokters`

Jadwal praktik dokter

- `dokter_id`, `poli_id`
- `hari`, `jam_mulai`, `jam_selesai`

### **Relasi**

```
users (dokter) → pendaftarans → rekam_medis
pasiens → pendaftarans → catatan_perkembangans
polis → pendaftarans
```

---

## 🔐 Role & Permission

| Role              | Akses                                           |
| ----------------- | ----------------------------------------------- |
| **Admin**   | Full access ke semua modul                      |
| **Dokter**  | Rekam Medis, Catatan Perkembangan (sesuai poli) |
| **Perawat** | Pendaftaran, Lihat Data Pasien                  |
| **Staff**   | Pendaftaran, Pasien, Jadwal Dokter              |

---

## 📸 Screenshot

> _Tambahkan screenshot aplikasi di sini_

---

## 🐛 Troubleshooting

### **Error: Class not found**

```bash
composer dump-autoload
```

### **Error: Permission denied (storage/logs)**

```bash
# Windows (as Administrator)
icacls storage /grant Users:F /T
icacls bootstrap/cache /grant Users:F /T

# Linux/Mac
chmod -R 775 storage bootstrap/cache
```

### **Error: SQLSTATE Connection refused**

- Pastikan database service berjalan
- Cek konfigurasi `.env`

### **Error: Mix/Vite manifest not found**

```bash
npm run build
```

### **Form Wizard tidak muncul**

- Clear cache: `php artisan cache:clear`
- Clear view: `php artisan view:clear`
- Clear config: `php artisan config:clear`

---

## 🤝 Contributing

Kontribusi sangat terbuka! Silakan:

1. Fork repository ini
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add: Amazing Feature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

### **Code Style**

Gunakan Laravel Pint untuk formatting:

```bash
./vendor/bin/pint
```

---

## 📝 License

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

## 📧 Contact & Support

- **Developer**: [bayu dani]
- **Email**: [bayu22122017@gmail.com]
- **Issues**: [GitHub Issues](https://github.com/username/rmedis/issues)

---

## 🙏 Acknowledgments

- [Laravel Framework](https://laravel.com)
- [Filament Admin](https://filamentphp.com)
- [Livewire](https://livewire.laravel.com)
- [Tailwind CSS](https://tailwindcss.com)

---

<p align="center">
Made with ❤️ for better healthcare management
</p>
