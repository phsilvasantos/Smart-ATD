<?php

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



Route::group(['middleware'=>['auth']], function () {

        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/teste', 'ProductsController@pegarProdutos');

        Route::get('clients', 'ClientsController@index')->name('clients.index');
        Route::get('clients/new', 'ClientsController@new')->name('clients.new');
        Route::post('clients/store', 'ClientsController@store')->name('clients.store');
        Route::post('clients/update/{clientModel}', 'ClientsController@update')->name('clients.update');
        Route::get('clients/edit/{client}', 'ClientsController@edit')->name('clients.edit');
        Route::get('clients/view/{client}', 'ClientsController@view')->name('clients.view');
        Route::get('clients/remove/{id}', 'ClientsController@destroy')->name('clients.remove');

        Route::get('providers', 'ProvidersController@index')->name('providers.index');
        Route::get('providers/new', 'ProvidersController@new')->name('providers.new');
        Route::post('providers/store', 'ProvidersController@store')->name('providers.store');
        Route::post('providers/update/{clientModel}', 'ProvidersController@update')->name('providers.update');
        Route::get('providers/edit/{client}', 'ProvidersController@edit')->name('providers.edit');
        Route::get('providers/view/{client}', 'ProvidersController@view')->name('providers.view');
        Route::get('providers/remove/{id}', 'ProvidersController@destroy')->name('providers.remove');

        Route::get('products_group', 'ProductsGroupController@index')->name('products_group.index');
        Route::get('products_group/new', 'ProductsGroupController@new')->name('products_group.new');
        Route::post('products_group/store', 'ProductsGroupController@store')->name('products_group.store');
        Route::post('products_group/update/{clientModel}', 'ProductsGroupController@update')->name('products_group.update');
        Route::get('products_group/edit/{client}', 'ProductsGroupController@edit')->name('products_group.edit');
        Route::get('products_group/remove/{id}', 'ProductsGroupController@destroy')->name('products_group.remove');

        Route::get('products', 'ProductsController@index')->name('products.index');
        Route::get('products/new', 'ProductsController@new')->name('products.new');
        Route::post('products/store', 'ProductsController@store')->name('products.store');
        Route::post('products/update/{clientModel}', 'ProductsController@update')->name('products.update');
        Route::get('products/edit/{client}', 'ProductsController@edit')->name('products.edit');
        Route::get('products/view/{client}', 'ProductsController@view')->name('products.view');
        Route::get('products/remove/{id}', 'ProductsController@destroy')->name('products.remove');

        Route::get('purchases', 'PurchasesController@index')->name('purchases.index');
        Route::get('purchases/new', 'PurchasesController@new')->name('purchases.new');
        Route::post('purchases/store', 'PurchasesController@store')->name('purchases.store');
        Route::get('purchases/update/{clientModel}', 'PurchasesController@update')->name('purchases.update');
        Route::get('purchases/view/{client}', 'PurchasesController@view')->name('purchases.view');
        Route::get('purchases/remove/{id}', 'PurchasesController@destroy')->name('purchases.remove');

        Route::get('products_purchases/new/{id}', 'ProductsPurchasesController@new')->name('products_purchases.new');
        Route::post('products_purchases/store', 'ProductsPurchasesController@store')->name('products_purchases.store');
        Route::get('products_purchases/remove/{id}', 'ProductsPurchasesController@destroy')->name('products_purchases.remove');

        Route::get('ticket', 'TicketController@index')->name('ticket.index');
        Route::post('pdf', 'TicketController@gerar')->name('pdf');

        Route::get('sales', 'SalesController@index')->name('sales.index');
        Route::get('sales/new', 'SalesController@new')->name('sales.new');
        Route::post('sales/store', 'SalesController@store')->name('sales.store');
        Route::post('sales/update', 'SalesController@update')->name('sales.update');
        Route::get('sales/view/{client}', 'SalesController@view')->name('sales.view');
        Route::get('sales/remove/{id}', 'SalesController@destroy')->name('sales.remove');
        Route::get('sales/carne/{id}', 'SalesController@gerarCarne')->name('sales.carne');

        Route::get('comission', 'ComissaoController@index')->name('comission.index');
        Route::post('comission/view', 'ComissaoController@view')->name('comission.view');

        Route::get('products_sales/new/{id}', 'ProductsSalesController@new')->name('products_sales.new');
        Route::post('products_sales/store', 'ProductsSalesController@store')->name('products_sales.store');
        Route::post('products_sales/update_info', 'SalesController@update_info')->name('products_sales.update_info');
        Route::get('products_sales/remove/{id}', 'ProductsSalesController@destroy')->name('products_sales.remove');

        Route::get('debit', 'ClientDebitController@index')->name('debit.index');
        Route::post('debit/search', 'ClientDebitController@search')->name('debit.search');
        Route::get('debit/list/{cli}', 'ClientDebitController@view')->name('debit.view');
        Route::post('clients/pay/{clientModel}', 'ClientDebitController@store')->name('debit.pay');

        Route::get('cash_desk', 'CashDeskController@index')->name('cash_desk.index');
        Route::get('cash_desk/open', 'CashDeskController@new')->name('cash_desk.new');
        Route::post('cash_desk/store', 'CashDeskController@store')->name('cash_desk.store');
        Route::get('cash_desk/close', 'CashDeskController@close')->name('cash_desk.close');
        Route::get('cash_desk/close_confirm', 'CashDeskController@close_confirm')->name('cash_desk.close_confirm');

        Route::get('movements/{client}', 'MovementController@index')->name('movements.index');
        Route::get('movements/', 'MovementController@indexsem')->name('movements.indexsem');

        Route::get('in_out', 'InOutController@index')->name('inout.index');
        Route::get('in_out/new', 'InOutController@new')->name('inout.new');
        Route::post('in_out/store', 'InOutController@store')->name('inout.store');

        Route::get('bills/list/{client}', 'BillsController@index')->name('bills.index');
        Route::post('bills/store', 'BillsController@store')->name('bills.store');
        Route::get('bills/new', 'BillsController@new')->name('bills.new');
        Route::get('bills/resolve/{clientModel}', 'BillsController@pay')->name('bills.pay');
        Route::get('bills/remove/{id}', 'BillsController@destroy')->name('bills.remove');
        Route::get('test', 'CashDeskController@teste');

    Route::get('users', 'UsersController@index')->name('users.index');
    Route::get('users_all/{id}', 'UsersController@index_all')->name('users.indexall');
    Route::get('users/new', 'UsersController@new')->name('users.new');
    Route::get('users/disable/{id}', 'UsersController@desativar')->name('users.disable');
    Route::get('users/enable/{id}', 'UsersController@ativar')->name('users.enable');

    Route::get('company', 'CompanyController@index')->name('company.index');
    Route::get('company/new', 'CompanyController@create')->name('company.new');
    Route::post('company/store', 'CompanyController@store')->name('company.store');
    Route::post('company/update/{clientModel}', 'CompanyController@update')->name('company.update');
    Route::get('company/edit/{client}', 'CompanyController@edit')->name('company.edit');
    Route::get('company/view/{id}', 'CompanyController@view')->name('company.view');

    Route::get('groups/{id}', 'UserTypeController@index')->name('groups.index');
    Route::get('groups/new/{id}', 'UserTypeController@create')->name('groups.new');
    Route::post('groups/store', 'UserTypeController@store')->name('groups.store');


    Route::post('exam/store', 'ExamEyeController@store')->name('exam.store');
    Route::get('exam/remove/{id}', 'ExamEyeController@destroy')->name('exam.remove');

    Route::get('reports/clients', 'ReportsController@clientsAll')->name('reports.clients');
    Route::get('reports/products', 'ReportsController@productsAll')->name('reports.products');
    Route::get('reports/providers', 'ReportsController@providersAll')->name('reports.providers');
    Route::get('reports/products_groups', 'ReportsController@products_groupsAll')->name('reports.products_groups');
    Route::get('reports/sales', 'ReportsController@salesAll')->name('reports.sales');
    Route::get('reports/purchases', 'ReportsController@purchasesAll')->name('reports.purchases');
    Route::get('reports/contrato/{id}', 'ReportsController@contrato')->name('reports.contrato');
    Route::get('reports/sale/{id}', 'ReportsController@sale')->name('reports.sale');
    Route::get('reports/purchase/{id}', 'ReportsController@purchase')->name('reports.purchase');
    Route::get('reports/provider/{id}', 'ReportsController@provider')->name('reports.provider');
    Route::get('reports/cash/{id}', 'ReportsController@cash')->name('reports.cash');
    Route::get('reports/client/{id}', 'ReportsController@client')->name('reports.client');

    Route::get('boleto', 'BoletoController@bradesco')->name('boleto.bradesco');

    Route::get('licensing', 'LicensingController@index')->name('licensing.index');
    Route::get('expired', 'LicensingController@expired')->name('licensing.expired');
    Route::get('licensing/{id}', 'LicensingController@all')->name('licensing.all');
    Route::post('licensing/update/{id}', 'LicensingController@update')->name('licensing.update');

    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('new_user/{id}', function ($id) {
        if(\Illuminate\Support\Facades\Auth::user()->id==1){
            return view('auth.register', compact('id'));
        }else{
            return 'Sem Acesso';
        }
    })->name('new_user_all');

});

Route::get('/cache', function() {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return $exitCode;
});

Auth::routes();
