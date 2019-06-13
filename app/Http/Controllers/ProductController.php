<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\Product as ProductResource;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ProductCollection
     */
    public function index(Request $request)
    {
        $searchField = $request->get('search');
        $products = Product::search($searchField);

      //  return view('shop/index', ['products' => $products]);


        return new ProductCollection(collect($products));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $products = Product::findOrFail($id);
        return new ProductResource($products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAddToCart(Request $request, $id) {
        $products = Product::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        if (Auth::check()) {
            $cart->add($products, $products->id);

            $request->session()->put('cart', $cart);

            return redirect()->route('product.index');
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getReduceByOne(Request $request, $id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        if (Auth::check()) {
            $cart->reduceByOne($id);

            $request->session()->put('cart', $cart);

            if (count($cart->items) > 0) {
                $request->session()->put('cart', $cart);
            } else {
                $request->session()->forget('cart');
            }

            return redirect()->route('product.shoppingCart');
        } else {
            return redirect()->route('login');
        }
    }

    public function getRemoveItem(Request $request, $id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->removeItem($id);

            if (count($cart->items) > 0) {
                $request->session()->put('cart', $cart);
            } else {
                $request->session()->forget('cart');
            }
        return redirect()->route('product.shoppingCart');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCart() {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }
}
