<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class SponsorController extends Controller
{
    public function index()
    {

        $accessToken = Cookie::get('token');
        $url = env("API_URL") . "sponsorship";
        $response = Http::withToken($accessToken)->get($url);
        if ($response->status() == 200) {
            return view('admin.sponsor_management', [
                'error' => false,
                'data' => json_decode($response)]
            );
        } else {
            return view('admin.sponsor_management', [
                'error' => true
            ]);
        }

    }

    public function destroy($id)
    {
        $accessToken = Cookie::get('token');
        $url = env("API_URL") . "sponsorship/" . $id;
        $response = Http::withToken($accessToken)->delete($url);
        if ($response->status() == 200) {
            return redirect('/admin/sponsor');
        } else {
            return redirect('/admin/sponsor')->with([
                'error' => true
            ]);
        }
    }
}
