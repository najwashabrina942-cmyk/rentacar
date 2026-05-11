<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentaCar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="page">

  @auth
<nav class="user-navbar">
    <div class="user-brand">
        <div class="logo">R</div>
        <span>RentaCar</span>
    </div>

    <div class="user-menu">
        <a href="{{ route('dashboard') }}">Home</a>
        <a href="{{ route('daftar.mobil') }}" class="active">Daftar Mobil</a>
        <a href="#">Riwayat Rental</a>
        <a href="#">Jadi Owner</a>
        <a href="#">Profile</a>
        <a href="#">Review</a>
    </div>

    <div class="user-profile">
        <span class="bell">🔔</span>
        <div class="avatar">
            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
        </div>
        <div>
            <h4>{{ Auth::user()->name ?? 'User' }}</h4>
            <p>User</p>
        </div>
    </div>
</nav>
@endauth

@guest
<nav class="navbar">
    <div class="brand">
        <div class="logo">R</div>
        <span>RentaCar</span>
    </div>

    <div class="menu">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('daftar.mobil') }}" class="active">Daftar Mobil</a>
    </div>

    <div class="nav-actions">
        <a href="{{ route('login') }}" class="btn-outline">Login</a>
        <a href="{{ route('register') }}" class="btn-primary-small">Daftar Sekarang</a>
    </div>
</nav>
@endguest

    <section class="hero">
        <div class="hero-content">
            <h1>Sewa Mobil Mudah<br><span>& Cepat.</span></h1>

            <p>
                Booking online, ambil di kota Anda, semua dalam hitungan menit.
            </p>

            <div class="hero-buttons">
                <a href="{{ route('daftar.mobil') }}" class="btn-primary">Lihat Mobil</a>
               <a href="{{ route('booking.mobil', 'toyota-innova-reborn') }}" class="btn-white">Booking Sekarang</a>
            </div>

            <div class="stats">
                <div>
                    <h3>8</h3>
                    <p>Mobil tersedia</p>
                </div>

                <div>
                    <h3>35+</h3>
                    <p>Penyewaan berhasil</p>
                </div>

                <div>
                    <h3>★ 4,82</h3>
                    <p>Rating rata-rata</p>
                </div>
            </div>
        </div>
    </section>

    <section class="cars-section">
        <div class="section-header">
            <div>
                <span>PILIHAN MOBIL</span>
                <h2>Mobil Pilihan untuk Anda</h2>
            </div>

            <a href="{{ route('daftar.mobil') }}" class="btn-see">Lihat Semua</a>
        </div>

        <div class="car-grid">
            @foreach ($mobils as $mobil)
                <div class="car-card">
                    <div class="car-image">
                        <img src="{{ asset('images/' . $mobil->gambar) }}" alt="{{ $mobil->nama_mobil }}">

                        <span class="badge {{ $mobil->status_mobil == 'disewa' ? 'badge-red' : '' }}">
                            {{ ucfirst($mobil->status_mobil) }}
                        </span>
                    </div>

                    <h3>{{ $mobil->nama_mobil }}</h3>

                    <p>
                        {{ $mobil->jenis }} •
                        {{ $mobil->transmisi }} •
                        {{ $mobil->seat }}
                    </p>

                    <div class="price-row">
                        <h4>
                            Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}
                            <small>/hari</small>
                        </h4>

                        <span>★ {{ $mobil->rating }}</span>
                    </div>

                    <a href="{{ route('detail.mobil', $mobil->slug) }}" class="btn-detail">
                        Lihat Detail
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <section class="features">
        <div class="feature-card">
            <div class="icon blue-icon">▣</div>
            <div>
                <h3>Mudah Digunakan</h3>
                <p>Pesan mobil dalam 3 langkah: pilih, bayar, ambil.</p>
            </div>
        </div>

        <div class="feature-card dark">
            <div class="icon yellow-icon">M</div>
            <div>
                <h3>Banyak Pilihan Mobil</h3>
                <p>Temukan mobil terbaik untuk perjalanan Anda.</p>
            </div>
        </div>

        <div class="feature-card">
            <div class="icon green-icon">◷</div>
            <div>
                <h3>Proses Cepat</h3>
                <p>Konfirmasi cepat, pembayaran mudah, layanan 24/7.</p>
            </div>
        </div>
    </section>

</div>

</body>
</html>