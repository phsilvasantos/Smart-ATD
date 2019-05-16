<?php

namespace App\Http\Controllers;

use App\PurchasesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchasesController extends Controller
{
    public function index(){
    $clients =  PurchasesModel::where('company_id', Auth::user()->company_id)->orderBy('created_at', 'desc')->get();
    return view('purchases.list', compact('clients'));
}

    public function new(){
        return view('purchases.new');
    }

    public function store(Request $request){
        $clientData = $request->all();
        $client = new PurchasesModel();
        HomeController::log('Nova Compra:');
        $client->create($clientData);
        $clientEdit = PurchasesModel::orderBy('id', 'desc')->first();
        return redirect()->route('products_purchases.new',['id'=> $clientEdit->id]);

    }

    public function edit($client){
        $clientEdit = PurchasesModel::findOrFail($client);
        return view('purchases.edit', compact('clientEdit'));
    }

    public function view($client){
        $clientEdit = PurchasesModel::findOrFail($client);
        return view('purchases.view', compact('clientEdit'));
    }

    public function update($clientModel){
        $client = PurchasesModel::findOrFail($clientModel);
        $client->status=1;
        HomeController::log('Compra Atualizada:');
        $client->save();
        flash('Compra Inserida!')->success();
        return redirect()->route('purchases.index');
    }

    public function destroy($id){
        $product = PurchasesModel::findOrFail($id);
        HomeController::log('Compra Excluida:');
        $product->delete();
        flash('Compra Excluída!')->success();
        return redirect()->route('purchases.index');
    }
}
