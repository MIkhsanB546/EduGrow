@extends('layouts.student')

@section('title', 'Permintaan Orang Tua')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900">Permintaan Orang Tua</h1>
    <p class="text-gray-500 mt-1 text-lg">Kelola permintaan hubungan dari orang tua.</p>
</div>

@if ($requests->isEmpty())
    <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="bi bi-people text-3xl text-gray-400"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-1">Tidak ada permintaan</h3>
        <p class="text-gray-500 text-sm">Belum ada permintaan hubungan dari orang tua.</p>
    </div>
@else
    <div class="space-y-4">
        @foreach ($requests as $req)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5
                @if ($req->status === 'pending') border-l-4 border-l-amber-400 @endif">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4 min-w-0">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0"
                            style="background-color: #E8F0F6;">
                            <i class="bi bi-person-circle text-2xl" style="color: #095890;"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="font-semibold text-gray-900 truncate">{{ $req->orangTua->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ $req->orangTua->email }}</p>
                            @if ($req->status === 'pending')
                                <span
                                    class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                                    <i class="bi bi-hourglass-split"></i> Menunggu persetujuan Anda
                                </span>
                            @elseif ($req->status === 'accepted')
                                <span
                                    class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                    <i class="bi bi-check-circle"></i> Diterima
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                    <i class="bi bi-x-circle"></i> Ditolak
                                </span>
                            @endif
                        </div>
                    </div>

                    @if ($req->status === 'pending')
                        <div class="flex items-center gap-2 shrink-0">
                            <form action="{{ route('siswa.parent-requests.accept', $req) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center gap-1 px-4 py-2 text-sm font-semibold text-white rounded-xl transition-colors duration-150 hover:brightness-110"
                                    style="background-color: #059669;">
                                    <i class="bi bi-check-lg"></i> Terima
                                </button>
                            </form>
                            <form action="{{ route('siswa.parent-requests.reject', $req) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center gap-1 px-4 py-2 text-sm font-semibold rounded-xl transition-colors duration-150"
                                    style="background-color: #F1F5F9; color: #DC2626; border: 1px solid #DDE7EF;">
                                    <i class="bi bi-x-lg"></i> Tolak
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
