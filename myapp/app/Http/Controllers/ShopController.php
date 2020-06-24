<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stock;
use App\Models\Cart;
use App\Mail\Thanks;
use App\User;
use Illuminate\Support\Facades\Mail;
use Validator;
use DB;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;

class ShopController extends Controller
{
    protected $stock;
    protected $user;

    public function __construct(Stock $stock, User $user)
    {
        $this->middleware('auth');
        $this->stock = $stock;
        $this->user = $user;
    }

    public function index()
    {
        $stocks = Stock::Paginate(6);
        return view('shop', compact('stocks'));
    }

    public function myCart(Cart $cart)
    {
        $data = $cart->showCart();
        return view('mycart', $data);
    }

    public function addMycart(Request $request,Cart $cart)
    {
        $stockId = $request->stock_id;
        $message = $cart->addCart($stockId);

        $data = $cart->showCart();
        return view('mycart', $data)->with('message', $message);
    }

    public function deleteCart(Request $request, Cart $cart)
    {
        $stockId = $request->stock_id;
        $message = $cart->deleteCart($stockId);

        $data = $cart->showCart();
        return view('mycart', $data)->with('message',$message);
    }

    public function checkout(Request $request, Cart $cart)
    {
        $user = Auth::user();
        $mailData['user'] = $user->name;
        $mailData['checkoutItems'] = $cart->checkoutCart();
        Mail::to($user->email)->send(new Thanks($mailData));
        return view('checkout');
    }

    public function show(Request $request, Stock $stock)
    {
        $stockId = $request->stock_id;
        $stock = $this->stock->find($stockId);
        return view('detail', compact('stock'));
    }

    public function getProfile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function postProfile(UserRequest $request, User $user)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return view('profile', compact('user'));
    }
}
