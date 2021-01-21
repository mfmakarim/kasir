<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function get($id)
    {
        $product = Product::where('id', $id)->first();

        return response()->json($product, 200);
    }
}
