<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class StatusController extends Controller
{
    public function index()
    {
        $accessToken = Cookie::get("token");
        $url = env("API_URL") . "status";
        $response = Http::withToken($accessToken)->get($url);
        if ($response->status() == 200) {
            return view('admin.status_management', [
                'error' => false,
                'data' => json_decode($response)->data
            ]);
        } else {
            return view('admin.status_management', [
                'error' => true
            ]);
        }
    }

    public function store(Request $request)
    {
        $data = [
            'status' => $request->status,
            'description' => $request->description
        ];

        try {
            $accessToken = Cookie::get("token");
            $url = env("API_URL") . "status";
            $response = Http::withToken($accessToken)->post($url, $data);
        } catch (Exception $e) {
            return redirect('/admin/status')->with([
                'error' => true,
                'message' => 'Gagal menambahkan data',
                'data' => $e
            ]);
        }

        if ($response->status() == 201) {
            return redirect('/admin/status');
        } else {
            return redirect('/admin/status')->with(['error' => true]);
        }
    }

    public function update(Request $request, $id)
    {
        $data = [
            '_method' => 'patch',
            'status' => $request->status,
            'description' => $request->description
        ];

        try {
            $accessToken = Cookie::get("token");
            $url = env("API_URL") . "status/" . $id;
            $response = Http::withToken($accessToken)->patch($url, $data);
        } catch (Exception $e) {
            return redirect('/admin/status')->with([
                'error' => true,
                'message' => 'Gagal mengupdate data',
                'data' => $e
            ]);
        }

        if ($response->status() == 200) {
            return redirect('/admin/status');

        } else {
            return redirect('/admin/status')->with(['error' => true]);
        }
    }

    public function destroy($id)
    {
        try {
            $accessToken = Cookie::get("token");
            $url = env("API_URL") . "status/" . $id;
            $response = Http::withToken($accessToken)->delete($url);
        } catch (Exception $e) {
            return redirect('/admin/status')->with([
                'error' => true
            ]);
        }

        if ($response->status() == 200) {
            return redirect('/admin/status');
        } else {
            return redirect('/admin/status')->with([
                'error' => true
            ]);
        }
    }
}
