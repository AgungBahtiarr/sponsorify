<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Sponsorship;
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
            $users = User::with("role")->get();
            return response()->json($users, 200);
        } catch (QueryException $e) {
            return response()->json([
                "success" => false,
                "error" => $e
            ], 500);
        }

    }
    public function indexEvent()
    {
        try {
            $users = User::where('id_role', 1)->get();
            return response()->json($users, 200);
        } catch (QueryException $e) {
            return response()->json([
                "success" => false,
                "error" => $e
            ], 500);
        }
    }

    public function indexSponsorship()
    {
        try {
            $users = User::where('id_role', 2)->get();
            return response()->json($users, 200);
        } catch (QueryException $e) {
            return response()->json([
                "success" => false,
                "error" => $e
            ], 500);
        }

    }
    public function authUser()
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

    public function update(Request $request, $id)
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
            ], 400);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'id_role' => $request->id_role
        ];

        try {
            $user = User::findOrFail($id);
            $user->update($data);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => "Update data gagal",
                'error' => $e
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => "Update data success",
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCurrentUser(Request $request)
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
            ], 400);
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
    public function destroy($id)
    {
        $authUser = Auth::user();

        if ($authUser->id_role == 3) {

            try {
                $user = User::findOrFail($id);
                $imagePath = public_path($user->profile_photo);
                File::delete($imagePath);
                $user->delete();
            } catch (QueryException $e) {
                return response()->json([
                    'success' => false,
                    'error' => $e
                ], 400);
            }
            return response()->json([
                'success' => true
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Role tidak di izinkan'
            ], 403);
        }
    }
}
