<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mobil</title>

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
                    <button type="submit" class="dropdown-logout">Logout</button>
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
            <a href="{{ route('login') }}" class="btn-outline">Login</a>
            <a href="{{ route('register') }}" class="btn-primary-small">Daftar Sekarang</a>
        </div>
    </nav>
    @endguest

    <section class="list-hero">
        <h1>Daftar Mobil</h1>
        <p>Temukan mobil terbaik untuk perjalanan Anda</p>
    </section>

    <section class="list-container">

        <form action="{{ route('daftar.mobil') }}" method="GET" class="filter-box">
            <input
                type="text"
                name="search"
                placeholder="🔍 Cari mobil... (Toyota Innova, Honda Civic, dll)"
                value="{{ request('search') }}"
            >

            <select name="jenis">
                <option value="">Kategori: Semua</option>
                <option value="MPV" {{ request('jenis') == 'MPV' ? 'selected' : '' }}>MPV</option>
                <option value="SUV" {{ request('jenis') == 'SUV' ? 'selected' : '' }}>SUV</option>
                <option value="Sport" {{ request('jenis') == 'Sport' ? 'selected' : '' }}>Sport</option>
                <option value="Hatchback" {{ request('jenis') == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
            </select>

            <select name="harga">
                <option value="">Harga: Semua</option>
                <option value="termurah" {{ request('harga') == 'termurah' ? 'selected' : '' }}>Termurah</option>
                <option value="termahal" {{ request('harga') == 'termahal' ? 'selected' : '' }}>Termahal</option>
            </select>

            <select name="status">
                <option value="">Status: Semua</option>
                <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="disewa" {{ request('status') == 'disewa' ? 'selected' : '' }}>Disewa</option>
            </select>

            <button type="submit">Cari / Filter</button>
        </form>

        <div class="filter-info">
            <div>
                <span>Filter aktif:</span>

                @if(request('jenis'))
                    <b>{{ request('jenis') }} ×</b>
                @endif

                @if(request('harga'))
                    <b>{{ ucfirst(request('harga')) }} ×</b>
                @endif

                @if(request('status'))
                    <b>{{ ucfirst(request('status')) }} ×</b>
                @endif

                @if(request('search'))
                    <b>{{ request('search') }} ×</b>
                @endif

                <a href="{{ route('daftar.mobil') }}">Hapus semua</a>
            </div>

            <p>Menampilkan {{ $mobils->count() }} mobil</p>
        </div>

        <div class="car-grid list-grid">
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

                    <a href="{{ route('detail.mobil', $mobil->id_mobil) }}" class="btn-detail">
                        Detail
                    </a>
                </div>
            @endforeach
        </div>

    </section>

</div>

<script>
    function toggleProfileMenu() {
        const dropdown = document.getElementById('profileDropdown');

        if (dropdown) {
            dropdown.classList.toggle('show');
        }
    }
</script>

</body>
</html>