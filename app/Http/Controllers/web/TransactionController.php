<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{
    public function index()
    {
        $accessToken = Cookie::get("token");
        $url = env("API_URL") . "transaction";
        $response = Http::withToken($accessToken)->get($url);
        return view('admin.transaction', [
            'data' => json_decode($response)
        ]);
    }
}
