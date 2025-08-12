<?php

namespace App\Http\Controllers;

use App\Models\Spesialisasi;
use Illuminate\Http\Request;

class SpesialisasiController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $spesialisasi = Spesialisasi::select('id', 'nama')->get();
            return datatables()->of($spesialisasi)
                ->addColumn('aksi', function ($spesialisasi) {
                    if (!auth()->user()->can('spesialisasi.delete')) {
                        return '<span class="text-muted">No Access</span>';
                    }
                    $button = '<button class="btn btn-danger btn-sm hapus-spesialisasi" data-id="' . $spesialisasi->id . '" name="edit"><i class="ri-delete-bin-6-line"></i></button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('konfigurasi.index');
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('spesialisasi.update')) {
            abort(403, 'Anda tidak punya akses untuk mengedit spesialisasi');
        }
        $spesialisasi = Spesialisasi::findOrFail($id);
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        $spesialisasi->update(['nama' => $request->nama]);

        return response()->json(['message' => 'Spesialisasi berhasil diperbarui']);
    }


    public function destroy(Spesialisasi $spesialisasi)
    {
        $spesialisasi->delete();
        return response()->json(['message' => 'Spesialisasi deleted']);
    }


    public function store(Request $request)
    {
        if (!auth()->user()->can('spesialisasi.create')) {
            abort(403, 'Anda tidak punya akses untuk membuat spesialisasi');
        }

        $request->validate([
            'nama' => 'required|unique:spesialisasi,nama',
        ]);

        Spesialisasi::create(['nama' => $request->nama]);
        return response()->json(['message' => 'Spesialisasi created successfully']);
    }
}
