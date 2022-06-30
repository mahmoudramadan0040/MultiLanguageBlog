<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardSettingController;
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

Route::get('/', function () {
    return view('Dashboard/index');
});

Route::group(['prefix'=>'dashboard','as'=>'dashboard.'], function (){
    Route::get('/settings',function(){
        return view('Dashboard.settings');
    })->name('settings');
    Route::post('/settings/update/{setting}',[DashboardSettingController::class,'update'])->name('settings.update');
    
    
});