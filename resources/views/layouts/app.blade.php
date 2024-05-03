<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Other meta tags and links -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- CSS Custom -->
    <style>
        body {
            margin-top: 100px;
            background: linear-gradient(to left, #FFFF,  #000000);
            color: #fff; /* Warna teks */
        }

        /* Footer */
        footer {
            background-color: #333; /* Warna latar belakang footer */
            color: #fff; /* Warna teks footer */
            padding: 20px;
            text-align: center;
        }
        
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Header -->
    <header>
        <!-- Navbar, logo, dan navigasi lainnya -->
    </header>

    <!-- Main Content -->
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Footer -->
    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
        Kelompok 8 Pemrograman API Kelas Manajemen Informatika 2022B
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
