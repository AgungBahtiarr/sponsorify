<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\Sponsorship;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProposalControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $proposals = Proposal::where("id_users", $user->id)->get();

        if ($user->id_role == 1) {
            return response()->json([
                "success" => true,
                "message" => "Data Proposal",
                "data" => $proposals
            ], 200);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Role tidak diizinkan"
            ], 403);
        }
    }

    public function indexSponsor()
    {
        $user = Auth::user();
        $sponsorship = Sponsorship::where("id_users", $user->id)->first();
        $proposals = Proposal::where("id_sponsorship", $sponsorship->id)->get();
        if ($user->id_role == 2) {
            return response()->json([
                'success' => true,
                'message' => 'Data ditemukan',
                'data' => $proposals
            ], 200);
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
        // ddd($request->all());
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'proposal' => 'required|mimes:pdf,docx,doc|max:12048',
            'id_sponsorship' => 'required',
            'id_event' => 'required',
            'id_status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'periksa kembali inputan anda',
                'errors' => $validator->errors()
            ]);
        }

        $file = $request->file('proposal');
        $fileName = $user->name . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('proposal'), $fileName);
        $filePath = 'proposal/' . $fileName;

        if ($user->id_role == 1) {
            try {
                //code...
                $proposal = Proposal::create([
                    'proposal' => $filePath,
                    'id_sponsorship' => $request->id_sponsorship,
                    'id_event' => $request->id_event,
                    'id_users' => $user->id,
                    'id_status' => $request->id_status,
                ]);
            } catch (QueryException $e) {
                return response()->json([
                    'success' => false,
                    'errors' => 'periksa kembali data anda'
                ], 400);
            }
            return response()->json([
                'success' => true,
                'message' => "berhasil menambahkan data",
                'data' => $proposal
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'role tidak diizinkan'
            ], 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Proposal $proposal)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        try {
            $proposal = Proposal::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'errors' => "Data Tidak ditemukan"
            ]);
        }

        $validator = Validator::make($request->all(), [
            'proposal' => 'required|mimes:pdf,docx,doc|max:12048',
            'id_sponsorship' => 'required',
            'id_event' => 'required',
            'id_status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'periksa kembali inputan anda',
                'errors' => $validator->errors()
            ]);
        }

        $beforePath = public_path($proposal->proposal);
        // return $beforePath;
        File::delete($beforePath);

        $file = $request->file('proposal');
        $fileName = $user->name . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('proposal'), $fileName);
        $filePath = 'proposal/' . $fileName;

        if (($user->id_role == 1) && ($proposal->id_users == $user->id)) {
            try {
                $proposal->update([
                    'proposal' => $filePath,
                    'id_sponsorship' => $request->id_sponsorship,
                    'id_event' => $request->id_event,
                    'id_users' => $user->id,
                    'id_status' => $request->id_status,
                ]);
            } catch (QueryException $e) {
                return response()->json([
                    'success' => false,
                    'errors' => 'periksa kembali data anda'
                ], 400);
            }
            return response()->json([
                'success' => true,
                'message' => "berhasil mengupdate data",
                'data' => $proposal
            ], 201);
        } else {
            # code...
            return response()->json([
                'success' => false,
                'message' => 'role tidak diizinkan'
            ], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();

        try {
            $proposal = Proposal::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        if ($user->id_role == 1) {
            $filePath = public_path($proposal->proposal);
            File::delete($filePath);
            $proposal->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data',
                'data' => $proposal
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Role tidak di izinkan'
            ], 403);
        }

    }
}
