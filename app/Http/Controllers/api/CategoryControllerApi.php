<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }


    // public function sponsorshipWithCategory($idCategory)
    // {

    //     $categories = Category::all()->where('id', $idCategory);

    //     return response()->json($categories, 200);

    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->id_role == 3) {
            $data = [
                'category' => $request->category,
                'description' => $request->description,
            ];
            $category = Category::create($data);

            return response()->json([
                'success' => true,
                'data' => $category
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Role tidak diizinkan"
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

        if ($user->id_role == 3) {
            $data = [
                'category' => $request->category,
                'description' => $request->description,
            ];
            $category = Category::findOrFail($id);

            $category->update($data);
            return response()->json([
                'success' => true,
                'data' => $category
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Role tidak diizinkan"
            ], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $category = Category::findOrFail($id);
        if ($user->id_role) {
            $category->delete();

            return response()->json([
                'success' => true,
                'message' => "Data berhasil dihapus"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Role tidak diizinkan"
            ], 403);
        }
    }
}
