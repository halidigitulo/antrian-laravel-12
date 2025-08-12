<?php

namespace Database\Seeders;

use App\Models\Spesialisasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpesialisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Spesialisasi::insertOrIgnore(
            [
                [
                    'nama' => 'Spesialis Anak',
                ],
                [
                    'nama' => 'Spesialis Bedah Umum',
                ],
                [
                    'nama' => 'Spesialis Gigi',
                ],
                [
                    'nama' => 'Spesialis Jantung dan Pembuluh Darah',
                ],
                [
                    'nama' => 'Spesialis Kulit dan Kelamin',
                ],
                [
                    'nama' => 'Spesialis Mata',
                ],
                [
                    'nama' => 'Spesialis THT',
                ],
                [
                    'nama' => 'Spesialis Penyakit Dalam',
                ],
                [
                    'nama' => 'Spesialis Psikiatri',
                ],
                [
                    'nama' => 'Spesialis Rehabilitasi Medik',
                ],
                [
                    'nama' => 'Spesialis Urologi',
                ],
                [
                    'nama' => 'Spesialis Orthopedi',
                ],
                [
                    'nama' => 'Spesialis Radiologi',
                ],
                [
                    'nama' => 'Spesialis Anestesiologi',
                ],
                [
                    'nama' => 'Spesialis Geriatri',
                ],
                [
                    'nama' => 'Spesialis Onkologi',
                ],
            ],
        );

    }
}
