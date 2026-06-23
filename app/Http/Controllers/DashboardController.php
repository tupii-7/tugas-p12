<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display dashboard with library statistics
     *
     * @return View
     */
    public function index(): View
    {
        // Statistik Buku
        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok', '=', 0)->count();

        // Statistik Anggota
        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'Aktif')->count();
        $anggotaNonaktif = Anggota::where('status', 'Nonaktif')->count();

        // 5 Buku Terbaru
        $bukuTerbaru = Buku::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // 5 Anggota Terbaru
        $anggotaTerbaru = Anggota::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('perpustakaan.dashboard', [
            'totalBuku' => $totalBuku,
            'bukuTersedia' => $bukuTersedia,
            'bukuHabis' => $bukuHabis,
            'totalAnggota' => $totalAnggota,
            'anggotaAktif' => $anggotaAktif,
            'anggotaNonaktif' => $anggotaNonaktif,
            'bukuTerbaru' => $bukuTerbaru,
            'anggotaTerbaru' => $anggotaTerbaru,
        ]);
    }
}
