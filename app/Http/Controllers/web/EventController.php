<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
    public function index()
    {

        $accessToken = Cookie::get('token');
        $url = env('API_URL') . 'event';
        $response = Http::withToken($accessToken)->get($url);
        return view('admin.event_management', [
            'error' => false,
            'data' => json_decode($response)
        ]);
    }


    public function destroy($id)
    {
        $accessToken = Cookie::get('token');
        $url = env('API_URL') . 'event/' . $id;
        $response = Http::withToken($accessToken)->delete($url);
        return redirect('/admin/event');
    }
}
