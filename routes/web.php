<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemInvoiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ContactsImportController;
use App\Http\Controllers\ItemsImportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexConroller;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\GodownController;
use App\Http\Controllers\salesmanController;
use App\Http\Controllers\bankController;
use App\Http\Controllers\purchaseController;
use App\Http\Controllers\purchaseReturnController;
use App\Http\Controllers\saleController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within the "web" middleware group.
|
*/



Route::get("loginForm",[UserController::class,"login"])->name("loginForm");
Route::post('loginSubmit',[UserController::class,"loginSubmit"])->name("loginSubmit");
Route::get('logout',[UserController::class,"logout"])->name("logout");

Route::middleware(['auth'])->group(function () {
    Route::get('/', [indexConroller::class,"index"])->name("home");


    Route::get("bank",[bankController::class,"index"])->name("bank");


    Route::get("party",[PartyController::class,"index"])->name("party");
    Route::post("party/add",[PartyController::class,"add"])->name("party.post");
    Route::get("item",[ItemController::class,"index"])->name("item");
    Route::get("search_items",[ItemController::class,"search"])->name("items.search");
    Route::post("item/add",[ItemController::class,"add"])->name("item.post");
    Route::post("item_invoice/add",[ItemInvoiceController::class,"add"])->name("item.invoice.post");
    Route::post("/addComment",[ItemInvoiceController::class,"addComment"])->name("addComment");


// ==================== AJAX ====================
    Route::get('ajax/get_areas/{city}', [AjaxController::class, 'get_areas']);

    Route::post('ajax/insert_city', [AjaxController::class, 'insert_city'])->name("ajax.insert_city");
    Route::get('ajax/fetch_cities', [AjaxController::class, 'fetch_cities'])->name("ajax.fetch_cities");
    Route::post('ajax/insert_area', [AjaxController::class, 'insert_area'])->name("ajax.insert_area");
    Route::post('ajax/party/id', [AjaxController::class, 'search_party_id'])->name("ajax.party.search.id");
    Route::post('ajax/item/id', [AjaxController::class, 'search_item_id'])->name("ajax.item.search.id");
    Route::post('ajax/item/id/party', [AjaxController::class, 'search_item_id_party'])->name("ajax.item.search.id.party");
    Route::get('ajax/get_item_codes/{party_id}', [AjaxController::class, 'get_item_codes'])->name("ajax.get_item_codes");
    Route::post('ajax/item_invoice/bill_no', [AjaxController::class, 'search_invoice'])->name("ajax.item_invoice.search");
    Route::post('ajax/insert_define_item', [AjaxController::class, 'insert_define_item'])->name("ajax.insert_define_item");
    Route::post('ajax/insert_define_size', [AjaxController::class, 'insert_define_size'])->name("ajax.insert_define_size");
    Route::post('ajax/check_party_mobile', [AjaxController::class, 'check_party_mobile'])->name("ajax.check_party_mobile");
    Route::get('/get-latest-item-id', function () {
        return \App\Models\Item::latest()->value('id');
    })->name('item.latest_id');

    Route::get('/get-item-details', [AjaxController::class, 'getItemDetails'])->name('get.item.details');

// ==================== ADMIN STATIC VIEWS ====================
    Route::get("sales-man",[salesmanController::class, 'index'])->name("sales-man");
    Route::post('addSaleman',[salesmanController::class, 'create'])->name("salesman.create");
    Route::post('ajax/salesman/id', [salesmanController::class, 'search_salesman_id'])->name("ajax.salesman.search.id");

    Route::get('retail-sale-rate', [SettingController::class, 'retail_sale_rate'])->name("retail-sale-rate");
    Route::post('retail-sale-rate/update', [SettingController::class, 'update_retail_sale_rate'])->name("retail-sale-rate.update");
    Route::get('barcode-setting', [SettingController::class, 'barcode'])->name("barcode-setting");
    Route::get('barcode/{size}', [SettingController::class, 'update_barcode'])->name("barcode.update");

    Route::get("bank",[bankController::class, 'index'])->name("bank");
    Route::post('addBank',[bankController::class, 'create'])->name("bank.create");

    Route::get("goddown",[GodownController::class, 'index'])->name("goddown");
    Route::post('addGoddown/', [GodownController::class, 'addGoddown'])->name('addGoddown');
    Route::get('delete_godown/{id}', [GodownController::class, 'delete_godown'])->name('delete_godown');
    Route::get('updateGodown', [GodownController::class, 'updateGodown'])->name('updateGodown');
    Route::get('fetchDefaultValue', [GodownController::class, 'fetchDefaultValue'])->name('fetchDefaultValue');
    Route::post('make_default', [GodownController::class, 'make_default'])->name('make_default');

    /*purchase invoice*/
    Route::get("purchase-invoice",[purchaseController::class,'index'])->name("purchase-invoice");
    Route::get("getItem/{barcode}",[purchaseController::class,'getItem'])->name("ajax.pur_inv.getItem");
    Route::post('ajax/pur_invoice/pur', [purchaseController::class, 'search_invoice'])->name("ajax.pur_invoice.search");
    Route::post("purchase_invoice/add",[purchaseController::class,"add"])->name("purchase.invoice.post");
    Route::post("delete_purchase_item/delete",[purchaseController::class,"delete_item"])->name("ajax.purchase.delete");
    Route::post("recover_purchase_item/recover",[purchaseController::class,"recover_item"])->name("ajax.purchase.recover");
    //Route::get('ajax/pur_g
    //et_areas/{area_id}', [purchaseController::class, 'get_areas']);

    /*purchase return invoice*/
    Route::get("purchase-return-invoice",[purchaseReturnController::class,'index'])->name("purchase-return-invoice");

    //Route::view("sale-invoice","admin.sale-invoice.sale-invoice")->name("sale-invoice");
    Route::get("sale-invoice",[saleController::class,'index'])->name("sale-invoice");

    //Route::get("sale-invoice",[indexConroller::class,"index"])->name("sale-invoice");
    //Route::view("purchase-invoice","admin.purchase-invoice.purchase-invoice")->name("purchase-invoice");
    //Route::get("purchase-invoice",[indexConroller::class,"index"])->name("purchase-invoice");

    Route::view("customer-payment-received","admin.customer-payment-received.customer-payment-received")->name("customer-payment-received");
    Route::view("customer-cheque-post","admin.customer-cheque-post.customer-cheque-post")->name("customer-cheque-post");
    Route::view("party-payment","admin.party-payment.party-payment")->name("party-payment");
    Route::view("party-cheque-post","admin.party-cheque-post.party-cheque-post")->name("party-cheque-post");
    Route::view("stock-navigation-voucher","admin.stock-navigation-voucher.stock-navigation-voucher")->name("stock-navigation-voucher");
    Route::view("stock-adjustment-voucher","admin.stock-adjustment-voucher.stock-adjustment-voucher")->name("stock-adjustment-voucher");
    Route::view("journal-voucher","admin.journal-voucher.journal-voucher")->name("journal-voucher");
    Route::view("search-all-vouchers","admin.search-all-vouchers.search-all-vouchers")->name("search-all-vouchers");
    Route::view("greeting","admin.greeting.greeting")->name("greeting");

    Route::get("city",[CityController::class, 'fetchCity'])->name("city");
    Route::get("deleteCity/{id}",[CityController::class, 'deleteCity'])->name("deleteCity");
    Route::get("updateCity/",[CityController::class, 'updateCity'])->name("updateCity");
    Route::post("addCityForm/",[CityController::class, 'addCityForm'])->name("addCityForm");
    Route::post("updateCityForm/",[CityController::class, 'updateCityForm'])->name("updateCityForm");

    Route::get("area", [AreaController::class, 'index'])->name("area");
    Route::get("deleteArea/{id}", [AreaController::class, 'deleteArea'])->name("deleteArea");
    Route::get("updateArea", [AreaController::class, 'updateArea'])->name("updateArea");
    Route::post("addAreaForm", [AreaController::class, 'addAreaForm'])->name("addAreaForm");
    Route::post("updateAreaForm", [AreaController::class, 'updateAreaForm'])->name("updateAreaForm");

    Route::view("party/import","admin.import.import")->name("party.import");
    Route::post('/party/import/post', [PartyController::class, 'import'])->name('party.import.post');

    Route::get('sync-contacts', function () {
        return view('admin.sync-contacts.index');
    })->name('sync-contacts');
    Route::post('sync-contacts/upload', [ContactsImportController::class, 'import'])->name('sync-contacts.upload');

    Route::get('sync-item', function () {
        return view('admin.sync-item.index');
    })->name('sync-item');
    Route::post('sync-item/upload', [ItemsImportController::class, 'upload'])->name('sync-item.upload');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get("dashboard",[DashboardController::class,"index"]);
    });
});


