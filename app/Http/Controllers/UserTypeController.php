<?php

namespace App\Http\Controllers;

use App\ModelUserType;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $clients =  ModelUserType::all()->where('company_id', $id);
        return view('users_groups.list', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        return view('users_groups.new', compact('id'));
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
        $clientData = $request->all();
        $dado = $clientData;
        $clientData['crud_cliente'] = (!isset($clientData['crud_cliente']))? 0 : 1;
        $clientData['crud_fornecedor'] = (!isset($clientData['crud_fornecedor']))? 0 : 1;
        $clientData['crud_grupo_produtos'] = (!isset($clientData['crud_grupo_produtos']))? 0 : 1;
        $clientData['crud_produtos'] = (!isset($clientData['crud_produtos']))? 0 : 1;
        $clientData['realizar_venda'] = (!isset($clientData['realizar_venda']))? 0 : 1;
        $clientData['visualizar_venda'] = (!isset($clientData['visualizar_venda']))? 0 : 1;
        $clientData['excluir_venda'] = (!isset($clientData['excluir_venda']))? 0 : 1;
        $clientData['visualizar_compra'] = (!isset($clientData['visualizar_compra']))? 0 : 1;
        $clientData['realizar_compra'] = (!isset($clientData['realizar_compra']))? 0 : 1;
        $clientData['excluir_compra'] = (!isset($clientData['excluir_compra']))? 0 : 1;
        $clientData['gerar_etiqueta'] = (!isset($clientData['gerar_etiqueta']))? 0 : 1;
        $clientData['visualizar_caixa'] = (!isset($clientData['visualizar_caixa']))? 0 : 1;
        $clientData['entrada_saida'] = (!isset($clientData['entrada_saida']))? 0 : 1;
        $clientData['contas_pagar'] = (!isset($clientData['contas_pagar']))? 0 : 1;
        $clientData['contas_receber'] = (!isset($clientData['contas_receber']))? 0 : 1;
        $clientData['debito_cliente'] = (!isset($clientData['debito_cliente']))? 0 : 1;
        $clientData['fluxo_caixa'] = (!isset($clientData['fluxo_caixa']))? 0 : 1;
        $clientData['crud_usuarios'] = (!isset($clientData['crud_usuarios']))? 0 : 1;
        $client = new ModelUserType();
        $client->create($clientData);
        flash('Grupo Cadastrado!')->success();
        return redirect()->route('new_user_all', $dado['company_id']);

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
