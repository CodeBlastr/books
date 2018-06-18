<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Credential;
use Illuminate\Support\Facades\Log;
use App\Plaid;

class CredentialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credentials = Credential::decode(Credential::where('status', 'unused')->orWhere('status', 'partial')->get());
        return response()->json($credentials);
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
     * @todo Change this to a api call with json output for react to digest
     */
    public function store(Request $request)
    {
        $credential = new Credential([
            'status' => 'unused',
            'public_data' =>json_encode($request->input()),
            'private_data' => json_encode(Plaid::request(['endpoint' => '/item/public_token/exchange', 'body' => ['public_token' => $request->input('public_token')]])),
            'name' => $request->input('metadata')['institution']['name']
        ]);

        return response()->json($credential->save());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $credential = Credential::find($id);
        return response()->json($credential);

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
        $credential = Credential::find($id);
        $credential->name = $request->get('name');
        $credential->save();

        return response()->json('Credential Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $credential = Credential::find($id);
        $credential->delete();

        return response()->json('Credential Deleted Successfully.');
    }
}
