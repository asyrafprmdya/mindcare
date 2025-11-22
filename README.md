# 🧠 MindCare - Platform Kesehatan Mental Berbasis Web

<div align="center">

![MindCare Banner](https://img.shields.io/badge/MindCare-Mental%20Health%20Platform-4CAF50?style=for-the-badge)
[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)](LICENSE)

**Platform kesehatan mental yang inovatif untuk membantu pengguna menganalisis kondisi psikologis dan memberikan solusi yang tepat**

[Demo](#demo) • [Fitur](#-fitur-utama) • [Instalasi](#-instalasi) • [Dokumentasi](#-dokumentasi) • [Kontribusi](#-kontribusi)

</div>

---

## 📋 Daftar Isi

- [Tentang MindCare](#-tentang-mindcare)
- [Fitur Utama](#-fitur-utama)
- [Manfaat](#-manfaat)
- [Teknologi](#-teknologi-yang-digunakan)
- [Instalasi](#-instalasi)
- [Penggunaan](#-penggunaan)
- [Struktur Project](#-struktur-project)
- [API Documentation](#-api-documentation)
- [Screenshot](#-screenshot)
- [Roadmap](#-roadmap)
- [Kontribusi](#-kontribusi)
- [Tim Pengembang](#-tim-pengembang)
- [Lisensi](#-lisensi)

---

## 🌟 Tentang MindCare

**MindCare** adalah platform kesehatan mental komprehensif yang dirancang untuk memberikan akses mudah ke sumber daya kesejahteraan mental. Aplikasi ini menganalisis kondisi psikologis dan kesehatan mental individu, kemudian memberikan solusi yang tepat untuk membantu pengguna mengatasi masalah mereka.

### 🎯 Visi & Misi

**Visi:** Menjadi platform kesehatan mental terdepan yang dapat diakses oleh semua orang untuk meningkatkan kualitas hidup mental.

**Misi:**
- Memberikan deteksi dini masalah kesehatan mental
- Menyediakan solusi dan rekomendasi yang personal
- Menghubungkan pengguna dengan profesional kesehatan mental
- Mengurangi stigma seputar kesehatan mental

---

## 🚀 Fitur Utama

### 1. 🧪 Assessment Kesehatan Mental
- **Kuesioner Interaktif**: Tes psikologi berbasis MCQ yang komprehensif
- **Analisis Multi-Dimensi**: Evaluasi stress, kecemasan, dan depresi
- **Hasil Real-time**: Dapatkan hasil analisis secara instan
- **Tracking Progress**: Lacak perkembangan kondisi mental dari waktu ke waktu

### 2. 🤖 AI-Powered Recommendations
- **Personalisasi**: Rekomendasi yang disesuaikan dengan kondisi individu
- **Chatbot Terapi**: Konsultasi awal dengan AI therapist
- **Saran Praktis**: Tips dan teknik self-help yang efektif
- **Resource Library**: Akses ke artikel, video, dan panduan kesehatan mental

### 3. 📊 Dashboard Monitoring
- **Mood Tracker**: Catat dan pantau perubahan mood harian
- **Habit Tracker**: Monitor kebiasaan positif dan pola hidup
- **Visualisasi Data**: Grafik dan chart untuk memahami pola mental
- **Reminder System**: Notifikasi untuk aktivitas kesehatan mental

### 4. 👨‍⚕️ Konsultasi Profesional
- **Booking Appointment**: Jadwalkan konsultasi dengan psikolog bersertifikat
- **Telemedicine**: Konsultasi online via video call
- **Chat Support**: Komunikasi langsung dengan counselor
- **Emergency Contact**: Akses cepat ke hotline krisis

### 5. 🧘 Wellness Resources
- **Meditasi Terpandu**: Audio dan video meditasi
- **Breathing Exercises**: Teknik pernapasan untuk mengurangi stress
- **Yoga & Exercise**: Video panduan olahraga untuk kesehatan mental
- **Sleep Therapy**: Program untuk meningkatkan kualitas tidur

### 6. 👥 Community Support
- **Forum Diskusi**: Berbagi pengalaman dengan komunitas
- **Support Groups**: Grup pendukung berdasarkan kondisi spesifik
- **Anonymous Mode**: Privasi terjaga dengan mode anonim
- **Moderated Content**: Konten dimoderasi oleh profesional

---

## 💡 Manfaat

### Untuk Pengguna

✅ **Deteksi Dini**
- Identifikasi masalah kesehatan mental sejak awal
- Mencegah kondisi memburuk dengan intervensi cepat

✅ **Akses 24/7**
- Tersedia kapan saja dan dimana saja
- Tidak perlu antri atau janji temu untuk assessment awal

✅ **Privasi Terjamin**
- Data terenkripsi dan aman
- Anonim dan confidential

✅ **Hemat Biaya**
- Assessment gratis dan resource education
- Konsultasi lebih terjangkau dibanding klinik tradisional

✅ **Self-Management**
- Tools untuk mengelola kesehatan mental sendiri
- Pemberdayaan pengguna untuk mengambil kontrol

### Untuk Profesional

🏥 **Management Pasien**
- Dashboard untuk monitor multiple pasien
- Riwayat lengkap kondisi pasien
- Efisiensi waktu dan resources

📈 **Data Analytics**
- Insight dari data agregat pengguna
- Membantu research dan pengembangan treatment

---

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel 10.x** - PHP Framework
- **MySQL/PostgreSQL** - Database
- **Redis** - Caching & Queue
- **JWT Authentication** - Secure API

### Frontend
- **Blade Templates** - Laravel Templating Engine
- **Tailwind CSS** - Utility-first CSS Framework
- **Alpine.js** - Lightweight JavaScript Framework
- **Chart.js** - Data Visualization

### Additional Tools
- **Laravel Sanctum** - API Authentication
- **Laravel Livewire** - Dynamic Interfaces
- **Pusher/Laravel Echo** - Real-time Features
- **AWS S3** - File Storage
- **SendGrid/Mailgun** - Email Service

---

## 📦 Instalasi

### Prerequisites

Pastikan sistem Anda memiliki:
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/PostgreSQL
- Git

### Langkah-langkah Instalasi

1. **Clone Repository**
```bash
git clone https://github.com/asyrafprmdya/mindcare.git
cd mindcare
```

2. **Install Dependencies**
```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

3. **Environment Configuration**
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

4. **Database Setup**
```bash
# Edit .env file dengan konfigurasi database Anda
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=mindcare
# DB_USERNAME=root
# DB_PASSWORD=

# Run migrations
php artisan migrate

# Seed database (optional)
php artisan db:seed
```

5. **Build Assets**
```bash
npm run dev
# Atau untuk production
npm run build
```

6. **Run Application**
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

### Docker Installation (Alternative)

```bash
# Build and run with Docker Compose
docker-compose up -d

# Run migrations
docker-compose exec app php artisan migrate
```

---

## 💻 Penggunaan

### Untuk Pengguna Baru

1. **Registrasi Account**
   - Kunjungi halaman registrasi
   - Isi data diri dan buat akun
   - Verifikasi email Anda

2. **Complete Profile**
   - Lengkapi profil kesehatan Anda
   - Informasi ini membantu personalisasi rekomendasi

3. **Take Assessment**
   - Mulai dengan assessment kesehatan mental
   - Jawab pertanyaan dengan jujur
   - Dapatkan hasil dan rekomendasi

4. **Explore Features**
   - Gunakan mood tracker harian
   - Akses resource library
   - Join community forum

### API Usage

```php
// Example: Get user assessment
GET /api/v1/assessments/{userId}

// Example: Submit new assessment
POST /api/v1/assessments
{
    "user_id": 1,
    "responses": [...],
    "assessment_type": "depression"
}

// Example: Get recommendations
GET /api/v1/recommendations/{assessmentId}
```

---

## 📁 Struktur Project

```
mindcare/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AssessmentController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── AppointmentController.php
│   │   │   └── ResourceController.php
│   │   └── Middleware/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Assessment.php
│   │   ├── MoodTrack.php
│   │   └── Appointment.php
│   └── Services/
│       ├── AssessmentService.php
│       └── RecommendationService.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── dashboard/
│   │   ├── assessment/
│   │   └── appointments/
│   ├── css/
│   └── js/
├── routes/
│   ├── web.php
│   └── api.php
├── tests/
│   ├── Feature/
│   └── Unit/
└── public/
```

---

## 📚 API Documentation

Dokumentasi lengkap API tersedia di:
- **Development**: `http://localhost:8000/api/documentation`
- **Production**: `https://mindcare.app/api/documentation`

### Authentication

```bash
# Login
POST /api/auth/login
Content-Type: application/json

{
  "email": "user@example.com",
  "password": "password123"
}

# Response
{
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
  "token_type": "Bearer",
  "expires_in": 3600
}
```

### Main Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/auth/register` | Register new user |
| POST | `/api/auth/login` | User login |
| GET | `/api/user/profile` | Get user profile |
| POST | `/api/assessments` | Submit assessment |
| GET | `/api/assessments/{id}` | Get assessment result |
| POST | `/api/mood-tracks` | Log mood entry |
| GET | `/api/appointments` | List appointments |
| POST | `/api/appointments` | Book appointment |

---

## 📸 Screenshot

### Dashboard
![Dashboard Preview](https://via.placeholder.com/800x400/4CAF50/FFFFFF?text=Dashboard+Preview)

### Assessment Page
![Assessment Preview](https://via.placeholder.com/800x400/2196F3/FFFFFF?text=Assessment+Page)

### Mood Tracker
![Mood Tracker Preview](https://via.placeholder.com/800x400/FF9800/FFFFFF?text=Mood+Tracker)

---

## 🗺️ Roadmap

### Phase 1 - Q4 2024 ✅
- [x] User authentication & authorization
- [x] Basic assessment module
- [x] Dashboard & mood tracker
- [x] Resource library

### Phase 2 - Q1 2025 🚧
- [ ] AI-powered chatbot integration
- [ ] Telemedicine video consultation
- [ ] Mobile responsive optimization
- [ ] Multi-language support (EN, ID)

### Phase 3 - Q2 2025 📋
- [ ] Mobile app (iOS & Android)
- [ ] Wearable device integration
- [ ] Advanced analytics & insights
- [ ] Community features enhancement

### Phase 4 - Q3 2025 🔮
- [ ] AI predictive analysis
- [ ] Personalized wellness program
- [ ] Insurance integration
- [ ] Corporate wellness packages

---

## 🤝 Kontribusi

Kami sangat menghargai kontribusi dari komunitas! Berikut cara Anda dapat berkontribusi:

### Cara Berkontribusi

1. **Fork** repository ini
2. **Create** feature branch (`git checkout -b feature/AmazingFeature`)
3. **Commit** perubahan (`git commit -m 'Add some AmazingFeature'`)
4. **Push** ke branch (`git push origin feature/AmazingFeature`)
5. **Open** Pull Request

### Guidelines

- Ikuti PSR-12 coding standards
- Write meaningful commit messages
- Add tests untuk fitur baru
- Update dokumentasi jika diperlukan
- Pastikan semua tests pass sebelum PR

### Code of Conduct

Proyek ini mengadopsi [Contributor Covenant Code of Conduct](CODE_OF_CONDUCT.md). Dengan berpartisipasi, Anda diharapkan menjunjung tinggi kode etik ini.

---

## 👨‍💻 Tim Pengembang

### Core Team

- **Asyraf Pramudya** - *Project Lead & Full Stack Developer* - [@asyrafprmdya](https://github.com/asyrafprmdya)

### Contributors

Terima kasih kepada semua [contributors](https://github.com/asyrafprmdya/mindcare/contributors) yang telah membantu project ini!

---

## 📞 Kontak & Support

- **Email**: support@mindcare.app
- **Website**: [https://mindcare.app](https://mindcare.app)
- **Issues**: [GitHub Issues](https://github.com/asyrafprmdya/mindcare/issues)
- **Discussions**: [GitHub Discussions](https://github.com/asyrafprmdya/mindcare/discussions)

### Emergency Mental Health Resources

Jika Anda atau seseorang yang Anda kenal mengalami krisis mental:

- **Indonesia**: 
  - SEJIWA: 119 ext. 8
  - Save Yourselves: 021-5720570
  - Into The Light: +62 812-1951-5779

---

## 📄 Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE) - lihat file LICENSE untuk detail lengkap.

```
MIT License

Copyright (c) 2024 MindCare Team

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files...
```

---

## 🙏 Acknowledgments

- Laravel Framework Team
- Mental Health Professionals yang memberikan konsultasi
- Open Source Community
- Semua pengguna dan supporters

---
