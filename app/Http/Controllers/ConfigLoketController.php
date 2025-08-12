<?php

namespace App\Http\Controllers;

use App\Models\Loket;
use Illuminate\Http\Request;

class ConfigLoketController extends Controller
{
    public function index()
    {
        // Logic to display loket settings
        $loket = Loket::with('userAktif')->select('loket.*');
        if (request()->ajax()) {
            return datatables()->of($loket)
                // ->addColumn('action', function ($row) {
                //     return '<a href="' . route('loketantrian.detail', $row->id) . '" class="btn btn-primary btn-sm">Pilih</a>';
                // })
                ->addColumn('aksi', function ($loket) {
                    // Generate Edit and Delete buttons with proper attributes
                    $button = '<button class="btn btn-warning btn-sm edit-loket" data-id="' . $loket->id . '" title="Edit"><i class="ri-pencil-line"></i></button>';
                    $button .= ' ';
                    $button .= '<button class="btn btn-danger btn-sm hapus-loket" data-id="' . $loket->id . '" title="Delete"><i class="ri-delete-bin-6-line"></i></button>';
                    $button .= ' ';
                    $button .= '<button class="btn btn-secondary btn-sm reset-loket" data-id="' . $loket->id . '" title="Reset"><i class="ri-refresh-line"></i></button>';
                    return $button;
                })

                ->editColumn('user_aktif', function ($row) {
                    // Show user name or placeholder
                    return $row->userAktif ? $row->userAktif->name : '<span class="text-muted">Belum dipilih</span>';
                })
                ->rawColumns(['user_aktif', 'aksi']) // Ensure the 'aksi' column is treated as raw HTML
                ->make(true);
        }
        return view('konfigurasi.index', compact('loket'));
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'is_aktif' => 'required|boolean',
        ]);

        if ($id) {
            // Update existing record
            $loket = Loket::findOrFail($id);
            $loket->update($validatedData);
            return response()->json(['message' => 'Loket updated successfully!']);
        } else {
            // Create new record
            Loket::create($validatedData);
            return response()->json(['message' => 'Loket created successfully!']);
        }
    }

    public function edit($id)
    {
        $loket = Loket::findOrFail($id);
        return response()->json($loket);
    }

    public function destroy($id)
    {
        $loket = Loket::findOrFail($id);
        $loket->delete();

        return response()->json([
            'message' => 'Loket successfully deleted.',
        ]);
    }

    public function resetAllLoket()
    {
        // Update all records in the loket table to set user_aktif to NULL
        Loket::query()->update(['user_aktif' => null]);

        return response()->json(['success' => true, 'message' => 'Semua loket telah direset.']);
    }
}
