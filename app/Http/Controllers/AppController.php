<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Yodlee;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Yodlee::appLogin();
        return response()->json($response);
    }
}
