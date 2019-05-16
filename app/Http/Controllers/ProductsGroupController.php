<?php

namespace App\Http\Controllers;

use App\ProductsGroupModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsGroupController extends Controller
{
    public function index(){
        $clients =  ProductsGroupModel::where('company_id', Auth::user()->company_id)->orderBy('name', 'ASC')->get();
        return view('products_group.list', compact('clients'));
    }

    public function new(){
        return view('products_group.new');
    }

    public function store(Request $request){
        $clientData = $request->all();
        $client = new ProductsGroupModel();
        HomeController::log('Novo Grupo de Produto:');
        $client->create($clientData);
        flash('Novo Grupo Cadastrado!')->success();
        return redirect()->route('products_group.index');
    }

    public function edit($client){
        $clientEdit = ProductsGroupModel::findOrFail($client);
        return view('products_group.edit', compact('clientEdit'));
    }

    public function update(Request $request, $clientModel){
        $clientData = $request->all();
        $client = ProductsGroupModel::findOrFail($clientModel);
        HomeController::log('Atualização de Grupo de Produto:');
        $client->update($clientData);
        flash('Grupo Atualizado!')->success();
        return redirect()->route('products_group.index');
    }

    public function destroy($id){
        $product = ProductsGroupModel::findOrFail($id);
        HomeController::log('Grupo de Produto Excluido:');
        $product->delete();
        flash('Grupo Excluído!')->success();
        return redirect()->route('products_group.index');
    }
}
