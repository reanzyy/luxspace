<?php

namespace App\Http\Controllers;

use App\Models\TransactionItems;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTable;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Transactions::query();

            return DataTable::of($query)
                ->editColumn('price', function ($item) {
                    return 'Rp.' . number_format($item->price);
                })
                ->addColumn('action',  function ($item) {
                    return '
                    <div class="flex gap-1">
                        <a href="' . route('dashboard.transaction.show', $item->id) . '" class="bg-green-600 hover:bg-green-700 px-4 py-2 text-white rounded shadow-xl">
                            Show
                        </a>
                        <a href="' . route('dashboard.transaction.show', $item->id) . '" class="bg-red-600 hover:bg-red-700 px-4 py-2 text-white rounded shadow-xl">
                            Edit
                        </a>
                    </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.dashboard.transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transactions $transaction)
    {
        if (request()->ajax()) {
            $query = TransactionItems::with(['product'])->where('transactions_id', $transaction->id);

            return DataTable::of($query)
                ->editColumn('product.price', function ($item) {
                    return number_format($item->product->price);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.dashboard.transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
