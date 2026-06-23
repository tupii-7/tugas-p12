<?php

namespace App\Http\Requests;

use App\Rules\KodeBukuFormat;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Kategori;

class StoreBukuRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan untuk membuat request ini.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $bukuId = $this->route('buku')?->id;

        return [
            'kode_buku' => [
                'required',
                new KodeBukuFormat(),
                Rule::unique('buku')->ignore($bukuId),
            ],
            'judul' => 'required|string|max:200',
            'kategori' => [
                'required',
                Rule::in(Kategori::pluck('nama_kategori')->toArray())
            ],
            'pengarang' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'isbn' => 'nullable|string|max:20',
            'harga' => 'required|numeric|min:0',
            'stok' => [
                'required',
                'integer',
                'min:0',
                // Conditional: Jika tahun terbit < 2000, stok maksimal 5
                Rule::when(
                    fn () => $this->input('tahun_terbit') < 2000,
                    ['max:5']
                ),
            ],
            'deskripsi' => 'nullable|string',
            'bahasa' => [
                'required',
                'string',
                'max:20',
                // Conditional: Jika kategori "Programming", bahasa harus "Inggris"
                Rule::when(
                    fn () => strtolower($this->input('kategori')) === 'programming',
                    ['in:Inggris']
                ),
            ],
        ];
    }

    /**
     * Get custom messages untuk validation errors dalam bahasa Indonesia.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Pesan untuk Kode Buku
            'kode_buku.required' => 'Kode buku harus diisi.',
            'kode_buku.unique' => 'Kode buku sudah terdaftar dalam sistem.',

            // Pesan untuk Judul
            'judul.required' => 'Judul buku harus diisi.',
            'judul.string' => 'Judul harus berupa teks.',
            'judul.max' => 'Judul tidak boleh lebih dari 200 karakter.',

            // Pesan untuk Kategori
            'kategori.required' => 'Kategori harus dipilih.',
            'kategori.in' => 'Kategori yang dipilih tidak valid.',

            // Pesan untuk Pengarang
            'pengarang.required' => 'Pengarang harus diisi.',
            'pengarang.string' => 'Pengarang harus berupa teks.',
            'pengarang.max' => 'Nama pengarang tidak boleh lebih dari 100 karakter.',

            // Pesan untuk Penerbit
            'penerbit.required' => 'Penerbit harus diisi.',
            'penerbit.string' => 'Penerbit harus berupa teks.',
            'penerbit.max' => 'Nama penerbit tidak boleh lebih dari 100 karakter.',

            // Pesan untuk Tahun Terbit
            'tahun_terbit.required' => 'Tahun terbit harus diisi.',
            'tahun_terbit.integer' => 'Tahun terbit harus berupa angka.',
            'tahun_terbit.min' => 'Tahun terbit tidak boleh kurang dari 1900.',
            'tahun_terbit.max' => 'Tahun terbit tidak boleh melebihi tahun sekarang.',

            // Pesan untuk ISBN
            'isbn.string' => 'ISBN harus berupa teks.',
            'isbn.max' => 'ISBN tidak boleh lebih dari 20 karakter.',

            // Pesan untuk Harga
            'harga.required' => 'Harga harus diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',

            // Pesan untuk Stok
            'stok.required' => 'Stok harus diisi.',
            'stok.integer' => 'Stok harus berupa angka.',
            'stok.min' => 'Stok tidak boleh kurang dari 0.',
            'stok.max' => 'Stok untuk buku terbit sebelum tahun 2000 maksimal 5 eksemplar.',

            // Pesan untuk Bahasa
            'bahasa.required' => 'Bahasa harus diisi.',
            'bahasa.string' => 'Bahasa harus berupa teks.',
            'bahasa.max' => 'Nama bahasa tidak boleh lebih dari 20 karakter.',
            'bahasa.in' => 'Untuk kategori Programming, bahasa harus Inggris.',

            // Pesan untuk Deskripsi
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
        ];
    }

    /**
     * Get custom attributes untuk validation messages.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'kode_buku' => 'kode buku',
            'judul' => 'judul',
            'kategori' => 'kategori',
            'pengarang' => 'pengarang',
            'penerbit' => 'penerbit',
            'tahun_terbit' => 'tahun terbit',
            'isbn' => 'ISBN',
            'harga' => 'harga',
            'stok' => 'stok',
            'deskripsi' => 'deskripsi',
            'bahasa' => 'bahasa',
        ];
    }
}
