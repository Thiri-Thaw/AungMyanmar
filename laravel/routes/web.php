<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccounttypeController;
use App\Http\Controllers\AccountController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    // return auth()->check();
    // if (auth()->check()) {
    //     return view('home');
    // }
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Nilar Lwin sale tables
Route::get('/getselectedCat', [SaleController::class, 'getselectedCat']);
// Route::post('/putSelectedItem', [SaleController::class, 'putSelectedItem'])->name('putselected.item');
// Route::post('/removeSelectedItem', [SaleController::class, 'removeSelectedItem'])->name('removeselected.item');
Route::post('/store-sale', [SaleController::class, 'store'])->name('sale.store');
Route::get('/salelist-view/{id}', [SaleController::class, 'salelist'])->name('salelist.view');
Route::get('/list-sale', [SaleController::class, 'list'])->name('sale.list');
Route::get('/sale', [SaleController::class, 'create'])->name('sale.create');


Auth::routes(['register' => false]);
Route::middleware('admin')->group(function () {
    // Nilar Lwin create table
    Route::get('/customer', [CustomerController::class, 'create'])->name('customer.create');

    Route::get('/user', [UserController::class, 'create'])->name('user.create');

    Route::get('/category', [CategoryController::class, 'create'])->name('category.create');

    Route::get('/item', [ItemController::class, 'create'])->name('item.create');
    Route::get('/company', [CompanyController::class, 'create'])->name('company.create');
    Route::get('/purchase', [PurchaseController::class, 'create'])->name('purchase.create');
    Route::get('/accounttype', [AccounttypeController::class, 'create'])->name('accounttype.create');
    Route::get('/account', [AccountController::class, 'create'])->name('account.create');
    //Nilar Lwin sale tables
    Route::get('/edit-saledetail/{id}', [SaleController::class, 'detailedit'])->name('saledetail.edit');
    Route::post('/update-saledetail/{id}', [SaleController::class, 'updatedetail'])->name('saledetail.update');
    Route::get('/saletrash-list', [SaleController::class, 'trashsale'])->name('saletrash.list');
    Route::post('/update-sale/{id}', [SaleController::class, 'update'])->name('sale.update');
    Route::get('/edit-sale/{id}', [SaleController::class, 'edit'])->name('sale.edit');
    Route::get('/delete-sale/{id}', [SaleController::class, 'destroy'])->name('sale.delete');
    Route::get('/saletrash-listdetail/{id}', [SaleController::class, 'trashsaledetail'])->name('trashsalelist.detail');
    Route::get('/saletrash-restore/{id}', [SaleController::class, 'trashsalerestore'])->name('trashsale.restore');
    //Nilar Lwin category tables
    Route::post('/store-category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/edit-category', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/delete-category/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

    //Nilar Lwin item tables
    Route::post('/store-item', [ItemController::class, 'store'])->name('item.store');
    Route::get('/edit-item/{id}', [ItemController::class, 'edit'])->name('item.edit');
    Route::post('/edit-item', [ItemController::class, 'update'])->name('item.update');
    Route::get('/delete-item/{id}', [ItemController::class, 'destroy'])->name('item.delete');

    //Nilar Lwin company tables
    Route::post('/store-company', [CompanyController::class, 'store'])->name('company.store');
    Route::get('/edit-company/{id}', [CompanyController::class, 'edit'])->name('company.edit');
    Route::post('/edit-company', [CompanyController::class, 'update'])->name('company.update');
    Route::get('/delete-company/{id}', [CompanyController::class, 'destroy'])->name('company.delete');

    // Nilar Lwin accounttype tables
    Route::post('/store-accounttype', [AccounttypeController::class, 'store'])->name('accounttype.store');
    Route::get('/edit-accounttype/{id}', [AccounttypeController::class, 'edit'])->name('accounttype.edit');
    Route::post('/edit-accounttype', [AccounttypeController::class, 'update'])->name('accounttype.update');
    Route::get('/delete-accounttype/{id}', [AccounttypeController::class, 'destroy'])->name('accounttype.delete');

    // Nilar Lwin account tables
    Route::post('/store-account', [AccountController::class, 'store'])->name('account.store');
    Route::get('/edit-account/{id}', [AccountController::class, 'edit'])->name('account.edit');
    Route::post('/edit-account', [AccountController::class, 'update'])->name('account.update');
    Route::get('/delete-account/{id}', [AccountController::class, 'destroy'])->name('account.delete');


    // From Date To Date Searching

    // Aung Min Khant
    Route::get('/list-users', [UserController::class, 'list'])->name('user.list');
    Route::get('/detail-company', [CompanyController::class, 'detail'])->name('companydetail.get');
    Route::get('/list-customers', [CustomerController::class, 'list'])->name('customer.list');
    Route::get('/list-category', [CategoryController::class, 'list'])->name('category.list');
    Route::get('/list-item', [ItemController::class, 'list'])->name('item.list');
    Route::get('/getselectedItem', [SaleController::class, 'getSelectedItem'])->name('getselected.item');
    Route::get('/list-purchase', [PurchaseController::class, 'list'])->name('purchase.list');
    Route::get('/list-purchase/{id}', [PurchaseController::class, 'listDetail'])->name('purchase.list.detail');
    Route::post('/list-purchase-item', [PurchaseController::class, 'detail'])->name('purchaseitem.get');
    Route::get('/list-account', [AccountController::class, 'list'])->name('account.list');
    Route::post('/add-user', [UserController::class, 'add'])->name('user.add');
    Route::post('/add-customer', [CustomerController::class, 'add'])->name('customer.add');
    Route::post('/get-user', [UserController::class, 'get'])->name('user.get');
    Route::get('/get-customer', [CustomerController::class, 'get'])->name('customer.get');
    Route::post('/get-customer', [CustomerController::class, 'getDatail'])->name('customer.getDetail');
    Route::get('/get-datatable', [UserController::class, 'getDataTable'])->name('user.gettable');
    Route::post('/edit-user', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/edit-customer', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('/delete-user', [UserController::class, 'delete'])->name('user.delete');
    Route::post('/delete-customer', [CustomerController::class, 'delete'])->name('customer.delete');
    Route::get('/delete-purchase-voucher/{id}', [PurchaseController::class, 'deleteVoucher'])->name('purchse.delete');
    Route::get('/restore-purchase-voucher/{id}', [PurchaseController::class, 'retoreVoucher'])->name('purchse.restore');
    Route::get('/getselectedPurchaseItem', [PurchaseController::class, 'getSelectedItem'])->name('getpurchaseselected.item');
    Route::post('/putSelectedItem', [PurchaseController::class, 'putSelectedItem'])->name('putselected.item');
    Route::post('/removeSelectedItem', [PurchaseController::class, 'removeSelectedItem'])->name('removeselected.item');
    Route::post('/removeSelectedItemEdit', [PurchaseController::class, 'removeSelectedItemEdit'])->name('removeselectededit.item');
    Route::post('/add-purchase', [PurchaseController::class, 'add'])->name('add.purchase');
    Route::post('/selected-item-qty', [PurchaseController::class, 'selectedItemQty'])->name('selected-item-qty.get');
    Route::post('/selected-item-price', [PurchaseController::class, 'selectedItemPrice'])->name('selected-item-price.get');
    Route::post('/editpurchase', [PurchaseController::class, 'editView'])->name('editpurchaseitem.editview');
    Route::post('/editpurchaseitem', [PurchaseController::class, 'edit'])->name('editpurchaseitem.edit');
    Route::post('/edit-purchase-voucher', [PurchaseController::class, 'storeEditVoucher'])->name('purchasevoucher.edit');
    Route::get('/edit-purchase-voucher/{id}', [PurchaseController::class, 'editVoucher'])->name('editpurchasevoucher.edit');
    Route::get('/trash-purchase', [PurchaseController::class, 'trash'])->name('purchase.trash');
    Route::get('/notiread/{id}', [PurchaseController::class, 'read'])->name('noti.read');
    Route::get('/inventory', [App\Http\Controllers\InventoryController::class, 'list'])->name('inventory.list');
    Route::post('/inventory-get-item-by-date', [App\Http\Controllers\InventoryController::class, 'getItemByDate'])->name('inventory.get_item_by_date');
    Route::get('/inventory-get-item', [App\Http\Controllers\InventoryController::class, 'getItem'])->name('inventory.get_item');
    Route::get('/print-purchase-list/{id}', [App\Http\Controllers\PrintController::class, 'printPurchaseList'])->name('print.purchaselist');
    Route::get('/print-sale-list/{id}', [App\Http\Controllers\PrintController::class, 'printSaleList'])->name('print.salelist');
    // report route
    Route::get('report', [App\Http\Controllers\ReportController::class, 'Create'])->name('report');
});