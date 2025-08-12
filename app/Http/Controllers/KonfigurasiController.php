<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KonfigurasiController extends Controller
{
    public function index()
    {
        // Logic to display configuration settings
        $generalSettings = GeneralSetting::first();
        return view('konfigurasi.index', compact('generalSettings') + [
            'canUpdate' => Auth::user()->can('konfigurasi.update'),
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'running_text' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $generalSettings = GeneralSetting::firstOrNew();
        $generalSettings->fill($request->all());



        $generalSettings->save();

        return response()->json([
            'status' => 'success',
            'message' => $generalSettings->wasRecentlyCreated ? 'Profile berhasil disimpan' : 'Profile berhasil diupdate',
            'general_settings' => $generalSettings,
            // 'isi' => $profile->isi,
        ]);
    }
}
