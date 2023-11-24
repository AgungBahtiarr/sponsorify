<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Saved;
use App\Models\Sponsorship;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SavedControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $saved = Saved::with('sponsorship', )->where("id_users", $user->id)->get();

        if ($user->id_role == 1) {
            return response()->json($saved, 200);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Role tidak diizinkan"
            ], 403);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_sponsorship' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'succes' => false,
                'message' => 'periksa kembali data anda',
                'errors' => $validator->fails()
            ], 400);
        }

        $user = Auth::user();


        if (($user->id_role == 1)) {
            $saved = Saved::create([
                'id_sponsorship' => $request->id_sponsorship,
                'id_users' => $user->id
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Behasil tersimpan',
                'data' => $saved
            ], 201);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Role tidak diizinkan"
            ], 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();

        try {
            $saved = Saved::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data event tidak ditemukan'
            ]);
        }

        if ($user->id_role == 1) {
            $saved->delete();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data',
                'data' => $saved
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Role tidak di izinkan'
            ], 403);
        }
    }
}
