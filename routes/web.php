<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PdfHasilLaboratoriumController;
use App\Http\Controllers\PdfMergeController;
use App\Http\Controllers\PdfSuketBebasNarkoba;
use App\Http\Controllers\PdfHasilMCUController;
use App\Http\Controllers\PdfHasilRadiologiController;
use App\Http\Controllers\PdfSuketKesehatanJiwaController;
use App\Http\Controllers\PdfHasilPemeriksaanTreadmillController;
use App\Http\Controllers\TcpdfController;
use App\Http\Controllers\SdsController;
use Illuminate\Support\Facades\Cookie;
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
Route::get('/login', [AuthController::class,'index']);

Route::get('/sds', [SdsController::class, 'auth'])->name('faq.auth.index');
Route::post('/sds', [SdsController::class, 'check'])->name('faq.auth.store');
Route::get('/sds/form', [SdsController::class, 'index'])->name('faq.index');
Route::post('/sds/form', [SdsController::class, 'store'])->name('faq.store');

Route::get('/pdfreportlist', function () {
  return view('main.mcu.reportpdfmcu');
});
Route::post('/listDocumentMCUPDFReport', [PdfController::class, 'listDocumentMCUPDFReport']);


Route::group(["middleware"=>["acl:user"]], function(){
    Route::get('/pdf', function () {
      return view('main.mcu.pdfmcu');
    });
    Route::post('/getRegistrationMCUbyDate', [PdfController::class, 'getRegistrationMCUbyDate']); 
    Route::post('/getRekapSDSbyPeriode', [PdfController::class, 'getRekapSDSbyPeriode']); 
    Route::get('/pdflist', function () {
      return view('main.mcu.pdfmcu');
    });
    
    Route::get('/merge-pdfs', [PdfMergeController::class,'process']);
    Route::get('/pdfview', [PdfMergeController::class, 'pdfview']); 

    Route::get('pdfviewhasillab/{noregistrasi}', [PdfHasilLaboratoriumController::class, 'viewHasilLab']);
    Route::get('pdfsavehasillab/{noregistrasi}', [PdfHasilLaboratoriumController::class, 'saveHasilLab']);

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
    Route::post('/uploadPDFMCU', [PdfController::class, 'uploadPDFMCU']); 


    Route::get('email-test', function(){
      
      $details['email'] = 'muchsin.abdillah@gmail.com';

      dispatch(new App\Jobs\SendEmailJob($details));

      dd('done');
    });
    Route::get('/create/pdf', [TcpdfController::class, 'createPDF'])->name('createPDF');
    Route::get('/tscprinter', [TcpdfController::class, 'tscprinter'])->name('tscprinter');


    Route::get('/rekapsds', function () {
      return view('main.mcu.rekapsds');
    });
    Route::get('/rekapgrafik', function () {
      return view('main.mcu.rekapgrafik');
    });

    Route::get('/getNamaPenjamin/{idgroupjaminan}', [PdfController::class, 'getNamaPenjamin']); 
    Route::post('/getRekap', [PdfController::class, 'getRekap']); 
  });