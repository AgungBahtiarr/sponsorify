<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function index()
    {
        return view("admin.login", [
            'failed' => false
        ]);
    }


    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        try {
            $url = env("API_URL") . "login";
            $response = Http::post($url, $data);
        } catch (Exception $e) {
            echo $e;
        }

        if ($response->getStatusCode() == 200) {
            $token = $response["token"];
            Cookie::queue(Cookie::make('token', $token));
            return redirect('/admin');
        } else {
            return view("admin.login", ['failed' => true]);
        }
    }
}
