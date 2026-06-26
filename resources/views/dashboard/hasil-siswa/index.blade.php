@extends('layouts.app')

@section('title', 'Hasil Siswa')

@section('content')
{{-- Awal konten halaman --}}
<div class="container-fluid">
    {{-- Kartu hasil siswa --}}
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Hasil Siswa</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                        {{-- Tabel hasil pengerjaan quiz --}}
                        <table id="hasilSiswaTable" class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Siswa</th>
                            <th>Quiz</th>
                            <th>Materi</th>
                            <th>Skor</th>
                            <th>Bintang</th>
                            <th>Attempt</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Looping data attempt --}}
                        @forelse ($attempts as $attempt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $attempt->siswa->name ?? '-' }}</td>
                            <td>{{ $attempt->quiz->judul ?? '-' }}</td>
                            <td>{{ $attempt->quiz->materi->judul ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $attempt->skor_persen >= 80 ? 'success' : ($attempt->skor_persen >= 60 ? 'warning' : 'danger') }} rounded-pill">
                                    {{ $attempt->skor_persen }}%
                                </span>
                            </td>
                            <td>
                                {{-- Render bintang berdasarkan skor --}}
                                @for ($i = 1; $i <= 3; $i++)
                                    <i class="bi bi-star{{ $i <= $attempt->bintang ? '-fill' : '' }} text-warning small"></i>
                                @endfor
                            </td>
                            <td>{{ $attempt->attempt_ke }}</td>
                            <td class="text-muted small">
                                {{ \Carbon\Carbon::parse($attempt->tanggal_pengerjaan)->translatedFormat('d M Y') }}
                            </td>
                        </tr>
                        {{-- Kondisi jika belum ada data --}}
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-3">Belum ada hasil quiz</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- Inisialisasi DataTables --}}
@push('scripts')
<script>
$(document).ready(function() {
    $('#hasilSiswaTable').DataTable({
        responsive: true,
        pageLength: 10,
        language: { url: '//cdn.datatables.net/plug-ins/1.13.11/i18n/id.json' }
    });
});
</script>
@endpush
@endsection
