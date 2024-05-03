@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: #e3f2fd;">
                <h3 class="card-header text-center" style="color: black;">Add New Expense</h3>

                <div class="card-body">
                    <form action="{{ route('expenses.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title" style="color: black; font-weight: bold;">Judul:</label>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description" style="color: black; font-weight: bold;">Deskripsi:</label>
                            <input type="text" id="description" name="description" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="amount" style="color: black; font-weight: bold;">Harga:</label>
                            <input type="number" id="amount" name="amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="date" style="color: black; font-weight: bold;">Tanggal:</label>
                            <input type="date" id="date" name="date" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
