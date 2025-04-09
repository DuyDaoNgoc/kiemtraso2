<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Slide;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
        $product_top = Product::where('top', 1)->get();
        $products = Product::where('new', 1)->get();
        $promotion = Product::where('promotion_price', '!=', 0)->paginate(4);

        $number_top = Product::where('top', 1)->count();
        $number_new = Product::where('new', 1)->count();
        $number_promotion = Product::where('promotion_price', '!=', 0)->count();

        return view('home', compact('slides', 'products', 'promotion', 'product_top', 'number_top', 'number_new', 'number_promotion'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
        }

        $cartOld = Session::get('cart', null);
        $cart = new Cart($cartOld);
        $cart->add($product, $id);
        Session::put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Thêm vào giỏ hàng thành công');
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function order(Request $request)
    {
        $cart = Session::get('cart', null);
        if (!$cart || empty($cart->items)) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        $customer = Customer::create([
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'note' => $request->input('notes'),
        ]);

        $bill = Bill::create([
            'id_customer' => $customer->id,
            'date_order' => now(),
            'total' => $cart->totalPrice,
            'payment' => $request->input('payment_method'),
            'note' => $request->input('notes'),
        ]);

        foreach ($cart->items as $key => $value) {
            if ($value['qty'] > 0) {
                BillDetail::create([
                    'id_bill' => $bill->id,
                    'id_product' => $key,
                    'quantity' => $value['qty'],
                    'unit_price' => ($value['qty'] > 0) ? ($value['price'] / $value['qty']) : $value['price'], 
                ]);
            }
        }

        Session::forget('cart');
        return redirect()->route('index')->with('success', 'Đặt hàng thành công!');
    }

    public function delCartItem($id)
    {
        $oldCart = Session::get('cart', null);
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        
        return redirect()->back();
    }

    public function getCheckout()
    {
        return view('checkout');
    }

    public function getSignin() 
    {
        return view('dangky');
    }

    public function postSignin(Request $req) 
    {
        $validated = $req->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20',
            'fullname' => 'required',
            'repassword' => 'required|same:password'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Không đúng định dạng email',
            'email.unique' => 'Email đã có người sử dụng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'repassword.same' => 'Mật khẩu không giống nhau',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự'
        ]);

        $user = new User();
        $user->name = $req->input('fullname'); // Đổi 'name' thành 'fullname' vì form đang sử dụng 'fullname'
        $user->email = $req->input('email');
        $user->password = Hash::make($req->input('password'));
        $user->save();

        return redirect()->route('getSignin')->with('success', 'Đăng ký thành công!');
    }
    public function postLogin(Request $req) {
        $credentials = $req->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Không đúng định dạng email',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự'
        ]);
    
        if (Auth::attempt($credentials)) {
            return redirect('/trangchu')->with(['flag' => 'success', 'message' => 'Đăng nhập thành công']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Đăng nhập không thành công']);
        }
    }
    public function getLogout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('trangchu.index');
    }
    
}
