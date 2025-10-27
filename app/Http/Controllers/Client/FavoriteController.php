<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;

class FavoriteController extends Controller
{
    public function index()
    {

        $favorites = array_keys((array) session()->get('favorites', []));
        $products = collect();
        if (!empty($favorites)) {
            $products = Product::whereIn('id', $favorites)->orderBy('id', 'DESC')->get();
        }

        $data = [
            'shop' => Shop::first(),
            'products' => $products,
            'title' => 'Favorites',
        ];

        return view('client.favorites', $data);
    }

    public function add($id)
    {
//        if ($id <= 0) {
//            return redirect()->back()->with('error', 'Invalid product ID!');
//        }

        $product = Product::findOrFail($id);

        $favorites = session()->get('favorites', []);
        $favorites[$product->id] = true;
        session()->put('favorites', $favorites);

        return redirect()->back()->with('success', 'Product added to favorites!');
    }

    public function remove($id)
    {
//        if ($id <= 0) {
//            return redirect()->back()->with('error', 'Invalid product ID!');
//        }

        $favorites = session()->get('favorites', []);
        if (isset($favorites[$id])) {
            unset($favorites[$id]);
            session()->put('favorites', $favorites);
        }

        return redirect()->back()->with('success', 'Product removed from favorites!');
    }
}
