<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - RentaCar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="register-page">

    <nav class="register-navbar">
        <div class="register-brand">
            <div class="logo">R</div>
            <span>RentaCar</span>
        </div>

        <div class="register-login">
            <span>Sudah punya akun?</span>
            <a href="{{ route('login') }}">Login</a>
        </div>
    </nav>

    <section class="register-wrapper">
        <h1>Buat Akun Baru</h1>
        <p>Pilih jenis akun yang ingin Anda daftarkan.</p>

        <div class="role-tabs">
            <button type="button" class="active" onclick="showUser()">Sebagai User</button>
            <button type="button" onclick="showOwner()">Sebagai Owner</button>
        </div>

        <div class="register-grid">

            <div class="register-card" id="userForm">
                <h2>Register sebagai User</h2>
                <p>Cepat & gratis. Mulai sewa mobil dalam beberapa menit.</p>

                <form method="POST" action="{{ route('register') }}" autocomplete="off">
                    @csrf

                    <input type="hidden" name="role" value="user">

                    <label>Nama Lengkap</label>
                    <input type="text" name="name" placeholder="Nama lengkap" autocomplete="off" required>

                    <label>Email</label>
                    <input type="email" name="email" placeholder="Email aktif" autocomplete="off" required>

                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" autocomplete="new-password" required>

                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi password" autocomplete="new-password" required>

                    <div class="check-row">
                        <input type="checkbox" required>
                        <span>Saya menyetujui <b>Syarat & Ketentuan</b></span>
                    </div>

                    <button type="submit" class="register-btn-blue">Daftar Sekarang</button>
                </form>

                <small>Akun User dapat menyewa mobil dari owner manapun.</small>
            </div>

            <div class="register-card" id="ownerForm" style="display: none;">
                <span class="verify-badge">VERIFIKASI ADMIN</span>
                <h2>Register sebagai Owner</h2>
                <p>Daftarkan armada Anda. Status awal: pending verifikasi.</p>

                <form method="POST" action="{{ route('register') }}" autocomplete="off">
                    @csrf

                    <input type="hidden" name="role" value="owner">

                    <div class="two-col">
                        <div>
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" placeholder="Nama lengkap" autocomplete="off" required>
                        </div>

                        <div>
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Email aktif" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="two-col">
                        <div>
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Masukkan password" autocomplete="new-password" required>
                        </div>

                        <div>
                            <label>Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" placeholder="Konfirmasi password" autocomplete="new-password" required>
                        </div>
                    </div>

                    <div class="two-col">
                        <div>
                            <label>No HP</label>
                            <input type="text" name="no_hp" placeholder="+62 812-xxxx-xxxx" autocomplete="off">
                        </div>

                        <div>
                            <label>Alamat</label>
                            <input type="text" name="alamat" placeholder="Alamat lengkap" autocomplete="off">
                        </div>
                    </div>

                    <label>Upload Identitas (KTP)</label>
                    <div class="upload-box">
                        <div>↑</div>
                        <p>Klik untuk upload KTP / drag & drop</p>
                        <small>JPG, PNG, PDF - maks. 5MB</small>
                    </div>

                    <div class="owner-status">
                        <b>!</b>
                        <div>
                            <strong>Status owner: pending</strong>
                            <p>Akun Anda akan aktif sebagai owner setelah disetujui admin.</p>
                        </div>
                    </div>

                    <button type="submit" class="register-btn-dark">Ajukan Pendaftaran Owner</button>
                </form>
            </div>

        </div>
    </section>

</div>

<script>
    function showUser() {
        document.getElementById('userForm').style.display = 'block';
        document.getElementById('ownerForm').style.display = 'none';

        document.querySelectorAll('.role-tabs button')[0].classList.add('active');
        document.querySelectorAll('.role-tabs button')[1].classList.remove('active');
    }

    function showOwner() {
        document.getElementById('userForm').style.display = 'none';
        document.getElementById('ownerForm').style.display = 'block';

        document.querySelectorAll('.role-tabs button')[0].classList.remove('active');
        document.querySelectorAll('.role-tabs button')[1].classList.add('active');
    }
</script>

</body>
</html>