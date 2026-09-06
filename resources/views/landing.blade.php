<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOMSAFE — Sistem Manajemen Dokumen Instansi</title>
    <meta name="description" content="KOMSAFE menyimpan, mengelola, dan mengamankan seluruh dokumen serta arsip instansi Anda dalam satu ruang kerja digital — dibangun khusus mengikuti kebutuhan lingkungan pemerintahan.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="{{ asset('js/lottie.min.js') }}"></script>
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --navy:       #0f1a2e;
            --navy-mid:   #162236;
            --navy-light: #1c2d47;
            --gold:       #4c6bca;
            --gold-hover: #3f5bb5;
            --gold-light: #6b88e2;
            --white:      #ffffff;
            --gray-50:    #f8f9fa;
            --gray-100:   #f1f3f5;
            --gray-200:   #e9ecef;
            --gray-300:   #dee2e6;
            --gray-500:   #adb5bd;
            --gray-600:   #6c757d;
            --text-dark:  #1a1e2e;
            --text-muted: #64748b;
        }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; color: var(--text-dark); background: var(--white); line-height: 1.6; overflow-x: hidden; }

        /* NAVBAR */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            background: var(--navy); border-bottom: 1px solid rgba(255,255,255,.07);
            height: 64px; display: flex; align-items: center; padding: 0 32px;
        }
        .navbar-inner {
            max-width: 1200px; margin: 0 auto; width: 100%;
            display: flex; align-items: center; justify-content: space-between;
        }
        .navbar-brand {
            display: flex; align-items: center; gap: 10px;
            text-decoration: none; flex-shrink: 0;
        }
        .navbar-logo-img {
            width: 36px; height: 36px; object-fit: contain;
            /* logo sudah berwarna, tidak perlu filter */
        }
        .navbar-brand-text {
            font-size: 17px; font-weight: 800; color: var(--white);
            letter-spacing: 2px; text-transform: uppercase;
            transform: translateY(2px);
        }
        .navbar-links {
            display: flex; align-items: center; gap: 36px; list-style: none;
        }
        .navbar-links a {
            text-decoration: none; font-size: 14px; font-weight: 500;
            color: rgba(255,255,255,.72); transition: color .2s;
        }
        .navbar-links a:hover { color: var(--white); }
        .navbar-actions { display: flex; align-items: center; gap: 12px; }
        .btn-register {
            font-family: 'Inter', sans-serif; font-size: 13px; font-weight: 600;
            color: rgba(255,255,255,.8); background: transparent;
            border: 1.5px solid rgba(255,255,255,.25); border-radius: 4px;
            padding: 8px 18px; cursor: pointer; text-decoration: none;
            transition: all .2s; white-space: nowrap;
        }
        .btn-register:hover {
            color: var(--white); border-color: rgba(255,255,255,.55);
            background: rgba(255,255,255,.06);
        }
        .btn-masuk {
            font-family: 'Inter', sans-serif; font-size: 13px; font-weight: 700;
            color: var(--white); background: var(--gold); border: none;
            border-radius: 4px; padding: 9px 22px; cursor: pointer;
            text-decoration: none; transition: background .2s; white-space: nowrap;
        }
        .btn-masuk:hover { background: var(--gold-hover); }

        /* HERO */
        .hero {
            background: #0f1a2e; min-height: 100vh; display: flex;
            align-items: center; padding: 0 32px; padding-top: 64px;
        }


        .hero-inner {
            max-width: 1200px; margin: 0 auto; width: 100%;
            display: grid; grid-template-columns: 1fr 1fr;
            align-items: center; gap: 80px;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(76,107,202,.15); border: 1px solid rgba(76,107,202,.35);
            border-radius: 99px; padding: 5px 14px; font-size: 12px; font-weight: 600;
            color: var(--gold-light); letter-spacing: .5px; margin-bottom: 24px;
        }
        .hero-badge-dot {
            width: 6px; height: 6px; border-radius: 50%; background: var(--gold);
            animation: pulse-dot 2s infinite;
        }
        @keyframes pulse-dot { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(.7)} }
        .hero-title {
            font-size: clamp(30px, 4vw, 50px); font-weight: 800; line-height: 1.15;
            color: var(--white); margin-bottom: 20px;
        }
        .hero-title em { font-style: normal; color: var(--gold); }
        .hero-desc {
            font-size: 15.5px; color: rgba(255,255,255,.65); line-height: 1.75;
            max-width: 460px; margin-bottom: 36px;
        }
        .hero-cta { display: flex; align-items: center; gap: 16px; flex-wrap: wrap; }
        .btn-primary {
            display: inline-block; font-family: 'Inter', sans-serif; font-size: 14px;
            font-weight: 700; color: var(--white); background: var(--gold); border: none;
            border-radius: 4px; padding: 13px 28px; cursor: pointer; text-decoration: none;
            transition: background .2s;
        }
        .btn-primary:hover { background: var(--gold-hover); }
        .btn-ghost-link {
            font-size: 14px; font-weight: 600; color: rgba(255,255,255,.7);
            text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: color .2s;
        }
        .btn-ghost-link:hover { color: var(--white); }
        .btn-ghost-link svg { transition: transform .2s; }
        .btn-ghost-link:hover svg { transform: translateX(3px); }
        .hero-note { margin-top: 20px; font-size: 12px; color: rgba(255,255,255,.35); }

        /* MOCKUP */
        .hero-visual { display: flex; justify-content: flex-end; }

        /* SECTIONS */
        .section { padding: 96px 32px; }
        .section-inner { max-width: 1200px; margin: 0 auto; }
        .section-label { font-size: 12px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--gold); margin-bottom: 12px; }
        .section-title { font-size: clamp(24px, 3vw, 36px); font-weight: 800; color: var(--text-dark); line-height: 1.25; margin-bottom: 14px; }
        .section-desc { font-size: 15.5px; color: var(--text-muted); max-width: 600px; line-height: 1.7; margin-bottom: 52px; }

        /* FEATURES */
        .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; }
        .feature-card {
            background: var(--gray-50); border: 1px solid var(--gray-200);
            border-radius: 8px; padding: 26px; transition: border-color .2s, background-color .2s;
        }
        .feature-card:hover { border-color: rgba(76,107,202,.3); background-color: var(--white); }
        .fi-wrap { width: 52px; height: 52px; background: rgba(76,107,202,.12); border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-bottom: 16px; }
        .fi-wrap img { width: 26px; height: 26px; object-fit: contain; filter: brightness(0) saturate(100%) invert(43%) sepia(50%) saturate(1487%) hue-rotate(193deg) brightness(88%) contrast(92%); }
        .feature-title { font-size: 14.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px; }
        .feature-desc { font-size: 13.5px; color: var(--text-muted); line-height: 1.6; }

        /* SECURITY */
        .security-section { background: var(--gray-50); border-top: 1px solid var(--gray-200); border-bottom: 1px solid var(--gray-200); }
        .sc-card:hover { border-color: rgba(76,107,202,.3); background: var(--white); }
        .si-wrap { width: 56px; height: 56px; border-radius: 50%; background: var(--gray-50); display: flex; align-items: center; justify-content: center; margin-bottom: 20px; transition: background .2s; }
        .sc-card:hover .si-wrap { background: rgba(76,107,202,.1); }
        .si-wrap img { width: 32px; height: 32px; object-fit: contain; filter: brightness(0) saturate(100%) invert(43%) sepia(50%) saturate(1487%) hue-rotate(193deg) brightness(88%) contrast(92%); }
        .security-title { font-size: 14.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 6px; }
        .security-desc { font-size: 13.5px; color: var(--text-muted); line-height: 1.6; }
        .faq-section-title { font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 18px; }
        .faq-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .faq-item { background: var(--white); border: 1px solid var(--gray-200); border-radius: 6px; padding: 18px 20px; transition: border-color .2s, background-color .2s; }
        .faq-item:hover { border-color: rgba(76,107,202,.4); background-color: var(--gray-50); }
        .faq-question { font-size: 13.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 5px; }
        .faq-answer { font-size: 13px; color: var(--text-muted); line-height: 1.6; }

        /* SHARE */
        .share-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 72px; align-items: center; }
        .feature-list { list-style: none; display: flex; flex-direction: column; gap: 20px; }
        .feature-list-item { display: flex; gap: 14px; align-items: flex-start; }
        .fl-icon { width: 44px; height: 44px; background: rgba(76,107,202,.10); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px; }
        .fl-icon img { width: 22px; height: 22px; object-fit: contain; filter: brightness(0) saturate(100%) invert(43%) sepia(50%) saturate(1487%) hue-rotate(193deg) brightness(88%) contrast(92%); }
        .fl-title { font-size: 14.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 4px; }
        .fl-desc { font-size: 13.5px; color: var(--text-muted); line-height: 1.6; }
        .share-diagram {
            background: var(--gray-50); border: 1px solid var(--gray-200); border-radius: 12px;
            padding: 40px; display: flex; flex-direction: column; align-items: center; gap: 28px;
            min-height: 280px; justify-content: center;
        }
        .share-nodes { display: flex; align-items: center; justify-content: center; gap: 16px; flex-wrap: wrap; width: 100%; }
        .share-node { background: var(--navy); color: var(--white); border-radius: 6px; padding: 12px 22px; font-size: 13px; font-weight: 700; min-width: 90px; text-align: center; }
        .share-node-main { background: var(--navy-light); }
        .share-lock { display: flex; flex-direction: column; align-items: center; gap: 8px; }
        .share-lock-icon { width: 52px; height: 52px; background: rgba(76,107,202,.12); border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .share-lock-label { font-size: 12px; color: var(--text-muted); text-align: center; }

        /* FOOTER */
        .footer { background: var(--white); border-top: 1px solid var(--gray-200); padding: 24px 32px; text-align: center; }
        .footer p { font-size: 13px; color: var(--text-muted); }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .hero-inner { grid-template-columns: 1fr; gap: 48px; padding: 60px 0; }
            .hero-visual { justify-content: center; }
            .features-grid { grid-template-columns: repeat(2, 1fr); }
            .security-grid { grid-template-columns: repeat(2, 1fr); }
            .share-layout { grid-template-columns: 1fr; gap: 40px; }
        }
        @media (max-width: 768px) {
            .navbar-links { display: none; }
            .navbar-inner { padding: 0 20px; }
            .hero { padding: 0 20px; padding-top: 64px; }
            .section { padding: 60px 20px; }
            .features-grid { grid-template-columns: 1fr; }
            .security-grid { grid-template-columns: 1fr; }
            .faq-grid { grid-template-columns: 1fr; }
            .cta-inner { flex-direction: column; text-align: center; }
            .btn-register { display: none; }
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<header class="navbar">
    <div class="navbar-inner">
        <a href="/" class="navbar-brand" aria-label="KOMSAFE Beranda">
            <img src="{{ asset('images/nih.png') }}" alt="Logo KOMSAFE" class="navbar-logo-img">
            <span class="navbar-brand-text">KOMSAFE</span>
        </a>
        <nav>
            <ul class="navbar-links">
                <li><a href="#fitur">Fitur</a></li>
                <li><a href="#keamanan">Keamanan</a></li>
                <li><a href="#bantuan">Bantuan</a></li>
            </ul>
        </nav>
        <div class="navbar-actions">
            <a href="{{ route('register') }}" class="btn-register" id="btn-buat-akun">Buat Akun Komsafe</a>
            <a href="{{ route('login') }}" class="btn-masuk" id="btn-masuk-header">Masuk</a>
        </div>
    </div>
</header>

{{-- HERO --}}
<section class="hero">
    <div class="hero-inner">
        <div>
            <h1 class="hero-title">
                Semua dokumen instansi,<br>
                <em>aman dalam satu tempat.</em>
            </h1>
            <p class="hero-desc">
                KOMSAFE menyimpan, mengelola, dan mengamankan seluruh dokumen serta arsip instansi Anda dalam satu ruang kerja digital dibangun khusus mengikuti kebutuhan lingkungan pemerintahan.
            </p>
            <p class="hero-note">Dikelola secara internal oleh instansi Anda.</p>
        </div>
        <div class="hero-visual">
            <div id="lottie-hero" style="width: 100%; max-width: 380px; display: flex; align-items: center; justify-content: center; margin: 0 auto;"></div>
        </div>
    </div>
</section>

{{-- FITUR --}}
<section class="section" id="fitur">
    <div class="section-inner">
        <p class="section-label">Fitur Unggulan</p>
        <h2 class="section-title">Semua yang instansi Anda butuhkan</h2>
        <p class="section-desc">KOMSAFE menyediakan perangkat lengkap untuk menyimpan, mengelola, dan mengamankan dokumen instansi dalam satu ruang kerja digital.</p>
        <div class="features-grid">
            <div class="feature-card">
                <div class="fi-wrap"><img src="{{ asset('images/ikon-folder.png') }}" alt="Folder"></div>
                <h3 class="feature-title">Manajemen folder</h3>
                <p class="feature-desc">Susun dokumen ke dalam struktur folder sesuai bidang, kegiatan, atau periode kerja instansi.</p>
            </div>
            <div class="feature-card">
                <div class="fi-wrap"><img src="{{ asset('images/upload-file.png') }}" alt="Upload"></div>
                <h3 class="feature-title">Upload &amp; unduh file</h3>
                <p class="feature-desc">Unggah berbagai format dokumen dan unduh kembali kapan saja dibutuhkan.</p>
            </div>
            <div class="feature-card">
                <div class="fi-wrap"><img src="{{ asset('images/dibintangi.png') }}" alt="Favorit"></div>
                <h3 class="feature-title">Favorit &amp; riwayat terbaru</h3>
                <p class="feature-desc">Tandai file penting sebagai favorit dan akses cepat file yang baru dibuka.</p>
            </div>
            <div class="feature-card">
                <div class="fi-wrap"><img src="{{ asset('images/sampah.png') }}" alt="Trash"></div>
                <h3 class="feature-title">Kelola trash</h3>
                <p class="feature-desc">File yang dihapus tersimpan sementara di trash dan dapat dipulihkan sebelum dihapus permanen.</p>
            </div>
            <div class="feature-card">
                <div class="fi-wrap"><img src="{{ asset('images/terbaru.png') }}" alt="Kuota"></div>
                <h3 class="feature-title">Kuota penyimpanan</h3>
                <p class="feature-desc">Penggunaan ruang penyimpanan dibasai dan dipantau sesuai kebijakan instansi.</p>
            </div>
            <div class="feature-card">
                <div class="fi-wrap"><img src="{{ asset('images/sharing.png') }}" alt="Berbagi"></div>
                <h3 class="feature-title">Berbagi dokumen internal</h3>
                <p class="feature-desc">Bagikan dokumen ke tim instansi melalui tautan yang aman dan tercatat.</p>
            </div>
        </div>
    </div>
</section>

{{-- KEAMANAN --}}
<section class="section security-section" id="keamanan">
    <div class="section-inner">
        <p class="section-label">Keamanan</p>
        <h2 class="section-title">Diamankan dari ujung ke ujung</h2>
        <p class="section-desc">Fitur keamanan KOMSAFE mengikuti standar pengamanan data yang berlaku di lingkungan instansi pemerintah.</p>
        <div class="security-grid">
            <div>
                <div class="si-wrap"><img src="{{ asset('images/gembok.png') }}" alt="Enkripsi"></div>
                <h3 class="security-title">Enkripsi tersimpan &amp; saat transfer</h3>
                <p class="security-desc">Setiap dokumen dilindungi enkripsi, baik saat disimpan maupun saat dikirim.</p>
            </div>
            <div>
                <div class="si-wrap"><img src="{{ asset('images/kunci.png') }}" alt="Kontrol Akses"></div>
                <h3 class="security-title">Kontrol akses berjenjang</h3>
                <p class="security-desc">Admin instansi menentukan siapa yang boleh melihat, mengubah, atau membagikan file.</p>
            </div>
            <div>
                <div class="si-wrap"><img src="{{ asset('images/terbaru.png') }}" alt="Jejak Audit"></div>
                <h3 class="security-title">Jejak audit setiap aktivitas</h3>
                <p class="security-desc">Riwayat akses dan perubahan file tercatat dan dapat ditelusuri kapan saja.</p>
            </div>
        </div>
        <div id="bantuan">
            <h3 class="faq-section-title">FAQ Keamanan</h3>
            <div class="faq-grid">
                <div class="faq-item">
                    <p class="faq-question">Apakah dokumen saya bisa diakses orang di luar instansi?</p>
                    <p class="faq-answer">Tidak. Hanya akun yang terdaftar di sistem instansi Anda yang bisa mengakses dokumen.</p>
                </div>
                <div class="faq-item">
                    <p class="faq-question">Apakah file yang dihapus bisa dikembalikan?</p>
                    <p class="faq-answer">Bisa, selama masih berada di folder Trash dan belum dihapus permanen oleh admin.</p>
                </div>
                <div class="faq-item">
                    <p class="faq-question">Bagaimana jika saya lupa password?</p>
                    <p class="faq-answer">Hubungi admin instansi untuk reset akses, karena sistem dikelola secara internal.</p>
                </div>
                <div class="faq-item">
                    <p class="faq-question">Siapa yang bisa melihat riwayat aktivitas saya?</p>
                    <p class="faq-answer">Admin instansi, melalui fitur audit log / jejak aktivitas sistem.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- BERBAGI --}}
