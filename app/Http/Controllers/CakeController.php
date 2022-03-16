<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CakeImport;
use App\Models\Cake;
use App\Models\Order;
use App\Models\Customer;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CakeController extends Controller
{
    public function shopConfig()
    {
        $user = Auth::user();
        return view('config', ['user' => $user]);
    }

    public function config()
    {
        $user = Auth::user();
        return view('import', ['user' => $user]);
    }

    public function import(Request $request)
    {   
        $excel_file = $request->file('excel_file');
        $excel_file->store('excels');
        Excel::import(new CakeImport, $excel_file);
        return redirect()->route('index');
    }

    public function export()
    {
        $user = Auth::user();
        $yamazaki_cakes = Cake::where('maker', '=', 'ヤマザキ')->get(); 
        $siraisi_cakes = Cake::where('maker', '=', 'シライシ')->get(); 
        $pasco_cakes = Cake::where('maker', '=', 'パスコ')->get(); 

        $yamazaki_orders = Order::where('shop_id', '=', $user->shop_id)
        ->where('cake_maker', '=', 'ヤマザキ')
        ->get();

        $siraisi_orders = Order::where('shop_id', '=', $user->shop_id)
        ->where('cake_maker', '=', 'シライシ')
        ->get();

        $pasco_orders = Order::where('shop_id', '=', $user->shop_id)
        ->where('cake_maker', '=', 'パスコ')
        ->get();

        $total = Order::where('shop_id', '=', $user->shop_id)->sum('quantity');
        $yamazaki_total = Order::where('cake_maker', '=', 'ヤマザキ')->sum('quantity');
        $siraisi_total = Order::where('cake_maker', '=', 'シライシ')->sum('quantity');
        $pasco_total = Order::where('cake_maker', '=', 'パスコ')->sum('quantity');

        return view('export', [
            'user' => $user,
            'yamazaki_cakes' => $yamazaki_cakes,
            'siraisi_cakes' => $siraisi_cakes,
            'pasco_cakes' => $pasco_cakes,
            'yamazaki_orders' => $yamazaki_orders,
            'siraisi_orders' => $siraisi_orders,
            'pasco_orders' => $pasco_orders,
            'total' => $total,
            'yamazaki_total' => $yamazaki_total,
            'siraisi_total' => $siraisi_total,
            'pasco_total' => $pasco_total
        ]);
    }

    public function case()
    {
        $user = Auth::user();
        $orders = Order::orderBy('reserva_date', 'asc')->orderBy('through', 'asc')->get();
        $id = [];
        return view('case', compact('user', 'orders', 'id'));
    }

    public function register(Request $request)
    {   
        $user = Auth::user();
        $message = '';
        $success = '登録に成功しました';

        $request->validate([
            'number' => 'required',
            'maker' => 'required',
            'name' => 'required',
        ]);

        $al_cakes = Cake::where('number', '=', $request->number)->get();
        foreach($al_cakes as $al_cake) {
            if($al_cake->maker == $request->maker) {
                $message = '登録に失敗しました。既に使用されているナンバーです';
                return view('import', ['user' => $user, 'message' => $message]);
            }
        }

        $cake = new Cake();
        $cake->number = $request->number;
        $cake->maker = $request->maker;
        $cake->name = $request->name;
        $cake->save();

        return view('import', ['user' => $user, 'success' => $success]);
    }

    public function index()
    {
        $user = Auth::user();

        return view('index', ['user' => $user]);
    }

    public function show() 
    {
        $user = Auth::user();
        $contents = Order::latest('updated_at')->get();
        $total = Order::where('shop_id', '=', $user->shop_id)->sum('quantity');
        return view('show', ['contents' => $contents, 'user' => $user, 'total' => $total]);
    }

    public function detail($id)
    {
        $order = Order::find($id);
        $user = Auth::user();
        return view('detail', ['order' => $order, 'user' => $user]);
    }

    public function store(Request $request) 
    {
        $user = Auth::user();
        $name = '';

        $al_customer = Customer::where('name', '=', preg_replace('/( |　)/', '', $request->customer_name))
                        ->where('reserva_shop_id', '=', $user->shop_id)
                        ->where('phone', '=', $request->customer_phone)
                        ->first();

        if(empty($al_customer)) {
            $customer = new Customer();
            $customer->reserva_shop_id = $user->shop_id;
            $name_check = preg_replace('/( |　)/', '', $request->customer_name);
            $customer->name = $name_check;
            $customer->phone = $request->customer_phone;
            $customer->time = $request->customer_time;
            $customer->save();
        }

        $order = new Order();
        $order->shop_id = $request->shop_id;
        $order->shop_name = $request->shop_name;
        $order->through = $request->through;
        $order->cake_maker = $request->cake_maker;
        $order->cake_number = $request->cake_number;
        $order->cake_name = $request->cake_name;
        $order->quantity = $request->quantity;
        if(isset($al_customer)) {
            $order->customer_id = $al_customer->id;
        } else {
            $order->customer_id = $customer->id;
        }
        $date = date('Y'). '-' . 12 . '-' . $request->date; 
        $order->reserva_date = date('Y年m月d日', strtotime($date));
        $order->save();

        return redirect()->route('index');
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $date = date('Y'). '-' . 12 . '-' . mb_substr($request->date, -3, 2); 
        $order->reserva_date = date('Y年m月d日', strtotime($date));
        $order->through = $request->through;
        if(empty($request->through)) {
            $order->through = '未入力';
        }
        $order->cake_maker = $request->cake_maker;
        $order->cake_number = $request->cake_number;
        $order->cake_name = $request->cake_name;
        $order->quantity = $request->quantity;
        $order->save();

        $customer = Customer::find($order->customer_id);
        $customer->name = $request->customer_name;
        if(empty($request->customer_name)) {
            $customer->name = '未入力';
        }
        $customer->phone = $request->customer_phone;
        if(empty($request->customer_phone)) {
            $customer->phone = '未入力';
        }
        $customer->time = $request->customer_time;
        $customer->save();

        return redirect()->route('show');
    }

    public function delete($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('show');
    }

    public function search(Request $request)
    {   
        $user = Auth::user();
        $total = Order::where('shop_id', '=', $user->shop_id)->sum('quantity');
        $date = date('Y'). '年' . 12 . '月' . $request->date;

        if(empty($request->date)) {
            $date = 12;
        }

        $contents = Order::where('shop_id', '=', $user->shop_id)
                        ->where('reserva_date', 'like', "%$date%")
                        ->where('cake_maker', 'like', "%$request->maker%")
                        ->where('cake_name', 'like', "%$request->name%")
                        ->orderBy('updated_at', 'desc')
                        ->get();

        $search_total = $contents->sum('quantity');

        return view('show', ['user' => $user, 'total' => $total, 'contents' => $contents, 'search_total' => $search_total]);
    }

    public function userUpdate(Request $request)
    {
        $user = Auth::user();
        if(isset($request->password)) {
            $rules = [
                'password' => 'confirmed|max:128|min:6',
            ];
            $this->validate($request, $rules);
            $user->password = Hash::make($request->password);
        }
        $user->shop_id = $request->shop_id;
        $user->name = $request->name;
        if(empty($request->target_num)) {
            $user->target_num = 0;
        } else {
            $user->target_num = $request->target_num;
        }
        $user->save();

        return view('logout', ['user' => $user]);
    }

    //api
    public function cake($maker) 
    {
        $cakes = Cake::where('maker', '=', $maker)->get();
        return $cakes;
    }

    public function deleteConfirm($id)
    {
        $order = Order::find($id);
        $customer = Customer::find($order->customer_id);
        $data = [$order, $customer];
        return $data;
    }
}