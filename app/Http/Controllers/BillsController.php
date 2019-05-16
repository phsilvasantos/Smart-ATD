<?php

namespace App\Http\Controllers;

use App\BillsModel;
use App\CashDeskModel;
use App\MovementModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($client)
    {
        if($client=='receive'){
            $clients =  BillsModel::all()->where('company_id', Auth::user()->company_id)->where('type',0);
            return view('bills.list_receive', compact('clients'));
        }else if($client=='pay'){
            $clients =  BillsModel::all()->where('company_id', Auth::user()->company_id)->where('type',1);
            return view('bills.list_pay', compact('clients'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
        return view('bills.new');
    }
    public function create()
    {
    }


    public function store(Request $request)
    {
        $qtd_parcelas = $request->qtd;
        $descricao = $request->description;
        $tipo = $request->type;
        $venc = $request->venc_date;
        $vl = $request->value;
        for ($i = 0; $i < $qtd_parcelas; $i++) {
            $cliente = new BillsModel();
            $cliente->value = $vl;
            $cliente->status=0;
            $cliente->description=$descricao.' - '.($i+1).'-'.$qtd_parcelas;
            $cliente->type=$tipo;
            $cliente->company_id = Auth::user()->company_id;
            $cliente->user_id = Auth::user()->id;
            $cliente->venc_date =  date('Y-m-d', strtotime($venc.'+'.$i.' month'));
            $cliente->pay_date =  $venc;
            HomeController::log('Conta Cadastrada:');
            $cliente->save();
        }
        if($tipo==0){
            flash('Conta a Receber Cadastrada!')->success();
            return redirect()->route('bills.index','receive');
        }else{
            flash('Conta a Pagar Cadastrada!')->success();
            return redirect()->route('bills.index','pay');
        }

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

    public static function test()
    {
        return "data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                                    datasets: [{
            label: 'My First dataset',
                                        data: [20, 59, 0, 81, 56, 55, 40],
                                        backgroundColor: [
                'rgba(255, 0, 0, .2)',
            ],
                                        borderColor: [
                'rgba(255, 0, 0, .7)',
            ],
                                        borderWidth: 2
                                    },
                                        {
                                            label: 'My Second dataset',
                                            data: [28, 48, 40, 19, 86, 27, 90],
                                            backgroundColor: [
                                            'rgba(0, 0, 255, .2)',
                                        ],
                                            borderColor: [
                                            'rgba(0, 0, 255, .7)',
                                        ],
                                            borderWidth: 2
                                        }
                                    ]
                                }";
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
        $client = BillsModel::findOrFail($id);
        HomeController::log('Conta Excluída:'.$client->id.' - '.$client->description.' - '.$client->value);
        $tipo = $client->type;
        $client->delete();
        flash('Conta Excluída!')->success();
        if($tipo==0){
            return redirect()->route('bills.index','receive');
        }else{
            return redirect()->route('bills.index','pay');
        }
    }


    public function pay($clientModel)
    {
        $client = BillsModel::findOrFail($clientModel);
        $client->status=1;
        $client->pay_date=date('Y-m-d');
        $tipo = $client->type;
        if ($tipo==0){
            $pagar = $client->value;
            $desc='Conta Recebida: '.$client->description;
        }else{
            $pagar = '-'.$client->value;
            $desc='Conta Paga: '.$client->description;
        }
        HomeController::log('Conta PagaRecebida:'.$client->id.' - '.$client->description.' - '.$client->value);
        $client->save();
        $caixa = (CashDeskModel::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->where('status',0)->select('id')->first())->id;
        $movement = new MovementModel();
        $movement->value = $pagar;
        $movement->description = $desc;
        $movement->payment_type = 0;
        $movement->company_id = Auth::user()->company_id;
        $movement->cash_desk_id = $caixa;
        $movement->save();

        if ($tipo==0){
            flash('Conta Recebida')->success();
            return redirect()->route('bills.index', 'receive');
        }else{
            flash('Conta Paga')->success();
            return redirect()->route('bills.index', 'pay');
        }

    }
}
