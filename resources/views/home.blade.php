@extends('layouts.app')
@section('content')
<div class="container">
    <!-- Header -->
    <div class="row mb-4 fixed-top bg-dark p-3">
        <div class="col-md-6">
            <h1 class="text-white">{{ config('app.name', 'Expense Tracker') }}</h1>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center"> <!-- Menempatkan tombol logout dan nama user di posisi paling kanan -->
            @guest
                <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
            @else
                <span class="text-white" style="margin-right:10px">{{ Auth::user()->name }}</span> <!-- Menampilkan nama user -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger"><i class="fas fa-power-off text-white"></i></button> <!-- Tombol logout dengan ikon shutdown laptop -->
                </form>
            @endguest
        </div>
    </div>
    
    <!-- grafik pengeluaran -->
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Grafik Pengeluaran</div>
                <div class="card-body">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Catatan Pengeluaran -->
<div class="row mb-4" style="margin-top: 20px;">
    <div class="col-md-12">
        <h4>
            Daftar Catatan Pengeluaran
        </h4>
        <table class="table table-primary"> <!-- Menggunakan kelas table-primary untuk warna biru pada tabel -->
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                    <tr>
                        <td>{{ $expense->title }}</td>
                        <td> Rp {{ $expense->amount }}</td>
                        <td>{{ $expense->date }}</td>
                        <td>{{ $expense->description }}</td>
                        <td>
                            <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Tombol Tambah Catatan Pengeluaran -->
<div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('expenses.create') }}" class="btn btn-primary">{{ __('Tambah Pengeluaran') }}</a>
        </div>
    </div>

<!-- Filter Berdasarkan Tanggal -->
<div class="row mb-4">
    <div class="col-md-12">
        <h4>Filter Berdasarkan Tanggal</h4>
        <form action="{{ route('expenses.filter') }}" method="GET">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="start_date">Mulai Tanggal:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="end_date">Akhir Tanggal:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary mt-4">Filter</button>
                </div>
                <!-- Tambahkan tombol Tampilkan Semua -->
                <div class="col-md-2">
                    <a href="{{ route('expenses.index') }}" class="btn btn-secondary mt-4">Tampilkan Semua</a>
                </div>
            </div>
        </form>
    </div>
</div>

    <!-- Ringkasan Total Pengeluaran -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h4>Total Pengeluaran</h4>
            <p>Total Pengeluaran: Rp {{ $totalExpenses }}</p>
        </div>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    var dates = <?php echo json_encode($dates) ?>;
    var totalExpenses = <?php echo json_encode($totalExpensesByDate) ?>;
    var maxExpense = Math.max(...totalExpenses); // Menemukan nilai maksimum dari total pengeluaran
    var yAxisMax = Math.ceil(maxExpense / 25000) * 25000; // Menyesuaikan nilai maksimum sumbu Y ke kelipatan 25000 terdekat

    Highcharts.chart('chart', {
        title: {
            text: 'Grafik Pengeluaran'
        },
        xAxis: {
            categories: dates
        },
        yAxis: {
            title: {
                text: 'Jumlah Pengeluaran'
            },
            max: yAxisMax, // Menyesuaikan rentang sumbu Y dengan nilai maksimum total pengeluaran
            tickInterval: 25000, // Menetapkan interval sumbu Y menjadi 25000
            plotLines: [{ // Menambahkan garis horizontal untuk nilai maksimum total pengeluaran
                color: 'red', // Warna garis horizontal
                value: maxExpense, // Nilai rentang sumbu Y
                width: 2, // Lebar garis
                zIndex: 4, // Urutan tampilan di atas grafik
                label: {
                    text: 'Rentang Jumlah Pengeluaran', // Label untuk garis horizontal
                    align: 'right',
                    x: 0,
                    y: -2
                }
            }]
        },
        series: [{
            name: 'Total Pengeluaran',
            data: totalExpenses,
            color: 'blue' // Warna garis biru
        }],
        plotOptions: {
            series: {
                marker: {
                    enabled: true // Menampilkan marker di titik data
                }
            }
        }
    });
</script>


@endsection
