<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - MindCare Professional</title>
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