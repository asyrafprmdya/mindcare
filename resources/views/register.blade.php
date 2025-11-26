<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - MindCare Professional</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath fill='%238b5cf6' d='M384 96c0-53-43-96-96-96l-16 0c-26.8 0-51.7 11.2-69.6 31.4L192 43.6c-2.2-2.4-5.5-3.6-8.8-3.3C114.5 46 64 103.6 64 172.7V176c0 10.7 2.7 20.8 7.5 29.7C30.7 224.4 4.3 266.1 5.1 312.6c1 55.8 44.2 101.8 99.5 106.8c1.8 .2 3.7 .3 5.5 .3h6.4c8.8 0 16-7.2 16-16s-7.2-16-16-16h-6.4c-1.3 0-2.6-.1-3.9-.2C68.8 384.2 37.8 351.3 37.1 311.2c-.6-34 19.5-64.8 50.9-78.1c7.8-3.3 12.2-12 10.7-20.3c-2.9-16.6-4.7-33.7-4.7-51.3v-1.5c0-55 37-102.6 89-110.2c1.6-.2 3.1-.8 4.4-1.7l23.9-16.6c11.6-8 25.3-12.3 39.4-12.3l13.3 0c35.3 0 64 28.7 64 64v8.7c0 10.5-3.1 20.7-8.8 29.3l-10.7 16c-5.5 8.3-6.2 19-1.8 27.9s13.4 14.3 23.4 14.3h5.4c45.2 0 83.7 29.5 94.6 72.4c2.6 10.1 13 16.2 23.1 13.6s16.2-13 13.6-23.1C450.2 201 390.8 160 320.6 160h-5.4l10.7-16c14.4-21.6 22-47 22-72.9V62.3c56.6 15.6 98 67.4 98 127.7v2c0 67.7-50.9 123.6-118 130c-10.4 1-17.9 10.3-16.9 20.7s10.3 17.9 20.7 16.9c86-8.2 151.2-81.4 151.2-167.6v-2C496 117.9 448 60.2 384 48.3v47.7zM192 160c0-17.7-14.3-32-32-32s-32 14.3-32 32v1.5c0 32.7 9.3 63.3 25.6 89.8c3.1 5 9 7.4 14.6 6l20-4.8c10.3-2.5 16.6-12.9 14.1-23.2s-12.9-16.6-23.2-14.1l-6.8 1.6C164.4 201.5 160 182.1 160 161.5V160zm32 128c-17.7 0-32 14.3-32 32s14.3 32 32 32h1.5c20.6 0 40-4.4 57.7-12.3l4.8-2.1c10.3-4.6 15-16.7 10.4-27s-16.7-15-27-10.4l-4.8 2.1c-12.9 5.7-27.1 8.8-41.8 8.8H224V288zm64 64c0 17.7 14.3 32 32 32h1.5c25.8 0 50-7.3 71-20.2l3.9-2.4c9.5-5.8 12.4-18.2 6.6-27.7s-18.2-12.4-27.7-6.6l-3.9 2.4c-14.9 9.1-32.1 14.3-50.4 14.3H319.5v1.5c0-17.7-14.3-32-32-32s-32 14.3-32 32v30.5c0 43.3 13.1 83.7 35.8 117.3l2.8 4.2c6.1 9.1 18.5 11.6 27.6 5.5s11.6-18.5 5.5-27.6l-2.8-4.2C309.4 443.9 300.9 414.7 300.9 384H320z'/%3E%3C/svg%3E">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
{{-- Class page-register memicu tema warna HIJAU di CSS --}}
<body class="page-register">

  {{-- Bagian Dekorasi Kiri --}}
  <div class="decoration-section">
    <div class="decoration-content">
      <div class="icon"><i class="fas fa-user-plus"></i></div>
      <h2>Bergabung Sekarang</h2>
      <p>Mulai perjalanan transformasi layanan kesehatan mental Anda bersama kami.</p>
      
      <div class="benefits" style="margin-top: 40px;">
        <div class="benefit-item">
          <i class="fas fa-shield-alt"></i>
          <div class="text"><h4>Data Terenkripsi</h4><p>Standar keamanan medis tingkat tinggi</p></div>
        </div>
        <div class="benefit-item">
          <i class="fas fa-chart-line"></i>
          <div class="text"><h4>Analitik Lengkap</h4><p>Pantau perkembangan pasien realtime</p></div>
        </div>
      </div>
    </div>
  </div>

  <div class="register-section">
    <div class="register-container">
      <div class="logo-section">
        <div class="logo-wrapper">
          <div class="logo-icon"><i class="fas fa-brain"></i></div>
          <span class="logo-text">MindCare</span>
        </div>
        <div class="auth-header"> 
            <h1>Buat Akun Baru</h1>
            <p>Lengkapi data diri untuk memulai akses</p>
        </div>
      </div>

      {{-- Error Display --}}
      @if($errors->any())
        <div class="error">
          <i class="fas fa-exclamation-circle"></i>
          <div>
            @foreach($errors->all() as $error)
                <div style="font-size: 13px;">{{ $error }}</div>
            @endforeach
          </div>
        </div>
      @endif

      <form method="POST" action="{{ url('/register') }}" class="register-form">
        @csrf 
        
        <div class="form-group">
          <label for="full_name">Nama Lengkap</label>
          <div class="input-wrapper">
            <i class="fas fa-id-card"></i>
            <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" placeholder="Contoh: Dr. Andi Pratama" required>
          </div>
        </div>

        {{-- Form Row untuk Username & Email Sebelahan --}}
        <div class="form-row">
          <div class="form-group">
            <label for="username">Username</label>
            <div class="input-wrapper">
              <i class="fas fa-user"></i>
              <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="username" required>
            </div>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <div class="input-wrapper">
              <i class="fas fa-envelope"></i>
              <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email@rs.com" required>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <div class="input-wrapper">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" required>
          </div>
          <div class="password-strength">
            <div class="strength-bar">
              <div class="strength-fill"></div>
            </div>
            <span style="font-size: 11px; color: #94a3b8;">Kombinasikan huruf besar, kecil, dan angka</span>
          </div>
        </div>

        <div class="form-group">
          <label for="confirm">Konfirmasi Password</label>
          <div class="input-wrapper">
            <i class="fas fa-check-double"></i>
            <input type="password" id="confirm" name="confirm" placeholder="Ulangi password" required>
          </div>
        </div>
        
        <button type="submit" class="btn-register">
          <i class="fas fa-user-plus"></i> Daftar Sekarang
        </button>

        <div class="terms" style="margin-top: 24px; text-align: center; font-size: 13px; color: #64748b;">
          Dengan mendaftar, Anda menyetujui <a href="#">Syarat & Ketentuan</a> Layanan
        </div>
      </form>

      <div class="divider"><span>atau</span></div>

      <div class="auth-link"> 
        Sudah memiliki akun? <a href="{{ url('/') }}">Login sekarang</a>
      </div>
    </div>
  </div>
  
  {{-- Script indikator password --}}
  <script>
    const passwordInput = document.getElementById('password');
    const strengthFill = document.querySelector('.strength-fill');
    if(passwordInput && strengthFill) {
        passwordInput.addEventListener('input', function() {
            const value = this.value;
            let strength = 0;
            if (value.length >= 6) strength += 25;
            if (value.length >= 8) strength += 25;
            if (/[a-z]/.test(value) && /[A-Z]/.test(value)) strength += 25;
            if (/[0-9]/.test(value)) strength += 25;
            strengthFill.style.width = strength + '%';
            if (strength <= 25) strengthFill.style.background = '#ef4444';
            else if (strength <= 50) strengthFill.style.background = '#f59e0b';
            else if (strength <= 75) strengthFill.style.background = '#3b82f6';
            else strengthFill.style.background = '#10b981';
        });
    }
  </script>
</body>
</html>