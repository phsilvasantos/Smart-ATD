<?php

namespace App\Http\Controllers;

use App\ProductsModel;
use App\ProductsSalesModel;
use App\SalesModel;
use Illuminate\Http\Request;

class ProductsSalesController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
    }

    public function store(Request $request){
        $clientData = $request->all();
        $idd = $request->purchase_id;
        $vl = str_replace(',','.', str_replace('.','',$request->price)) * str_replace(',','.', $request->qtd);
        HomeController::log('Adicionado Produto a Venda:');
        $client = new ProductsSalesModel();
        $client->create($clientData);

        $client = SalesModel::findOrFail($idd);
        $client->final_value= number_format((str_replace(',','.', str_replace('.','', $client->final_value)) + $vl), 2, ',','.');
        $client->save();
        return redirect()->route('products_sales.new',['id'=> $idd]);
    }

    public function new($id){
        $clientEdit = SalesModel::findOrFail($id);
        if ($clientEdit->status==0){
            return view('products_sales.new', compact('clientEdit'));
        }else{
            return 'Compra Fechada';
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id){
        $product = ProductsSalesModel::findOrFail($id);
        $idd = $product->sale_id;
        HomeController::log('Removido Produto da Venda:');
        $vl = str_replace(',','.', str_replace('.','',$product->price)) * str_replace(',','.', $product->qtd);
        $product->delete();
        $client = SalesModel::findOrFail($idd);
        $final =  number_format((str_replace(',','.', str_replace('.','', $client->final_value)) - $vl), 2, ',','.');
        if ($final==0){
            $final="0,00";
        }
        $client->final_value=$final;
        $client->save();

        return redirect()->route('products_sales.new',['id'=> $idd]);
    }
}
