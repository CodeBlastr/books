<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Account;
use App\Credential;
use App\Plaid;
use App\Transaction;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::all();
        return response()->json($accounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $credentials = Credential::where('status', '=', 'unused')->get();
        $accounts = Account::where('type', '=', 'bank')->get();
        //return response()->json([$credentials, $accounts]);
        return view('accounts/create')->with(compact('credentials', 'accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $account = new Account([
            'title' => $request->get('title'),
            'body' => $request->get('body')
        ]);
        $account->save();


        return response()->json('Account Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = Account::find($id);
        if (!empty($account)) {
            $credential = Credential::where('id', '=', $account->credential_id)->first();
            dd(json_decode($credential->public_data));


            $response = Plaid::request(['endpoint' => '/transactions/get']);
            dd($response);
            return response()->json($response);

            $transactions = Transaction::where('account_id', '=', $id)->get();
            return view('accounts/show')->with(compact('account', 'transactions'));
        } else {
            Session::flash('status', 'No account found!');
            Session::flash('status-class', 'alert-danger');
            return view('accounts/show')->with('account', null);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = Account::find($id);
        return response()->json($account);

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
        $account = Account::find($id);
        $account->title = $request->get('title');
        $account->body = $request->get('body');
        $account->save();


        return response()->json('Account Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::find($id);
        $account->delete();


        return response()->json('Account Deleted Successfully.');
    }
}
