<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\soal_ujian;
use App\Models\ujian;
use Illuminate\Support\Str;

class SoalUjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ujianRecords = ujian::all(); // Ambil semua data ujian

        // Counter untuk membatasi jumlah data yang diisi
        $counter = 0;
        $maxData = 2;

        foreach ($ujianRecords as $ujian) {
            if ($counter >= $maxData) {
                break; // Keluar dari loop jika sudah mencapai batas
            }

            soal_ujian::create([
                'id_soal_ujian' => Str::uuid(),
                'ujian_id' => $ujian->id_ujian, // Menggunakan ID ujian yang sudah ada
                'judul_ujian' => $ujian->judul, // Menambahkan judul ujian dari tabel ujian
                'teks_soal' => 'Apa ibu kota dari Indonesia?',
                'opsi_a' => 'A. Jakarta',
                'opsi_b' => 'B. Bandung',
                'opsi_c' => 'C. Surabaya',
                'opsi_d' => 'D. Medan',
                'kunci_jawaban' => 'A. Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Tambahkan soal ujian lain jika perlu
            soal_ujian::create([
                'id_soal_ujian' => Str::uuid(),
                'ujian_id' => $ujian->id_ujian,
                'judul_ujian' => $ujian->judul, // Menambahkan judul ujian dari tabel ujian
                'teks_soal' => 'Berapa hasil dari 2 + 2?',
                'opsi_a' => 'A. 3',
                'opsi_b' => 'B. 4',
                'opsi_c' => 'C. 5',
                'opsi_d' => 'D. 6',
                'kunci_jawaban' => 'B. 4',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $counter++; // Tambah counter setiap kali data dibuat
        }
    }
}
