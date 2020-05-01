<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stock;
use App\Models\Cart;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $stocks = Stock::Paginate(6);
        return view('shop', compact('stocks'));
    }

    public function myCart(Cart $cart)
    {
        $myCarts = $cart->showCart();
        return view('mycart', compact('myCarts'));
    }

    public function addMycart(Request $request,Cart $cart)
    {
       //カートに追加の処理
        $stockId = $request->stock_id;
        $message = $cart->addCart($stockId);

       //追加後の情報を取得
        $myCarts = $cart->showCart();
        return view('mycart',compact('myCarts' , 'message'));
    }

    public function deleteCart(Request $request, Cart $cart)
    {
        $stockId = $request->stock_id;
        $message = $cart->deleteCart($stockId);

        $myCarts = $cart->showCart();
        return view('mycart',compact('myCarts' , 'message'));
    }
}
