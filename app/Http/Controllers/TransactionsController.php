<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\Category;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('transactions.create', compact('request'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->amount <= 0 || !$request->amount) {
            return redirect()
                ->back()
                ->with('status', 'Invalid amount!');
        }
        $category_id = Category::where('name', $request->category)->first()->id;
        $data = new Transactions();
        $data->category_id = $category_id;
        $data->in = $request->in;
        $data->amount = $request->amount;
        $data->description = $request->description;
        if($request->category === 'Laundry'){
            $data->folds = $request->folds;
        } 
        $data->save();
        return redirect('/' . strtolower($request->category))->with('status', 'Data saved!');
    }

    public function grocery(Request $request)
    {
        return $this->getDataForEachCategory(1, $request);
    }

    public function refilling(Request $request)
    {
        return $this->getDataForEachCategory(2, $request);
    }

    public function laundry(Request $request)
    {
        return $this->getDataForEachCategory(3, $request);
    }

    public function getDataForEachCategory(int $id, Request $request)
    {
        $data = Transactions::where('category_id', $id);
            
        $sales = Transactions::where('category_id', $id)->where('in', true);

        $expense = Transactions::where('category_id', $id)->where('in', false);

        if ($request->date_from || $request->date_to) {
            if ($request->date_from) {
                $data = $data->whereDate('created_at', '>=', $request->date_from);
                $sales = $sales->whereDate('created_at', '>=', $request->date_from);
                $expense = $expense->whereDate('created_at', '>=', $request->date_from);
            }
            if ($request->date_to) {
                $data = $data->whereDate('created_at', '<=', $request->date_to);
                $sales = $sales->whereDate('created_at', '<=', $request->date_to);
                $expense = $expense->whereDate('created_at', '<=', $request->date_to);
            }
        } else {
            $data = $data->whereDate('created_at', now()->toDateString());
            $sales = $sales->whereDate('created_at', now()->toDateString());
            $expense = $expense->whereDate('created_at', now()->toDateString());
        }

        if($request->type) {
            $type = $request->type === 'sales' ? true : false;
            $data = $data->where('in', $type);
        }
        

        $data = $data->latest()->get();

        $sales = $sales->get();
        $totalSales = $sales->sum('amount');
        $sales = number_format($totalSales, 2, '.', '');

        $expnse = $expense->get();
        $totalExpense = $expense->sum('amount');
        $expense = number_format($totalExpense, 2, '.', '');

        $category = Category::find($id)->name;

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $today = now()->toDateString();

        return view(strtolower($category), compact('data', 'sales', 'expense','date_from','date_to','today','request'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Transactions $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transactions $transactions)
    {
        //
    }
}
