@extends('layouts.app')

@section('title', 'Laporan')

@push('styles')
    {{-- Style tambahan --}}
    <style>
        .small-box {
            border-radius: .25rem;
        }

        .info-box-icon {
            border-radius: .25rem 0 0 .25rem;
        }
    </style>
@endpush

@section('content')
    {{-- Awal konten halaman --}}
    <div class="container-fluid">
        {{-- Kartu statistik --}}
        <div class="row g-3 mb-4">
            <div class="col-lg-2 col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="fw-bold text-primary mb-0">{{ $totalGuru }}</h3>
                        <small class="text-muted">Guru</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="fw-bold text-success mb-0">{{ $totalSiswa }}</h3>
                        <small class="text-muted">Siswa</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="fw-bold text-info mb-0">{{ $totalMateri }}</h3>
                        <small class="text-muted">Materi</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="fw-bold text-warning mb-0">{{ $totalQuiz }}</h3>
                        <small class="text-muted">Quiz</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="fw-bold text-danger mb-0">{{ $totalAttempts }}</h3>
                        <small class="text-muted">Pengerjaan</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="fw-bold text-secondary mb-0">{{ $rataNilai }}</h3>
                        <small class="text-muted">Rata Nilai</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol export PDF --}}
        <div class="row g-3 mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="btn-group">
                            <a href="{{ route('dashboard.laporan.export-pengguna') }}" class="btn btn-primary">
                                <i class="bi bi-file-earmark-pdf"></i> Export PDF Pengguna
                            </a>
                            <a href="{{ route('dashboard.laporan.export-materi') }}" class="btn btn-success">
                                <i class="bi bi-file-earmark-pdf"></i> Export PDF Materi
                            </a>
                            <a href="{{ route('dashboard.laporan.export-progress') }}" class="btn btn-info text-white">
                                <i class="bi bi-file-earmark-pdf"></i> Export PDF Progress Siswa
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel aktivitas quiz terbaru --}}
        <div class="row g-3 mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aktivitas Quiz Terbaru</h3>
                    </div>
                    <div class="card-body">
                        <table id="aktivitasQuizTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Quiz</th>
                                    <th>Materi</th>
                                    <th>Skor</th>
                                    <th>Bintang</th>
                                    <th>Tanggal Pengerjaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentAttempts as $attempt)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $attempt->siswa->name ?? '-' }}</td>
                                        <td>{{ $attempt->quiz->judul ?? '-' }}</td>
                                        <td>{{ $attempt->quiz->materi->judul ?? '-' }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $attempt->skor_persen >= 80 ? 'success' : ($attempt->skor_persen >= 60 ? 'warning' : 'danger') }} rounded-pill">
                                                {{ $attempt->skor_persen }}%
                                            </span>
                                        </td>
                                        <td>
                                            @for ($i = 1; $i <= 3; $i++)
                                                <i
                                                    class="bi bi-star{{ $i <= $attempt->bintang ? '-fill' : '' }} text-warning small"></i>
                                            @endfor
                                        </td>
                                        <td class="text-muted small">
                                            {{ \Carbon\Carbon::parse($attempt->tanggal_pengerjaan)->translatedFormat('d M Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-3">Belum ada aktivitas quiz
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel progress seluruh siswa --}}
        <div class="row g-3 mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Progress Seluruh Siswa</h3>
                    </div>
                    <div class="card-body">
                        <table id="progressSiswaTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Jumlah Quiz Dikerjakan</th>
                                    <th>Nilai Rata-rata</th>
                                    <th>Nilai Tertinggi</th>
                                    <th>Nilai Terendah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($siswaProgress as $siswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->name }}</td>
                                        <td>{{ $siswa->quiz_dikerjakan ?? 0 }}</td>
                                        <td>{{ $siswa->rata_rata_nilai ?? 0 }}</td>
                                        <td>{{ $siswa->nilai_tertinggi ?? 0 }}</td>
                                        <td>{{ $siswa->nilai_terendah ?? 0 }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-3">Belum ada data siswa
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel materi paling banyak dikerjakan --}}
        <div class="row g-3 mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Materi Paling Banyak Dikerjakan</h3>
                    </div>
                    <div class="card-body">
                        <table id="laporanTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Materi</th>
                                    <th>Guru</th>
                                    <th>Jumlah Pengerjaan Quiz</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($topMateri as $materi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $materi->judul }}</td>
                                        <td>{{ $materi->guru->name ?? '-' }}</td>
                                        <td>{{ $materi->attempt_count ?? 0 }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Inisialisasi DataTables --}}
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#laporanTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    responsive: true,
                    lengthChange: true,
                    autoWidth: false,
                    pageLength: 10,
                    language: {
                        url: '{{ asset('vendor/datatables/i18n/id.json') }}'
                    }
                });
                $('#aktivitasQuizTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    responsive: true,
                    lengthChange: true,
                    autoWidth: false,
                    pageLength: 10,
                    language: {
                        url: '{{ asset('vendor/datatables/i18n/id.json') }}'
                    },
                    columnDefs: [{
                        orderable: false,
                        targets: 5
                    }]
                });
                $('#progressSiswaTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    responsive: true,
                    lengthChange: true,
                    autoWidth: false,
                    pageLength: 10,
                    language: {
                        url: '{{ asset('vendor/datatables/i18n/id.json') }}'
                    }
                });
            });
        </script>
    @endpush
@endsection
