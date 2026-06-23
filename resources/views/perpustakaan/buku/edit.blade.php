@extends('layouts.app')

@section('title', 'Edit Buku')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/buku">Buku</a></li>
            <li class="breadcrumb-item active">Edit Buku</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 fw-bold text-dark">
                <i class="bi bi-pencil-square"></i> Edit Buku
            </h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="/buku/{{ $buku->id }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Kode Buku</label>
                        <input type="text" name="kode_buku" value="{{ old('kode_buku', $buku->kode_buku) }}" class="form-control">
                        @error('kode_buku') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" value="{{ old('judul', $buku->judul) }}" class="form-control">
                        @error('judul') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kategori</label>
                        <select class="form-select" name="kategori">
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->nama_kategori }}" {{ old('kategori', $buku->kategori) == $kat->nama_kategori ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Pengarang</label>
                        <input type="text" name="pengarang" value="{{ old('pengarang', $buku->pengarang) }}" class="form-control">
                        @error('pengarang') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Penerbit</label>
                        <input type="text" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" class="form-control">
                        @error('penerbit') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" class="form-control">
                        @error('tahun_terbit') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">ISBN</label>
                        <input type="text" name="isbn" value="{{ old('isbn', $buku->isbn) }}" class="form-control">
                        @error('isbn') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Harga</label>
                        <input type="number" step="0.01" name="harga" value="{{ old('harga', $buku->harga) }}" class="form-control">
                        @error('harga') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" value="{{ old('stok', $buku->stok) }}" class="form-control">
                        @error('stok') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Bahasa</label>
                        <input type="text" name="bahasa" value="{{ old('bahasa', $buku->bahasa) }}" class="form-control">
                        @error('bahasa') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                        @error('deskripsi') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-custom btn-custom-primary">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                    <a href="/buku/{{ $buku->id }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
