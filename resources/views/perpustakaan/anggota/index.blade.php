@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active"><i class="bi bi-people"></i> Anggota</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 fw-bold text-dark">
                <i class="bi bi-people"></i> Daftar Anggota
            </h1>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon text-primary">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-number">{{ $totalAnggota }}</div>
                <div class="stat-label">Total Anggota</div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="color: var(--success-color);">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-number">{{ $anggotaAktif }}</div>
                <div class="stat-label">Anggota Aktif</div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="color: var(--warning-color);">
                    <i class="bi bi-exclamation-circle"></i>
                </div>
                <div class="stat-number">{{ $anggotaNonaktif }}</div>
                <div class="stat-label">Anggota Nonaktif</div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="color: var(--info-color);">
                    <i class="bi bi-percent"></i>
                </div>
                <div class="stat-number">{{ $totalAnggota > 0 ? round(($anggotaAktif / $totalAnggota) * 100, 0) : 0 }}%</div>
                <div class="stat-label">Aktif (%)</div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="filter-section">
        <form method="GET" action="/anggota" class="row g-3">
            <div class="col-md-5">
                <label for="search" class="filter-label">Cari Anggota</label>
                <input type="text" class="form-control search-input" id="search" name="search" 
                       placeholder="Cari nama, email, atau kode anggota..." value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <label for="status" class="filter-label">Filter Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="">Semua Status</option>
                    <option value="Aktif" {{ request('status') === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Nonaktif" {{ request('status') === 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="sort" class="filter-label">Urutkan Berdasarkan</label>
                <div class="d-flex gap-2">
                    <select class="form-select" id="sort" name="sort">
                        <option value="created_at" {{ request('sort') === 'created_at' ? 'selected' : '' }}>Tanggal Daftar</option>
                        <option value="nama" {{ request('sort') === 'nama' ? 'selected' : '' }}>Nama</option>
                        <option value="email" {{ request('sort') === 'email' ? 'selected' : '' }}>Email</option>
                        <option value="status" {{ request('sort') === 'status' ? 'selected' : '' }}>Status</option>
                    </select>
                    <select class="form-select" id="dir" name="dir" style="max-width: 100px;">
                        <option value="desc" {{ request('dir') === 'desc' ? 'selected' : '' }}>↓ Desc</option>
                        <option value="asc" {{ request('dir') === 'asc' ? 'selected' : '' }}>↑ Asc</option>
                    </select>
                </div>
            </div>

            <div class="col-md-1 d-flex align-items-end">
                <button type="submit" class="btn btn-custom btn-custom-primary w-100">
                    <i class="bi bi-search"></i>
                </button>
                <a href="/anggota" class="btn btn-outline-secondary ms-2">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Members Table -->
    <div class="card">
        <div class="card-body p-0">
            @if ($anggota->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Kode Anggota</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Jenis Kelamin</th>
                                <th>Status</th>
                                <th>Tanggal Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anggota as $item)
                                <tr>
                                    <td>
                                        <span class="badge bg-light text-dark">{{ $item->kode_anggota }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $item->nama }}</strong><br>
                                        <small class="text-muted">Umur: {{ $item->umur }} tahun</small>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $item->email }}">{{ $item->email }}</a>
                                    </td>
                                    <td>{{ $item->telepon }}</td>
                                    <td>
                                        @if ($item->jenis_kelamin === 'Laki-laki')
                                            <span class="badge bg-info">♂️ Laki-laki</span>
                                        @else
                                            <span class="badge bg-danger">♀️ Perempuan</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status === 'Aktif')
                                            <span class="badge bg-success">✓ Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">✗ Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small>{{ $item->created_at->format('d M Y') }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button class="btn btn-outline-primary btn-sm" title="Detail" disabled>
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <a href="/anggota/{{ $item->id }}/edit" class="btn btn-outline-secondary btn-sm" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="card-footer bg-light">
                    <nav>
                        <ul class="pagination justify-content-center mb-0">
                            <!-- Previous Link -->
                            @if ($anggota->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">← Sebelumnya</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $anggota->previousPageUrl() }}">← Sebelumnya</a>
                                </li>
                            @endif

                            <!-- Page Numbers -->
                            @foreach ($anggota->getUrlRange(1, $anggota->lastPage()) as $page => $url)
                                @if ($page == $anggota->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            <!-- Next Link -->
                            @if ($anggota->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $anggota->nextPageUrl() }}">Selanjutnya →</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Selanjutnya →</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="bi bi-inbox"></i>
                    </div>
                    <h5 class="empty-state-title">Anggota Tidak Ditemukan</h5>
                    <p class="empty-state-text">Tidak ada anggota yang sesuai dengan kriteria pencarian Anda.</p>
                    <a href="/anggota" class="btn btn-custom btn-custom-primary">
                        <i class="bi bi-arrow-clockwise"></i> Reset Filter
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
