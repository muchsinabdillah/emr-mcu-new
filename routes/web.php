<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PdfMergeController;
use App\Http\Controllers\PdfSuketBebasNarkoba;
use App\Http\Controllers\PdfHasilMCUController;
use App\Http\Controllers\PdfHasilRadiologiController;
use App\Http\Controllers\PdfSuketKesehatanJiwaController;
use App\Http\Controllers\PdfHasilPemeriksaanTreadmillController;
use App\Http\Controllers\TcpdfController;
use setasign\Fpdi\TcpdfFpdi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 
Route::get('/', [AuthController::class,'index']);
Route::get('/logout', [AuthController::class,'logout']);
Route::post('/proses_login', [AuthController::class,'proses_login']);
Route::get('/main', function () {
 
  return view('main.main');
});
Route::get('/login', function () {
  return view('login.login');
});

Route::get('/pdf', function () {
  return view('main.mcu.pdfmcu');
});
Route::get('/pdfreportlist', function () {
  return view('main.mcu.reportpdfmcu');
});
Route::post('/getRegistrationMCUbyDate', [PdfController::class, 'getRegistrationMCUbyDate']); 
Route::get('/pdflist', function () {
  return view('main.mcu.pdfmcu');
});
 
Route::get('/merge-pdfs', [PdfMergeController::class,'process']);
Route::get('/pdfview', [PdfMergeController::class, 'pdfview']); 

Route::get('pdfviewhasillab/{noregistrasi}', [PdfController::class, 'viewHasilLab']);
Route::get('pdfsavehasillab/{noregistrasi}', [PdfController::class, 'saveHasilLab']);

Route::get('pdfviewhasilradiologi/{noregistrasi}', [PdfHasilRadiologiController::class, 'viewHasilRadiolgi']); 
Route::get('pdfsavehasilradiologi/{noregistrasi}', [PdfHasilRadiologiController::class,'saveHasilRadiologi']); 

Route::get('pdfviewhasilmcu/{noregistrasi}', [PdfHasilMCUController::class, 'viewHasilMcu']); 
Route::get('pdfsavehasilmcu/{noregistrasi}', [PdfHasilMCUController::class,'saveHasilMcu']);
 


Route::get('saveSuketJiwa/{noregistrasi}', [PdfSuketKesehatanJiwaController::class,'saveSuketJiwa']);
Route::get('saveBebasNarkoba/{noregistrasi}', [PdfSuketBebasNarkoba::class, 'saveBebasNarkoba']);
Route::get('savePemeriksaanTreadmill/{noregistrasi}', [PdfHasilPemeriksaanTreadmillController::class, 'savePemeriksaanTreadmill']);

// Route::get('pdfviewsuketkesehatanjiwa/{noregistrasi}', [PdfSuketKesehatanJiwaController::class, 'viewSuketJiwa']); 
// Route::get('pdfsavehasilmcu/{noregistrasi}', [PdfSuketKesehatanJiwaController::class,'saveHasilMcu']);
// Route::get('pdfsavehasilmcu/{noregistrasi}', [PdfSuketBebasNarkoba::class,'saveHasilMcu']);

Route::get('/aws', [PdfController::class, 'aws']); 
Route::get('/mergehasilmcu/{noregistrasi}', [PdfController::class, 'mergehasilmcu']); 
Route::post('/listDocumentMCU', [PdfController::class, 'listDocumentMCU']); 
Route::post('/listDocumentMCUPDFReport', [PdfController::class, 'listDocumentMCUPDFReport']); 
Route::post('/uploadPDFMCU', [PdfController::class, 'uploadPDFMCU']); 


Route::get('email-test', function(){
  
  $details['email'] = 'muchsin.abdillah@gmail.com';

  dispatch(new App\Jobs\SendEmailJob($details));

  dd('done');
});
Route::get('/create/pdf', [TcpdfController::class, 'createPDF'])->name('createPDF');
Route::get('/tscprinter', [TcpdfController::class, 'tscprinter'])->name('tscprinter');