# tugas-p12
# Tugas 1 - Validation Rules Advanced

## Deskripsi

Implementasi validasi lanjutan pada modul buku menggunakan Form Request dan Custom Validation Rule. Sistem validasi dirancang untuk memastikan data buku yang disimpan sesuai dengan aturan bisnis perpustakaan.

## File yang Ditambahkan

### Custom Validation Rule

* `app/Rules/KodeBukuFormat.php`

### Form Request

* `app/Http/Requests/StoreBukuRequest.php`

## File yang Dimodifikasi

* `app/Http/Controllers/BukuController.php`

## Fitur yang Diimplementasikan

### Validasi Format Kode Buku

Menerapkan custom validation rule untuk memastikan format kode buku mengikuti pola:

```text
BK-[kategori]-[nomor]
```

Contoh:

```text
BK-PROG-001
BK-DB-002
BK-WEB-003
```

### Conditional Validation

#### Bahasa Buku

Jika kategori buku adalah **Programming**, maka bahasa wajib menggunakan **Inggris**.

#### Stok Buku Lama

Jika tahun terbit buku sebelum tahun 2000, maka jumlah stok maksimal yang diperbolehkan adalah 5 buku.

### Form Request Validation

Seluruh proses validasi data buku dipindahkan ke Form Request sehingga controller menjadi lebih bersih dan terstruktur.

### Pesan Error Kustom

Menampilkan pesan validasi dalam Bahasa Indonesia agar lebih mudah dipahami oleh pengguna.

## Struktur File

```text
app
├── Http
│   ├── Controllers
│   │   └── BukuController.php
│   │
│   └── Requests
│       └── StoreBukuRequest.php
│
└── Rules
    └── KodeBukuFormat.php
```

## Teknologi yang Digunakan

* Laravel Form Request
* Custom Validation Rule
* Conditional Validation
* MVC Architecture
* PHP 8+
