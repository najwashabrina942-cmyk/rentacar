<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - RentaCar</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="user-dashboard">

    <nav class="user-navbar">

        <div class="user-brand">
            <div class="logo">R</div>
            <span>RentaCar</span>
        </div>

        <div class="user-menu">
            <a href="{{ route('dashboard') }}" class="active">Home</a>
            <a href="{{ route('daftar.mobil') }}">Daftar Mobil</a>
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

                <a href="#" class="edit-profile-btn">Edit Profile</a>

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

    <main class="user-main">

        <section class="user-hero">

            <span>TEMUKAN MOBIL IMPIAN ANDA</span>

            <h1>
                Sewa mobil di kota mana saja, kapan saja.
            </h1>

            <p>
                Temukan mobil terbaik dari owner terpercaya.
            </p>

            <form class="user-search" action="{{ route('dashboard') }}" method="GET">

                <input
                    type="text"
                    name="search"
                    placeholder="Cari nama mobil, merek, atau lokasi..."
                    value="{{ request('search') }}"
                >

                <button type="submit">
                    Cari
                </button>

            </form>

        </section>

        <div class="dashboard-layout">

            <aside class="filter-sidebar">

                <h3>Filter</h3>

                <form action="{{ route('dashboard') }}" method="GET">

                    <div class="filter-group">

                        <h4>Kategori</h4>

                        <label>
                            <input
                                type="checkbox"
                                name="jenis[]"
                                value="SUV"
                                {{ in_array('SUV', request('jenis', [])) ? 'checked' : '' }}
                            >
                            SUV
                        </label>

                        <label>
                            <input
                                type="checkbox"
                                name="jenis[]"
                                value="MPV"
                                {{ in_array('MPV', request('jenis', [])) ? 'checked' : '' }}
                            >
                            MPV
                        </label>

                        <label>
                            <input
                                type="checkbox"
                                name="jenis[]"
                                value="Sedan"
                                {{ in_array('Sedan', request('jenis', [])) ? 'checked' : '' }}
                            >
                            Sedan
                        </label>

                        <label>
                            <input
                                type="checkbox"
                                name="jenis[]"
                                value="Hatchback"
                                {{ in_array('Hatchback', request('jenis', [])) ? 'checked' : '' }}
                            >
                            Hatchback
                        </label>

                        <label>
                            <input
                                type="checkbox"
                                name="jenis[]"
                                value="Sport"
                                {{ in_array('Sport', request('jenis', [])) ? 'checked' : '' }}
                            >
                            Sport
                        </label>

                    </div>

                    <div class="filter-group">

                        <h4>Harga per hari</h4>

                        <input
                            type="range"
                            name="harga"
                            min="200000"
                            max="1500000"
                            value="{{ request('harga', 1500000) }}"
                        >

                        <div class="range-text">
                            <span>Rp 200K</span>
                            <span>Rp 1,5jt</span>
                        </div>

                    </div>

                    <div class="filter-group">

                        <h4>Transmisi</h4>

                        <div class="filter-buttons">

                            <button
                                type="submit"
                                name="transmisi"
                                value="Matic"
                                class="{{ request('transmisi') == 'Matic' ? 'active' : '' }}"
                            >
                                Matic
                            </button>

                            <button
                                type="submit"
                                name="transmisi"
                                value="Manual"
                                class="{{ request('transmisi') == 'Manual' ? 'active' : '' }}"
                            >
                                Manual
                            </button>

                        </div>

                    </div>

                    <div class="filter-group">

                        <h4>Kapasitas</h4>

                        <div class="filter-buttons">

                            <button
                                type="submit"
                                name="seat"
                                value="4 seater"
                                class="{{ request('seat') == '4 seater' ? 'active' : '' }}"
                            >
                                2-4
                            </button>

                            <button
                                type="submit"
                                name="seat"
                                value="7 seater"
                                class="{{ request('seat') == '7 seater' ? 'active' : '' }}"
                            >
                                5-7
                            </button>

                        </div>

                    </div>

                    <button type="submit" class="apply-filter">
                        Terapkan Filter
                    </button>

                    <a href="{{ route('dashboard') }}" class="reset-filter">
                        Hapus Filter
                    </a>

                </form>

            </aside>

            <section class="user-cars">

                <div class="user-section-head">
                    <h2>Tersedia ({{ $mobils->count() }} mobil)</h2>
                </div>

                <div class="user-car-grid">

                    @forelse ($mobils as $mobil)

                        <div class="user-car-card">

                            <div class="user-car-image">
                                <img
                                    src="{{ asset('images/' . $mobil->gambar) }}"
                                    alt="{{ $mobil->nama_mobil }}"
                                >
                            </div>

                            <span class="status {{ $mobil->status_mobil == 'disewa' ? 'red' : '' }}">
                                {{ ucfirst($mobil->status_mobil) }}
                            </span>

                            <h3>{{ $mobil->nama_mobil }}</h3>

                            <p>
                                {{ $mobil->jenis }} •
                                {{ $mobil->transmisi }} •
                                {{ $mobil->seat }}
                            </p>

                            <div class="rating">
                                ★ {{ $mobil->rating ?? '4.8' }}
                            </div>

                            <div class="car-bottom">

                                <h4>
                                    Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}
                                    <small>/hari</small>
                                </h4>

                                <a href="{{ route('detail.mobil', $mobil->slug) }}">
                                    Detail
                                </a>

                            </div>

                        </div>

                    @empty

                        <p>
                            Tidak ada mobil yang sesuai dengan filter.
                        </p>

                    @endforelse

                </div>

                <div class="user-pagination">
                    <span>
                        Menampilkan {{ $mobils->count() }} mobil
                    </span>
                </div>

            </section>

        </div>

    </main>

</div>

<script>

    function toggleProfileMenu() {
        document
            .getElementById('profileDropdown')
            .classList.toggle('show');
    }

</script>

</body>
</html>