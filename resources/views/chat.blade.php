<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Dokter Virtual - MindCare</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        /* === PERBAIKAN LAYOUT FULL WIDTH === */
        
        /* 1. Override Content Wrapper agar Full Width */
        .content-wrapper {
            max-width: 100% !important; /* Mematikan batasan lebar */
            width: 100% !important;
            padding: 20px !important; /* Padding lebih kecil agar chat luas */
            display: flex;
            flex-direction: column;
            height: calc(100vh - 90px); /* Tinggi layar dikurangi header */
            overflow: hidden; /* Mencegah scroll di wrapper */
        }

        /* 2. Chat Card memenuhi ruang */
        .chat-card {
            background: white; 
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden; 
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            display: flex; 
            flex-direction: column; 
            width: 100%; /* Lebar Penuh */
            flex: 1; /* Mengisi sisa tinggi yang ada */
            height: 100%; /* Memastikan tinggi penuh */
        }

        /* === CSS KOMPONEN CHAT === */
        .chat-header-box { 
            background: #ffffff;
            color: #0f172a; 
            padding: 15px 24px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            border-bottom: 1px solid #f1f5f9;
            flex-shrink: 0; /* Header tidak boleh mengecil */
        }
        .chat-header-box h2 { 
            font-size: 1.1rem; 
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #8b5cf6;
            margin: 0;
        }
        .status-indicator {
            width: 8px; height: 8px; background: #4caf50; border-radius: 50%;
            display: inline-block; animation: pulse 2s infinite;
        }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
        
        .new-chat-btn {
            background: #f5f3ff;
            border: 1px solid #ede9fe;
            color: #8b5cf6;
            padding: 8px 15px; 
            border-radius: 20px; 
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .new-chat-btn:hover { background: #ede9fe; transform: translateY(-2px); }

        .chat-box { 
            flex: 1; /* Mengisi ruang tengah */
            overflow-y: auto; /* Scroll hanya di area pesan */
            padding: 20px; 
            background: #f8fafc;
            display: flex; 
            flex-direction: column;
            gap: 12px;
        }
        .message { 
            padding: 12px 18px; 
            border-radius: 18px; 
            max-width: 75%; 
            line-height: 1.5;
            word-wrap: break-word;
            animation: fadeIn 0.3s ease-in;
            white-space: pre-wrap;
            font-size: 14px;
        }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        
        .message.bot { 
            background: white; color: #334155; align-self: flex-start; border: 1px solid #e2e8f0; 
            border-bottom-left-radius: 4px;
        }
        .message.user { 
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white; align-self: flex-end;
            border-bottom-right-radius: 4px;
        }

        .chat-form { 
            display: flex; padding: 15px 20px; background: white; border-top: 1px solid #f1f5f9; gap: 10px; 
            flex-shrink: 0; /* Input tidak boleh mengecil */
        }
        .chat-form input { 
            flex: 1; padding: 12px 20px; border: 1.5px solid #e2e8f0; border-radius: 25px; outline: none; font-family: 'Inter', sans-serif;
        }
        .chat-form input:focus { border-color: #8b5cf6; box-shadow: 0 0 0 3px #f5f3ff; }
        .chat-form button { 
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white; border: none; width: 48px; height: 48px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: transform 0.2s;
        }
        .chat-form button:hover { transform: scale(1.05); }
        
        .typing-indicator { 
            display: flex; align-items: center; background: white; padding: 12px 16px; 
            border-radius: 18px; align-self: flex-start; border: 1px solid #e2e8f0; color: #64748b; margin-bottom: 10px;
        }
        .typing-dots { display: flex; margin-left: 10px; gap: 4px; }
        .typing-dots span { 
            width: 6px; height: 6px; background: #8b5cf6; border-radius: 50%; animation: blink 1.4s infinite both; 
        }
        .typing-dots span:nth-child(2) { animation-delay: 0.2s; }
        .typing-dots span:nth-child(3) { animation-delay: 0.4s; }
        @keyframes blink { 0%, 100% { opacity: .2; transform: scale(0.8); } 50% { opacity: 1; transform: scale(1); } }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .content-wrapper { padding: 10px !important; height: calc(100vh - 70px); }
            .chat-card { border-radius: 0; border: none; }
            .message { max-width: 85%; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        
        <aside class="sidebar">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <div class="logo-text">
                    <span class="logo-title">MindCare</span>
                    <span class="logo-subtitle">Professional</span>
                </div>
            </div>
            
            <nav>
                <ul class="nav-menu">
                    <li class="nav-section">
                        <div class="nav-section-title">Menu Utama</div>
                        <ul>
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="nav-link">
                                    <i class="fas fa-home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/pasien') }}" class="nav-link">
                                    <i class="fas fa-users"></i>
                                    <span>Profil Pasien</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/jadwal') }}" class="nav-link">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Jadwal Konseling</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('chat.index') }}" class="nav-link active">
                                    <i class="fas fa-comments"></i>
                                    <span>Chat Dokter AI</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-section">
                        <div class="nav-section-title">Laporan</div>
                        <ul>
                             <li class="nav-item">
                                <a href="{{ url('/laporan') }}" class="nav-link">
                                    <i class="fas fa-chart-bar"></i>
                                    <span>Laporan</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-section">
                        <div class="nav-section-title">Akun</div>
                        <ul>
                            <li class="nav-item">
                                <a href="{{ url('/logout') }}" class="nav-link" style="color: #ef4444;">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="header fade-in">
                <div class="header-top">
                    <div class="welcome-text">
                        <h1>Konsultasi AI</h1>
                        <p>Tanyakan keluhan kesehatan Anda kepada Dokter Virtual kami.</p>
                    </div>
                    <div class="header-actions">
                        <div class="status-badge" style="background: #dcfce7; color: #16a34a; padding: 8px 12px; border-radius: 8px; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                            <span style="width: 8px; height: 8px; background: #16a34a; border-radius: 50%;"></span>
                            System Online
                        </div>
                    </div>
                </div>
            </header>

            <div class="content-wrapper">
                <div class="chat-card fade-in">
                    <div class="chat-header-box">
                        <h2>
                            <i class="fas fa-user-md"></i>
                            Dokter Virtual
                            <span class="status-indicator" title="Online"></span>
                        </h2>
                        <button class="new-chat-btn" onclick="startNewChat()" title="Mulai percakapan baru">
                            <i class="fas fa-plus"></i> Reset
                        </button>
                    </div>

                    <div class="chat-box" id="chat-box">
                        <div class="message bot">👋 Halo, <b>{{ Auth::user()->full_name }}</b>! Saya dokter virtual MindCare. <br>Ada yang bisa saya bantu terkait kesehatan Anda hari ini? 😊
                        </div>
                    </div>

                    <form class="chat-form" id="chat-form">
                        @csrf
                        <input type="text" id="chat-input" placeholder="Ketik pesan Anda di sini..." required autocomplete="off">
                        <button type="submit" id="send-btn">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        const sessionId = "{{ $sessionId }}";
        const chatBox = document.getElementById("chat-box");
        const chatInput = document.getElementById("chat-input");
        const sendBtn = document.getElementById("send-btn");
        const csrfToken = document.querySelector('input[name="_token"]').value;

        function addMessage(text, sender = 'bot') {
            const msg = document.createElement('div');
            msg.className = 'message ' + sender;
            msg.innerHTML = text;
            chatBox.appendChild(msg);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function addTypingIndicator() {
            const typing = document.createElement('div');
            typing.className = 'typing-indicator';
            typing.id = 'typing-indicator';
            typing.innerHTML = '<span>Dokter sedang mengetik</span><div class="typing-dots"><span></span><span></span><span></span></div>';
            chatBox.appendChild(typing);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function removeTypingIndicator() {
            const typing = document.getElementById('typing-indicator');
            if (typing) typing.remove();
        }

        function disableInput(disabled) {
            chatInput.disabled = disabled;
            sendBtn.disabled = disabled;
        }

        async function sendMessage(message) {
            if (!message.trim()) return;
            
            addMessage(message, 'user');
            addTypingIndicator();
            disableInput(true);
            chatInput.value = '';

            try {
                const res = await fetch("{{ route('chat.send') }}", {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ 
                        message: message,
                        session_id: sessionId 
                    })
                });

                const data = await res.json();
                removeTypingIndicator();
                
                if (data.success && data.response) {
                    addMessage(data.response, 'bot');
                } else {
                    addMessage("⚠ " + (data.error || "Maaf, terjadi kesalahan."), 'bot');
                    console.error('Error:', data);
                }
            } catch (e) {
                removeTypingIndicator();
                addMessage("❌ Terjadi kesalahan koneksi. Cek internet atau server.", 'bot');
                console.error('Fetch error:', e);
            } finally {
                disableInput(false);
                chatInput.focus();
            }
        }

        document.getElementById('chat-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const msg = chatInput.value.trim();
            if (!msg) return;
            sendMessage(msg);
        });

        function startNewChat() {
            if (confirm('Mulai percakapan baru? Chat saat ini akan dibersihkan.')) {
                chatBox.innerHTML = '<div class="message bot">👋 Sesi baru dimulai! Silakan ceritakan keluhan Anda. 😊</div>';
                chatInput.value = '';
                chatInput.focus();
            }
        }

        window.addEventListener('load', () => {
            chatInput.focus();
        });
    </script>
</body>
</html>