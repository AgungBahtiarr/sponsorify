<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            $responseTransaction = Http::withToken($accessToken)->get($url . "transaction");
        } catch (Exception $e) {
            return view('admin.dashboard', [
                "error" => true
            ]);
        }

        $transaction = json_decode($responseTransaction, true);

        $januari = [];
        $februari = [];
        $maret = [];
        $april = [];
        $mei = [];
        $juni = [];
        $juli = [];
        $agustus = [];
        $september = [];
        $oktober = [];
        $november = [];
        $desember = [];
        foreach ($transaction as $item) {
            $timestamp = strtotime($item['created_at']);

            if (date('m', $timestamp) == 1) {
                array_push($januari, $item);
            }

            if (date('m', $timestamp) == 2) {
                array_push($februari, $item);
            }

            if (date('m', $timestamp) == 3) {
                array_push($maret, $item);
            }

            if (date('m', $timestamp) == 4) {
                array_push($april, $item);
            }

            if (date('m', $timestamp) == 5) {
                array_push($mei, $item);
            }

            if (date('m', $timestamp) == 6) {
                array_push($juni, $item);
            }

            if (date('m', $timestamp) == 7) {
                array_push($juli, $item);
            }

            if (date('m', $timestamp) == 8) {
                array_push($agustus, $item);
            }

            if (date('m', $timestamp) == 9) {
                array_push($september, $item);
            }

            if (date('m', $timestamp) == 10) {
                array_push($oktober, $item);
            }

            if (date('m', $timestamp) == 11) {
                array_push($november, $item);
            }

            if (date('m', $timestamp) == 12) {
                array_push($desember, $item);
            }
        }

        $transaction_date = [count($januari), count($februari), count($maret), count($april), count($mei), count($juni), count($juli), count($agustus), count($september), count($oktober), count($november), count($desember)];
        if ($responseUser->status() == 200) {
            return view('admin.dashboard', [
                'error' => false,
                'users' => json_decode($responseUser),
                'roles' => json_decode($responseRoles),
                'statuses' => json_decode($responseStatus)->data,
                'categories' => json_decode($responseCategory),
                'sponsorships' => json_decode($responseSponsorship),
                'events' => json_decode($responseEvent),
                'transaction' => $transaction_date
            ]);
        } else {
            return view('admin.dashboard', [
                'error' => true
            ]);
        }
    }
}
