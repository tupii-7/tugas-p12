# Implementasi Fitur Lanjutan Sistem Perpustakaan

## 1. Advanced Validation

### Perubahan File

**File Baru**

* `KodeBukuFormat.php`
* `StoreBukuRequest.php`

**File Diperbarui**

* `BukuController.php`

### Implementasi

* Validasi khusus untuk format kode buku (`BK-[kategori]-[nomor]`).
* Validasi bersyarat berdasarkan kategori dan tahun terbit.
* Pesan kesalahan menggunakan Bahasa Indonesia.
* Penerapan Form Request untuk proses validasi saat menambah dan memperbarui data buku.

---
Screenshots
<img width="1868" height="988" alt="Screenshot 2026-06-23 105929" src="https://github.com/user-attachments/assets/c60654cc-a796-41a6-aabd-3ef3b15c5a48" />

## 2. Bulk Delete Data Buku

### Perubahan File

**File Diperbarui**

* `routes/web.php`
* `BukuController.php`
* `resources/views/perpustakaan/buku/index.blade.php`

### Implementasi

* Pemilihan banyak data menggunakan checkbox.
* Fitur pilih semua data sekaligus.
* Penghapusan massal melalui tombol aksi.
* Konfirmasi sebelum proses penghapusan dilakukan.
* Penambahan method `bulkDelete()` pada controller.

<img width="1871" height="1016" alt="Screenshot 2026-06-23 110237" src="https://github.com/user-attachments/assets/40850317-111d-48c3-b85e-2f7ddb45ecfa" />
<img width="1864" height="1053" alt="Screenshot 2026-06-23 110300" src="https://github.com/user-attachments/assets/ae1d2722-3518-4148-8068-9809acce2815" />
<img width="1855" height="976" alt="Screenshot 2026-06-23 110312" src="https://github.com/user-attachments/assets/704f988a-27c4-4f91-b381-25e3168514e6" />

fitur delete
---

## 3. Export Data Buku ke CSV

### Perubahan File

**File Diperbarui**

* `routes/web.php`
* `BukuController.php`
* `resources/views/perpustakaan/buku/index.blade.php`

### Implementasi

* Tombol ekspor data pada halaman daftar buku.
* Pembuatan file CSV secara otomatis dari data buku.
* Download file langsung melalui browser.
* Format file dan nama file dibuat secara dinamis.

<img width="1855" height="976" alt="Screenshot 2026-06-23 110312" src="https://github.com/user-attachments/assets/e4c0b0b3-6fd2-4d95-b79b-c9613367fe16" />
<img width="1886" height="1079" alt="Screenshot 2026-06-23 110635" src="https://github.com/user-attachments/assets/222787ab-5d81-498f-8197-df44f6755770" />
<img width="1919" height="1078" alt="Screenshot 2026-06-23 110708" src="https://github.com/user-attachments/assets/3d8d0517-8fdd-4739-b174-e0bfddfd8c8a" />

---

## Struktur File Utama

| File                   | Fungsi                                  |
| ---------------------- | --------------------------------------- |
| `KodeBukuFormat.php`   | Validasi format kode buku               |
| `StoreBukuRequest.php` | Pengelolaan validasi data buku          |
| `BukuController.php`   | CRUD, validasi, bulk delete, dan export |
| `web.php`              | Konfigurasi route aplikasi              |
| `index.blade.php`      | Tampilan daftar buku dan fitur tambahan |

## Fitur yang Berhasil Diimplementasikan

* Advanced Validation Rules
* Conditional Validation
* Form Request Validation
* Bulk Delete Operations
* Export Data ke CSV
* Custom Error Messages
* JavaScript Select All & Confirmation
* Download CSV Otomatis
