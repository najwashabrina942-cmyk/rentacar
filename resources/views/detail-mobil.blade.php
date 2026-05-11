<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mobil</title>

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

        <div class="user-profile-wrapper">

            <span class="bell">🔔</span>

            <div class="user-profile" onclick="toggleProfileMenu()">

                <div class="avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>

                <div>
                    <h4>{{ Auth::user()->name ?? 'User' }}</h4>
                    <p>User</p>
                </div>

            </div>

            <div class="profile-dropdown" id="profileDropdown">

                <div class="dropdown-head">

                    <div class="avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </div>

                    <div>
                        <h4>{{ Auth::user()->name ?? 'User' }}</h4>
                        <span>User</span>
                        <p>{{ Auth::user()->email ?? 'email@gmail.com' }}</p>
                    </div>

                </div>

                <a href="#" class="edit-profile-btn">
                    Edit Profile
                </a>

                <div class="dropdown-menu">
                    <a href="#">Lihat Profile</a>
                    <a href="#">Edit Profile</a>
                    <a href="#">Riwayat Rental</a>
                    <a href="#">Review Saya</a>
                    <a href="#">Ganti Password</a>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="dropdown-logout">
                        Logout
                    </button>
                </form>

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
            <a href="{{ route('login') }}" class="btn-outline">
                Login
            </a>

            <a href="{{ route('register') }}" class="btn-primary-small">
                Daftar Sekarang
            </a>
        </div>

    </nav>
    @endguest

    <section class="detail-hero">
        <h1>Detail Mobil</h1>

        <p>
            8.230+ mobil dari MPV, SUV, Sedan,
            hingga Sport. Pilih sesuai kebutuhan Anda.
        </p>
    </section>

    <section class="detail-container">

        <div class="detail-left">

            <div class="main-car-image">
                <img
                    src="{{ asset('images/' . $mobil->gambar) }}"
                    alt="{{ $mobil->nama_mobil }}"
                >
            </div>

            <div class="description-box">

                <h3>DESKRIPSI</h3>

                <p>{{ $mobil->deskripsi }}</p>

                <h3>SPESIFIKASI</h3>

                <div class="spec-grid">

                    <div>
                        <span>Transmisi</span>
                        <b>{{ $mobil->transmisi }}</b>
                    </div>

                    <div>
                        <span>Bahan Bakar</span>
                        <b>{{ $mobil->bahan_bakar }}</b>
                    </div>

                    <div>
                        <span>Penumpang</span>
                        <b>{{ $mobil->seat }}</b>
                    </div>

                    <div>
                        <span>Tahun</span>
                        <b>{{ $mobil->tahun }}</b>
                    </div>

                </div>

            </div>

        </div>

        <div class="detail-right">

            <div class="booking-card">

                <span class="detail-badge {{ $mobil->status_mobil == 'disewa' ? 'badge-red' : '' }}">
                    {{ ucfirst($mobil->status_mobil) }}
                </span>

                <h2>{{ $mobil->nama_mobil }}</h2>

                <p>
                    {{ $mobil->jenis }} •
                    {{ $mobil->transmisi }} •
                    {{ $mobil->seat }} •
                    {{ $mobil->tahun }}
                </p>

                <div class="detail-rating">
                    <span>★★★★★</span>
                    <b>{{ $mobil->rating }}</b>
                    <small>(156 review)</small>
                </div>

                <h1>
                    Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}
                    <small>/hari</small>
                </h1>

                <div class="date-row">

                    <div class="date-group">

                        <div class="date-box">
                            <label>Tanggal Mulai</label>

                            <input
                                type="date"
                                id="tanggal_mulai"
                            >
                        </div>

                        <div class="date-box">
                            <label>Tanggal Selesai</label>

                            <input
                                type="date"
                                id="tanggal_selesai"
                            >
                        </div>

                    </div>

                    <div class="total-box">

                        <div>
                            <span>Durasi</span>
                            <b id="durasiText">-</b>
                        </div>

                        <div>
                            <span>Total</span>
                            <b id="totalText">-</b>
                        </div>

                    </div>

                </div>

                @auth
                <a
                    href="#"
                    onclick="lanjutBooking()"
                    class="booking-btn"
                >
                    Booking Sekarang
                </a>
                @endauth

                @guest
                <a
                    href="{{ route('login') }}"
                    class="booking-btn"
                >
                    Login untuk Booking
                </a>
                @endguest

            </div>

        </div>

    </section>

</div>

<script>

    const hargaPerHari = {{ $mobil->harga_per_hari }};

    const tanggalMulai = document.getElementById('tanggal_mulai');
    const tanggalSelesai = document.getElementById('tanggal_selesai');

    const durasiText = document.getElementById('durasiText');
    const totalText = document.getElementById('totalText');

    function hitungTotal() {

        if (!tanggalMulai.value || !tanggalSelesai.value) {

            durasiText.innerText = '-';
            totalText.innerText = '-';

            return;
        }

        const mulai = new Date(tanggalMulai.value);
        const selesai = new Date(tanggalSelesai.value);

        const selisihWaktu = selesai - mulai;

        const durasi = selisihWaktu / (1000 * 60 * 60 * 24);

        if (durasi <= 0) {

            durasiText.innerText = '-';
            totalText.innerText = '-';

            return;
        }

        const total = durasi * hargaPerHari;

        durasiText.innerText = durasi + ' hari';

        totalText.innerText =
            'Rp ' + total.toLocaleString('id-ID');
    }

    tanggalMulai.addEventListener('change', hitungTotal);
    tanggalSelesai.addEventListener('change', hitungTotal);

    function lanjutBooking() {

        const mulai = tanggalMulai.value;
        const selesai = tanggalSelesai.value;

        if (!mulai || !selesai) {

            alert('Pilih tanggal dulu');

            return;
        }

       window.location.href =
    "/booking/{{ $mobil->id_mobil }}"
    }

    function toggleProfileMenu() {

        document
            .getElementById('profileDropdown')
            .classList
            .toggle('show');
    }

</script>

</body>
</html>