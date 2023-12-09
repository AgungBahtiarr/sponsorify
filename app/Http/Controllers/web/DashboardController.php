<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $accessToken = Cookie::get("token");
            $url = env("API_URL");
            $responseUser = Http::withToken($accessToken)->get($url . "user");
            $responseRoles = Http::withToken($accessToken)->get($url . "roles");
            $responseCategory = Http::withToken($accessToken)->get($url . "category");
            $responseStatus = Http::withToken($accessToken)->get($url . "status");
            $responseEvent = Http::withToken($accessToken)->get($url . "user/event");
            $responseSponsorship = Http::withToken($accessToken)->get($url . "user/sponsorship");
        } catch (Exception $e) {
            return view('admin.dashboard', [
                "error" => true
            ]);
        }
        if ($responseUser->status() == 200) {
            return view('admin.dashboard', [
                'error' => false,
                'users' => json_decode($responseUser),
                'roles' => json_decode($responseRoles),
                'statuses' => json_decode($responseStatus)->data,
                'categories' => json_decode($responseCategory),
                'sponsorships' => json_decode($responseSponsorship),
                'events' => json_decode($responseEvent)

            ]);
        } else {
            return view('admin.dashboard', [
                'error' => true
            ]);
        }
    }
}
