<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    public function index()
    {
        $accessToken = Cookie::get("token");
        $url = env("API_URL") . "category";
        $response = Http::withToken($accessToken)->get($url);

        if ($response->status() == 200) {
            return view('admin.category_management', [
                'error' => false,
                'data' => json_decode($response)
            ]);
        } else {
            return view('admin.category_management', [
                'error' => true
            ]);
        }
    }

    public function store(Request $request)
    {
        $data = [
            'category' => $request->category,
            'description' => $request->description
        ];

        try {
            $accessToken = Cookie::get("token");
            $url = env("API_URL") . "category";
            $response = Http::withToken($accessToken)->post($url, $data);
        } catch (Exception $e) {
            return redirect('/admin/category')->with([
                'error' => true,
                'message' => 'Gagal menambahkan data',
                'data' => $e
            ]);
        }

        if ($response->status() == 201) {
            return redirect('/admin/category');
        } else {
            return redirect('/admin/category')->with(['error' => true]);
        }
    }

    public function update(Request $request, $id)
    {
        $data = [
            '_method' => 'patch',
            'category' => $request->category,
            'description' => $request->description
        ];

        try {
            $accessToken = Cookie::get("token");
            $url = env("API_URL") . "category/" . $id;
            $response = Http::withToken($accessToken)->patch($url, $data);
        } catch (Exception $e) {
            return redirect('/admin/category')->with([
                'error' => true,
                'message' => 'Gagal mengupdate data',
                'data' => $e
            ]);
        }

        if ($response->status() == 200) {
            return redirect('/admin/category');

        } else {
            return redirect('/admin/category')->with(['error' => true]);
        }
    }

    public function destroy($id)
    {
        try {
            $accessToken = Cookie::get("token");
            $url = env("API_URL") . "category/" . $id;
            $response = Http::withToken($accessToken)->delete($url);
        } catch (Exception $e) {
            return redirect('/admin/category')->with([
                'error' => true
            ]);
        }

        if ($response->status() == 200) {
            return redirect('/admin/category');
        } else {
            return redirect('/admin/category')->with([
                'error' => true
            ]);
        }
    }
}
