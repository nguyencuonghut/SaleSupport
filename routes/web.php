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
use App\Http\Livewire\AddPolicyComponent;
use App\Http\Livewire\AddPriceComponent;
use App\Http\Livewire\AddProductComponent;
use App\Http\Livewire\EditPolicyComponent;
use App\Http\Livewire\EditProductComponent;
use App\Http\Livewire\ImportPriceComponent;
use App\Http\Livewire\PolicyComponent;
use App\Http\Livewire\PriceComponent;
use App\Http\Livewire\ProductComponent;
use App\Http\Livewire\ProductPriceComponent;
use App\Http\Livewire\UserAddOrderComponent;
use App\Http\Livewire\UserPolicyByMonthComponent;
use App\Http\Livewire\UserCartComponent;
use App\Http\Livewire\UserPolicyComponent;
use App\Http\Livewire\UserPolicyDetailComponent;
use App\Http\Livewire\UserPolicyWarningComponent;

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

Route::get('/sendotp', [LoginController::class, 'showOtpForm'])->name('sendotp');
Route::post('/sendotp', [LoginController::class, 'sendOtp'])->name('sendotp');
Route::get('/loginotp', [LoginController::class, 'showloginOtpForm'])->name('showloginotpform');
Route::post('/loginotp', [LoginController::class, 'loginOtp'])->name('loginotp');
//Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
//Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', UserAddOrderComponent::class)->name('user.add.order');
//Route::get('/home', HomeComponent::class)->name('home');

//Employee route
Route::group(['middleware' => 'auth'], function (){
    Route::get('/cart', UserCartComponent::class)->name('user.cart');
    Route::get('/policy/month', UserPolicyByMonthComponent::class)->name('user.policy.month');
    Route::get('/policy/calendar', UserPolicyComponent::class)->name('user.policy.calendar');
    Route::get('/policy/show/{policy_id}', UserPolicyDetailComponent::class)->name('user.show.policy');
    Route::get('/policy/warning', UserPolicyWarningComponent::class)->name('user.policy.warning');
});

//Admin route
Route::group(['middleware' => 'auth'], function (){
    Route::group(['middleware' => 'isAdmin'], function (){
        Route::get('admin/departments', DepartmentComponent::class)->name('admin.departments');
        Route::get('admin/departments/show/{department_id}', DepartmentDetailComponent::class)->name('admin.show.department');
        Route::get('admin/departments/add', AddDepartmentComponent::class)->name('admin.add.department');
        Route::get('admin/departments/edit/{department_id}', EditDepartmentComponent::class)->name('admin.edit.department');
        Route::get('admin/users', UserComponent::class)->name('admin.users');
        Route::get('admin/users/add', AddUserComponent::class)->name('admin.add.user');
        Route::get('admin/users/edit/{user_id}', EditUserComponent::class)->name('admin.edit.user');
        Route::get('admin/users/resetpassword/{user_id}', ResetPasswordComponent::class)->name('admin.resetpassword');
        Route::get('admin/products', ProductComponent::class)->name('admin.products');
        Route::get('admin/products/add', AddProductComponent::class)->name('admin.add.product');
        Route::get('admin/products/edit/{product_id}', EditProductComponent::class)->name('admin.edit.product');
        Route::get('admin/products/show/{product_id}', ProductPriceComponent::class)->name('admin.show.productprice');
        Route::get('admin/prices', PriceComponent::class)->name('admin.prices');
        Route::get('admin/prices/add', AddPriceComponent::class)->name('admin.add.price');
        Route::get('admin/prices/importView', ImportPriceComponent::class)->name('admin.importview.price');
        Route::get('admin/policies', PolicyComponent::class)->name('admin.policies');
        Route::get('admin/policies/add', AddPolicyComponent::class)->name('admin.add.policy');
        Route::get('admin/policies/edit/{policy_id}', EditPolicyComponent::class)->name('admin.edit.policy');



    });
});
