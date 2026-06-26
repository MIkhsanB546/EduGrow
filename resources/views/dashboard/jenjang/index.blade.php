@extends('layouts.app')

@section('title', 'Kelola Jenjang')

@push('styles')
<style>
.dataTables_filter input { width: 220px; }
</style>
@endpush

@section('content')
{{-- Konten daftar jenjang --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            {{-- Kartu daftar jenjang --}}
            <div class="card">
                {{-- Header kartu dengan tombol tambah --}}
                <div class="card-header">
                    <h3 class="card-title">Daftar Jenjang</h3>
                    <div class="card-tools">
                        <a href="{{ route('dashboard.jenjang.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-lg"></i> Tambah Jenjang
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Tabel daftar jenjang --}}
                    <table id="jenjangTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Jenjang</th>
                                <th>Jumlah Materi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jenjangList as $jenjang)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jenjang->nama_jenjang }}</td>
                                <td>{{ $jenjang->materi_count ?? $jenjang->materi->count() }}</td>
                                {{-- Tombol aksi edit dan hapus --}}
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('dashboard.jenjang.edit', $jenjang->id_jenjang) }}" class="btn btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('dashboard.jenjang.destroy', $jenjang->id_jenjang) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jenjang ini?')">
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
                                <td colspan="4" class="text-center text-muted py-3">Belum ada jenjang</td>
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
    $('#jenjangTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        pageLength: 10,
        language: { url: '//cdn.datatables.net/plug-ins/1.13.11/i18n/id.json' },
        columnDefs: [{ orderable: false, targets: 3 }]
    });
});
</script>
@endpush
@endsection
