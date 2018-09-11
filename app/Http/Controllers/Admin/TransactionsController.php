<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PDF;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $transactions = Transaction::where('item', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->orWhere('reservation_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $transactions = Transaction::latest()->paginate($perPage);
        }

        return view('admin/transactions.transactions.index', compact('transactions', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin/transactions.transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'item' => 'required',
			'price' => 'required',
			'reservation_id' => 'required'
		]);
        $requestData = $request->all();
        
        Transaction::create($requestData);

        return redirect('admin/transactions')->with('flash_message', 'Transaction added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('admin/transactions.transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('admin/transactions.transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'item' => 'required',
			'price' => 'required',
			'reservation_id' => 'required'
		]);
        $requestData = $request->all();
        
        $transaction = Transaction::findOrFail($id);
        $transaction->update($requestData);

        return redirect('admin/transactions')->with('flash_message', 'Transaction updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Transaction::destroy($id);

        return redirect('admin/transactions')->with('flash_message', 'Transaction deleted!');
    }

    public function printTransactions(Request $request) {
        $keyword = $request->get('search');
         if (!empty($keyword)) {
            $transactions = Transaction::where('item', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->orWhere('reservation_id', 'LIKE', "%$keyword%")
                ->latest()->get();
        } else {
            $transactions = Transaction::latest()->get();
        }

        $pdf = PDF::loadView('reports.transaction', compact('transactions'));
        return $pdf->stream();
    }
}
