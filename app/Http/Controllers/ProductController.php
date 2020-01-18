<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Resources\Product as ProductResource;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {

        $query = $request->input('query');
        if (!empty($query)) {

            $products = Product::search($query)->get();
        } else {
            $products = Product::getProducts()->get();
        }

        return ProductResource::collection($products);

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
     * Store items to cart
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getAddToCart(Request $request, $id) {
        $products = Product::findOrFail($id);
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
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
     * Reduce items in cart by one
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getReduceByOne(Request $request, $id) {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
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

    /**
     * Remove items from cart
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getRemoveItem(Request $request, $id) {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
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
     * Get the shopping cart
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCart(Request $request) {
        if (!$request->session()->has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);

        return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }
}