<section class="section">
    <div class="section-inner">
        <div class="share-layout">
            <div>
                <p class="section-label">Berbagi Internal</p>
                <h2 class="section-title">Berbagi tanpa keluar dari lingkungan instansi</h2>
                <p class="section-desc" style="margin-bottom:32px;">Dokumen tetap berada dalam kendali instansi. Tautan berbagi hanya berlaku untuk akun yang terdaftar, punya masa berlaku, dan setiap unduhan tercatat otomatis.</p>
                <ul class="feature-list">
                    <li class="feature-list-item">
                        <div class="fl-icon"><img src="{{ asset('images/terbaru.png') }}" alt="Waktu"></div>
                        <div><h3 class="fl-title">Tautan kedaluwarsa otomatis</h3><p class="fl-desc">Akses berbagi bisa dibatasi jangka waktunya.</p></div>
                    </li>
                    <li class="feature-list-item">
                        <div class="fl-icon"><img src="{{ asset('images/user.png') }}" alt="Akun"></div>
                        <div><h3 class="fl-title">Hanya untuk akun instansi terdaftar</h3><p class="fl-desc">Tidak bisa diakses pihak di luar instansi.</p></div>
                    </li>
                    <li class="feature-list-item">
                        <div class="fl-icon"><img src="{{ asset('images/telusuri.png') }}" alt="Riwayat"></div>
                        <div><h3 class="fl-title">Setiap unduhan tercatat</h3><p class="fl-desc">Riwayat siapa membuka dan mengunduh file tersimpan.</p></div>
                    </li>
                </ul>
            </div>
            <div class="share-diagram">
                <div class="share-nodes">
                    <div class="share-node">Anda</div>
                    <div class="share-node share-node-main">Tim Instansi</div>
                    <div class="share-node">Admin</div>
                </div>
                <div class="share-lock">
                    <div class="share-lock-icon">
                        <img src="{{ asset('images/gembok.png') }}" alt="Gembok" style="width:26px;height:26px;object-fit:contain;filter:brightness(0) saturate(100%) invert(66%) sepia(55%) saturate(700%) hue-rotate(5deg) brightness(95%)">
                    </div>
                    <p class="share-lock-label">Setiap koneksi berbagi diverifikasi dan tercatat</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer class="footer">
    <p>© {{ date('Y') }} KOMSAFE — Sistem Manajemen Dokumen Instansi</p>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var animData = {!! file_get_contents(public_path('animations/Files.json')) !!};
        var animation = lottie.loadAnimation({
            container: document.getElementById('lottie-hero'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            animationData: animData
        });
    });
</script>

</body>
</html>
