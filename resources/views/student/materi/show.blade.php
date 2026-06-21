<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $materi->judul }} - SIPINTER</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand bg-white shadow-sm border-bottom">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="{{ route('siswa.dashboard') }}">
                SIPINTER
                <small class="d-block fs-6 fw-normal text-muted">Belajar Interaktif dan Menyenangkan</small>
            </a>
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item">
                    <a href="{{ route('siswa.materi.index') }}" class="nav-link text-muted">
                        <i class="bi bi-collection"></i> Materi
                    </a>
                </li>
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
        <a href="{{ route('siswa.materi.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill mb-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="bg-primary bg-opacity-10 d-flex align-items-center justify-content-center"
                        style="height: 200px;">
                        <i class="bi bi-journal-bookmark-fill fs-1 text-primary opacity-50"></i>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge bg-primary rounded-pill">
                                {{ $materi->kategori->nama_kategori ?? 'Umum' }}
                            </span>
                            <span class="badge bg-secondary rounded-pill">
                                {{ $materi->jenjang->nama_jenjang ?? '-' }}
                            </span>
                        </div>

                        <h3 class="fw-bold mb-2">{{ $materi->judul }}</h3>

                        <small class="text-muted d-block mb-3">
                            <i class="bi bi-person"></i> {{ $materi->guru->name ?? '-' }}
                        </small>

                        @if ($materi->deskripsi)
                            <p class="text-muted">{{ $materi->deskripsi }}</p>
                        @endif

                        <div class="d-flex flex-wrap gap-3 mt-4">
                            @if ($materi->file_materi)
                                <a href="{{ asset('storage/' . $materi->file_materi) }}"
                                    class="btn btn-outline-primary rounded-pill" target="_blank">
                                    <i class="bi bi-download"></i> Unduh Materi
                                </a>
                            @endif

                            @if ($materi->quiz)
                                <a href="#" class="btn btn-success rounded-pill">
                                    <i class="bi bi-pencil-square"></i> Kerjakan Quiz
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">Informasi Materi</h6>
                        <hr class="my-2">
                        <dl class="mb-0">
                            <dt class="small text-muted">Kategori</dt>
                            <dd class="mb-2">{{ $materi->kategori->nama_kategori ?? '-' }}</dd>

                            <dt class="small text-muted">Jenjang</dt>
                            <dd class="mb-2">{{ $materi->jenjang->nama_jenjang ?? '-' }}</dd>

                            <dt class="small text-muted">Guru</dt>
                            <dd class="mb-2">{{ $materi->guru->name ?? '-' }}</dd>

                            <dt class="small text-muted">Quiz</dt>
                            <dd class="mb-2">
                                @if ($materi->quiz)
                                    <span class="badge bg-success rounded-pill">{{ $materi->quiz->judul }}</span>
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </dd>

                            <dt class="small text-muted">Dipublikasikan</dt>
                            <dd>{{ $materi->created_at->translatedFormat('d M Y') }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>
