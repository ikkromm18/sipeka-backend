<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFieldSuratRequest;
use App\Http\Requests\UpdateFieldSuratRequest;
use App\Models\FieldSurat;

class FieldSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FieldSurat $fieldSurat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FieldSurat $fieldSurat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FieldSurat $fieldSurat)
    {
        //
    }

    public function getFieldSurat($jenisSuratId)
    {
        $fields = FieldSurat::where('jenis_surat_id', $jenisSuratId)->get();

        if ($fields->isEmpty()) {
            return response()->json([
                'message' => 'Field Surat tidak ditemukan'
            ], 404);
        }

        return response()->json($fields, 200);
    }
}
