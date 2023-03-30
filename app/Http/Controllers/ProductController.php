<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Products;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTable;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Products::query();

            return DataTable::of($query)
                ->editColumn('price', function ($item) {
                    return 'Rp.' . number_format($item->price);
                })
                ->addColumn('action',  function ($item) {
                    return '
                    <div class="flex gap-1">
                    <a href="' . route('dashboard.product.gallery.index', $item->id) . '" class="bg-green-600 hover:bg-green-700 px-4 py-2 text-white rounded shadow-xl">
                        Gallery
                    </a>
                    <a href="' . route('dashboard.product.edit', $item->id) . '" class="bg-red-600 hover:bg-red-700 px-4 py-2 text-white rounded shadow-xl">
                        Edit
                    </a>
                    <form class="inline-block" action="' . route('dashboard.product.destroy', $item->id) . '" method="post">
                        <button class="bg-black hover:bg-gray-700 px-4 py-2 text-white rounded shadow-xl">
                            Hapus
                        </button>
                        ' . method_field('delete') . csrf_field() . '
                    </form>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.dashboard.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        Products::create($data);

        return redirect()->route('dashboard.product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        return view('pages.dashboard.product.edit', [
            'item' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest  $request, Products $product)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        $product->update($data);

        return redirect()->route('dashboard.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        $product->delete();
        return redirect()->route('dashboard.product.index');
    }
}
