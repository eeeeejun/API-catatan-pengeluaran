<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class ExpensesControllerAPI extends BaseController
{
public function index(): Response
    {
        $expenses = Auth::user()->expenses()->get();
        $totalExpenses = Auth::user()->expenses()->sum('amount');

        return $this->sendResponse([
            'expenses' => $expenses,
            'total_expenses' => $totalExpenses,
        ], 'Expenses retrieved successfully.');
    }

    public function store(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'nullable',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $expense = Auth::user()->expenses()->create($request->all());

        return $this->sendResponse($expense, 'Expense created successfully.');
    }

    public function show($id): Response
    {
        $expense = Auth::user()->expenses()->findOrFail($id);
        return $this->sendResponse($expense, 'Expense retrieved successfully.');
    }

    public function update(Request $request, $id): Response
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'nullable',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $expense = Auth::user()->expenses()->findOrFail($id);
        $expense->update($request->all());

        return $this->sendResponse($expense, 'Expense updated successfully.');
    }

    public function destroy($id): Response
    {
        $expense = Auth::user()->expenses()->findOrFail($id);
        $expense->delete();

        return $this->sendResponse([], 'Expense deleted successfully.');
    }

    public function filterByDate(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $expenses = Auth::user()->expenses()
            ->whereBetween('date', [$request->start_date, $request->end_date])
            ->latest()
            ->get();

        $totalExpenses = $expenses->sum('amount');

        return $this->sendResponse([
            'expenses' => $expenses,
            'total_expenses' => $totalExpenses,
        ], 'Expenses filtered successfully.');
    }
}
