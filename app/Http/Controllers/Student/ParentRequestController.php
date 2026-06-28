<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ParentStudentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParentRequestController extends Controller
{
    public function index()
    {
        $siswa = Auth::user();

        $requests = ParentStudentRequest::where('id_siswa', $siswa->id_user)
            ->with('orangTua')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.parent-requests.index', compact('requests'));
    }

    public function accept(ParentStudentRequest $request)
    {
        $siswa = Auth::user();

        if ($request->id_siswa !== $siswa->id_user) {
            abort(403);
        }

        if ($request->status !== 'pending') {
            return back()->with('error', 'Permintaan ini sudah diproses.');
        }

        DB::transaction(function () use ($request) {
            $request->update(['status' => 'accepted']);

            DB::table('orang_tua_siswa')->updateOrInsert([
                'id_orang_tua' => $request->id_orang_tua,
                'id_siswa' => $request->id_siswa,
            ], [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        return back()->with('success', 'Permintaan dari ' . $request->orangTua->name . ' telah diterima.');
    }

    public function reject(ParentStudentRequest $request)
    {
        $siswa = Auth::user();

        if ($request->id_siswa !== $siswa->id_user) {
            abort(403);
        }

        if ($request->status !== 'pending') {
            return back()->with('error', 'Permintaan ini sudah diproses.');
        }

        $request->update(['status' => 'rejected']);

        return back()->with('success', 'Permintaan dari ' . $request->orangTua->name . ' telah ditolak.');
    }
}
