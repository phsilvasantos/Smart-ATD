<?php

namespace App\Http\Controllers;

use App\ProductsPurchasesModel;
use App\PurchasesModel;
use Illuminate\Http\Request;

class ProductsPurchasesController extends Controller
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
        $client = new ProductsPurchasesModel();
        HomeController::log('Adicionado Produto a Compra:');
        $client->create($clientData);
        return redirect()->route('products_purchases.new',['id'=> $idd]);
    }

    public function new($id){
        $clientEdit = PurchasesModel::findOrFail($id);
        if ($clientEdit->status==0){
        return view('products_purchases.new', compact('clientEdit'));
            }else{
            return 'Nota Fechada';
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
        $product = ProductsPurchasesModel::findOrFail($id);
        $idd = $product->purchase_id;
        HomeController::log('Removido Produto da Compra:');
        $product->delete();
        return redirect()->route('products_purchases.new',['id'=> $idd]);
    }
}
