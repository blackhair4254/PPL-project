<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ujian;
use App\Models\topik;
use App\Models\kelas_mata_pelajaran;
use Illuminate\Support\Str;

class UjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topikRecords = topik::all();
        $kelasMataPelajaranRecords = kelas_mata_pelajaran::all();
        
        // Counter untuk membatasi jumlah data yang diisi
        $counter = 0;
        $maxData = 2;

        foreach ($kelasMataPelajaranRecords as $kelasMataPelajaran) {
            foreach ($topikRecords as $topik) {
                if ($counter >= $maxData) {
                    break 2; // Keluar dari kedua loop jika sudah mencapai batas
                }

                ujian::create([
                    'id_ujian' => Str::uuid(),
                    'judul' => 'Ujian Matematika Kelas 7',
                    'deskripsi' => 'Ujian ini dibuat untuk kelas 7',
                    'topik_id' => $topik->id_topik,
                    'kelas_mata_pelajaran_id' => $kelasMataPelajaran->id_kelas_mata_pelajaran,
                    'tanggal_dibuat' => now()->format('Y-m-d'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $counter++; // Tambah counter setiap kali data dibuat
            }
        }
    }
}
