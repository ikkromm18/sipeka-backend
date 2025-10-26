<?php

namespace App\Http\Controllers;

use App\Models\Utility;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    public function index()
    {
        $utility = Utility::first();

        return response()->json([
            'success' => true,
            'message' => 'Data pengaturan berhasil diambil.',
            'data' => $utility
        ]);
    }
}
