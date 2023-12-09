<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class LogoutController extends Controller
{
    public function logout()
    {
        $accessToken = Cookie::get("token");
        $url = env("API_URL") . "logout";
        $responsee = Http::withToken($accessToken)->delete($url);
        if ($responsee->status() == 200) {
            Cookie::queue(Cookie::make('token', null));
            return redirect('/admin/login');
        }

    }
}
