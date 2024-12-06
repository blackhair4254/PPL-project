<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\pengumpulan_ujian;
use App\Models\ujian;
use App\Models\Siswa;
use Illuminate\Support\Str;

class PengumpulanUjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data ujian dan siswa yang ada
        $ujianRecords = ujian::all();
        $siswaRecords = Siswa::all();

        // Pastikan ada cukup data ujian dan siswa untuk membuat 2 entri
        if ($ujianRecords->isEmpty() || $siswaRecords->isEmpty()) {
            return; // Hentikan seeder jika data ujian atau siswa tidak tersedia
        }

        // Membuat 2 data pengumpulan ujian
        pengumpulan_ujian::create([
            'id_pengumpulan_ujian' => Str::uuid(),
            'ujian_id' => $ujianRecords->first()->id_ujian, // Mengambil ID ujian pertama
            'siswa_id' => $siswaRecords->first()->id_siswa, // Mengambil ID siswa pertama
            'tanggal_pengumpulan' => now()->format('Y-m-d'), // Menentukan tanggal pengumpulan
            'nilai' => rand(60, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        pengumpulan_ujian::create([
            'id_pengumpulan_ujian' => Str::uuid(),
            'ujian_id' => $ujianRecords->skip(1)->first()->id_ujian, // Mengambil ID ujian kedua
            'siswa_id' => $siswaRecords->skip(1)->first()->id_siswa, // Mengambil ID siswa kedua
            'tanggal_pengumpulan' => now()->format('Y-m-d'), // Menentukan tanggal pengumpulan
            'nilai' => rand(60, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
