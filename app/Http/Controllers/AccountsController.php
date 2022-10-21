<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class AccountsController extends Controller
{

    public function index()
    {
        Paginator::useBootstrap();
        $accounts = DB::table('accounts')->orderBy('id', 'DESC');
        return view('Accounts.index')->with("accounts",$accounts->paginate(15))->with("page","account");
    }
    public function create()
    {
        return view('Accounts.create')->with("page","account");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'dealerId' => 'required|unique:accounts,dealerId',
            'apiKey' => 'required|unique:accounts,apiKey',
            'secretKey' => 'required|unique:accounts,secretKey',
        ], [
            'name.required' => 'İsim alanı boş bırakılamaz.',
            'dealerId.required' => 'Bayi Id alanı boş bırakılamaz.',
            'dealerId.unique' => 'Bu bayi id ile kayıt oluşturulmuş.',
            'apiKey.required' => 'Api key alanı boş bırakılamaz',
            'apiKey.unique' => 'Bu api key ile kayıt oluşturulmuş.',
            'secretKey.required' => 'Secret key alanı boş bırakılamaz',
            'secretKey.unique' => 'Bu secret key ile kayıt oluşturulmuş.',
        ]);

        Accounts::create([
            'name' => $request->input('name'),
            'dealerId' => $request->input('dealerId'),
            'apiKey' => $request->input('apiKey'),
            'secretKey' => $request->input('secretKey'),
        ]);

        return redirect('/accounts')->with('success', 'Yeni hesap oluşturuldu.');

    }

    public function delete($id)
    {
        Accounts::find($id)->delete();
        return redirect('/accounts')->with('success', 'Silme işlemi başarıyla gerçekleşti.');

    }

    public function detail($id)
    {
        $account =  Accounts::find($id);
        return view('Accounts.detail')->with("account",$account)->with("page","account");
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
            'dealerId' => 'required',
            'apiKey' => 'required',
            'secretKey' => 'required',
        ], [
            'name.required' => 'İsim alanı boş bırakılamaz.',
            'dealerId.required' => 'Bayi Id alanı boş bırakılamaz.',
            'dealerId.unique' => 'Bu bayi id ile kayıt oluşturulmuş.',
            'apiKey.required' => 'Api key alanı boş bırakılamaz',
            'apiKey.unique' => 'Bu api key ile kayıt oluşturulmuş.',
            'secretKey.required' => 'Secret key alanı boş bırakılamaz',
            'secretKey.unique' => 'Bu secret key ile kayıt oluşturulmuş.',
        ]);

        $account = Accounts::find($id);
        $account->name = $request->input('name');
        $account->dealerId = $request->input('dealerId');
        $account->apiKey = $request->input('apiKey');
        $account->secretKey = $request->input('secretKey');
        $account->save();
        return  redirect('/account/detail/'.$id)->with('success', 'Güncelleme işlemi başarıyla gerçekleşti.')->with("account",$account)->with("page","account");
    }
}