<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SponsorshipControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sponsorships = Sponsorship::with("category", "user")->get();

        return response()->json($sponsorships);
    }

    public function count($id)
    {
        $sponsorships = Sponsorship::where('id_users', $id)->get()->count();
        return response()->json([
            'count' => $sponsorships
        ]);
    }

    public function sponsorshipWithCategory($idCategory)
    {
        // $sponsorships = Sponsorship::all()->where('id_category', $idCategory);

        $sponsorships = Sponsorship::with("category", "user")->where('id_category', $idCategory)->get();


        return response()->json($sponsorships);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'description' => 'required',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'required',
            'id_category' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'messeage' => 'Periksa kembali data anda',
                'error' => $validator->errors()
            ], 400);
        }

        //Get image
        $image = $request->file('profile_photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('profile_photo'), $imageName);
        $imagePath = 'profile_photo/' . $imageName;


        $user = Auth::user();
        $role = $user->id_role;
        if ($role == 2) {
            try {
                $sponsorship = Sponsorship::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'profile_photo' => $imagePath,
                    'email' => $request->email,
                    'address' => $request->address,
                    'id_category' => $request->id_category,
                    'id_users' => $user->id,
                    'message' => $request->message
                ]);
            } catch (QueryException $e) {
                return response()->json([
                    'success' => false,
                    'errors' => 'periksa kembali data anda'
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Ditambahkan',
                'data' => $sponsorship
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Role tidak diizinkan, Data Gagal Ditambahkan',
            ], 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sponsorships = Sponsorship::with("category", "user")->find($id);

        return response()->json($sponsorships);
    }

    public function detailAuthSponsorship()
    {
        $user = Auth::user();
        $sponsorship = Sponsorship::where('id_users', $user->id)->with("category", "user")->first();

        return response()->json($sponsorship);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            '_method' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'description' => 'required',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'required',
            'id_category' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'messeage' => 'Periksa kembali data anda',
                'error' => $validator->errors()
            ], 401);
        }

        try {
            $sponsorship = Sponsorship::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan, proses update gagal',
            ], 400);
        }

        $beforePath = public_path($sponsorship->profile_photo);
        File::delete($beforePath);

        //Get image
        $image = $request->file('profile_photo');

        if ($image != null) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profile_photo'), $imageName);
            $imagePath = 'profile_photo/' . $imageName;
            $user = Auth::user();
            $role = $user->id_role;
            if (($role == 2) && ($sponsorship->id_users == $user->id)) {
                $sponsorship->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'profile_photo' => $imagePath,
                    'email' => $request->email,
                    'address' => $request->address,
                    'id_category' => $request->id_category,
                    'id_users' => $user->id,
                    'message' => $request->message
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Data Berhasil Diupdate',
                    'data' => $sponsorship
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Role tidak diizinkan, Data Gagal Ditambahkan',
                ], 401);
            }
        } else {
            $user = Auth::user();
            $role = $user->id_role;
            if (($role == 2) && ($sponsorship->id_users == $user->id)) {
                $sponsorship->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'email' => $request->email,
                    'address' => $request->address,
                    'id_category' => $request->id_category,
                    'id_users' => $user->id,
                    'message' => $request->message
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Data Berhasil Diupdate',
                    'data' => $sponsorship
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Role tidak diizinkan, Data Gagal Ditambahkan',
                ], 401);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $sponsorship = Sponsorship::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan, proses delete gagal',
            ], 400);
        }

        if ((Auth::user()->id_role == 2) && ($sponsorship->id_users == Auth::user()->id)) {
            $imagePath = public_path($sponsorship->profile_photo);
            File::delete($imagePath);
            $sponsorship->delete();
            return response()->json([
                'success' => true,
                'message' => 'User Berhasil Dihapus',
                'data' => $sponsorship
            ]);
        }
    }
}
