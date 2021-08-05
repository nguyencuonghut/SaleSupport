<?php

use App\Http\Livewire\AddDepartmentComponent;
use App\Http\Livewire\AddUserComponent;
use App\Http\Livewire\DashboardComponent;
use App\Http\Livewire\DepartmentComponent;
use App\Http\Livewire\DepartmentDetailComponent;
use App\Http\Livewire\EditDepartmentComponent;
use App\Http\Livewire\EditUserComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ResetPasswordComponent;
use App\Http\Livewire\UserComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function (){
    Route::get('/', HomeComponent::class)->name('home');;
    Route::get('admin/departments', DepartmentComponent::class)->name('admin.departments');
    Route::get('admin/departments/show/{department_id}', DepartmentDetailComponent::class)->name('admin.show.department');
    Route::get('admin/departments/add', AddDepartmentComponent::class)->name('admin.add.department');
    Route::get('admin/departments/edit/{department_id}', EditDepartmentComponent::class)->name('admin.edit.department');
    Route::get('admin/users', UserComponent::class)->name('admin.users');
    Route::get('admin/users/add', AddUserComponent::class)->name('admin.add.user');
    Route::get('admin/users/edit/{user_id}', EditUserComponent::class)->name('admin.edit.user');
    Route::get('admin/users/resetpassword/{user_id}', ResetPasswordComponent::class)->name('admin.resetpassword');
});
