@extends('layouts.orang_tua')

@section('title', 'Hubungkan Anak')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900">Hubungkan Anak</h1>
    <p class="text-gray-500 mt-1 text-lg">Masukkan email siswa yang ingin Anda hubungkan.</p>
</div>

<div class="max-w-lg">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-800 rounded-xl p-4 mb-6">
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('orang-tua.students.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="email" class="block text-sm font-semibold mb-1.5" style="color: #1E293B;">
                    <i class="bi bi-envelope me-1" style="color: #095890;"></i> Email Siswa
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    placeholder="contoh@email.com"
                    class="w-full px-4 py-2.5 rounded-xl border text-sm transition duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('email') border-red-400 @enderror"
                    style="border-color: #DDE7EF;" required>
                @error('email')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
                <div class="flex gap-3">
                    <i class="bi bi-info-circle text-blue-500 mt-0.5"></i>
                    <div class="text-sm text-blue-800">
                        <p class="font-semibold mb-1">Bagaimana cara kerjanya?</p>
                        <ol class="list-decimal list-inside space-y-1 text-blue-700">
                            <li>Masukkan email siswa yang ingin dihubungkan.</li>
                            <li>Kami akan mengirimkan permintaan ke akun siswa tersebut.</li>
                            <li>Siswa perlu menyetujui permintaan dari halaman dashboard-nya.</li>
                            <li>Setelah disetujui, Anda dapat memantau perkembangannya.</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white rounded-xl transition-colors duration-150 hover:brightness-110"
                    style="background-color: #095890;">
                    <i class="bi bi-send"></i> Kirim Permintaan
                </button>
                <a href="{{ route('orang-tua.students') }}"
                    class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-colors duration-150"
                    style="background-color: #F1F5F9; color: #64748B; border: 1px solid #DDE7EF;">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
