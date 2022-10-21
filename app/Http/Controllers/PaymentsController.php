<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Accounts;
use App\Models\Cards;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{

    public function index()
    {
        Paginator::useBootstrap();
        $payments = DB::table('orders')
        ->join('cards', 'orders.creditCardId', '=', 'cards.id')
        ->join('accounts', 'orders.accountId', '=', 'accounts.id')
        ->select('orders.*', 'cards.*', 'accounts.*')
        ->orderBy('orders.id', 'DESC');

        $paginate = $payments->paginate(15);
        $cards = Cards::all();
        $accounts = Accounts::all();
        return view('Payments.index')->with("payments",$paginate)->with("page","payment")->with("cards",$cards)->with("accounts",$accounts);
    }

    public function success(Request $request)
    {
        dd($request->all());
    }

    public function error(Request $request)
    {
        dd($request->all());
    }

    public function callback(Request $request)
    {
        $order = Orders::find($request->orderId);
        if($request->paymentStatus == "false"){
            $order->weepayOrderId = $request->paymentId;
            $order->status = 2;
            $order->save();
            return view('Payments.error')->with("page","payment")->with("error",$request->message);
        }else{
            $order->weepayOrderId = $request->paymentId;
            $order->status = 1;
            $order->save();
            return view('Payments.success')->with("page","payment");
        }

    }
}