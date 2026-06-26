<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Jenjang;
use App\Models\KategoriMateri;

/**
 * Controller untuk menampilkan materi pembelajaran di halaman siswa.
 */
class MateriController extends Controller
{
    /**
     * Menampilkan daftar materi dengan filter pencarian, jenjang, dan kategori.
     */
    public function index()
    {
        $query = Materi::query();

        // Filter pencarian berdasarkan judul atau deskripsi
        if ($q = request('q')) {
            $query->where(function ($qry) use ($q) {
                $qry->where('judul', 'like', "%{$q}%")
                    ->orWhere('deskripsi', 'like', "%{$q}%");
            });
        }

        // Filter berdasarkan jenjang
        if ($jenjang = request('jenjang')) {
            $query->where('id_jenjang', $jenjang);
        }

        // Filter berdasarkan kategori
        if ($kategori = request('kategori')) {
            $query->where('id_kategori_materi', $kategori);
        }

        $materiList = $query
            ->with(['guru', 'jenjang', 'kategori', 'quiz'])
            ->where('is_published', true)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $jenjangList = Jenjang::orderBy('nama_jenjang')->get();
        $kategoriList = KategoriMateri::orderBy('nama_kategori')->get();

        return view('student.materi.index', compact('materiList', 'jenjangList', 'kategoriList'));
    }

    /**
     * Menampilkan detail materi.
     */
    public function show(Materi $materi)
    {
        abort_if(!$materi->is_published, 404);

        $materi->load(['guru', 'jenjang', 'kategori', 'quiz']);

        return view('student.materi.show', compact('materi'));
    }
}
