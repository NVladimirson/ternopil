<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect()->route('companies.index');
});

Auth::routes(
    [
  'register' => false,
  'verify' => true,
  'reset' => false
    ]
);

Route::get('/home', function () {
  return redirect()->route('companies.index');
});

Route::get('/companies/datatable', [CompanyController::class, 'datatable'])->name('companies.datatable');

Route::get('/employees/datatable', [EmployeeController::class, 'datatable'])->name('employees.datatable');

Route::resource('companies', CompanyController::class);

Route::resource('employees', EmployeeController::class);


