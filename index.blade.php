@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>
        <i class="bi bi-book"></i>
        Daftar Buku
    </h1>

    <div class="d-flex gap-2">
        <a href="{{ route('buku.export') }}" class="btn btn-success">
            <i class="bi bi-download"></i>
            Export CSV
        </a>

        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Tambah Buku
        </a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-primary shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Buku</h6>
                <h2>{{ $totalBuku }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-success shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Buku Tersedia</h6>
                <h2>{{ $bukuTersedia }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-danger shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Buku Habis</h6>
                <h2>{{ $bukuHabis }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <h6 class="mb-3">
            <i class="bi bi-funnel"></i>
            Filter Kategori
        </h6>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('buku.index') }}" class="btn btn-sm btn-outline-primary">
                Semua
            </a>

            <a href="{{ route('buku.kategori', 'Programming') }}" class="btn btn-sm btn-outline-primary">
                Programming
            </a>

            <a href="{{ route('buku.kategori', 'Database') }}" class="btn btn-sm btn-outline-primary">
                Database
            </a>

            <a href="{{ route('buku.kategori', 'Web Design') }}" class="btn btn-sm btn-outline-primary">
                Web Design
            </a>

            <a href="{{ route('buku.kategori', 'Networking') }}" class="btn btn-sm btn-outline-primary">
                Networking
            </a>

            <a href="{{ route('buku.kategori', 'Data Science') }}" class="btn btn-sm btn-outline-primary">
                Data Science
            </a>
        </div>
    </div>
</div>

<form action="{{ route('buku.bulk-delete') }}" method="POST">
    @csrf

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <input type="checkbox" id="select-all">
                <label for="select-all">Pilih Semua</label>
            </div>

            <button
                type="submit"
                class="btn btn-danger btn-sm"
                onclick="return confirm('Yakin ingin menghapus buku yang dipilih?')"
            >
                <i class="bi bi-trash"></i>
                Hapus Terpilih
            </button>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50"></th>
                        <th>Kode Buku</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Pengarang</th>
                        <th>Stok</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($bukus as $buku)
                        <tr>
                            <td>
                                <input
                                    type="checkbox"
                                    name="buku_ids[]"
                                    value="{{ $buku->id }}"
                                >
                            </td>

                            <td>{{ $buku->kode_buku }}</td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->kategori }}</td>
                            <td>{{ $buku->pengarang }}</td>
                            <td>{{ $buku->stok }}</td>

                            <td>
                                <a
                                    href="{{ route('buku.show', $buku->id) }}"
                                    class="btn btn-info btn-sm text-white"
                                >
                                    Detail
                                </a>

                                <a
                                    href="{{ route('buku.edit', $buku->id) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('buku.destroy', $buku->id) }}"
                                    method="POST"
                                    class="d-inline delete-form"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="button"
                                        class="btn btn-danger btn-sm btn-delete"
                                        data-judul="{{ $buku->judul }}"
                                    >
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                Tidak ada data buku.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</form>

@if($bukus->count() > 0)
    <div class="text-center mt-3">
        <p class="text-muted">
            Menampilkan {{ $bukus->count() }} buku
        </p>
    </div>
@endif

@endsection

@push('scripts')
<script>
    document.getElementById('select-all').addEventListener('change', function () {
        document.querySelectorAll('input[name="buku_ids[]"]').forEach(cb => {
            cb.checked = this.checked;
        });
    });

    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {

            const form = this.closest('form');
            const judul = this.dataset.judul;

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus buku "${judul}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush