<?php

namespace App\Http\Controllers;

use App\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index(){
        $clients =  ProductsModel::where('company_id', Auth::user()->company_id)->orderBy('name', 'ASC')->get();
        return view('products.list', compact('clients'));
    }

    public function new(){
        return view('products.new');
    }

    public function store(Request $request){
        $request['sale_value']= trim($request['sale_value']);
        $request['cost_value']= trim($request['cost_value']);
        $clientData = $request->all();
        $client = new ProductsModel();
        HomeController::log('Novo Produto:');
        $client->create($clientData);
        flash('Novo Produto Cadastrado!')->success();
        return redirect()->route('products.index');
    }

    public function edit($client){
        $clientEdit = ProductsModel::findOrFail($client);
        return view('products.edit', compact('clientEdit'));
    }

    public function view($client){
        $clientEdit = ProductsModel::findOrFail($client);
        return view('products.view', compact('clientEdit'));
    }

    public function update(Request $request, $clientModel){
        $request['sale_value']= trim($request['sale_value']);
        $request['cost_value']= trim($request['cost_value']);
        $clientData = $request->all();
        HomeController::log('Atualização de Produto:');
        $client = ProductsModel::findOrFail($clientModel);
        $client->update($clientData);
        flash('Produto Atualizado!')->success();
        return redirect()->route('products.index');
    }

    public function destroy($id){
        $product = ProductsModel::findOrFail($id);
        HomeController::log('Produto Excluido:');
        $product->delete();
        flash('Produto Excluído!')->success();
        return redirect()->route('products.index');
    }

    public static function pegarProdutos(){
        $dado='';
        foreach(\App\ProductsModel::where('company_id', Auth::user()->company_id)->orderBy('name','asc')->get() as $dd){
            $dado=$dado.'"'.$dd->id.'.'.$dd->code.'.'.$dd->barcode.' | '.$dd->name.' - R$ '.$dd->sale_value.'",';
        }
        $size = strlen($dado);
        $dado=substr($dado,0, $size-1);
        return $dado;
    }
}
