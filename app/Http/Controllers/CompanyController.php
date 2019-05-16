<?php

namespace App\Http\Controllers;

use App\ModelCompany;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients =  ModelCompany::all();
        return view('company.list', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.new');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $file = $request->file('logo');
        $newName = str_replace('.'.$file->getClientOriginalExtension() , '' , strtolower( preg_replace('/[ -]+/' , '_' , strtr(utf8_decode(trim($file->getClientOriginalName())), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")) )).'_'.uniqid().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('files'), $newName);
        $clientData = new ModelCompany();
        $clientData->logo = $newName;
        $clientData->name = $request->name;
        $clientData->razao = $request->razao;
        $clientData->cep = $request->cep;
        $clientData->uf = $request->uf;
        $clientData->service = $request->service;
        $clientData->bairro = $request->bairro;
        $clientData->address = $request->address;
        $clientData->city = $request->city;
        $clientData->cnpj = $request->cnpj;
        HomeController::log('Nova Empresa:');
        $clientData->save();
        $empresa = ModelCompany::orderBy('id', 'desc')->first();
        flash('Empresa Cadastrada!')->success();
        return redirect()->route('groups.new', $empresa->id);
    }

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
        $clientEdit = ModelCompany::findOrFail($client);
        return view('company.edit', compact('clientEdit'));
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
        $client = ModelCompany::findOrFail($clientModel);
        $client->update($clientData);
        flash('Empresa Atualizada Atualizada!')->success();
        return redirect()->route('company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public static function view($id)
    {
        $client = ModelCompany::findOrFail($id);
        flash()->overlay('<div style="width: 100%" align="center"><img src="'. asset('files/'.$client->logo) .'" width="100px"></div><br><strong>Razão Social: </strong>'.$client->razao
            .'<br><strong>CPNJ: </strong>'.$client->cnpj
            .'<br><strong>Ramo: </strong>'.$client->service
            .'<br><strong>Endereço: </strong>'.$client->address.', '.$client->bairro.', '.$client->city.', '.$client->uf
                .'<br><strong>CEP: </strong>'.$client->cep.'<br><br><div style="width: 100%" align="center"><a class="btn btn-primary" href="'.route('company.edit', $client->id) .'">Editar Dados</a></div>'
            , $client->name);
        $clients =  ModelCompany::all();
        return view('company.list', compact('clients'));
    }
}
