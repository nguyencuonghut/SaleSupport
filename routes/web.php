<?php

use App\Http\Livewire\AddDepartmentComponent;
use App\Http\Livewire\DashboardComponent;
use App\Http\Livewire\DepartmentComponent;
use App\Http\Livewire\DepartmentDetailComponent;
use App\Http\Livewire\EditDepartmentComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\UserComponent;
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

Route::get('/', HomeComponent::class)->name('home');;
Route::get('admin/departments', DepartmentComponent::class)->name('admin.departments');
Route::get('admin/departments/show/{department_id}', DepartmentDetailComponent::class)->name('admin.show.department');
Route::get('admin/departments/add', AddDepartmentComponent::class)->name('admin.add.department');
Route::get('admin/departments/edit/{department_id}', EditDepartmentComponent::class)->name('admin.edit.department');
Route::get('admin/users', UserComponent::class)->name('admin.users');
