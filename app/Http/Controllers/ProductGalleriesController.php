<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductGalleriesRequest;
use App\Models\ProductGalleries;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProductGalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Products $product)
    {
        if (request()->ajax()) {
            $query = ProductGalleries::query();

            return DataTables::of($query)
                ->addColumn('action',  function ($item) {
                    return '
                    <form class="inline-block" action="' . route('dashboard.gallery.destroy', $item->id) . '" method="post">
                        <button class="bg-black hover:bg-gray-700 px-4 py-2 text-white rounded shadow-xl"> 
                            Hapus
                        </button>
                        ' . method_field('delete') . csrf_field() . '
                    </form>';
                })
                ->editColumn('url', function ($item) {
                    return '<img style="max-width: 150px;" src="' . Storage::url($item->url) . '"/>';
                })
                ->editColumn('is_featured', function ($item) {
                    return $item->is_featured ? 'Yes' : 'No';
                })
                ->rawColumns(['action', 'url'])
                ->make();
        }
        return view('pages.dashboard.product.gallery.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Products $product)
    {
        return view('pages.dashboard.product.gallery.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductGalleriesRequest $request, Products $product)
    {
        $files = $request->file('files');

        if ($request->hasFile('files')) {
            foreach ($files as $file) {
                $path = $file->store('public/gallery');

                ProductGalleries::create([
                    'products_id' => $product->id,
                    'url' => $path,
                ]);
            }
        }
        return redirect()->route('dashboard.product.gallery.index', $product->id);
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
    public function destroy(ProductGalleries $gallery)
    {
        $gallery->delete();
        return redirect()->route('dashboard.product.gallery.index', $gallery->products_id);
    }
}
