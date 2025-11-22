<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - MindCare Professional</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
{{-- Class page-login memicu tema warna UNGU di CSS --}}
<body class="page-login">

  <div class="login-section">
    <div class="login-container">
      <div class="logo-section">
        <div class="logo-wrapper">
          <div class="logo-icon">
            <i class="fas fa-brain"></i>
          </div>
          <span class="logo-text">MindCare</span>
        </div>
        
        <div class="auth-header"> 
            <h1>Selamat Datang</h1>
            <p>Masuk untuk mengakses dashboard profesional Anda</p>
        </div>
      </div>

      {{-- Alert Error --}}
      @if(session('error'))
        <div class="error">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
      @endif

      {{-- Alert Success --}}
      @if(session('register_success'))
        <div class="success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('register_success') }}</span>
        </div>
      @endif
      
      <form method="POST" action="{{ url('/login') }}" class="login-form">
        @csrf 
        <div class="form-group">
            <label for="username">Username</label>
            <div class="input-wrapper">
                <i class="fas fa-user"></i>
                <input type="text" id="username" name="username" placeholder="Masukkan username Anda" required autofocus>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrapper">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
            </div>
        </div>

        <div class="form-options" style="display: flex; justify-content: space-between; margin-bottom: 24px;">
          <div class="remember-me" style="display: flex; gap: 8px; align-items: center;">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember" style="margin:0; font-weight: 400;">Ingat saya</label>
          </div>
          <a href="#" class="forgot-password">Lupa password?</a>
        </div>

        <button type="submit" class="btn-login">
          <i class="fas fa-sign-in-alt"></i>
          Masuk Dashboard
        </button>
      </form>

      <div class="divider">
        <span>atau</span>
      </div>

      <div class="auth-link"> 
          Belum punya akun? <a href="{{ url('/register') }}">Daftar sekarang</a>
      </div>
      <div class="divider">
        <span>atau</span>
      </div>
      <div class="admin-link" style="margin-top: 20px; text-align: center; font-size: 13px;">
          <a href="{{ route('admin.login') }}" style="color: #64748b; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 6px;">
              <i class="fas fa-user-shield"></i> Masuk sebagai Admin
          </a>
      </div>

    </div>
  </div>
    </div>
  </div>

  {{-- Bagian Dekorasi Kanan --}}
  <div class="decoration-section">
     <div class="decoration-content">
        <div class="icon"><i class="fas fa-heart-pulse"></i></div>
        <h2>Platform Kesehatan Mental</h2>
        <p>Solusi terintegrasi untuk pengelolaan pasien, jadwal sesi, dan rekam medis elektronik dalam satu pintu.</p>
     </div>
  </div>

</body>
</html>