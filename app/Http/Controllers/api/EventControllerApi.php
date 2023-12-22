<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Proposal;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->id_role == 1) {
            $events = Event::with('users')->where("id_users", $user->id)->get();
        } elseif ($user->id_role == 3) {
            $events = Event::with('users')->get();
        }

        return response()->json($events);
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
        ]);
        if ($validator->fails()) {
            return response()->json([
                'messeage' => 'Periksa kembali data anda',
                'error' => $validator->errors()
            ]);
        }

        //Get image
        $image = $request->file('profile_photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('profile_photo'), $imageName);
        $imagePath = 'profile_photo/' . $imageName;


        $user = Auth::user();
        $role = $user->id_role;
        if ($role == 1) {
            try {
                //code... 
                $event = Event::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'profile_photo' => $imagePath,
                    'email' => $request->email,
                    'id_users' => $user->id
                ]);
            } catch (QueryException $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan data, periksa kembali data anda'
                ], 400);
            }
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Ditambahkan',
                'data' => $event,
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Role tidak diizinkan, Data Gagal Ditambahkan',
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        try {
            $event = Event::with('users')->find($id);
            return response()->json($event, 200);
        } catch (QueryException $e) {
            return response()->json([
                "success" => false
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            '_method' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'description' => 'required',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'messeage' => 'Periksa kembali data anda',
                'error' => $validator->errors()
            ]);
        }

        // ambil model event dan user
        $event = Event::findOrFail($id);
        $user = Auth::user();

        $beforePath = public_path($event->profile_photo);
        File::delete($beforePath);

        // proses image
        $image = $request->file('profile_photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('profile_photo'), $imageName);
        $imagePath = 'profile_photo/' . $imageName;


        // proses update
        if ($user->id_role == 1 && $event->id_users == $user->id) {
            $event->update([
                'name' => $request->name,
                'description' => $request->description,
                'profile_photo' => $imagePath,
                'email' => $request->email,
                'id_users' => $user->id
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Update data success',
                'data' => $event
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Role tidak diizinkan,Update data failed',
            ], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $event = Event::findOrFail($id);
            $eventId = $event->id;
            $user = Auth::user();
            $proposal = Proposal::where('id_event', $eventId);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan, proses delete gagal',
            ], 400);
        }

        if ((($user->id_role == 1) && ($event->id_users == $user->id)) || $user->id_role == 3) {
            $imagePath = public_path($event->profile_photo);
            File::delete($imagePath);
            $proposal->delete();
            $event->delete();
            return response()->json([
                'success' => true,
                'message' => 'Event With id ' . $eventId . ' Succesfully Deleted'
            ], 200);
        }
    }
}
