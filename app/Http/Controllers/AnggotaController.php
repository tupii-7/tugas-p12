<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class AnggotaController extends Controller
{
    /**
     * Display list of members with search, pagination and sorting
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = Anggota::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('kode_anggota', 'like', "%{$search}%");
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Sorting
        $sortBy = $request->input('sort', 'created_at');
        $sortDir = $request->input('dir', 'desc');
        
        if (in_array($sortBy, ['nama', 'email', 'created_at', 'status'])) {
            $query->orderBy($sortBy, $sortDir);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Pagination
        $anggota = $query->paginate(15)->withQueryString();

        // Statistics
        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'Aktif')->count();
        $anggotaNonaktif = Anggota::where('status', 'Nonaktif')->count();

        return view('perpustakaan.anggota.index', [
            'anggota' => $anggota,
            'totalAnggota' => $totalAnggota,
            'anggotaAktif' => $anggotaAktif,
            'anggotaNonaktif' => $anggotaNonaktif,
        ]);
    }

    public function edit(Anggota $anggota): View
    {
        return view('perpustakaan.anggota.edit', [
            'anggota' => $anggota,
        ]);
    }

    public function update(Request $request, Anggota $anggota): RedirectResponse
    {
        $data = $request->validate([
            'kode_anggota' => [
                'required',
                'max:20',
                Rule::unique('anggota')->ignore($anggota->id),
            ],
            'nama' => 'required|string|max:200',
            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('anggota')->ignore($anggota->id),
            ],
            'telepon' => 'nullable|string|max:30',
            'alamat' => 'nullable|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'pekerjaan' => 'nullable|string|max:100',
            'tanggal_daftar' => 'required|date',
            'status' => 'required|string|in:Aktif,Nonaktif',
        ]);

        $anggota->update($data);

        return redirect('/anggota')->with('success', 'Anggota berhasil diperbarui.');
    }
}
