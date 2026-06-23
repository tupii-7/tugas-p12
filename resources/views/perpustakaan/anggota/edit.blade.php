@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/anggota">Anggota</a></li>
            <li class="breadcrumb-item active">Edit Anggota</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 fw-bold text-dark">
                <i class="bi bi-pencil-square"></i> Edit Anggota
            </h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="/anggota/{{ $anggota->id }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Kode Anggota</label>
                        <input type="text" name="kode_anggota" value="{{ old('kode_anggota', $anggota->kode_anggota) }}" class="form-control">
                        @error('kode_anggota') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama', $anggota->nama) }}" class="form-control">
                        @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $anggota->email) }}" class="form-control">
                        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="telepon" value="{{ old('telepon', $anggota->telepon) }}" class="form-control">
                        @error('telepon') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin">
                            <option value="Laki-laki" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="Aktif" {{ old('status', $anggota->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ old('status', $anggota->status) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $anggota->tanggal_lahir->format('Y-m-d')) }}" class="form-control">
                        @error('tanggal_lahir') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Daftar</label>
                        <input type="date" name="tanggal_daftar" value="{{ old('tanggal_daftar', $anggota->tanggal_daftar->format('Y-m-d')) }}" class="form-control">
                        @error('tanggal_daftar') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" rows="3" class="form-control">{{ old('alamat', $anggota->alamat) }}</textarea>
                        @error('alamat') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Pekerjaan</label>
                        <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $anggota->pekerjaan) }}" class="form-control">
                        @error('pekerjaan') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-custom btn-custom-primary">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                    <a href="/anggota" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
