<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cards;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class CardsController extends Controller
{

    public function index()
    {
        Paginator::useBootstrap();
        $accounts = DB::table('cards')->orderBy('id', 'DESC');
        return view('Cards.index')->with("cards",$accounts->paginate(15))->with("page","cards");
    }
    
    public function create()
    {
        return view('Cards.create')->with("page","cards");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'holderName' => 'required',
            'cardNumber' => 'required',
            'expiryMonth' => 'required',
            'expiryYear' => 'required',
            'cvc' => 'required',
        ], [
            'cvc.required' => 'CVC alanı boş bırakılamaz.',
            'holderName.required' => 'Kart sahibi alanı boş bırakılamaz.',
            'cardNumber.required' => 'Kart numarası alanı boş bırakılamaz',
            'expiryMonth.required' => 'Son kullanma tarihi boş bırakılamaz',
            'expiryYear.required' => 'Son kullanma tarihi boş bırakılamaz',
        ]);

        Cards::create([
            'cardNumber' => $request->input('cardNumber'),
            'expiryMonth' => $request->input('expiryMonth'),
            'expiryYear' => $request->input('expiryYear'),
            'cvc' => $request->input('cvc'),
            'holderName' => $request->input('holderName'),
        ]);

        return redirect('/cards')->with('success', 'Yeni Kart oluşturuldu.');

    }

    public function delete($id)
    {
        Cards::find($id)->delete();
        return redirect('/cards')->with('success', 'Silme işlemi başarıyla gerçekleşti.');

    }

    public function detail($id)
    {
        $card =  Cards::find($id);
        return view('Cards.detail')->with("card",$card)->with("page","cards");
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'holderName' => 'required',
            'cardNumber' => 'required',
            'expiryMonth' => 'required',
            'expiryYear' => 'required',
            'cvc' => 'required',
        ], [
            'cvc.required' => 'CVC alanı boş bırakılamaz.',
            'holderName.required' => 'Kart sahibi alanı boş bırakılamaz.',
            'cardNumber.required' => 'Kart numarası alanı boş bırakılamaz',
            'expiryMonth.required' => 'Son kullanma tarihi boş bırakılamaz',
            'expiryYear.required' => 'Son kullanma tarihi boş bırakılamaz',
        ]);

        $card = Cards::find($id);
        $card->holderName = $request->input('holderName');
        $card->cardNumber = $request->input('cardNumber');
        $card->expiryMonth = $request->input('expiryMonth');
        $card->expiryYear = $request->input('expiryYear');
        $card->cvc = $request->input('cvc');
        $card->save();
        return  redirect('/card/detail/'.$id)->with('success', 'Güncelleme işlemi başarıyla gerçekleşti.')->with("card",$card)->with("page","cards");
    }


}