<?php

namespace App\Http\Controllers;

use App\ClientsModel;
use App\ModelCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients =  ClientsModel::where('company_id', Auth::user()->company_id)->orderBy('name', 'ASC')->get();
        return view('clients.list', compact('clients'));

    }

    public function new()
    {
        return view('clients.new');
    }

    public function store(Request $request)
    {
        //

        $clientData = $request->all();
        HomeController::log('Cliente Cadastrado:');
        $client = new ClientsModel();
        $client->create($clientData);
        flash('Novo Cliente Cadastrado!')->success();
        return redirect()->route('clients.index');

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($client)
    {
        $clientEdit = ClientsModel::findOrFail($client);
        return view('clients.edit', compact('clientEdit'));
        //
    }

    public function view($client)
    {
        $clientEdit = ClientsModel::findOrFail($client);
        return view('clients.view', compact('clientEdit'));
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $clientModel){
        $clientData = $request->all();
        HomeController::log('Cliente Excluído:');
        $client = ClientsModel::findOrFail($clientModel);
        $client->update($clientData);

        flash('Cliente Atualizado!')->success();
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = ClientsModel::findOrFail($id);

        HomeController::log('Cliente Excluído:');
        $product->delete();
        flash('Cliente Excluído!')->success();
        return redirect()->route('clients.index');
    }
}
