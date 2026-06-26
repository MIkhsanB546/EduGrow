@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
{{-- Konten dashboard --}}
<div class="container-fluid">
    {{-- Kartu statistik --}}
    <div class="row g-3 mb-4">
        {{-- Blok kartu untuk role Guru --}}
        @if (isset($isGuru) && $isGuru)
        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Jumlah Materi</p>
                            <h3 class="mb-0 fw-bold">{{ $jumlahMateri }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-book fs-4 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Jumlah Quiz</p>
                            <h3 class="mb-0 fw-bold">{{ $jumlahQuiz }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-pencil-square fs-4 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Siswa Mengerjakan</p>
                            <h3 class="mb-0 fw-bold">{{ $jumlahSiswa }}</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-people fs-4 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Rata-rata Nilai</p>
                            <h3 class="mb-0 fw-bold">{{ $rataNilai }}</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-graph-up fs-4 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Blok kartu untuk role Admin --}}
        @else
        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Jumlah Guru</p>
                            <h3 class="mb-0 fw-bold">{{ $jumlahGuru ?? 0 }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-person-workspace fs-4 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Jumlah Siswa</p>
                            <h3 class="mb-0 fw-bold">{{ $jumlahSiswa }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-people fs-4 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Jumlah Materi</p>
                            <h3 class="mb-0 fw-bold">{{ $jumlahMateri }}</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-book fs-4 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Jumlah Quiz</p>
                            <h3 class="mb-0 fw-bold">{{ $jumlahQuiz }}</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-pencil-square fs-4 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- Tabel materi terbaru --}}
    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Materi Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="latestMateriTable" class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Judul</th>
                                    <th>Guru</th>
                                    <th>Jenjang</th>
                                    <th>Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($latestMateri as $materi)
                                <tr>
                                    <td>{{ $materi->judul }}</td>
                                    <td>{{ $materi->guru->name ?? '-' }}</td>
                                    <td>{{ $materi->jenjang->nama_jenjang ?? '-' }}</td>
                                    <td>{{ $materi->kategori->nama_kategori ?? '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3">Belum ada materi</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel quiz terbaru --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quiz Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="latestQuizTable" class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Judul</th>
                                    <th>Materi</th>
                                    <th>Durasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($latestQuiz as $quiz)
                                <tr>
                                    <td>{{ $quiz->judul }}</td>
                                    <td>{{ $quiz->materi->judul ?? '-' }}</td>
                                    <td>{{ $quiz->durasi_menit ? $quiz->durasi_menit . ' menit' : '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">Belum ada quiz</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Inisialisasi DataTable --}}
@push('scripts')
<script>
$(document).ready(function() {
    $('#latestMateriTable').DataTable({
        responsive: true,
        pageLength: 5,
        language: { url: '//cdn.datatables.net/plug-ins/1.13.11/i18n/id.json' }
    });
    $('#latestQuizTable').DataTable({
        responsive: true,
        pageLength: 5,
        language: { url: '//cdn.datatables.net/plug-ins/1.13.11/i18n/id.json' }
    });
});
</script>
@endpush
@endsection
