<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/{any?}', function () {
    // '/{any?}' ovo je dodavanje parametra
    //fallback route
    //ovime prebacujemo na vue trazenje ruta sa laravela
    //where('any','^(?!api\/)[\/w\.-]*');
    //znaci da nece da pronadje rute koje krecu sa api
    return view('welcome');
}) -> where('any','^(?!api\/)[\/\w\.-]*');
