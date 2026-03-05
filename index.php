<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ULTRA | Profesyonel Sorgu Paneli</title>
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <style>
        /* ==================== RESET & VARIABLES ==================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        :root {
            --bg-primary: #0a0f1e;
            --bg-secondary: #121828;
            --bg-card: #1a1f32;
            --bg-hover: #252b3d;
            --accent-primary: #4f46e5;
            --accent-secondary: #7c3aed;
            --accent-glow: rgba(79, 70, 229, 0.3);
            --text-primary: #ffffff;
            --text-secondary: #a0a8c0;
            --text-muted: #6b7280;
            --border-color: #2a3142;
            --success: #10b981;
            --error: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
        }

        body {
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* ==================== ANİMASYONLAR ==================== */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes glowPulse {
            0%, 100% {
                box-shadow: 0 0 20px var(--accent-glow);
            }
            50% {
                box-shadow: 0 0 40px var(--accent-glow);
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* ==================== LOADING ANİMASYONU ==================== */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--bg-primary);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .loading-overlay.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loading-logo {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: spin 2s linear infinite, glowPulse 2s ease infinite;
            position: relative;
        }

        .loading-logo::before {
            content: '';
            position: absolute;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 2px solid transparent;
            border-top-color: var(--accent-primary);
            border-bottom-color: var(--accent-secondary);
            animation: spin 1.5s linear infinite;
        }

        .loading-logo i {
            font-size: 50px;
            color: white;
            animation: float 2s ease infinite;
        }

        .loading-text {
            position: absolute;
            bottom: -40px;
            color: var(--text-secondary);
            font-size: 14px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* ==================== TRANSITION EFEKTLERİ ==================== */
        .fade-enter {
            opacity: 0;
            transform: translateY(10px);
        }

        .fade-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .fade-exit {
            opacity: 1;
            transform: translateY(0);
        }

        .fade-exit-active {
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        /* ==================== NAVBAR & HAMBURGER ==================== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 20px 40px;
            background: rgba(10, 15, 30, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .logo i {
            font-size: 24px;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hamburger {
            width: 50px;
            height: 50px;
            background: var(--bg-card);
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
            position: relative;
            z-index: 1001;
        }

        .hamburger:hover {
            background: var(--bg-hover);
            transform: scale(1.05);
            border-color: var(--accent-primary);
        }

        .hamburger.active {
            background: var(--accent-primary);
        }

        .hamburger span {
            width: 25px;
            height: 2px;
            background: var(--text-primary);
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
            transform: scale(0);
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }

        /* ==================== HAMBURGER MENÜ ==================== */
        .menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 998;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .menu-panel {
            position: fixed;
            top: 0;
            right: -400px;
            width: 350px;
            height: 100%;
            background: var(--bg-secondary);
            border-left: 1px solid var(--border-color);
            z-index: 999;
            transition: right 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            overflow-y: auto;
            padding: 100px 20px 30px;
        }

        .menu-panel.active {
            right: 0;
        }

        .menu-header {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            background: var(--bg-card);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 1px solid var(--border-color);
        }

        .menu-avatar {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            font-weight: 700;
        }

        .menu-user h4 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .menu-user p {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .menu-category {
            margin-bottom: 20px;
        }

        .menu-category-title {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-bottom: 10px;
            padding-left: 10px;
        }

        .menu-items {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .menu-item {
            padding: 12px 15px;
            background: var(--bg-card);
            border-radius: 10px;
            border: 1px solid var(--border-color);
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .menu-item:hover {
            background: var(--bg-hover);
            border-color: var(--accent-primary);
            transform: translateX(-5px);
        }

        .menu-item i {
            width: 20px;
            color: var(--accent-primary);
        }

        .menu-item span {
            flex: 1;
            font-size: 14px;
        }

        .menu-item .badge {
            padding: 3px 8px;
            background: var(--accent-primary);
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
        }

        .menu-footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            text-align: center;
        }

        .menu-footer a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 13px;
            margin: 0 10px;
            transition: color 0.2s ease;
        }

        .menu-footer a:hover {
            color: var(--accent-primary);
        }

        /* ==================== MAIN CONTENT ==================== */
        .main-content {
            margin-top: 90px;
            padding: 20px 40px 40px;
            min-height: calc(100vh - 90px);
        }

        /* ==================== HERO SECTION ==================== */
        .hero {
            text-align: center;
            padding: 60px 20px;
            animation: slideIn 1s ease;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #fff, var(--text-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 18px;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto 30px;
            line-height: 1.6;
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 40px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: var(--accent-primary);
            display: block;
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-secondary);
        }

        /* ==================== SORGU KARTLARI ==================== */
        .queries-section {
            padding: 40px 0;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }

        .queries-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .section-title {
            font-size: 24px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--accent-primary);
        }

        .queries-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .query-card {
            background: var(--bg-card);
            border-radius: 15px;
            padding: 20px;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateY(20px);
            animation: slideIn 0.5s ease forwards;
        }

        .query-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-primary);
            box-shadow: 0 10px 30px rgba(79, 70, 229, 0.2);
        }

        .query-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, transparent, rgba(79, 70, 229, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .query-card:hover::before {
            opacity: 1;
        }

        .query-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
        }

        .query-icon i {
            font-size: 24px;
            color: white;
        }

        .query-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .query-desc {
            font-size: 13px;
            color: var(--text-secondary);
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .query-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .tag {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .tag.blue {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
        }

        .tag.purple {
            background: rgba(139, 92, 246, 0.2);
            color: #8b5cf6;
        }

        .tag.green {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        /* ==================== SORGU FORMU ==================== */
        .query-form-container {
            background: var(--bg-card);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid var(--border-color);
            margin: 20px 0;
            animation: slideIn 0.5s ease;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-secondary);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-primary);
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px var(--accent-glow);
        }

        .btn-submit i {
            font-size: 18px;
        }

        /* ==================== SONUÇ ALANI ==================== */
        .result-container {
            background: var(--bg-card);
            border-radius: 20px;
            padding: 25px;
            border: 1px solid var(--border-color);
            margin: 20px 0;
            animation: slideIn 0.5s ease;
        }

        .result-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .result-header h3 {
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .result-header i {
            color: var(--accent-primary);
        }

        .result-content {
            font-family: 'Monaco', 'Menlo', monospace;
            font-size: 13px;
            line-height: 1.6;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .result-item {
            padding: 10px;
            background: var(--bg-primary);
            border-radius: 8px;
            margin-bottom: 8px;
            border: 1px solid var(--border-color);
        }

        .result-item strong {
            color: var(--accent-primary);
            margin-right: 10px;
        }

        .error-container {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid var(--error);
            border-radius: 10px;
            padding: 15px;
            margin: 20px 0;
            color: var(--error);
            animation: slideIn 0.5s ease;
        }

        .loading-spinner {
            text-align: center;
            padding: 40px;
        }

        .loading-spinner i {
            font-size: 40px;
            color: var(--accent-primary);
            animation: spin 2s linear infinite;
        }

        .loading-spinner p {
            margin-top: 10px;
            color: var(--text-secondary);
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
            }

            .main-content {
                padding: 20px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .hero p {
                font-size: 16px;
            }

            .hero-stats {
                flex-direction: column;
                gap: 20px;
            }

            .menu-panel {
                width: 100%;
                right: -100%;
            }

            .queries-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ==================== SCROLLBAR ==================== */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-primary);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-primary);
        }
    </style>
</head>
<body>
    <!-- LOADING ANİMASYONU -->
    <div class="loading-overlay" id="loadingOverlay">
        <div style="position: relative;">
            <div class="loading-logo">
                <i class="fas fa-shield-halos"></i>
            </div>
            <div class="loading-text">ULTRA PANEL</div>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-shield-halos"></i>
            <span>ULTRA</span>
        </div>
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <!-- HAMBURGER MENÜ -->
    <div class="menu-overlay" id="menuOverlay"></div>
    <div class="menu-panel" id="menuPanel">
        <div class="menu-header">
            <div class="menu-avatar">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="menu-user">
                <h4>Misafir Kullanıcı</h4>
                <p><i class="fas fa-circle" style="color: var(--success); font-size: 8px;"></i> Aktif</p>
            </div>
        </div>

        <div class="menu-category">
            <div class="menu-category-title">ANA SAYFA</div>
            <div class="menu-items">
                <div class="menu-item" onclick="showHome()">
                    <i class="fas fa-home"></i>
                    <span>Ana Sayfa</span>
                </div>
                <div class="menu-item" onclick="showStats()">
                    <i class="fas fa-chart-line"></i>
                    <span>İstatistikler</span>
                    <span class="badge">11K</span>
                </div>
            </div>
        </div>

        <div class="menu-category">
            <div class="menu-category-title">TC SORGULARI</div>
            <div class="menu-items">
                <div class="menu-item" onclick="showQueryForm('tc_eski')">
                    <i class="fas fa-id-card"></i>
                    <span>TC Basic (Eski)</span>
                </div>
                <div class="menu-item" onclick="showQueryForm('tcpro')">
                    <i class="fas fa-id-card"></i>
                    <span>TC PRO (Yeni)</span>
                    <span class="badge">POPÜLER</span>
                </div>
                <div class="menu-item" onclick="showQueryForm('tcgsm_eski')">
                    <i class="fas fa-phone-alt"></i>
                    <span>TC/GSM (Eski)</span>
                </div>
            </div>
        </div>

        <div class="menu-category">
            <div class="menu-category-title">AD SOYAD SORGULARI</div>
            <div class="menu-items">
                <div class="menu-item" onclick="showQueryForm('adsoyad_eski')">
                    <i class="fas fa-user"></i>
                    <span>Ad Soyad Basic</span>
                </div>
                <div class="menu-item" onclick="showQueryForm('adsoyadpro')">
                    <i class="fas fa-user"></i>
                    <span>Ad Soyad PRO</span>
                </div>
            </div>
        </div>

        <div class="menu-category">
            <div class="menu-category-title">AİLE SORGULARI</div>
            <div class="menu-items">
                <div class="menu-item" onclick="showQueryForm('aile_eski')">
                    <i class="fas fa-users"></i>
                    <span>TC Aile (Eski)</span>
                </div>
                <div class="menu-item" onclick="showQueryForm('ailepro')">
                    <i class="fas fa-users"></i>
                    <span>Aile PRO</span>
                </div>
                <div class="menu-item" onclick="showQueryForm('sulale_eski')">
                    <i class="fas fa-tree"></i>
                    <span>TC Sülale</span>
                </div>
            </div>
        </div>

        <div class="menu-category">
            <div class="menu-category-title">ADRES SORGULARI</div>
            <div class="menu-items">
                <div class="menu-item" onclick="showQueryForm('adres_eski')">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>TC Adres (Eski)</span>
                </div>
                <div class="menu-item" onclick="showQueryForm('adres')">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>TC Adres (Yeni)</span>
                </div>
            </div>
        </div>

        <div class="menu-category">
            <div class="menu-category-title">GSM SORGULARI</div>
            <div class="menu-items">
                <div class="menu-item" onclick="showQueryForm('gsmtc_eski')">
                    <i class="fas fa-phone"></i>
                    <span>GSM/TC (Eski)</span>
                </div>
                <div class="menu-item" onclick="showQueryForm('operator_eski')">
                    <i class="fas fa-phone"></i>
                    <span>Operatör (Eski)</span>
                </div>
                <div class="menu-item" onclick="showQueryForm('gncloperator')">
                    <i class="fas fa-phone"></i>
                    <span>Güncel Operatör</span>
                </div>
            </div>
        </div>

        <div class="menu-category">
            <div class="menu-category-title">DİĞER SORGULAR</div>
            <div class="menu-items">
                <div class="menu-item" onclick="showQueryForm('iban')">
                    <i class="fas fa-university"></i>
                    <span>IBAN Sorgu</span>
                </div>
            </div>
        </div>

        <div class="menu-footer">
            <a href="https://t.me/doxbinhack" target="_blank"><i class="fab fa-telegram"></i> Kanal</a>
            <a href="https://t.me/DoxbinJA" target="_blank"><i class="fab fa-telegram"></i> Admin</a>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content" id="mainContent">
        <!-- Dinamik içerik buraya yüklenecek -->
    </div>

    <script>
        // ==================== PROXY & USER-AGENT HAVUZU ====================
        const PROXY_LIST = [
            'http://45.87.213.207:8080',
            'http://185.217.131.117:8080',
            'http://185.208.156.155:8080',
            'http://45.129.14.82:8080',
            'http://185.217.131.118:8080'
        ];

        const USER_AGENTS = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Safari/605.1.15',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1',
            'Mozilla/5.0 (Linux; Android 13; SM-S918B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.6099.210 Mobile Safari/537.36'
        ];

        // ==================== API KONFİGÜRASYON ====================
        const API = {
            sckizm: {
                base: 'https://api.sckizm.shop/api',
                endpoints: {
                    tc_eski: '/tc',
                    adsoyad_eski: '/adsoyad',
                    tcgsm_eski: '/tcgsm',
                    gsmtc_eski: '/gsmtc',
                    adres_eski: '/adres',
                    aile_eski: '/aile',
                    sulale_eski: '/sulale',
                    operator_eski: '/operator'
                }
            },
            punisher: {
                base: 'https://punisherapi.alwaysdata.net',
                endpoints: {
                    gncloperator: '/api/subnetdevil/gncloperator.php',
                    adsoyadpro: '/apiservices/adsoyadpro.php',
                    adres: '/api/subnetdevil/adres.php',
                    ailepro: '/api/subnetdevil/ailepro.php',
                    tcpro: '/api/subnetdevil/tcpro.php',
                    iban: '/apiservices/iban.php'
                }
            }
        };

        // ==================== REKLAM TEMİZLEME ====================
        const REKLAM_ANAHTARLARI = [
            'status', 'message', 'developer', 'version', 'timestamp',
            'endpoints', 'type', 'success', 'time', 'elapsed'
        ];

        function temizleVeri(data) {
            if (!data) return null;
            
            if (Array.isArray(data)) {
                return data.map(item => temizleVeri(item)).filter(item => item !== null);
            }
            
            if (typeof data === 'object') {
                // Önce results veya data varsa onları al
                if (data.results && Array.isArray(data.results)) {
                    return temizleVeri(data.results);
                }
                if (data.data) {
                    return temizleVeri(data.data);
                }
                
                const temiz = {};
                for (const [key, value] of Object.entries(data)) {
                    if (!REKLAM_ANAHTARLARI.includes(key.toLowerCase())) {
                        if (value !== null && value !== '' && value !== 'null') {
                            temiz[key] = typeof value === 'object' ? temizleVeri(value) : value;
                        }
                    }
                }
                return Object.keys(temiz).length ? temiz : null;
            }
            
            return data;
        }

        // ==================== API İSTEK FONKSİYONU (Proxy + User-Agent) ====================
        async function apiIstek(apiName, endpoint, params) {
            const api = API[apiName];
            if (!api) throw new Error('API bulunamadı');
            
            const url = `${api.base}${api.endpoints[endpoint]}`;
            const userAgent = USER_AGENTS[Math.floor(Math.random() * USER_AGENTS.length)];
            const proxy = PROXY_LIST[Math.floor(Math.random() * PROXY_LIST.length)];
            
            const headers = {
                'User-Agent': userAgent,
                'Accept': 'application/json',
                'X-Proxy': proxy  // Proxy bilgisi header'da
            };
            
            try {
                // Not: Browser'da proxy kullanımı kısıtlı, header olarak ekliyoruz
                const response = await fetch(`${url}?${new URLSearchParams(params)}`, { headers });
                const data = await response.json();
                return temizleVeri(data);
            } catch (error) {
                console.error('API Hatası:', error);
                throw error;
            }
        }

        // ==================== LOADING YÖNETİMİ ====================
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('loadingOverlay').classList.add('hidden');
                showHome();
            }, 1500);
        });

        // ==================== HAMBURGER MENÜ ====================
        const hamburger = document.getElementById('hamburger');
        const menuPanel = document.getElementById('menuPanel');
        const menuOverlay = document.getElementById('menuOverlay');

        function toggleMenu() {
            hamburger.classList.toggle('active');
            menuPanel.classList.toggle('active');
            menuOverlay.classList.toggle('active');
            document.body.style.overflow = menuPanel.classList.contains('active') ? 'hidden' : '';
        }

        hamburger.addEventListener('click', toggleMenu);
        menuOverlay.addEventListener('click', toggleMenu);

        // ==================== İÇERİK YÖNETİMİ ====================
        const mainContent = document.getElementById('mainContent');

        function showHome() {
            if (window.innerWidth <= 768) toggleMenu();
            
            mainContent.innerHTML = `
                <div class="hero">
                    <h1>Profesyonel Sorgu Paneli</h1>
                    <p>20+ farklı sorgu türü ile anlık bilgi. Hamburger menüden sorgu seçin.</p>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <span class="stat-number">11.237</span>
                            <span class="stat-label">Kullanıcı</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">2.8M</span>
                            <span class="stat-label">Sorgu</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">0.3s</span>
                            <span class="stat-label">Yanıt</span>
                        </div>
                    </div>
                </div>
                <div class="queries-section visible">
                    <h2 class="section-title"><i class="fas fa-star"></i> Popüler Sorgular</h2>
                    <div class="queries-grid">
                        ${Object.entries({
                            'tcpro': ['TC PRO', 'TC ile tüm detaylı bilgiler', 'purple'],
                            'adsoyadpro': ['Ad Soyad PRO', 'İsim + il ile detaylı sorgu', 'purple'],
                            'ailepro': ['Aile PRO', 'Detaylı aile bilgileri', 'purple'],
                            'iban': ['IBAN Sorgu', 'IBAN ile banka bilgileri', 'blue']
                        }).map(([key, [ad, desc, renk]]) => `
                            <div class="query-card" onclick="showQueryForm('${key}')">
                                <div class="query-icon"><i class="fas fa-search"></i></div>
                                <div class="query-title">${ad}</div>
                                <div class="query-desc">${desc}</div>
                                <div class="query-tags">
                                    <span class="tag ${renk}">POPÜLER</span>
                                    <span class="tag green">ÜCRETSİZ</span>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `;
        }

        function showStats() {
            if (window.innerWidth <= 768) toggleMenu();
            
            mainContent.innerHTML = `
                <div class="query-form-container">
                    <h3 style="margin-bottom: 20px;"><i class="fas fa-chart-line"></i> İstatistikler</h3>
                    <div style="display: grid; gap: 15px;">
                        <div class="result-item"><strong>👥 Toplam Kullanıcı:</strong> 11.237</div>
                        <div class="result-item"><strong>⭐ Premium Kullanıcı:</strong> 3.892</div>
                        <div class="result-item"><strong>🆓 Bedava Kullanıcı:</strong> 7.345</div>
                        <div class="result-item"><strong>🔍 Toplam Sorgu:</strong> 2.845.678</div>
                        <div class="result-item"><strong>📊 Günlük Sorgu:</strong> 89.456</div>
                        <div class="result-item"><strong>⚡ Ortalama Süre:</strong> 0.3 saniye</div>
                        <div class="result-item"><strong>🌐 Aktif Proxy:</strong> ${PROXY_LIST.length}</div>
                        <div class="result-item"><strong>🔄 User-Agent:</strong> ${USER_AGENTS.length}</div>
                    </div>
                </div>
            `;
        }

        // ==================== SORGU FORMU ====================
        const SORGU_TIPLERI = {
            tc_eski: { api: 'sckizm', endpoint: 'tc_eski', params: ['tc'], label: 'TC Kimlik No', placeholder: '11 haneli TC girin' },
            tcpro: { api: 'punisher', endpoint: 'tcpro', params: ['tc'], label: 'TC Kimlik No', placeholder: '11 haneli TC girin' },
            tcgsm_eski: { api: 'sckizm', endpoint: 'tcgsm_eski', params: ['tc'], label: 'TC Kimlik No', placeholder: '11 haneli TC girin' },
            adsoyad_eski: { api: 'sckizm', endpoint: 'adsoyad_eski', params: ['ad', 'soyad'], label: 'Ad Soyad', placeholder: 'Örn: Roket Atar' },
            adsoyadpro: { api: 'punisher', endpoint: 'adsoyadpro', params: ['ad', 'soyad', 'il'], label: 'Ad Soyad İl', placeholder: 'Örn: Roket Atar Bursa' },
            aile_eski: { api: 'sckizm', endpoint: 'aile_eski', params: ['tc'], label: 'TC Kimlik No', placeholder: '11 haneli TC girin' },
            ailepro: { api: 'punisher', endpoint: 'ailepro', params: ['tc'], label: 'TC Kimlik No', placeholder: '11 haneli TC girin' },
            sulale_eski: { api: 'sckizm', endpoint: 'sulale_eski', params: ['tc'], label: 'TC Kimlik No', placeholder: '11 haneli TC girin' },
            adres_eski: { api: 'sckizm', endpoint: 'adres_eski', params: ['tc'], label: 'TC Kimlik No', placeholder: '11 haneli TC girin' },
            adres: { api: 'punisher', endpoint: 'adres', params: ['tc'], label: 'TC Kimlik No', placeholder: '11 haneli TC girin' },
            gsmtc_eski: { api: 'sckizm', endpoint: 'gsmtc_eski', params: ['gsm'], label: 'GSM Numarası', placeholder: '10 haneli GSM (örn: 5530961609)' },
            operator_eski: { api: 'sckizm', endpoint: 'operator_eski', params: ['gsm'], label: 'GSM Numarası', placeholder: '10 haneli GSM' },
            gncloperator: { api: 'punisher', endpoint: 'gncloperator', params: ['gsm'], label: 'GSM Numarası', placeholder: '10 haneli GSM' },
            iban: { api: 'punisher', endpoint: 'iban', params: ['iban'], label: 'IBAN', placeholder: 'IBAN girin (örn: TR280006256953335759003718)' }
        };

        function showQueryForm(sorguTipi) {
            if (window.innerWidth <= 768) toggleMenu();
            
            const tip = SORGU_TIPLERI[sorguTipi];
            if (!tip) return;

            let formHtml = `
                <div class="query-form-container">
                    <h3 style="margin-bottom: 20px;"><i class="fas fa-search"></i> ${sorguTipi.replace('_', ' ').toUpperCase()}</h3>
                    <form id="queryForm" onsubmit="event.preventDefault(); sorgula('${sorguTipi}')">
            `;

            if (tip.params.length === 1) {
                formHtml += `
                    <div class="form-group">
                        <label>${tip.label}</label>
                        <input type="text" class="form-control" id="param1" placeholder="${tip.placeholder}" required>
                    </div>
                `;
            } else if (tip.params.length === 2) {
                formHtml += `
                    <div class="form-group">
                        <label>Ad</label>
                        <input type="text" class="form-control" id="param1" placeholder="Ad" required>
                    </div>
                    <div class="form-group">
                        <label>Soyad</label>
                        <input type="text" class="form-control" id="param2" placeholder="Soyad" required>
                    </div>
                `;
            } else if (tip.params.length === 3) {
                formHtml += `
                    <div class="form-group">
                        <label>Ad</label>
                        <input type="text" class="form-control" id="param1" placeholder="Ad" required>
                    </div>
                    <div class="form-group">
                        <label>Soyad</label>
                        <input type="text" class="form-control" id="param2" placeholder="Soyad" required>
                    </div>
                    <div class="form-group">
                        <label>İl</label>
                        <input type="text" class="form-control" id="param3" placeholder="İl" required>
                    </div>
                `;
            }

            formHtml += `
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-search"></i> SORGULA
                        </button>
                    </form>
                </div>
                <div id="sonucAlan"></div>
            `;

            mainContent.innerHTML = formHtml;
        }

        // ==================== SORGU İŞLEME ====================
        async function sorgula(sorguTipi) {
            const tip = SORGU_TIPLERI[sorguTipi];
            if (!tip) return;

            // Parametreleri topla
            const params = {};
            if (tip.params.length === 1) {
                params[tip.params[0]] = document.getElementById('param1').value;
            } else {
                for (let i = 0; i < tip.params.length; i++) {
                    params[tip.params[i]] = document.getElementById(`param${i+1}`).value;
                }
            }

            // Loading göster
            document.getElementById('sonucAlan').innerHTML = `
                <div class="loading-spinner">
                    <i class="fas fa-circle-notch"></i>
                    <p>Sorgulanıyor, lütfen bekleyin...</p>
                </div>
            `;

            try {
                const sonuc = await apiIstek(tip.api, tip.endpoint, params);
                
                let sonucHtml = '<div class="result-container">';
                sonucHtml += '<div class="result-header"><h3><i class="fas fa-check-circle" style="color: var(--success);"></i> SORGULAMA SONUCU</h3></div>';
                
                if (!sonuc) {
                    sonucHtml += '<p>Sonuç bulunamadı.</p>';
                } else if (Array.isArray(sonuc)) {
                    sonuc.forEach((item, index) => {
                        sonucHtml += `<div class="result-item"><strong>#${index + 1}</strong></div>`;
                        for (const [key, value] of Object.entries(item)) {
                            if (value) {
                                sonucHtml += `<div class="result-item"><strong>${key}:</strong> ${value}</div>`;
                            }
                        }
                    });
                } else if (typeof sonuc === 'object') {
                    for (const [key, value] of Object.entries(sonuc)) {
                        if (value && typeof value !== 'object') {
                            sonucHtml += `<div class="result-item"><strong>${key}:</strong> ${value}</div>`;
                        }
                    }
                } else {
                    sonucHtml += `<div class="result-item">${sonuc}</div>`;
                }
                
                sonucHtml += '</div>';
                document.getElementById('sonucAlan').innerHTML = sonucHtml;
                
            } catch (error) {
                document.getElementById('sonucAlan').innerHTML = `
                    <div class="error-container">
                        <i class="fas fa-exclamation-triangle"></i> Hata: ${error.message}
                    </div>
                `;
            }
        }

        // ==================== SAYFA DEĞİŞİM EFEKTLERİ ====================
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('menu-item') || e.target.closest('.menu-item')) {
                document.querySelectorAll('.menu-item').forEach(item => {
                    item.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        item.style.transform = '';
                    }, 200);
                });
            }
        });
    </script>
</body>
</html>
