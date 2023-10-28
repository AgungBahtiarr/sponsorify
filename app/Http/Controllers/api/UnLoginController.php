<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

class UnLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => 'Silahkan login terlebih dahulu'
        ]);
    }
}
