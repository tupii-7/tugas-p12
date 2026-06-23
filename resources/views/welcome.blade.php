@extends('layouts.app')

@section('title', 'Beranda')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><i class="bi bi-house-door"></i> Beranda</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row align-items-center min-vh-75">
        <div class="col-lg-6">
            <div class="p-5 bg-white rounded-4 shadow-sm">
                <h1 class="display-6 fw-bold">Selamat Datang di Perpustakaan</h1>
                <p class="lead text-secondary">Kelola data buku dan anggota dengan mudah. Temukan buku terbaru, lihat statistik perpustakaan, dan lakukan peminjaman cepat.</p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="/dashboard" class="btn btn-custom btn-custom-primary btn-lg">
                        <i class="bi bi-graph-up"></i> Dashboard
                    </a>
                    <a href="/buku" class="btn btn-outline-primary btn-lg">
                        <i class="bi bi-book"></i> Buku
                    </a>
                    <a href="/anggota" class="btn btn-outline-secondary btn-lg">
                        <i class="bi bi-people"></i> Anggota
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="row g-0">
                    <div class="col-12 p-5 bg-primary text-white">
                        <h2 class="fw-bold">Perpustakaan Modern</h2>
                        <p class="mb-0">Manajemen buku dan anggota dalam satu sistem yang responsif dan mudah digunakan.</p>
                    </div>
                    <div class="col-12 p-4 bg-white">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="p-3 bg-light rounded-3 text-center">
                                    <i class="bi bi-journal-bookmark fs-2 text-primary"></i>
                                    <h5 class="mt-3 mb-1">Buku</h5>
                                    <p class="text-muted mb-0">Tambah, edit, dan cari buku dengan cepat.</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-light rounded-3 text-center">
                                    <i class="bi bi-people fs-2 text-success"></i>
                                    <h5 class="mt-3 mb-1">Anggota</h5>
                                    <p class="text-muted mb-0">Kelola data anggota dan status keaktifan.</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-light rounded-3 text-center">
                                    <i class="bi bi-funnel fs-2 text-warning"></i>
                                    <h5 class="mt-3 mb-1">Filter</h5>
                                    <p class="text-muted mb-0">Temukan buku berdasarkan kategori dan stok.</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-light rounded-3 text-center">
                                    <i class="bi bi-speedometer2 fs-2 text-danger"></i>
                                    <h5 class="mt-3 mb-1">Statistik</h5>
                                    <p class="text-muted mb-0">Lihat ringkasan buku dan anggota secara real-time.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
