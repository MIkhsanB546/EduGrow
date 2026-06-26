<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJenjangRequest;
use App\Http\Requests\UpdateJenjangRequest;
use App\Models\Jenjang;

/**
 * Controller untuk mengelola data jenjang.
 */
class JenjangController extends Controller
{
    /**
     * Menampilkan daftar jenjang.
     */
    public function index()
    {
        $jenjangList = Jenjang::withCount('materi')->latest()->get();
        return view('dashboard.jenjang.index', compact('jenjangList'));
    }

    /**
     * Menampilkan form tambah jenjang.
     */
    public function create()
    {
        return view('dashboard.jenjang.create');
    }

    /**
     * Menyimpan jenjang baru.
     */
    public function store(StoreJenjangRequest $request)
    {
        Jenjang::create($request->validated());

        return redirect()->route('dashboard.jenjang.index')
            ->with('success', 'Jenjang berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit jenjang.
     */
    public function edit(Jenjang $jenjang)
    {
        return view('dashboard.jenjang.edit', compact('jenjang'));
    }

    /**
     * Memperbarui data jenjang.
     */
    public function update(UpdateJenjangRequest $request, Jenjang $jenjang)
    {
        $jenjang->update($request->validated());

        return redirect()->route('dashboard.jenjang.index')
            ->with('success', 'Jenjang berhasil diperbarui.');
    }

    /**
     * Menghapus jenjang.
     */
    public function destroy(Jenjang $jenjang)
    {
        if ($jenjang->materi()->count() > 0) {
            return back()->with('error', 'Jenjang tidak dapat dihapus karena masih memiliki materi.');
        }

        $jenjang->delete();

        return redirect()->route('dashboard.jenjang.index')
            ->with('success', 'Jenjang berhasil dihapus.');
    }
}
