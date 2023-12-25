<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionControllerApi extends Controller
{
    public function index()
    {
        $transaction = Transaction::get();
        return response()->json($transaction);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = [
            'id_event' => $request->id_event,
            'id_proposal' => $request->id_proposal,
            'id_sponsorship' => $request->id_sponsorship,
            'sponsorship_funds' => $request->sponsorship_funds
        ];

        if ($user->id_role == 2 || $user->id_role == 3) {
            try {
                $transaction = Transaction::create($data);

                return response()->json([
                    'success' => true,
                    'data' => $transaction
                ], 201);
            } catch (QueryException $e) {
                return response()->json([
                    'success' => false,
                    'error' => $e
                ], 400);
            }
        } else {
            return response()->json([
                'succcess' => false,
                'message' => 'Role tidak diizinkan'
            ], 401);
        }
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $data = [
            'id_event' => $request->id_event,
            'id_proposal' => $request->id_proposal,
            'id_sponsorship' => $request->id_sponsorship,
            'sponsorship_funds' => $request->sponsorship_funds
        ];

        if ($user->id_role == 2 || $user->id_role == 3) {
            try {
                $transaction = Transaction::findOrFail($id);
                $transaction->update($data);

                return response()->json([
                    'success' => true,
                    'data' => $transaction
                ], 201);
            } catch (QueryException $e) {
                return response()->json([
                    'success' => false,
                    'error' => $e
                ], 400);
            }
        } else {
            return response()->json([
                'succcess' => false,
                'message' => 'Role tidak diizinkan'
            ], 401);
        }
    }

    public function destroy($id)
    {
        $user = Auth::user();

        if ($user->id_role == 2 || $user->id_role == 3) {
            try {
                $transaction = Transaction::findOrFail($id);
                $transaction->delete();

                return response()->json([
                    'success' => true,
                    'data' => $transaction
                ], 201);
            } catch (QueryException $e) {
                return response()->json([
                    'success' => false,
                    'error' => $e
                ], 400);
            }
        } else {
            return response()->json([
                'succcess' => false,
                'message' => 'Role tidak diizinkan'
            ], 401);
        }
    }
}
