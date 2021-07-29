<?php

use App\Http\Livewire\DashboardComponent;
use App\Http\Livewire\DepartmentComponent;
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
Route::get('/departments', DepartmentComponent::class)->name('admin.departments');
Route::get('/users', UserComponent::class)->name('admin.users');
