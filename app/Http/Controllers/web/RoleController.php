<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accessToken = Cookie::get("token");
        $url = env("API_URL") . "roles";
        $response = Http::withToken($accessToken)->get($url);
        return view('admin.role_management', [
            'data' => json_decode($response)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'role' => $request->role
        ];

        try {
            $accessToken = Cookie::get("token");
            $url = env("API_URL") . "roles";
            $response = Http::withToken($accessToken)->post($url, $data);
        } catch (Exception $e) {
            return redirect('/admin/role')->with([
                'error' => true,
                'message' => 'Gagal menambahkan data',
                'data' => $e
            ]);
        }


        if ($response->status() == 201) {
            return redirect('/admin/role');
        } else {
            return redirect('/admin/role')->with(['error' => true]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = [
            '_method' => 'patch',
            'role' => $request->role
        ];

        try {
            $accessToken = Cookie::get("token");
            $url = env("API_URL") . "roles/" . $id;
            $response = Http::withToken($accessToken)->patch($url, $data);
        } catch (Exception $e) {
            return redirect('/admin/role')->with([
                'error' => true,
                'message' => 'Gagal Update data',
                'data' => $e
            ]);
        }


        if ($response->status() == 200) {
            return redirect('/admin/role');
        } else {
            return redirect('/admin/role')->with(['error' => true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $accessToken = Cookie::get("token");
            $url = env("API_URL") . "roles/" . $id;
            $response = Http::withToken($accessToken)->delete($url);
        } catch (Exception $e) {
            return redirect('/admin/role')->with([
                'error' => true
            ]);
        }

        if ($response->status() == 200) {
            return redirect('/admin/role');
        } else {
            return redirect('/admin/role')->with([
                'error' => true
            ]);
        }
    }
}
