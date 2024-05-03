@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3 class="card-header text-center" style="color: black;">Edit Expense</h3>

                <div class="card-body" style="background-color: #e3f2fd;">
                    <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title" style="color: black; font-weight: bold;">Title:</label>
                            <input type="text" id="title" name="title" value="{{ $expense->title }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description" style="color: black; font-weight: bold;">Description:</label>
                            <textarea id="description" name="description" class="form-control">{{ $expense->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="amount" style="color: black; font-weight: bold;">Amount:</label>
                            <input type="number" id="amount" name="amount" value="{{ $expense->amount }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="date" style="color: black; font-weight: bold;">Date:</label>
                            <input type="date" id="date" name="date" value="{{ $expense->date }}" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Expense</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
