<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;

Route::get("/", function () {
    return view("welcome");
});

// ========== MAIN ROUTES ==========

// Dashboard Routes
Route::get("/dashboard", [DashboardController::class, "index"]);

// Buku Routes
Route::get("/buku", [BukuController::class, "index"])->name("buku.index");
Route::get("/buku/create", [BukuController::class, "create"])->name("buku.create");
Route::post("/buku", [BukuController::class, "store"])->name("buku.store");
Route::get("/buku/export", [BukuController::class, "export"])->name("buku.export");
Route::get("/buku/{buku}/edit", [BukuController::class, "edit"])->whereNumber("buku")->name("buku.edit");
Route::put("/buku/{buku}", [BukuController::class, "update"])->whereNumber("buku")->name("buku.update");
Route::get("/buku/{buku}", [BukuController::class, "show"])->whereNumber("buku")->name("buku.show");
Route::post("/buku/bulk-delete", [BukuController::class, "bulkDelete"])->name("buku.bulk-delete");

// Anggota Routes
Route::get("/anggota", [AnggotaController::class, "index"]);
Route::get("/anggota/{anggota}/edit", [AnggotaController::class, "edit"])->whereNumber("anggota");
Route::put("/anggota/{anggota}", [AnggotaController::class, "update"])->whereNumber("anggota");
