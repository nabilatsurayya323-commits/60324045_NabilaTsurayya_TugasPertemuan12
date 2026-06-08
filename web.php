<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('home');
})->name('home');

// =========================
// DASHBOARD
// =========================
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// =========================
// ANGGOTA
// =========================
Route::resource('anggota', AnggotaController::class);

// =========================
// BUKU - CUSTOM ROUTES
// =========================
Route::get('/buku/search', [BukuController::class, 'search'])
    ->name('buku.search');

Route::get('/buku/kategori/{kategori}', [BukuController::class, 'filterKategori'])
    ->name('buku.kategori');

Route::post('/buku/bulk-delete', [BukuController::class, 'bulkDelete'])
    ->name('buku.bulk-delete');

Route::get('/buku/export', [BukuController::class, 'export'])
    ->name('buku.export');

// =========================
// BUKU RESOURCE ROUTES
// =========================
Route::resource('buku', BukuController::class);

/*
|--------------------------------------------------------------------------
| TESTING BUKU
|--------------------------------------------------------------------------
*/

// List semua buku
// Route::get('/buku', function () {

//     $bukus = Buku::all();

//     $html = '<h1>Daftar Buku</h1>';
//     $html .= '<a href="/buku/create">Tambah Buku</a><br><br>';

//     $html .= '<table border="1" cellpadding="10">';
//     $html .= '
//         <tr>
//             <th>ID</th>
//             <th>Kode</th>
//             <th>Judul</th>
//             <th>Kategori</th>
//             <th>Harga</th>
//             <th>Stok</th>
//             <th>Status</th>
//             <th>Aksi</th>
//         </tr>
//     ';

//     foreach ($bukus as $buku) {

//         $html .= '
//             <tr>
//                 <td>' . $buku->id . '</td>
//                 <td>' . $buku->kode_buku . '</td>
//                 <td>' . $buku->judul . '</td>
//                 <td>' . $buku->kategori . '</td>
//                 <td>' . $buku->harga_format . '</td>
//                 <td>' . $buku->stok . '</td>
//                 <td>' . $buku->status_stok_badge . '</td>
//                 <td>
//                     <a href="/buku/' . $buku->id . '">Detail</a> |
//                     <a href="/buku/' . $buku->id . '/edit">Edit</a>
//                 </td>
//             </tr>
//         ';
//     }

//     $html .= '</table>';

//     return $html;
// });

// // Detail buku
// Route::get('/buku/{id}', function ($id) {

//     $buku = Buku::findOrFail($id);

//     $html = '<h1>Detail Buku</h1>';
//     $html .= '<a href="/buku">Kembali</a><br><br>';

//     $html .= '<table border="1" cellpadding="10">';
//     $html .= '<tr><th>Field</th><th>Value</th></tr>';

//     $html .= '<tr><td>ID</td><td>' . $buku->id . '</td></tr>';
//     $html .= '<tr><td>Kode Buku</td><td>' . $buku->kode_buku . '</td></tr>';
//     $html .= '<tr><td>Judul</td><td>' . $buku->judul . '</td></tr>';
//     $html .= '<tr><td>Kategori</td><td>' . $buku->kategori . '</td></tr>';
//     $html .= '<tr><td>Pengarang</td><td>' . $buku->pengarang . '</td></tr>';
//     $html .= '<tr><td>Penerbit</td><td>' . $buku->penerbit . '</td></tr>';
//     $html .= '<tr><td>Tahun</td><td>' . $buku->tahun_terbit . '</td></tr>';
//     $html .= '<tr><td>ISBN</td><td>' . $buku->isbn . '</td></tr>';
//     $html .= '<tr><td>Harga</td><td>' . $buku->harga_format . '</td></tr>';
//     $html .= '<tr><td>Stok</td><td>' . $buku->stok . '</td></tr>';
//     $html .= '<tr><td>Status Stok</td><td>' . $buku->status_stok_badge . '</td></tr>';
//     $html .= '<tr><td>Label Tahun</td><td>' . $buku->tahun_label . '</td></tr>';
//     $html .= '<tr><td>Tersedia?</td><td>' . ($buku->tersedia ? 'Ya' : 'Tidak') . '</td></tr>';

//     $html .= '</table>';

//     return $html;
// });

// /*
// |--------------------------------------------------------------------------
// | TESTING ANGGOTA
// |--------------------------------------------------------------------------
// */

// // List semua anggota
// Route::get('/anggota', function () {

//     $anggotas = Anggota::all();

//     $html = '<h1>Daftar Anggota</h1>';

//     $html .= '<table border="1" cellpadding="10">';
//     $html .= '
//         <tr>
//             <th>ID</th>
//             <th>Kode</th>
//             <th>Nama</th>
//             <th>Email</th>
//             <th>Umur</th>
//             <th>Status</th>
//             <th>Aksi</th>
//         </tr>
//     ';

//     foreach ($anggotas as $anggota) {

