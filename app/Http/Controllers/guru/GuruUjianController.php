<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\jawaban_ujian;
use App\Models\soal_ujian;
use App\Models\ujian;
use App\Models\pengumpulan_ujian;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SoalUjianImport;

class GuruUjianController extends Controller
{
    //CRUD JAWABAN UJIAN
    public function showJawabanUjian()
    {
        $jawabanUjian = jawaban_ujian::all();
        $soalUjian = soal_ujian::all();
        return view("guru.ujian.jawaban_ujian", compact("jawabanUjian","soalUjian"));
    }

    // public function editJawabanUjian($id)
    // {
    //     $jawaban = jawaban_ujian::findOrFail($id);
    //     return view('guru.ujian.jawaban_ujian_edit', compact('jawaban'));
    // }

    public function editJawabanUjian($id)
    {
        $jawaban = jawaban_ujian::findOrFail($id);

        $soalUjian = soal_ujian::select('id_soal_ujian as soal_id', 'teks_soal')->get();

        return view('guru.ujian.jawaban_ujian_edit', compact('jawaban', 'soalUjian'));
    }

    public function destroyJawabanUjian($id)
    {
        $jawaban = jawaban_ujian::findOrFail($id);
        $jawaban->delete();
        return redirect()->route('guru.dashboard.ujian.jawaban_ujian')->with('success', 'Jawaban ujian berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $jawaban = jawaban_ujian::findOrFail($id);
        $soalUjian = soal_ujian::findOrFail($id);

        $jawaban->update($request->all());
        $soalUjian->update($request->all());

        return redirect()->route('guru.dashboard.ujian.jawaban_ujian')->with('success', 'Jawaban ujian berhasil diperbarui.');
    }

    //CRUD SOAL
    public function showSoalUjian()
    {
        $soalUjian = soal_ujian::all();
        return view("guru.ujian.soal_ujian", compact("soalUjian"));
    }

    public function importSoal(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new SoalUjianImport, $request->file('file'));

        return redirect()->route('guru.ujian.soal_ujian')->with('success', 'Soal ujian berhasil diimpor!');
    }

    public function soalEdit($id)
    {
        $soal = soal_ujian::findOrFail($id); // Find soal by primary key

        return view('guru.ujian.soal_edit', compact('soal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function soalUpdate(Request $request, $id)
    {
        $request->validate([
            'judul_ujian' => 'required|string|max:255',
            'teks_soal' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'kunci_jawaban' => 'required|string|in:a,b,c,d',
        ]);

        $soal = soal_ujian::findOrFail($id);
        $soal->update($request->all());

        return redirect()->route('guru.dashboard.ujian.soal_ujian')->with('success', 'Soal Ujian berhasil diperbarui.');
    }


    public function destroySoal($id)
    {
        $soal = soal_ujian::findOrFail($id);
        $soal->delete();

        return redirect()->route('guru.dashboard.ujian.soal_ujian')
                         ->with('success', 'Soal ujian berhasil dihapus.');
    }
    public function pengumpulan()
    {
        return view("guru.ujian.pengumpulan");
    }
    //CRUD PENGUMPULAN UJIAN
    public function showPengumpulan(){
        $pengumpulan = pengumpulan_ujian::all();
        $ujian = ujian::all();

        return view("guru.dashboard.ujian.pengumpulan", compact("pengumpulan","ujian"));

        // return view("guru.dashboard.ujian.pengumpulan");
    }
}
