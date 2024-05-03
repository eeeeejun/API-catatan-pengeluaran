<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index()
{
    // Mengambil semua pengeluaran
    $expenses = Auth::user()->expenses()->get();
    
    // Mengambil total pengeluaran keseluruhan
    $totalExpenses = Auth::user()->expenses()->sum('amount');

    // Mengambil total pengeluaran berdasarkan tanggal
    $expensesByDate = Expense::select(DB::raw("date, SUM(amount) as totalExpenses"))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    // Menyiapkan data untuk digunakan dalam grafik
    $dates = $expensesByDate->pluck('date');
    $totalExpensesByDate = $expensesByDate->pluck('totalExpenses');

    return view('home', compact('expenses', 'totalExpenses', 'dates', 'totalExpensesByDate'));
}

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        Auth::user()->expenses()->create($request->all());

        return redirect()->route('expenses.index')->with('success', 'Expense created successfully.');
    }

    public function show($id)
{
    $expense = Expense::findOrFail($id);
    return view('show', compact('expense'));
}

    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        return view('edit', compact('expense'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->update($request->all());

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }

    public function filterByDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
        ]);

        $expenses = Expense::whereBetween('date', [$request->start_date, $request->end_date])
            ->latest()
            ->get();

        $totalExpenses = $expenses->sum('amount');

        return view('home', compact('expenses', 'totalExpenses'));
    }
}