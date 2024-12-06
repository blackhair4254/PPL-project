<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\jawaban_ujian;
use App\Models\pengumpulan_ujian;
use App\Models\soal_ujian;
use Illuminate\Support\Str;

class JawabanUjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengumpulanUjianRecords = pengumpulan_ujian::all(); // Ambil semua data pengumpulan ujian
        $soalUjianRecords = soal_ujian::all(); // Ambil semua data soal ujian

        // Counter untuk membatasi jumlah data yang diisi
        $counter = 0;
        $maxData = 2;

        foreach ($pengumpulanUjianRecords as $pengumpulanUjian) {
            foreach ($soalUjianRecords as $soalUjian) {
                if ($counter >= $maxData) {
                    break 2; // Keluar dari kedua loop jika sudah mencapai batas
                }

                jawaban_ujian::create([
                    'pengumpulan_ujian_id' => $pengumpulanUjian->id_pengumpulan_ujian, // Menggunakan ID pengumpulan ujian yang sudah ada
                    'soal_id' => $soalUjian->id_soal_ujian, // Menggunakan ID soal ujian yang sudah ada
                    'jawaban_dipilih' => 'A. Jakarta', // Ganti dengan jawaban yang sesuai
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Tambahkan jawaban ujian lain jika perlu
                jawaban_ujian::create([
                    'pengumpulan_ujian_id' => $pengumpulanUjian->id_pengumpulan_ujian,
                    'soal_id' => $soalUjian->id_soal_ujian,
                    'jawaban_dipilih' => 'B. 4', // Ganti dengan jawaban yang sesuai
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $counter++; // Tambah counter setiap kali data dibuat
            }
        }
    }
}
