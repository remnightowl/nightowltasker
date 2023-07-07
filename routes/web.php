<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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
    return view('authentication.index');
})->name('login');
Route::get('/dashboard', [Controller::class, 'dashboard'])->middleware('auth');
Route::get('/newbranch', function () {
    return view('admin.newbranch');
})->middleware('auth');


Route::get('/newuser', [Controller::class, 'newuser'])->middleware('auth');
Route::get('/reports', [Controller::class, 'reports'])->middleware('auth');
Route::get('/newloan', [Controller::class, 'newloan'])->middleware('auth');
Route::get('/typeofrequest', [Controller::class, 'typeofrequest'])->middleware('auth');
Route::get('/loaninformation/{id}', [Controller::class, 'loaninformation'])->middleware('auth');
Route::get('/branchedit/{id}', [Controller::class, 'branchedit'])->middleware('auth');
Route::get('/useredit/{id}', [Controller::class, 'useredit'])->middleware('auth');
Route::get('/overduetasks', [Controller::class, 'overduetasks'])->middleware('auth');
Route::get('/overdueorderouts', [Controller::class, 'overdueorderouts'])->middleware('auth');
Route::get('/userlist', [Controller::class, 'userlist'])->middleware('auth');
Route::get('/branchlist', [Controller::class, 'branchlist'])->middleware('auth');
Route::get('/loanlist', [Controller::class, 'loanlist'])->middleware('auth');
Route::post('addbranch', [Controller::class,'addbranch'])->middleware('auth');
Route::post('editbranch', [Controller::class,'editbranch'])->middleware('auth');
Route::post('edituser', [Controller::class,'edituser'])->middleware('auth');
Route::post('addrequest', [Controller::class,'addrequest'])->middleware('auth');
Route::post('addbranch', [Controller::class,'addbranch'])->middleware('auth');
Route::post('adduser', [Controller::class,'adduser'])->middleware('auth');
Route::post('requestorandcoordinator', [Controller::class,'RequestorAndCoordinator'])->middleware('auth');
Route::post('loanedit', [Controller::class,'loanedit'])->name('loanedit')->middleware('auth');
Route::post('addloan', [Controller::class,'addloan'])->middleware('auth');
Route::post('deleteuser', [Controller::class,'deleteuser'])->middleware('auth');
Route::post('deletebranch', [Controller::class,'deletebranch'])->middleware('auth');
Route::post('/login', [Controller::class,'login']);
Route::post('/logout', [Controller::class,'logout']);
Route::post('/newtask', [Controller::class,'newtask']);
Route::post('/neworderout', [Controller::class,'neworderout']);
Route::post('/branchandtasksmonthly', [Controller::class,'branchandtasksmonthly']);


