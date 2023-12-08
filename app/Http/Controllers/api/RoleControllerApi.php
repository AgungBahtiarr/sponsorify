<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleControllerApi extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->id_role == 3) {
            $roles = Role::get();
            return response()->json($roles);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Role tidak di izinkan'
            ], 403);
        }
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $data = [
            'role' => $request->role
        ];
        if ($user->id_role == 3) {
            $role = Role::create($data);
            return response()->json([
                'success' => true,
                'data' => $role
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Role tidak di izinkan'
            ], 403);
        }
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $data = [
            'role' => $request->role
        ];
        if ($user->id_role == 3) {
            try {
                $role = Role::findOrFail($id);
                $role->update($data);
            } catch (QueryException $e) {
                return response()->json([
                    'success' => false,
                    'error' => $e
                ], 400);
            }
            return response()->json([
                'success' => true,
                'data' => $role
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Role tidak di izinkan'
            ], 403);
        }
    }

    public function destroy($id)
    {
        $user = Auth::user();

        if ($user->id_role == 3) {
            try {
                $role = Role::findOrFail($id);
                $role->delete();
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
                'message' => 'Role tidak di izinkan'
            ], 403);
        }

    }
}
