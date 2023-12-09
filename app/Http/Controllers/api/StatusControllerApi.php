<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $statuses = Status::get();
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'error' => $e
            ], 500);
        }
        return response()->json([
            'success' => true,
            'data' => $statuses
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = [
            'status' => $request->status,
            'description' => $request->description
        ];
        if ($user->id_role == 3) {
            try {
                $status = Status::create($data);
            } catch (QueryException $e) {
                return response()->json([
                    'success' => false,
                    'error' => $e
                ], 400);
            }
            return response()->json([
                'success' => true,
                'data' => $status
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'status tidak di izinkan'
            ], 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $data = [
            'status' => $request->status,
            'description' => $request->description
        ];
        if ($user->id_role == 3) {
            try {
                $status = Status::findOrFail($id);
                $status->update($data);
            } catch (QueryException $e) {
                return response()->json([
                    'success' => false,
                    'error' => $e
                ], 400);
            }
            return response()->json([
                'success' => true,
                'data' => $status
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'status tidak di izinkan'
            ], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();

        if ($user->id_role == 3) {
            try {
                $status = Status::findOrFail($id);
                $status->delete();
            } catch (QueryException $e) {
                return response()->json([
                    'success' => false,
                    'error' => $e
                ], 400);
            }
            return response()->json(['success' => true, 'message' => "Data berhasil dihapus"], 200);

        } else {
            return response()->json([
                'success' => false,
                'message' => 'status tidak di izinkan'
            ], 403);
        }
    }
}
