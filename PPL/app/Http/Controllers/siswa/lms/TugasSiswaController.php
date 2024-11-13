<?php

namespace App\Http\Controllers\siswa\lms;

use App\Models\KelasSiswa;
use App\Http\Controllers\Controller;
use App\Models\kelas_mata_pelajaran;

class TugasSiswaController extends Controller
{
    public function index()
    {
        $id_siswa = auth()->guard('web-siswa')->user()->id_siswa;
        $kelas = KelasSiswa::with('kelas')->where('id_siswa', $id_siswa)->firstOrFail()->kelas;

        // Mata pelajaran dengan tugas untuk bagian kiri (Tugas Mendatang)
        $mataPelajaranList = kelas_mata_pelajaran::where('kelas_id', $kelas->id_kelas)
            ->with(['mataPelajaran', 'tugas' => function ($query) {
                $query->orderBy('deadline', 'asc');
            }])
            ->get();

        // Semua tugas untuk bagian kanan (Tugas Terbaru)
        $allTasks = collect([]);
        foreach ($mataPelajaranList as $mapel) {
            $allTasks = $allTasks->concat($mapel->tugas);
        }

        $allTasks = $allTasks->sortBy('created_at')->groupBy(function ($task) {
            return \Carbon\Carbon::parse($task->created_at)->format('Y-m-d');
        });

        return view('siswa.lms.tugas', [
            'mataPelajaranList' => $mataPelajaranList,
            'allTasks' => $allTasks
        ]);
    }




    public function forumTugas($id)
    {
        $kelasMataPelajaran = kelas_mata_pelajaran::with([
            'mataPelajaran:id_matpel,nama_matpel',
            'topik.tugas',
        ])->findOrFail($id);
        return view('siswa.lms.forum_tugas', [
            'id' => $kelasMataPelajaran->id_kelas_mata_pelajaran,
            'mataPelajaran' => $kelasMataPelajaran->mataPelajaran,
            'listTopik' => $kelasMataPelajaran->topik
        ]);
    }

    public function detail($id)
    {
        return view('siswa.lms.detail_tugas');
    }
}
