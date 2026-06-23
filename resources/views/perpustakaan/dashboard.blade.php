@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><i class="bi bi-graph-up"></i> Dashboard</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 fw-bold text-dark">
                <i class="bi bi-graph-up"></i> Dashboard Perpustakaan
            </h1>
            <p class="text-muted">Selamat datang di sistem manajemen perpustakaan. Berikut adalah ringkasan statistik perpustakaan Anda.</p>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="row mb-4">
        <!-- Total Books -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon text-primary">
                    <i class="bi bi-book"></i>
                </div>
                <div class="stat-number">{{ $totalBuku }}</div>
                <div class="stat-label">Total Buku</div>
            </div>
        </div>

        <!-- Available Books -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="color: var(--success-color);">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-number">{{ $bukuTersedia }}</div>
                <div class="stat-label">Buku Tersedia</div>
            </div>
        </div>

        <!-- Out of Stock Books -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="color: var(--danger-color);">
                    <i class="bi bi-x-circle"></i>
                </div>
                <div class="stat-number">{{ $bukuHabis }}</div>
                <div class="stat-label">Buku Habis</div>
            </div>
        </div>

        <!-- Stock Availability Rate -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="color: var(--info-color);">
                    <i class="bi bi-percent"></i>
                </div>
                <div class="stat-number">{{ $totalBuku > 0 ? round(($bukuTersedia / $totalBuku) * 100, 0) : 0 }}%</div>
                <div class="stat-label">Tingkat Ketersediaan</div>
            </div>
        </div>
    </div>

    <!-- Members Statistics Section -->
    <div class="row mb-4">
        <!-- Total Members -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="color: var(--primary-color);">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-number">{{ $totalAnggota }}</div>
                <div class="stat-label">Total Anggota</div>
            </div>
        </div>

        <!-- Active Members -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="color: var(--success-color);">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-number">{{ $anggotaAktif }}</div>
                <div class="stat-label">Anggota Aktif</div>
            </div>
        </div>

        <!-- Inactive Members -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="color: var(--warning-color);">
                    <i class="bi bi-exclamation-circle"></i>
                </div>
                <div class="stat-number">{{ $anggotaNonaktif }}</div>
                <div class="stat-label">Anggota Nonaktif</div>
            </div>
        </div>

        <!-- Member Percentage -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="color: var(--info-color);">
                    <i class="bi bi-percent"></i>
                </div>
                <div class="stat-number">{{ $totalAnggota > 0 ? round(($anggotaAktif / $totalAnggota) * 100, 0) : 0 }}%</div>
                <div class="stat-label">Anggota Aktif (%)</div>
            </div>
        </div>
    </div>

    <!-- Newest Books & Members Section -->
    <div class="row mb-4">
        <!-- Newest Books -->
        <div class="col-lg-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-clock-history"></i> 5 Buku Terbaru
                </div>
                <div class="card-body">
                    @forelse ($bukuTerbaru as $buku)
                        <div class="d-flex justify-content-between align-items-start mb-3 pb-3" style="border-bottom: 1px solid #e2e8f0;">
                            <div style="flex: 1;">
                                <h6 class="mb-1">{{ $buku->judul }}</h6>
                                <small class="text-muted d-block">Pengarang: {{ $buku->pengarang }}</small>
                                <small class="text-muted">Tahun: {{ $buku->tahun_terbit }}</small>
                            </div>
                            <div>
                                @if ($buku->stok > 0)
                                    <span class="badge bg-success">{{ $buku->stok }} Tersedia</span>
                                @else
                                    <span class="badge bg-danger">Habis</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="bi bi-inbox" style="font-size: 32px; color: #cbd5e1;"></i>
                            <p class="text-muted mt-2">Belum ada data buku</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Newest Members -->
        <div class="col-lg-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-clock-history"></i> 5 Anggota Terbaru
                </div>
                <div class="card-body">
                    @forelse ($anggotaTerbaru as $anggota)
                        <div class="d-flex justify-content-between align-items-start mb-3 pb-3" style="border-bottom: 1px solid #e2e8f0;">
                            <div style="flex: 1;">
                                <h6 class="mb-1">{{ $anggota->nama }}</h6>
                                <small class="text-muted d-block">Email: {{ $anggota->email }}</small>
                                <small class="text-muted">Daftar: {{ $anggota->created_at->format('d M Y') }}</small>
                            </div>
                            <div>
                                @if ($anggota->status === 'Aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="bi bi-inbox" style="font-size: 32px; color: #cbd5e1;"></i>
                            <p class="text-muted mt-2">Belum ada data anggota</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-lightning"></i> Quick Actions - Menu Utama
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-4">
                            <a href="/buku" class="btn btn-custom btn-custom-primary w-100">
                                <i class="bi bi-book"></i> Kelola Buku
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <a href="/anggota" class="btn btn-custom btn-custom-primary w-100">
                                <i class="bi bi-people"></i> Kelola Anggota
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <a href="#" class="btn btn-custom btn-custom-primary w-100" disabled>
                                <i class="bi bi-arrow-left-right"></i> Transaksi Peminjaman
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
