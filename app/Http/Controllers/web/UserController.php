<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        try {
            $accessToken = Cookie::get("token");
            $urlUser = env("API_URL") . "user";
            $responseUser = Http::withToken($accessToken)->get($urlUser);
            $urlRole = env("API_URL") . "roles";
            $responseRoles = Http::withToken($accessToken)->get($urlRole);

        } catch (Exception $e) {
            return view('admin.user_management', [
                "error" => true
            ]);
        }

        if ($responseUser->status() == 200) {
            return view('admin.user_management', [
                'error' => false,
                'data' => json_decode($responseUser),
                'roles' => json_decode($responseRoles)
            ]);
        } else {
            return view('admin.user_management', [
                'error' => true
            ]);
        }
    }


    public function update(Request $request, $id)
    {
        $data = [
            '_method' => 'patch',
            'name' => $request->name,
            'email' => $request->email,
            'id_role' => $request->id_role
        ];

        try {
            $accessToken = Cookie::get("token");
            $url = env("API_URL") . "user/" . $id;
            $response = Http::withToken($accessToken)->patch($url, $data);
        } catch (Exception $e) {
            return redirect('/admin/user')->with(['error' => true]);

        }

        if ($response->status() == 200) {
            return redirect('/admin/user');
        } else {
            return redirect('/admin/user')->with(['error' => true]);
        }
    }

    public function destroy($id)
    {
        try {
            $accessToken = Cookie::get("token");
            $url = env("API_URL") . "user/" . $id;
            $response = Http::withToken($accessToken)->delete($url);
        } catch (Exception $e) {
            return redirect('/admin/user')->with(['error' => true]);
        }

        if ($response->status() == 200) {
            return redirect('/admin/user');
        } else {
            return redirect('/admin/user')->with(['error' => false]);
        }
    }
}
