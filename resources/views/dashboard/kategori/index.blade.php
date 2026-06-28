@extends('layouts.app')

@section('title', 'Kelola Kategori Materi')

@push('styles')
    <style>
        .dataTables_filter input {
            width: 220px;
        }
    </style>
@endpush

@section('content')
    {{-- Konten daftar kategori --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {{-- Kartu daftar kategori --}}
                <div class="card">
                    {{-- Header kartu dengan tombol tambah --}}
                    <div class="card-header">
                        <h3 class="card-title">Daftar Kategori Materi</h3>
                        <div class="card-tools">
                            <a href="{{ route('dashboard.kategori.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-lg"></i> Tambah Kategori
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- Tabel daftar kategori --}}
                        <table id="kategoriTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah Materi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kategoriList as $kategori)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kategori->nama_kategori }}</td>
                                        <td>{{ $kategori->deskripsi ?? '-' }}</td>
                                        <td>{{ $kategori->materi_count ?? $kategori->materi->count() }}</td>
                                        {{-- Tombol aksi edit dan hapus --}}
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('dashboard.kategori.edit', $kategori->id_kategori_materi) }}"
                                                    class="btn btn-warning" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form
                                                    action="{{ route('dashboard.kategori.destroy', $kategori->id_kategori_materi) }}"
                                                    method="post" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- State kosong --}}
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">Belum ada kategori</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Inisialisasi DataTable --}}
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#kategoriTable').DataTable({
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
                        targets: 4
                    }]
                });
            });
        </script>
    @endpush
@endsection
