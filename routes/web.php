<?php

use App\Models\Buku;
use App\Models\Hki;
use App\Models\Ijazah;
use App\Models\JabatanFungsional;
use App\Models\Kompetensi;
use App\Models\Organisasi;
use App\Models\Pangkat;
use App\Models\Paten;
use App\Models\Prestasi;
use App\Models\Serdos;
use App\Models\Skp;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/export/ijazah/pdf', function () {
    $data = Ijazah::whereHas('user')->where('status', 'diterima')->get();
    $pdf = Pdf::loadView('pdf.ijazah', ['data' => $data]);
    return new Response($pdf->stream('ijazah.pdf'), 200, [
        'Content-Type' => 'application/pdf',
    ]);
})->name('export.ijazah.pdf');
Route::get('/export/buku/pdf', function () {
    $data = Buku::whereHas('user')->where('status', 'diterima')->get();
    $pdf = Pdf::loadView('pdf.buku', ['data' => $data]);
    return new Response($pdf->stream('buku.pdf'), 200, [
        'Content-Type' => 'application/pdf',
    ]);
})->name('export.buku.pdf');

Route::get('/export/hki/pdf', function () {
    $data = Hki::whereHas('user')->where('status', 'diterima')->get();
    $pdf = Pdf::loadView('pdf.hki', ['data' => $data]);
    return new Response($pdf->stream('hki.pdf'), 200, [
        'Content-Type' => 'application/pdf',
    ]);
})->name('export.hki.pdf');

Route::get('/export/fungsional/pdf', function () {
    $data = JabatanFungsional::whereHas('user')->where('status', 'diterima')->get();
    $pdf = Pdf::loadView('pdf.jabatan-fungsional', ['data' => $data]);
    return new Response($pdf->stream('fungsional.pdf'), 200, [
        'Content-Type' => 'application/pdf',
    ]);
})->name('export.fungsional.pdf');

Route::get('/export/kompetensi/pdf', function () {
    $data = Kompetensi::whereHas('user')->where('status', 'diterima')->get();
    $pdf = Pdf::loadView('pdf.kompetensi', ['data' => $data]);
    return new Response($pdf->stream('kompetensi.pdf'), 200, [
        'Content-Type' => 'application/pdf',
    ]);
})->name('export.kompetensi.pdf');

Route::get('/export/prestasi/pdf', function () {
    $data = Prestasi::whereHas('user')->where('status', 'diterima')->get();
    $pdf = Pdf::loadView('pdf.prestasi', ['data' => $data]);
    return new Response($pdf->stream('prestasi.pdf'), 200, [
        'Content-Type' => 'application/pdf',
    ]);
})->name('export.prestasi.pdf');

Route::get('/export/sertifikat/pdf', function () {
    $data = Serdos::whereHas('user')->where('status', 'diterima')->get();
    $pdf = Pdf::loadView('pdf.sertifikat', ['data' => $data]);
    return new Response($pdf->stream('sertifikat.pdf'), 200, [
        'Content-Type' => 'application/pdf',
    ]);
})->name('export.sertifikat.pdf');

Route::get('/export/organisasi/pdf', function () {
    $data = Organisasi::whereHas('user')->where('status', 'diterima')->get();
    $pdf = Pdf::loadView('pdf.organisasi', ['data' => $data]);
    return new Response($pdf->stream('organisasi.pdf'), 200, [
        'Content-Type' => 'application/pdf',
    ]);
})->name('export.organisasi.pdf');

Route::get('/export/pangkat/pdf', function () {
    $data = Pangkat::whereHas('user')->where('status', 'diterima')->get();
    $pdf = Pdf::loadView('pdf.pangkat', ['data' => $data]);
    return new Response($pdf->stream('pangkat.pdf'), 200, [
        'Content-Type' => 'application/pdf',
    ]);
})->name('export.pangkat.pdf');

Route::get('/export/paten/pdf', function () {
    $data = Paten::whereHas('user')->where('status', 'diterima')->get();
    $pdf = Pdf::loadView('pdf.paten', ['data' => $data]);
    return new Response($pdf->stream('paten.pdf'), 200, [
        'Content-Type' => 'application/pdf',
    ]);
})->name('export.paten.pdf');

Route::get('/export/skp/pdf', function () {
    $data = Skp::whereHas('user')->where('status', 'diterima')->get();
    $pdf = Pdf::loadView('pdf.skp', ['data' => $data]);
    return new Response($pdf->stream('skp.pdf'), 200, [
        'Content-Type' => 'application/pdf',
    ]);
})->name('export.skp.pdf');



Route::redirect('/', '/admin/login');
Route::redirect('/pimpinan/login', '/admin/login')->name('login');
