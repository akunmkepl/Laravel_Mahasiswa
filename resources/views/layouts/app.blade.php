<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Mahasiswa')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Menggunakan Flexbox untuk memastikan footer selalu di bawah */
        html, body {
            height: 100%;
            margin: 0; /* Menghilangkan margin default dari body dan html */
        }
        .content-wrapper {
            min-height: 100%; /* Menjamin konten mengisi seluruh halaman */
            display: flex;
            flex-direction: column;
        }
        .container {
            flex-grow: 1; /* Konten utama mengisi sisa ruang */
        }
        footer {
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body class="d-flex flex-column">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('mahasiswa.index') }}">Aplikasi Mahasiswa</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mahasiswa.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mahasiswa.create') }}">Tambah Mahasiswa</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten utama -->
    <div class="content-wrapper">
        <div class="container mt-4">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-3">
        <p>&copy; {{ date('Y') }} Aplikasi Mahasiswa</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
