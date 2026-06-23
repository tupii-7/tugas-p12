<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Rules\KodeBukuFormat;
use App\Http\Requests\StoreBukuRequest;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;


class BukuController extends Controller
{
    /**
     * Display list of books with filtering and search
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = Buku::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('judul', 'like', "%{$search}%")
                ->orWhere('pengarang', 'like', "%{$search}%")
                ->orWhere('isbn', 'like', "%{$search}%");
        }

        // Filter by category
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->input('kategori'));
        }

        // Pagination
        $buku = $query->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        // Statistics
        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok', '=', 0)->count();

        // Get all categories for filter
        $kategori = Kategori::all();

        return view('perpustakaan.buku.index', [
            'buku' => $buku,
            'totalBuku' => $totalBuku,
            'bukuTersedia' => $bukuTersedia,
            'bukuHabis' => $bukuHabis,
            'kategori' => $kategori,
        ]);
    }

    /**
     * Display book detail
     *
     * @param Buku $buku
     * @return View
     */
    public function edit(Buku $buku): View
    {
        $kategori = Kategori::all();

        return view('perpustakaan.buku.edit', [
            'buku' => $buku,
            'kategori' => $kategori,
        ]);
    }

    /**
     * Show form untuk membuat buku baru
     *
     * @return View
     */
    public function create(): View
    {
        $kategori = Kategori::all();

        return view('perpustakaan.buku.create', [
            'kategori' => $kategori,
        ]);
    }

    /**
     * Store buku baru ke database dengan validation advanced
     *
     * @param StoreBukuRequest $request
     * @return RedirectResponse
     */
    public function store(StoreBukuRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Buku::create($data);

        return redirect('/buku')->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Update buku dengan validation advanced
     *
     * @param StoreBukuRequest $request
     * @param Buku $buku
     * @return RedirectResponse
     */
    public function update(StoreBukuRequest $request, Buku $buku): RedirectResponse
    {
        $data = $request->validated();

        $buku->update($data);

        return redirect('/buku')->with('success', 'Buku berhasil diperbarui.');
    }

    public function show(Buku $buku): View
    {
        // Get similar books from same category
        $bukuSerupa = Buku::where('kategori', $buku->kategori)
            ->where('id', '!=', $buku->id)
            ->limit(6)
            ->get();

        return view('perpustakaan.buku.show', [
            'buku' => $buku,
            'bukuSerupa' => $bukuSerupa,
        ]);
    }

    /**
     * Delete multiple books at once
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function bulkDelete(Request $request): RedirectResponse
    {
        $ids = $request->input('buku_ids', []);

        // Validate that IDs array is not empty
        if (empty($ids)) {
            return redirect()->route('buku.index')
                ->with('warning', 'Pilih minimal 1 buku untuk dihapus.');
        }

        // Ensure all IDs are integers
        $ids = array_map('intval', $ids);

        // Delete the books
        $deletedCount = Buku::whereIn('id', $ids)->delete();

        return redirect()->route('buku.index')
            ->with('success', $deletedCount . ' buku berhasil dihapus!');
    }

    /**
     * Export buku data ke file CSV
     *
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function export()
    {
        $bukus = Buku::all();

        $filename = 'buku_' . date('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($bukus) {
            $file = fopen('php://output', 'w');

            // Set UTF-8 BOM untuk kompatibilitas Excel
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header CSV
            fputcsv($file, [
                'Kode Buku',
                'Judul',
                'Kategori',
                'Pengarang',
                'Penerbit',
                'Tahun Terbit',
                'ISBN',
                'Harga',
                'Stok',
                'Bahasa',
                'Deskripsi',
                'Tanggal Dibuat',
            ], ',', '"');

            // Data buku
            foreach ($bukus as $buku) {
                fputcsv($file, [
                    $buku->kode_buku,
                    $buku->judul,
                    $buku->kategori,
                    $buku->pengarang,
                    $buku->penerbit,
                    $buku->tahun_terbit,
                    $buku->isbn ?? '-',
                    number_format($buku->harga, 0, ',', '.'),
                    $buku->stok,
                    $buku->bahasa,
                    $buku->deskripsi ?? '-',
                    $buku->created_at->format('Y-m-d H:i:s'),
                ], ',', '"');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
