<?php

use App\Http\Controllers\LateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\StudentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('/login-auth', [UserController::class, 'loginAuth'])->name('login.auth');


Route::middleware('IsGuest')->group(function(){
    Route::get('/', function () {
        return view('login');
    })->name('login');
});

Route::middleware('IsLogin')->group(function(){

    Route::get('/error404', function(){
        return view('error404');
    });
    // Route::get('/dashboard', function () {  
    // return view('index');
    // })->name('index');
    Route::get('/dashboard', [UserController::class, 'indexSiswa'])->name('index');

    Route::middleware('IsAdmin')->group(function(){
        Route::prefix('user')->name('user.')->group(function(){
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [UserController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
        });

        Route::prefix('rayon')->name('rayon.')->group(function(){
            Route::get('/', [RayonController::class, 'index'])->name('index');
            Route::get('/create', [RayonController::class, 'create'])->name('create');
            Route::post('/store', [RayonController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [RayonController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [RayonController::class, 'update'])->name('update');
        });
    
        Route::prefix('rombel')->name('rombel.')->group(function(){
            Route::get('/',[RombelController::class, 'index'])->name('index');
            Route::get('/create', [RombelController::class, 'create'])->name('create');
            Route::post('/store', [RombelController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [RombelController::class, 'edit'])->name('edit');
            Route::patch('update/{id}', [RombelController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [RombelController::class, 'destroy'])->name('delete');
        });
    
        Route::prefix('student')->name('student.')->group(function(){
            Route::get('/', [StudentsController::class, 'index'])->name('index');
            Route::get('/create', [StudentsController::class, 'create'])->name('create');
            Route::post('/store', [StudentsController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [StudentsController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [StudentsController::class, 'update'])->name('update');
        });
    
        Route::prefix('keterlambatan')->name('keterlambatan.')->group(function(){
            Route::get('/', [LateController::class, 'index'])->name('index');
            Route::get('/create', [LateController::class, 'create'])->name('create');
            Route::post('/store', [LateController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [LateController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [LateController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [LateController::class, 'destroy'])->name('delete');
            Route::get('/show/{id}', [LateController::class, 'show'])->name('show');
            Route::get('/print/{student_id}', [LateController::class, 'print'])->name('print');
            Route::get('/export-excel', [LateController::class, 'exportExcel'])->name('export-excel');
        });
    });

    Route::middleware('IsPembimbing')->group(function(){
        Route::prefix('studentPs')->name('student.')->group(function(){
            Route::get('/', [StudentsController::class, 'index'])->name('indexPs');
            Route::get('/show/{id}', [LateController::class, 'show'])->name('showPs');
        });

        Route::prefix('keterlambatanPs')->name('keterlambatan.')->group(function(){
            Route::get('/', [LateController::class, 'index'])->name('indexPs');
            Route::get('/show/{id}', [LateController::class, 'show'])->name('showPs');
            Route::get('/print/{student_id}', [LateController::class, 'print'])->name('printPs');
            Route::get('/export-excelPs', [LateController::class, 'exportExcel'])->name('export-excelPs');
        });
    });
    
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});