<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class UserControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $auth_user = Auth::user();
            $user = User::with('role')->where('id', $auth_user->id)->first();
            return response()->json(['data' => $user], 200);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'error' => $e
            ], 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '_method' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'messeage' => 'Periksa kembali data anda',
                'error' => $validator->errors()
            ],400);
        }

        // ambil model user
        $user = Auth::user();


        $beforePath = public_path($user->profile_photo);
        File::delete($beforePath);

        // proses image
        $image = $request->file('profile_photo');
        if ($image != null) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profile_photo'), $imageName);
            $imagePath = 'profile_photo/' . $imageName;
            $user->update([
                'name' => $request->name,
                'profile_photo' => $imagePath,
                'email' => $request->email,
            ]);
        }

        // proses update
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Update data success',
            'data' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
