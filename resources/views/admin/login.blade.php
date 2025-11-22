<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - MindCare</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body class="page-login">

  <div class="login-section">
    <div class="login-container">
      <div class="logo-section">
        <div class="logo-wrapper">
          <div class="logo-icon"><i class="fas fa-user-shield"></i></div>
          <span class="logo-text">MindCare Admin</span>
        </div>
        
        <div class="auth-header">
          <h1>Admin Panel Login</h1>
          <p>Silakan masuk ke panel kontrol admin.</p>
        </div>
      </div>

      @if(session('error'))
        <div class="error">
          <i class="fas fa-exclamation-circle"></i>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      <form method="POST" action="{{ route('admin.login.submit') }}" class="login-form">
        @csrf
        <div class="form-group">
          <label for="username">Username Admin</label>
          <div class="input-wrapper">
            <i class="fas fa-user-shield"></i>
            <input type="text" id="username" name="username" placeholder="Masukkan username admin" required autofocus>
          </div>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <div class="input-wrapper">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
          </div>
        </div>

        <div class="form-options">
          <div class="remember-me">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Ingat saya</label>
          </div>
        </div>

        <button type="submit" class="btn-login">
          <i class="fas fa-sign-in-alt"></i>
          Masuk ke Admin Panel
        </button>
      </form>

      <div class="divider"><span>atau</span></div>

      <div class="auth-link">
        Bukan admin? <a href="{{ url('/') }}">Kembali ke login utama</a>
      </div>
    </div>
  </div>

  <div class="decoration-section">
    <div class="decoration-content">
      <div class="icon"><i class="fas fa-user-shield"></i></div>
      <h2>MindCare Control Panel</h2>
      <p>Kelola pengguna, pantau aktivitas, dan atur seluruh sistem dari satu tempat.</p>
      
      <div class="features" style="margin-top: 30px; display:flex; flex-direction:column; gap:15px;">
        <div class="benefit-item">
          <i class="fas fa-users-cog"></i>
          <div class="text"><h4>Manajemen Pengguna</h4><p>Atur peran dan status</p></div>
        </div>
        <div class="benefit-item">
          <i class="fas fa-chart-line"></i>
          <div class="text"><h4>Analitik Laporan</h4><p>Pantau data sesi</p></div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>