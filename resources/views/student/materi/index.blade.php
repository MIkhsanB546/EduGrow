<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Materi - SIPINTER</title>

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
                    <a href="{{ route('siswa.dashboard') }}" class="nav-link text-muted">
                        <i class="bi bi-grid-fill"></i>
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
        <div class="mb-4">
            <h2 class="fw-bold">Materi Pembelajaran</h2>
            <p class="text-muted">Pilih materi yang ingin kamu pelajari</p>
        </div>

        @php
            $grouped = $materiList->groupBy(fn ($m) => $m->kategori->nama_kategori ?? 'Umum');
        @endphp

        @forelse ($grouped as $kategori => $materiGroup)
            <div class="mb-4">
                <h5 class="fw-bold mb-3">{{ $kategori }}</h5>
                <div class="row g-3">
                    @foreach ($materiGroup as $materi)
                        <div class="col-lg-4 col-md-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                                <div class="bg-primary bg-opacity-10 d-flex align-items-center justify-content-center"
                                    style="height: 140px;">
                                    <i class="bi bi-journal-bookmark-fill fs-1 text-primary opacity-50"></i>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h6 class="fw-bold mb-1">{{ $materi->judul }}</h6>
                                    <small class="text-muted mb-1">
                                        <i class="bi bi-person"></i> {{ $materi->guru->name ?? '-' }}
                                    </small>
                                    <small class="text-muted mb-3">
                                        <i class="bi bi-bar-chart"></i> {{ $materi->jenjang->nama_jenjang ?? '-' }}
                                    </small>
                                    <div class="d-flex gap-2 mt-auto">
                                        <a href="{{ route('siswa.materi.show', $materi) }}"
                                            class="btn btn-primary rounded-pill w-100">
                                            Pelajari
                                        </a>
                                        @if ($materi->quiz)
                                            <a href="#" class="btn btn-outline-success rounded-pill">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-book fs-1 text-muted"></i>
                <p class="text-muted mt-3">Belum ada materi tersedia</p>
            </div>
        @endforelse
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>
