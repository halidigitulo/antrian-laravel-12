<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display the list of doctors
        $dokter = Dokter::with('spesialisasi')->get();
        if (request()->ajax()) {
            return datatables()->of($dokter)
                ->addColumn('aksi', function ($dokter) {
                    // Generate Edit and Delete buttons with proper attributes
                    $button = '<button class="btn btn-warning btn-sm edit-dokter" data-id="' . $dokter->id . '" title="Edit"><i class="ri-pencil-line"></i></button>';
                    $button .= ' ';
                    $button .= '<button class="btn btn-danger btn-sm hapus-dokter" data-id="' . $dokter->id . '" title="Delete"><i class="ri-delete-bin-6-line"></i></button>';
                    
                    return $button;
                })

                ->editColumn('spesialisasi', function ($row) {
                    // Show the specialization name or a placeholder
                    return $row->spesialisasi ? $row->spesialisasi->nama : '<span class="text-muted">Tidak ada spesialisasi</span>';
                })
                
                ->rawColumns(['spesialisasi','is_praktik', 'aksi']) // Ensure the 'aksi' column is treated as raw HTML
                ->make(true);
        }
        $spesialisasi = \App\Models\Spesialisasi::all(); // Assuming you have a Spesialisasi model
        return view('dokter.index', compact('dokter','spesialisasi'));
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'spesialisasi_id' => 'required|exists:spesialisasi,id',
            'is_praktik' => 'required|boolean',
        ]);

        if ($id) {
            // Update existing record
            $dokter = Dokter::findOrFail($id);
            $dokter->update($validatedData);
            return response()->json(['message' => 'Dokter updated successfully!']);
        } else {
            // Create new record
            Dokter::create($validatedData);
            return response()->json(['message' => 'Dokter created successfully!']);
        }
    }

    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        return response()->json($dokter);
    }

    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();

        return response()->json([
            'message' => 'Dokter successfully deleted.',
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->is_praktik = $request->input('is_praktik', 0);
        $dokter->save();

        return response()->json([
            'message' => 'Status dokter updated successfully.',
            'is_praktik' => $dokter->is_praktik,
        ]);
    }
}
