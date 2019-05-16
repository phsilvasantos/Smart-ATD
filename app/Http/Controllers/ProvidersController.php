<?php

namespace App\Http\Controllers;

use App\ProvidersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvidersController extends Controller
{
    public function index(){
        $clients =  ProvidersModel::where('company_id', Auth::user()->company_id)->orderBy('fantasy_name', 'ASC')->get();
        return view('providers.list', compact('clients'));
    }

    public function new(){
        return view('providers.new');
    }

    public function store(Request $request){
        $clientData = $request->all();
        $client = new ProvidersModel();
        HomeController::log('Novo Fornecedor:');
        $client->create($clientData);
        flash('Novo Fornecedor Cadastrado!')->success();
        return redirect()->route('providers.index');
    }

    public function edit($client){
        $clientEdit = ProvidersModel::findOrFail($client);
        return view('providers.edit', compact('clientEdit'));
    }

    public function view($client){
        $clientEdit = ProvidersModel::findOrFail($client);
        return view('providers.view', compact('clientEdit'));
    }

    public function update(Request $request, $clientModel){
        $clientData = $request->all();
        $client = ProvidersModel::findOrFail($clientModel);
        HomeController::log('Fornecedor Atualizado:');
        $client->update($clientData);
        flash('Fornecedor Atualizado!')->success();
        return redirect()->route('providers.index');
    }

    public function destroy($id){
        $product = ProvidersModel::findOrFail($id);
        HomeController::log('Fornecedor Excluido:');
        $product->delete();
        flash('Fornecedor Excluído!')->success();
        return redirect()->route('providers.index');
    }
}
