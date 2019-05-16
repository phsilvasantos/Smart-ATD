<?php

namespace App\Http\Controllers;

use App\CashDeskModel;
use App\ClientDebitModel;
use App\ClientPaymentModel;
use App\ClientsModel;
use App\ComissaoModel;
use App\MovementModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientDebitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('client_debit.new');
    }

    public function view($cli)
    {
        $client = ClientsModel::findOrFail($cli);
        return view('client_debit.list', compact('client'));
    }

    public function search(Request $request)
    {
        return redirect()->route('debit.view',$request->client_id);
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
    public function store(Request $request, $clientModel)
    {
        $pagar = $request->pagar;
        $client = ClientDebitModel::findOrFail($clientModel);

        $idd = $client->client_id;
        $sale = $client->sale_id;
        $idDeb = $client->id;
        $idEmp = $client->company_id;
        $client->payment_value = HomeController::valor_com(HomeController::valor_sem($client->payment_value)+HomeController::valor_sem($pagar));
        if ($client->value==$client->payment_value){
            $client->status=1;
        }
        HomeController::log('Pagamento de Debito:');
        $client->save();

        $pag = new ClientPaymentModel();
        $pag->value = $pagar;
        $pag->debit_id = $idDeb;
        $pag->company_id = $idEmp;
        HomeController::log('Novo Pagamento:');
        $pag->save();

        $caixa = (CashDeskModel::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->where('status',0)->select('id')->first())->id;
        $movement = new MovementModel();
        $movement->value = $pagar;
        foreach (ClientsModel::all()->where('id', $idd) as $cc){
            $nome = $cc->name;
            $cpf = $cc->cpf;
    }
        $movement->description = 'Pagamento de Débito - Cliente: '.$nome.'-'.$cpf;
        $movement->payment_type = 0;
        $movement->company_id = Auth::user()->company_id;
        $movement->cash_desk_id = $caixa;
        HomeController::log('Movimentação:');
        $movement->save();

        $comissao = new ComissaoModel();
        $comissao->client_id = $idd;
        $comissao->sale_id = $sale;
        $comissao->company_id = Auth::user()->company_id;
        $comissao->value = $pagar;
        $comissao->value = str_replace('.','',$comissao->value);
        $comissao->description = 'Pagamento de Crediário - Venda REF: ' . $sale;
        $comissao->user_id = Auth::user()->id;
        $comissao->save();

        flash('Valor Pago de R$ '.$pagar)->success();
        return redirect()->route('debit.view',$idd);
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
