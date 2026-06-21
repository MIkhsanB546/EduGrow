<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPINTER</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand bg-white shadow-sm border-bottom">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">
                SIPINTER
                <small class="d-block fs-6 fw-normal text-muted">Belajar Interaktif dan Menyenangkan</small>
            </a>
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item">
                    <span class="nav-link text-muted">{{ auth()->user()->name }}</span>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <main class="container py-4">
        <div class="mb-4">
            <h2 class="fw-bold">Halo, {{ auth()->user()->name }}</h2>
            <p class="text-muted">Lanjutkan belajar hari ini!</p>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-lg-3 col-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body text-center p-4">
                        <div class="display-6 fw-bold text-primary mb-2">{{ $overallProgress }}%</div>
                        <div class="progress rounded-pill" style="height: 8px;">
                            <div class="progress-bar bg-primary rounded-pill" style="width: {{ $overallProgress }}%"></div>
                        </div>
                        <p class="text-muted small mt-2 mb-0">Progress Keseluruhan</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body text-center p-4">
                        <div class="display-6 fw-bold text-success mb-2">{{ $averageScore }}</div>
                        <i class="bi bi-graph-up-arrow fs-4 text-success"></i>
                        <p class="text-muted small mt-2 mb-0">Rata-rata Skor</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body text-center p-4">
                        <div class="display-6 fw-bold text-warning mb-2">{{ $completedQuiz }}</div>
                        <i class="bi bi-check-circle fs-4 text-warning"></i>
                        <p class="text-muted small mt-2 mb-0">Quiz Selesai</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body text-center p-4">
                        <div class="display-6 fw-bold text-info mb-2">{{ $totalStars }}</div>
                        <i class="bi bi-star-fill fs-4 text-info"></i>
                        <p class="text-muted small mt-2 mb-0">Bintang Terkumpul</p>
                    </div>
                </div>
            </div>
        </div>

        @if ($continueMateri->isNotEmpty())
            <div class="mb-4">
                <h5 class="fw-bold mb-3">Lanjutkan Belajar</h5>
                <div class="row g-3">
                    @foreach ($continueMateri as $materi)
                        <div class="col-lg-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                                <div class="bg-primary bg-opacity-10 d-flex align-items-center justify-content-center"
                                    style="height: 140px;">
                                    <i class="bi bi-book fs-1 text-primary opacity-50"></i>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h6 class="fw-bold mb-1">{{ $materi->judul }}</h6>
                                    <small class="text-muted mb-3">
                                        {{ $materi->kategori->nama_kategori ?? 'Umum' }} &middot;
                                        {{ $materi->jenjang->nama_jenjang ?? '-' }}
                                    </small>
                                    <div class="progress rounded-pill mb-3" style="height: 6px;">
                                        <div class="progress-bar bg-primary rounded-pill" style="width: 0%"></div>
                                    </div>
                                    <a href="#" class="btn btn-outline-primary rounded-pill mt-auto w-100">
                                        Lanjutkan
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if ($recentAttempts->isNotEmpty())
            <div>
                <h5 class="fw-bold mb-3">Riwayat Quiz</h5>
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Quiz</th>
                                    <th>Skor</th>
                                    <th>Bintang</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentAttempts as $attempt)
                                    <tr>
                                        <td>{{ $attempt->quiz->judul ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-success rounded-pill">{{ $attempt->skor_persen }}%</span>
                                        </td>
                                        <td>
                                            @for ($i = 1; $i <= 3; $i++)
                                                <i class="bi bi-star{{ $i <= $attempt->bintang ? '-fill' : '' }} text-warning small"></i>
                                            @endfor
                                        </td>
                                        <td class="text-muted small">
                                            {{ \Carbon\Carbon::parse($attempt->tanggal_pengerjaan)->translatedFormat('d M Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>
