<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RentaCar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<section class="auth-login-page">
    <div class="auth-left">
        <div class="auth-brand">
            <div class="auth-logo">R</div>
            <h3>RentaCar</h3>
        </div>

        <h1>Sewa mobil,<br><span>jelajahi tanpa batas.</span></h1>
        <p>Marketplace rental mobil terpercaya untuk perjalanan Anda.</p>

        <ul>
            <li>Ribuan mobil dari owner terverifikasi</li>
            <li>Booking dan pembayaran aman dalam hitungan menit</li>
            <li>Dukungan untuk User, Owner, dan Admin</li>
        </ul>
    </div>

    <div class="auth-card">
        <span>SELAMAT DATANG</span>
        <h2>Masuk ke Akun</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label>Email</label>
            <input type="email" name="email" placeholder="nama@email.com" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="********" required>

            <div class="auth-row">
                <label>
                    <input type="checkbox" name="remember">
                    Ingat saya
                </label>

                <a href="#">Lupa password?</a>
            </div>

            <button type="submit">Login</button>
        </form>

        <p class="auth-bottom">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>
    </div>
</section>

</body>
</html>