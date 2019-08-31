<?php

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
    return view('front.main');
})->name('urlMain');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/test', function (){
    return "salam ok shod;";
})->name('test');


//==============================================================================
Route::get('/clear-cache', function () {
//    $exitCode = Artisan::call('optimize');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

//==============================================================================


// categories route
Route::get('cat/{name}','CategryController@show')->name('category.show');

//end categories route



//************************************ADMIN ROUTE **********************
Route::middleware(['admin'])->group(function () {
    Route::prefix('admin')->group(function () {
      Route::get('',function (){
          return view('admin.layouts.main');
      });
    });
});


//************************************ END ADMIN ROUTE **********************