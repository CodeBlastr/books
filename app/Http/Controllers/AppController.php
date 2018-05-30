<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plaid;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plaid = new Plaid();
        $response = $plaid->testPoint();
        return response()->json($response);
    }
}
