<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Credential;
use Illuminate\Support\Facades\Log;

class CredentialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credentials = Credential::all();
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
     */
    public function store(Request $request)
    {
        //['public_token'] => public-sandbox-f99ccb0b-f166-404d-90a5-cff8b80b1632
        $credential = new Credential([
            'status' => 'unused',
            'data' => json_encode($request->input()),
            'name' => $request->input('metadata')['institution']['name']
        ]);
        $credential->save();
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
        $credential->title = $request->get('title');
        $credential->body = $request->get('body');
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
