<?php

namespace App\Http\Controllers;

/**
 * Controller untuk menampilkan style guide UI aplikasi.
 */
class StyleGuideController extends Controller
{
    /**
     * Redirect ke style guide siswa.
     */
    public function index()
    {
        return redirect()->route('styleguide.student');
    }

    /**
     * Menampilkan style guide halaman siswa.
     */
    public function student()
    {
        return view('styleguide.student');
    }

    /**
     * Menampilkan style guide halaman admin.
     */
    public function admin()
    {
        return view('styleguide.admin');
    }
}
