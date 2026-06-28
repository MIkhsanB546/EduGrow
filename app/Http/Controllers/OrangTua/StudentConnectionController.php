<?php

namespace App\Http\Controllers\OrangTua;

use App\Http\Controllers\Controller;
use App\Models\ParentStudentRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentConnectionController extends Controller
{
    public function index()
    {
        $orangTua = Auth::user();

        $connected = $orangTua->anak()->get();

        $pendingRequests = ParentStudentRequest::where('id_orang_tua', $orangTua->id_user)
            ->where('status', 'pending')
            ->with('siswa')
            ->get();

        return view('orang_tua.students.index', compact('connected', 'pendingRequests'));
    }

    public function create()
    {
        return view('orang_tua.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $orangTua = Auth::user();
        $siswa = User::where('email', $request->email)->first();

        if ($siswa->role !== 'siswa') {
            return back()->withErrors(['email' => 'Akun dengan email tersebut bukan akun siswa.'])
                ->withInput();
        }

        if ($siswa->id_user === $orangTua->id_user) {
            return back()->withErrors(['email' => 'Tidak dapat menghubungkan dengan akun sendiri.'])
                ->withInput();
        }

        $alreadyConnected = DB::table('orang_tua_siswa')
            ->where('id_orang_tua', $orangTua->id_user)
            ->where('id_siswa', $siswa->id_user)
            ->exists();

        if ($alreadyConnected) {
            return back()->withErrors(['email' => 'Siswa ini sudah terhubung dengan akun Anda.'])
                ->withInput();
        }

        $existingRequest = ParentStudentRequest::where('id_orang_tua', $orangTua->id_user)
            ->where('id_siswa', $siswa->id_user)
            ->first();

        if ($existingRequest) {
            if ($existingRequest->status === 'pending') {
                return back()->withErrors(['email' => 'Permintaan sudah dikirim dan menunggu persetujuan siswa.'])
                    ->withInput();
            }
            if ($existingRequest->status === 'rejected') {
                return back()->withErrors(['email' => 'Permintaan sebelumnya ditolak oleh siswa. Silakan hubungi siswa secara langsung.'])
                    ->withInput();
            }
        }

        ParentStudentRequest::create([
            'id_orang_tua' => $orangTua->id_user,
            'id_siswa' => $siswa->id_user,
            'status' => 'pending',
        ]);

        return redirect()->route('orang-tua.students')
            ->with('success', 'Permintaan terhubung berhasil dikirim ke ' . $siswa->name . '.');
    }

    public function destroy(User $student)
    {
        $orangTua = Auth::user();

        if ($student->role !== 'siswa') {
            abort(404);
        }

        $detached = DB::table('orang_tua_siswa')
            ->where('id_orang_tua', $orangTua->id_user)
            ->where('id_siswa', $student->id_user)
            ->delete();

        if (!$detached) {
            return back()->with('error', 'Siswa tidak ditemukan dalam daftar anak Anda.');
        }

        ParentStudentRequest::where('id_orang_tua', $orangTua->id_user)
            ->where('id_siswa', $student->id_user)
            ->delete();

        return redirect()->route('orang-tua.students')
            ->with('success', 'Hubungan dengan ' . $student->name . ' berhasil dihapus.');
    }
}
