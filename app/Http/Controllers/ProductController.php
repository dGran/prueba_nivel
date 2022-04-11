<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Custom\ImportProductData;

class ProductController extends Controller
{
    public function list()
    {
        $products = Product::orderBy('id', 'asc')->get();
        return view('products.list', [
            'products' => $products
        ]);
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id);
        return view('products.detail', [
            'product' => $product
        ]);
    }

    public function importData()
    {
        $import = new ImportProductData;
        $import->importData();

        return redirect()->route('product-list');
    }
}
