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
    Route::group(['middleware'=>['LoggedMiddleware']], function(){
        Route::get('/', function(){
            return view('signin')->with('msg','');
        });
        Route::post('/','UserController@signin')->name('user.signin');
    });

    Route::group(['middleware'=>['LoginMiddleware']], function(){
        Route::get("dashboard", "DashboardController@index")->name("dashboard.index");
        Route::get("logout","Logout@logout")->name("logout");
        Route::get('master/store','StoreController@index')->name('store.index');

    Route::get('master/user','UserController@index')->name('user.index');
    Route::get('master/user/add', 'UserController@add')->name('user.add');
    Route::get('master/user/edit/{id}','UserController@edit')->name('user.edit');
    Route::get('master/user/delete/{id}', 'UserController@delete')->name('user.delete');
    Route::get("master/store/edit",'StoreController@edit')->name('store.edit');
    Route::get("inventory/product",'InventoryController@index')->name('inventory.product.index');
    Route::get('inventory/product/add','InventoryController@add')->name('inventory.product.add');
    Route::get('inventory/product/edit/{id}','InventoryController@edit')->name('inventory.product.edit');
    Route::get('inventory/product/delete/{id}',"InventoryController@delete")->name('inventory.product.delete');
    Route::get('inventory/config/currency',"InventoryConfigCurrency@index")->name('inventory.config.currency.index');
    Route::get('inventory/config/currency/add',"InventoryConfigCurrency@add")->name('inventory.config.currency.add');
    Route::get('inventory/config/currency/edit/{id}',"InventoryConfigCurrency@edit")->name('inventory.config.currency.edit');
    Route::get('inventory/config/currency/delete/{id}',"InventoryConfigCurrency@delete")->name('inventory.config.currency.delete');
    Route::get('inventory/config/category',"InventoryConfigCategory@index")->name('inventory.config.category.index');
    Route::get('inventory/config/category/add',"InventoryConfigCategory@add")->name('inventory.config.category.add');
    Route::get('inventory/config/category/edit/{id}',"InventoryConfigCategory@edit")->name('inventory.config.category.edit');
    Route::get('inventory/config/category/delete/{id}',"InventoryConfigCategory@delete")->name('inventory.config.category.delete');
    Route::get('inventory/config/unit',"InventoryConfigUnit@index")->name('inventory.config.unit.index');
    Route::get('inventory/config/unit/add',"InventoryConfigUnit@add")->name('inventory.config.unit.add');
    Route::get('inventory/config/unit/edit/{id}',"InventoryConfigUnit@edit")->name('inventory.config.unit.edit');
    Route::get('inventory/config/unit/delete/{id}',"InventoryConfigUnit@delete")->name('inventory.config.unit.delete');
    Route::get('inventory/config/profit',"InventoryConfigProfit@index")->name('inventory.config.profit.index');
    Route::get('inventory/config/profit/add',"InventoryConfigProfit@add")->name('inventory.config.profit.add');
    Route::get('inventory/config/profit/edit/{id}',"InventoryConfigProfit@edit")->name('inventory.config.profit.edit');
    Route::get('inventory/config/profit/delete/{id}',"InventoryConfigProfit@delete")->name('inventory.config.profit.delete');
    Route::get('inventory/config/stock',"InventoryConfigStock@index")->name('inventory.config.stock.index');
    Route::get('inventory/config/stock/add',"InventoryConfigStock@add")->name('inventory.config.stock.add');
    Route::get('inventory/config/stock/edit/{id}',"InventoryConfigStock@edit")->name('inventory.config.stock.edit');
    Route::get('inventory/config/stock/delete/{id}',"InventoryConfigStock@delete")->name('inventory.config.stock.delete');
    Route::get('inventory/config/ppn/add',"InventoryConfigPPN@add")->name('inventory.config.ppn.add');
    Route::get('inventory/config/ppn/edit/{id}',"InventoryConfigPPN@edit")->name('inventory.config.ppn.edit');
    Route::get('inventory/config/ppn/delete/{id}',"InventoryConfigPPN@delete")->name("inventory.config.ppn.delete");
    Route::get('inventory/config/ingredient',"InventoryConfigIngredient@index")->name('inventory.config.ingredient.index');
    Route::get('inventory/config/ingredient/edit/{id}',"InventoryConfigIngredient@edit")->name('inventory.config.ingredient.edit');
    Route::get('inventory/config/ingredient/add',"InventoryConfigIngredient@add")->name('inventory.config.ingredient.add');
    Route::get('inventory/config/ingredient/delete/{id}',"InventoryConfigIngredient@delete")->name('inventory.config.ingredient.delete');
    Route::get('inventory/income-report',"InventoryIncomeReport@index")->name('inventory.income-item.index');
    Route::get('inventory/outgoing-report',"InventoryOutgoingReport@index")->name('inventory.outgoing-item.index');
    Route::get('inventory/product/stock/add/{id}',"InventoryController@addstock")->name('inventory.product.stock.add');
    Route::get('pos', "PointofSale@index")->name('pos.index');
    Route::get('report',"ReportController@index")->name("report.index");

    Route::post('master/user/update/{id}', 'UserController@update')->name('user.update');
    Route::post('master/user/store', 'UserController@store')->name('user.store');
    Route::post('master/store/update','StoreController@update')->name('store.update');
    Route::post('inventory/product/store','InventoryController@store')->name('inventory.product.store');
    Route::post('inventory/product/update/{id}',"InventoryController@update")->name('inventory.product.update');
    Route::post('inventory/config/currency/store',"InventoryConfigCurrency@store")->name('inventory.config.currency.store');
    Route::post('inventory/config/currency/update/{id}',"InventoryConfigCurrency@update")->name('inventory.config.currency.update');
    Route::post('inventory/config/category/store',"InventoryConfigCategory@store")->name('inventory.config.category.store');
    Route::post('inventory/config/category/update/{id}',"InventoryConfigCategory@update")->name('inventory.config.category.update');
    Route::post('inventory/config/unit/store',"InventoryConfigUnit@store")->name('inventory.config.unit.store');
    Route::post('inventory/config/unit/update/{id}',"InventoryConfigUnit@update")->name('inventory.config.unit.update');
    Route::post("inventory/config/profit/update/{id}","InventoryConfigProfit@update")->name('inventory.config.profit.update');
    Route::post('inventory/config/profit/store',"InventoryConfigProfit@store")->name('inventory.config.profit.store');
    Route::post('inventory/config/stock/store',"InventoryConfigStock@store")->name('inventory.config.stock.store');
    Route::post('inventory/config/stock/update/{id}',"InventoryConfigStock@update")->name('inventory.config.stock.update');
    Route::post('inventory/config/ppn/store',"InventoryConfigPPN@store")->name("inventory.config.ppn.store");
    Route::post('inventory/config/ppn/update/{id}',"InventoryConfigPPN@update")->name('inventory.config.ppn.update');
    Route::post('inventory/config/ingredient/update/{id}',"InventoryConfigIngredient@update")->name('inventory.config.ingredient.update');
    Route::post('inventory/config/ingredient/store',"InventoryConfigIngredient@store")->name('inventory.config.ingredient.store');
    Route::post('inventory/product/data',"InventoryController@data")->name('inventory.product.data');
    Route::post('inventory/product/alldata',"InventoryController@alldata")->name('inventory.product.alldata');
    Route::post('inventory/product/stock/update/{id}',"InventoryController@updatestock")->name('inventory.product.stock.update');
    Route::post('inventory/income-report/date',"InventoryIncomeReport@rangedate")->name('inventory.income-item.date');
    Route::post('inventory/income-report/time',"InventoryIncomeReport@rangetime")->name('inventory.income-item.time');
    Route::post('inventory/income-report/date-time',"InventoryIncomeReport@rangedatetime")->name('inventory.income-item.datetime');
    Route::post('inventory/income-report/alldata',"InventoryIncomeReport@alldata")->name('inventory.income-item.alldata');
    Route::post("inventory/product/barcodedata","InventoryController@barcodedata")->name('inventory.product.barcodedata');
    Route::post("report/store", "ReportController@store")->name("report.store");
    Route::post("inventory/outgoing-report/store","InventoryOutgoingReport@store")->name("inventory.outgoing-item.store");
    Route::post("inventory/outgoing-report/alldata","InventoryOutgoingReport@allData")->name("inventory.outgoing-item.alldata");
    Route::post("inventory/outgoing-report/date", "InventoryOutgoingReport@rangeDate")->name("inventory.outgoing-item.date");
    Route::post("inventory/outgoing-report/time", "InventoryOutgoingReport@rangeTime")->name("inventory.outgoing-item.time");
    Route::post("inventory/outgoing-report/datetime","InventoryOutgoingReport@rangeDateTime")->name("inventory.outgoing-item.datetime");
    Route::post("inventory/product/search", "InventoryController@searchdata")->name("inventory.product.search");
});

