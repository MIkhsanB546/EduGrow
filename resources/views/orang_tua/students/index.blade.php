@extends('layouts.orang_tua')

@section('title', 'Anak Saya')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-extrabold text-gray-900">Anak Saya</h1>
        <p class="text-gray-500 mt-1 text-lg">Kelola hubungan dengan anak-anak Anda</p>
    </div>
    <a href="{{ route('orang-tua.students.create') }}"
        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white rounded-xl transition-colors duration-150 hover:brightness-110"
        style="background-color: #095890;">
        <i class="bi bi-plus-lg"></i> Hubungkan Anak
    </a>
</div>

{{-- Connected Children --}}
@if ($connected->isNotEmpty())
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Terhubung</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($connected as $student)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0"
                            style="background-color: #E8F0F6;">
                            @if ($student->avatar)
                                <img src="{{ $student->avatar }}" class="w-12 h-12 rounded-full object-cover" alt="">
                            @else
                                <i class="bi bi-person-circle text-2xl" style="color: #095890;"></i>
                            @endif
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $student->name }}</p>
                            <p class="text-xs text-gray-500">{{ $student->email }}</p>
                        </div>
                    </div>
                    <form action="{{ route('orang-tua.students.destroy', $student) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin melepas hubungan dengan {{ $student->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="p-2 rounded-lg text-red-500 hover:bg-red-50 transition-colors"
                            title="Lepaskan hubungan">
                            <i class="bi bi-unlink"></i>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100 mb-8">
        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="bi bi-people text-3xl text-gray-400"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-1">Belum ada anak terhubung</h3>
        <p class="text-gray-500 text-sm mb-4">Hubungkan dengan akun siswa untuk memantau perkembangannya.</p>
        <a href="{{ route('orang-tua.students.create') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white rounded-xl transition-colors duration-150 hover:brightness-110"
            style="background-color: #095890;">
            <i class="bi bi-plus-lg"></i> Hubungkan Anak
        </a>
    </div>
@endif

{{-- Pending Requests --}}
@if ($pendingRequests->isNotEmpty())
    <div>
        <h2 class="text-xl font-bold text-gray-900 mb-4">Permintaan Menunggu</h2>
        <div class="space-y-3">
            @foreach ($pendingRequests as $req)
                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0 bg-white">
                            <i class="bi bi-person-circle text-2xl" style="color: #095890;"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $req->siswa->name }}</p>
                            <p class="text-xs text-gray-500">{{ $req->siswa->email }}</p>
                            <span
                                class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                                <i class="bi bi-hourglass-split"></i> Menunggu persetujuan siswa
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
@endsection
