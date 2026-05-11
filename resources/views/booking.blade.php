@php
    $mulai = $mulai ?? null;
    $selesai = $selesai ?? null;

    $durasi = 0;
    $totalMobil = 0;
    $hargaDriver = 250000;
    $totalAwal = 0;

    if ($mulai && $selesai) {
        $durasi = \Carbon\Carbon::parse($mulai)->diffInDays(\Carbon\Carbon::parse($selesai));
        $totalMobil = $durasi * $mobil->harga_per_hari;
        $totalAwal = $totalMobil + ($durasi * $hargaDriver);
    }
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Mobil</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="booking-page">

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

    <main class="booking-main">

        <section class="booking-title">
            <h1>Booking Mobil</h1>
            <p>Lengkapi form di bawah untuk melanjutkan ke pembayaran.</p>
        </section>

        <div class="booking-steps">
            <div class="step active">1 <span>Booking</span></div>
            <div class="line"></div>
            <div class="step">2 <span>Pembayaran</span></div>
            <div class="line"></div>
            <div class="step">3 <span>Selesai</span></div>
        </div>

        <section class="booking-layout">

            <div class="booking-form-card">

                <h2>Detail Sewa</h2>

                <div class="booking-car-box">
                    <div class="booking-car-img">
                        <img src="{{ asset('images/' . $mobil->gambar) }}" alt="{{ $mobil->nama_mobil }}">
                    </div>

                    <div>
                        <h3>{{ $mobil->nama_mobil }}</h3>

                        <p>
                            {{ $mobil->jenis }} •
                            {{ $mobil->transmisi }} •
                            {{ $mobil->seat }} •
                            {{ $mobil->bahan_bakar }}
                        </p>

                        <small>
                            ★ {{ $mobil->rating }} | Owner: Andi Wijaya
                        </small>
                    </div>

                    <div class="booking-price">
                        @if ($durasi > 0)
                            <div class="booking-price-final">
                                <small>Total {{ $durasi }} hari</small>

                                <h2 id="totalHarga">
                                    Rp {{ number_format($totalAwal, 0, ',', '.') }}
                                </h2>

                                <p id="driverInfo">
                                    Termasuk driver Rp {{ number_format($durasi * $hargaDriver, 0, ',', '.') }}
                                </p>
                            </div>
                        @else
                            <div class="booking-price-final">
                                <small>Harga per hari</small>

                                <h2 id="totalHarga">
                                    Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}
                                </h2>
                            </div>
                        @endif
                    </div>
                </div>

                <form action="{{ route('booking.store', $mobil->slug) }}" method="POST">
                    @csrf

                    <div class="booking-two-col">
                        <div>
                            <label>Tanggal Mulai Sewa</label>

                            <input
                                type="datetime-local"
                                name="tanggal_mulai"
                                value="{{ $mulai }}"
                                required
                            >
                        </div>

                        <div>
                            <label>Tanggal Selesai Sewa</label>

                            <input
                                type="datetime-local"
                                name="tanggal_selesai"
                                value="{{ $selesai }}"
                                required
                            >
                        </div>
                    </div>

                    <div class="booking-input-group">
                        <label>Lokasi Penjemputan</label>

                        <input
                            type="text"
                            name="lokasi"
                            placeholder="Contoh: Hotel Mercure Sabang, Jakarta Pusat"
                            required
                        >
                    </div>

                    <label class="service-title">Layanan Tambahan</label>

                    <div class="service-row single-service">
                        <label class="service-card">
                            <input
                                type="checkbox"
                                id="driverCheckbox"
                                checked
                            >

                            <div>
                                <b>Driver</b>
                                <p>+Rp 250.000/hari</p>
                            </div>
                        </label>
                    </div>

                    <div class="booking-input-group">
                        <label>Catatan untuk Owner (opsional)</label>

                        <textarea
                            name="catatan"
                            placeholder="Contoh: tolong siapkan car seat untuk anak..."
                        ></textarea>
                    </div>

                    <button
                        type="button"
                        class="confirm-booking-btn"
                        onclick="showStatusCard()"
                    >
                        Konfirmasi
                    </button>
                </form>

            </div>

            <div class="booking-status-card" id="statusCard" style="display: none;">
                <div class="clock-icon">🕒</div>

                <h2>Menunggu Persetujuan Owner</h2>

                <p>
                    Pengajuan booking Anda telah dikirim ke owner.
                    Silakan cek notifikasi secara berkala untuk melihat status pemesanan.
                </p>

                <div class="booking-warning">
                    Pembayaran baru tersedia setelah owner menyetujui pengajuan booking Anda.
                </div>

                <a href="{{ route('dashboard') }}" class="back-home-btn">
                    Kembali ke Home
                </a>
            </div>

        </section>

    </main>

</div>

<script>
    const durasi = {{ $durasi }};
    const totalMobil = {{ $totalMobil }};
    const hargaDriverPerHari = {{ $hargaDriver }};

    const driverCheckbox = document.getElementById('driverCheckbox');
    const totalHarga = document.getElementById('totalHarga');
    const driverInfo = document.getElementById('driverInfo');

    function formatRupiah(angka) {
        return 'Rp ' + angka.toLocaleString('id-ID');
    }

    function hitungTotalBooking() {
        let totalAkhir = totalMobil;

        if (driverCheckbox && driverCheckbox.checked) {
            totalAkhir += durasi * hargaDriverPerHari;

            if (driverInfo) {
                driverInfo.style.display = 'block';
            }
        } else {
            if (driverInfo) {
                driverInfo.style.display = 'none';
            }
        }

        if (totalHarga && durasi > 0) {
            totalHarga.innerText = formatRupiah(totalAkhir);
        }
    }

    function showStatusCard() {
        const lokasi = document.querySelector('input[name="lokasi"]').value;

        if (lokasi.trim() === '') {
            alert('Lokasi penjemputan wajib diisi!');
            return;
        }

        const statusCard = document.getElementById('statusCard');

        statusCard.style.display = 'flex';

        statusCard.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }

    if (driverCheckbox) {
        driverCheckbox.addEventListener('change', hitungTotalBooking);
        hitungTotalBooking();
    }
</script>

</body>
</html>