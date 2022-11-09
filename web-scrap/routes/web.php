<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\scrapingController;
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




// routes/web.php





Route::get('/',[scrapingController::class,'scrp']);

//

Route::post('/sheet', [scrapingController::class, 'export_report_sheet'])->name('phone.export');