//         $html .= '
//             <tr>
//                 <td>' . $anggota->id . '</td>
//                 <td>' . $anggota->kode_anggota . '</td>
//                 <td>' . $anggota->nama . '</td>
//                 <td>' . $anggota->email . '</td>
//                 <td>' . $anggota->umur . ' tahun</td>
//                 <td>' . $anggota->status_badge . '</td>
//                 <td>
//                     <a href="/anggota/' . $anggota->id . '">Detail</a>
//                 </td>
//             </tr>
//         ';
//     }

//     $html .= '</table>';

//     return $html;
// });

// // Detail anggota
// Route::get('/anggota/{id}', function ($id) {

//     $anggota = Anggota::findOrFail($id);

//     $html = '<h1>Detail Anggota</h1>';
//     $html .= '<a href="/anggota">Kembali</a><br><br>';

//     $html .= '<table border="1" cellpadding="10">';
//     $html .= '<tr><th>Field</th><th>Value</th></tr>';

//     $html .= '<tr><td>Kode Anggota</td><td>' . $anggota->kode_anggota . '</td></tr>';
//     $html .= '<tr><td>Nama</td><td>' . $anggota->nama . '</td></tr>';
//     $html .= '<tr><td>Email</td><td>' . $anggota->email . '</td></tr>';
//     $html .= '<tr><td>Telepon</td><td>' . $anggota->telepon . '</td></tr>';
//     $html .= '<tr><td>Alamat</td><td>' . $anggota->alamat . '</td></tr>';
//     $html .= '<tr><td>Tanggal Lahir</td><td>' . $anggota->tanggal_lahir->format('d-m-Y') . '</td></tr>';
//     $html .= '<tr><td>Umur</td><td>' . $anggota->umur . ' tahun</td></tr>';
//     $html .= '<tr><td>Kategori Usia</td><td>' . $anggota->kategori_usia . '</td></tr>';
//     $html .= '<tr><td>Jenis Kelamin</td><td>' . $anggota->jenis_kelamin . '</td></tr>';
//     $html .= '<tr><td>Pekerjaan</td><td>' . $anggota->pekerjaan . '</td></tr>';
//     $html .= '<tr><td>Tanggal Daftar</td><td>' . $anggota->tanggal_daftar->format('d-m-Y') . '</td></tr>';
//     $html .= '<tr><td>Lama Anggota</td><td>' . $anggota->lama_anggota . ' hari</td></tr>';
//     $html .= '<tr><td>Status</td><td>' . $anggota->status_badge . '</td></tr>';

//     $html .= '</table>';

//     return $html;
// });

// /*
// |--------------------------------------------------------------------------
// | TEST QUERY & SCOPE
// |--------------------------------------------------------------------------
// */

// Route::get('/test-query', function () {

//     $html = '<h1>Testing Query Eloquent</h1>';

//     // Buku tersedia
//     $tersedia = Buku::tersedia()->get();

//     $html .= '<h3>Buku Tersedia</h3><ul>';

//     foreach ($tersedia as $buku) {
//         $html .= '<li>' . $buku->judul . ' (Stok: ' . $buku->stok . ')</li>';
//     }

//     $html .= '</ul>';

//     // Buku terbaru
//     $terbaru = Buku::terbaru()->get();

//     $html .= '<h3>Buku Terbaru</h3><ul>';

//     foreach ($terbaru as $buku) {
//         $html .= '<li>' . $buku->judul . '</li>';
//     }

//     $html .= '</ul>';

//     // Anggota aktif
//     $aktif = Anggota::aktif()->get();

//     $html .= '<h3>Anggota Aktif</h3><ul>';

//     foreach ($aktif as $anggota) {
//         $html .= '<li>' . $anggota->nama . '</li>';
//     }

//     $html .= '</ul>';

//     return $html;
// });

// /*
// |--------------------------------------------------------------------------
// | TEST ACCESSOR & SCOPE
// |--------------------------------------------------------------------------
// */

// Route::get('/test-accessor-scope', function () {

//     $html = '<h1>Testing Accessor & Scope</h1>';

//     // ACCESSOR BUKU
//     $html .= '<h2>Status Stok Buku</h2>';

//     foreach (Buku::all() as $buku) {

//         $html .= "
//             <p>
//                 {$buku->judul} -
//                 {$buku->status_stok_badge} -
//                 {$buku->tahun_label}
//             </p>
//         ";
//     }

//     // SCOPE STOK MENIPIS
//     $html .= '<h2>Buku Stok Menipis</h2>';

//     foreach (Buku::stokMenipis()->get() as $buku) {

//         $html .= "
//             <p>
//                 {$buku->judul} -
//                 Stok: {$buku->stok}
//             </p>
//         ";
//     }

//     // ACCESSOR ANGGOTA
//     $html .= '<h2>Status Anggota</h2>';

//     foreach (Anggota::all() as $anggota) {

//         $html .= "
//             <p>
//                 {$anggota->nama} -
//                 {$anggota->status_badge} -
//                 {$anggota->kategori_usia}
//             </p>
//         ";
//     }

//     // SCOPE TERDAFTAR BULAN INI
//     $html .= '<h2>Anggota Terdaftar Bulan Ini</h2>';

//     foreach (Anggota::terdaftarBulanIni()->get() as $anggota) {

//         $html .= "<p>{$anggota->nama}</p>";
//     }

//     return $html;
// });