<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\POSController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\AddonsController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\Vending_maController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\IteamCategoryController;


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
    return view('welcome');
});
Auth::routes();
//home page
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Dashboard page
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//inventory page
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
Route::get('/inventory/search', [InventoryController::class, 'search'])->name('inventory.search');

//Suppliers page
Route::get('/suppliers', [SuppliersController::class, 'index'])->name('suppliers');
Route::post('/suppliers', [SuppliersController::class, 'store'])->name('suppliers.store');
Route::get('suppliers/destroy/{Sup_id}', [SuppliersController::class, 'destroy']);
Route::patch('/suppliers_update/{Sup_id}', [SuppliersController::class, 'update'])->name('suppliers.update');
Route::get('/suppliers/search', [SuppliersController::class, 'search'])->name('suppliers.search');

//Items page
Route::get('/items', [ItemsController::class, 'index'])->name('items');
Route::post('/items', [ItemsController::class, 'store'])->name('items.store');
Route::get('items/destroy/{Item_id}', [ItemsController::class, 'destroy']);
Route::get('/items/search', [ItemsController::class, 'search'])->name('items.search');
Route::patch('/items_update/{Item_id}', [ItemsController::class, 'update'])->name('items.update');
//Sales page
Route::get('/sales', [SalesController::class, 'index'])->name('sales');

//Order page
Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
Route::post('/orders', [OrdersController::class, 'store'])->name('orders.store');
Route::get('orders/destroy/{Order_Info_id}', [OrdersController::class, 'destroy']);
Route::get('/orders/search', [OrdersController::class, 'search'])->name('orders.search');

//orders page
Route::get('/pos', [POSController::class, 'index'])->name('pos');
Route::post('/pos/store', [PosController::class, 'store'])->name('pos.store');
//Report page
Route::get('/reports', [ReportsController::class, 'index'])->name('reports');

//accounts page
Route::get('/accounting', [AccountingController::class, 'index'])->name('accounting');

//settings page
Route::get('/setting', [SettingController::class, 'index'])->name('setting');

//products page
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
Route::get('products/destroy/{Pro_id}', [ProductsController::class, 'destroy']);
Route::get('/products/search', [ProductsController::class, 'search'])->name('products.search');
Route::patch('/products/{Pro_id}', [ProductsController::class, 'update'])->name('products.update');

//add-ons page
Route::get('/add-ons', [AddonsController::class, 'index'])->name('add-ons');
Route::post('/add-ons', [AddonsController::class, 'store'])->name('add-ons.store');
Route::get('add-ons/destroy/{Addons_id}', [AddonsController::class, 'destroy']);
Route::get('/add-ons/search', [AddonsController::class, 'search'])->name('add-ons.search');
Route::patch('/add-ons/{Addons_id}', [AddonsController::class, 'update'])->name('add-ons.update');

//register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

//User edit
Route::patch('/profile/{U_id}', [UserController::class, 'update'])->name('home.update');
Route::post('/setting/update', [ModuleController::class, 'update'])->name('setting.update');

//shop
Route::post('/setting', [SettingController::class, 'store'])->name('setting.store');
Route::patch('/setting/{S_id}', [SettingController::class, 'update'])->name('setting.update');


Route::post('/setting/location', [SettingController::class, 'location'])->name('setting.location');

Route::post('/setting/user', [SettingController::class, 'user'])->name('setting.user');
//add category items on setting
Route::post('/setting/category', [SettingController::class, 'category'])->name('setting.category');
Route::post('/setting/product_cate', [SettingController::class, 'product_cate'])->name('setting.product_cate');
Route::post('/setting/expense_cate', [SettingController::class, 'expense_cate'])->name('setting.expense_cate');
Route::post('/setting/uom', [SettingController::class, 'uom'])->name('setting.uom');

//Edit product ingredients
Route::patch('/setting/test/{Pro_id}', [SettingController::class, 'updateIngredients'])->name('setting.updateIngredients');
//edit user setting
Route::patch('/setting/user/{U_id}', [SettingController::class, 'updateUser'])->name('setting.updateUser');

//expense
Route::get('/expense', [ExpenseController::class, 'index'])->name('expense');
Route::post('/setting/expense', [SettingController::class, 'createIng'])->name('setting.createIng');

