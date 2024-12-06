<?php

namespace App\Http\Controllers\siswa;
use App\Models\Ujian;
use App\Models\soal_ujian;
use App\Models\jawaban_ujian;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UjianSiswaController extends Controller
{
    /**
     * Halaman Daftar Ujian
     */
    public function index()
    {
        $ujians = Ujian::all();
        return view('siswa.ujian.index', compact('ujians'));
    }

    /**
     * Halaman Mulai Ujian
     */
    public function start($id)
    {
        $ujian = Ujian::with('soalUjian')->findOrFail($id);

        // Set waktu durasi ujian (contoh: 30 menit)
        $durasi = 30; // dalam menit
        $endTime = now()->addMinutes($durasi);

        // Simpan waktu selesai ujian di session
        Session::put('ujian_end_time', $endTime);

        return view('siswa.ujian.start', compact('ujian', 'endTime'));
    }

    /**
     * Submit Ujian
     */
    public function submit(Request $request, $id)
    {
        $ujian = Ujian::findOrFail($id);
        $soalIds = $ujian->soal_ujian->pluck('id_soal_ujian');

        foreach ($soalIds as $soalId) {
            jawaban_ujian::create([
                'pengumpulan_ujian_id' => auth()->id(), // Contoh ID siswa (ubah sesuai logika Anda)
                'soal_id' => $soalId,
                'jawaban_dipilih' => $request->input("jawaban_$soalId"),
            ]);
        }

        // Hapus session waktu ujian
        Session::forget('ujian_end_time');

        return redirect()->route('siswa.ujian.index')->with('success', 'Ujian telah selesai!');
    }

}
