<?php

namespace App\Http\Controllers;

use App\Models\JenisAntrian;
use Illuminate\Http\Request;

class ConfigAntrianController extends Controller
{
    public function index()
    {
        $antrian = JenisAntrian::all();

        if (request()->ajax()) {
            return datatables()->of($antrian)
                ->addColumn('aksi', function ($antrian) {
                    // Generate Edit and Delete buttons with proper attributes
                    $button = '<button class="btn btn-warning btn-sm edit-antrian" data-id="' . $antrian->id . '" title="Edit"><i class="ri-pencil-line"></i></button>';
                    $button .= ' ';
                    $button .= '<button class="btn btn-danger btn-sm hapus-antrian" data-id="' . $antrian->id . '" title="Delete"><i class="ri-delete-bin-6-line"></i></button>';
                    return $button;
                })
                ->rawColumns(['aksi']) // Ensure the 'aksi' column is treated as raw HTML
                ->make(true);
        }
        return view('konfigurasi.index', compact('antrian'));
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'kode_antrian' => 'required|string',
            'nama' => 'required|string|max:255',
            'is_aktif' => 'required|boolean',
        ]);

        if ($id) {
            // Update existing record
            $antrian = JenisAntrian::findOrFail($id);
            $antrian->update($validatedData);
            return response()->json(['message' => 'Jenis antrian updated successfully!']);
        } else {
            // Create new record
            JenisAntrian::create($validatedData);
            return response()->json(['message' => 'Jenis antrian created successfully!']);
        }
    }

    public function edit($id)
    {
        $antrian = JenisAntrian::findOrFail($id);
        return response()->json($antrian);
    }

    public function destroy($id)
    {
        $antrian = JenisAntrian::findOrFail($id);
        $antrian->delete();

        return response()->json([
            'message' => 'Antrian successfully deleted.',
        ]);
    }
}
