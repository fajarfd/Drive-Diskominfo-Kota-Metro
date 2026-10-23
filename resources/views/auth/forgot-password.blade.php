<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Manajemen File</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: #1c2a47;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: -150px; right: -100px;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: absolute;
            bottom: -180px; left: -80px;
            width: 550px; height: 550px;
            background: radial-gradient(circle, rgba(0,0,0,0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        /* ── CARD ── */
        .card {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            width: 880px;
            min-height: 420px;
            max-width: calc(100vw - 32px);
            background: #ffffff;
            border-radius: 4px;
        }

        /* ── KIRI ── */
        .card-left {
            position: relative;
            flex: 0 0 380px;
            padding: 105px 40px 70px;
            display: flex;
            flex-direction: column;
        }

        /* Logo + Nama: absolut di pojok kiri atas card */
        .brand {
            position: absolute;
            top: 32px;
            left: 40px;
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 10px;
            user-select: none;
        }

        .brand img {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }

        .brand-name {
            font-size: 20px;
            font-weight: 700;
            color: #1c2a47;
            letter-spacing: 0.5px;
        }

        .card-left h1 {
            font-size: 26px;
            font-weight: 700;
            color: #1f1f1f;
            margin-bottom: 14px;
            line-height: 1.2;
            margin-top: -3px;
        }

        .card-left .desc {
            font-size: 13px;
            color: #555555;
            line-height: 1.7;
        }

        /* ── KANAN ── */
        .card-right {
            flex: 1;
            padding: 105px 44px 70px;
            display: flex;
            flex-direction: column;
        }

        /* Alert */
        .alert-success {
            font-size: 13px;
            color: #059669;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            border-radius: 4px;
            padding: 10px 14px;
            margin-bottom: 20px;
        }

        .alert-error {
            font-size: 13px;
            color: #dc2626;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 4px;
            padding: 10px 14px;
            margin-bottom: 20px;
        }

        /* Input */
        .input-group {
            margin-bottom: 56px;
        }

        .input-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #3a3a3a;
        }

        .input-group input {
            width: 100%;
            height: 52px;
            padding: 0 16px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: #1f2937;
            background-color: #f0f2f5;
            border: none;
            border-radius: 0;
            outline: none;
            transition: all 0.25s ease;
            box-shadow: none;
        }

        .input-group input::placeholder { color: #9ca3af; }

        .input-group input:-webkit-autofill,
        .input-group input:-webkit-autofill:hover,
        .input-group input:-webkit-autofill:focus,
        .input-group input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #f0f2f5 inset !important;
            -webkit-text-fill-color: #1f2937 !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        /* Baris tombol: kembali (kiri) + kirim (kanan) */
        .btn-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .btn-back {
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: #3730a3;
            background: none;
            border: none;
            cursor: pointer;
            text-decoration: none;
            padding: 0;
            transition: color 0.2s;
        }

        .btn-back:hover {
            color: #4338ca;
            text-decoration: underline;
        }

        .btn-submit {
            height: 40px;
            padding: 0 24px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #ffffff;
            background: #3730a3;
            border: none;
            border-radius: 0;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
            white-space: nowrap;
        }

        .btn-submit:hover { background: #4338ca; }
        .btn-submit:active { background: #312e81; }

        /* ── RESPONSIVE ── */
        @media (max-width: 640px) {
            .card { flex-direction: column; }
            .card-left { flex: unset; padding: 36px 28px 24px; }
            .card-right { padding: 24px 28px 40px; }
            .btn-row { flex-direction: column-reverse; align-items: stretch; }
            .btn-submit { width: 100%; }
        }
    </style>
</head>
<body>

    <div class="card">

        {{-- KIRI: Logo (horizontal) + Judul + Deskripsi --}}
        <div class="card-left">
            <div class="brand">
                <img src="{{ asset('images/nih.png') }}" alt="Logo Komsafe">
                <span class="brand-name">Komsafe</span>
            </div>

            <h1>Lupa Password</h1>

            <p class="desc">
                Masukkan alamat email akun Anda. Kami akan mengirimkan kode verifikasi untuk mereset kata sandi.
            </p>
        </div>

        {{-- KANAN: Form --}}
        <div class="card-right">

            @if(session('status'))
                <div class="alert-success">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="alert-error">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" autocomplete="off">
                @csrf

                <div class="input-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan alamat email Anda"
                        required
                        autocomplete="off"
                    >
                </div>

                {{-- Baris bawah: Kembali ke Login (kiri) | Kirim Kode Verifikasi (kanan) --}}
                <div class="btn-row">
                    <a href="{{ route('login') }}" class="btn-back">Kembali ke Login</a>
                    <button type="submit" class="btn-submit">Kirim Kode Verifikasi</button>
                </div>

            </form>

        </div>

    </div>

</body>
</html>
