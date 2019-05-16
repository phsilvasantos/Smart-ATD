<?php

namespace App\Http\Controllers;

use App\CashDeskModel;
use App\ClientDebitModel;
use App\ComissaoModel;
use App\MovementModel;
use App\SalesModel;
use Illuminate\View\View;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index(){
        $clients =  SalesModel::where('company_id', Auth::user()->company_id)->orderBy('CREATED_AT', 'desc')->get();
        return view('sales.list', compact('clients'));
    }

    public function new(){
        return view('sales.new');
    }

    public function store(Request $request){
        $clientData = $request->all();
        $client = new SalesModel();
        $client->create($clientData);
        $clientEdit = SalesModel::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->first();
        return redirect()->route('products_sales.new',['id'=> $clientEdit->id]);

    }

    public function edit($client){
        $clientEdit = SalesModel::findOrFail($client);
        return view('sales.edit', compact('clientEdit'));
    }

    public function view($client){
        $clientEdit = SalesModel::findOrFail($client);
        return view('sales.view', compact('clientEdit'));
    }

    public function update(Request $request)
    {

        $caixa = (CashDeskModel::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->where('status',0)->select('id')->first())->id;
        $tipo = $request->tipopagamento;
        $idd = $request->sale_id;
        $company = $request->company_id;
        $desconto = $request->discount;
        foreach (SalesModel::all()->where('id', $idd) as $vv) {
            $clienteid = $vv->client_id;
            $valorA1 = $vv->final_value;
            $valorA2 = str_replace(',', '.', str_replace('.', '', $valorA1));
            $valor = number_format($valorA2 - ($valorA2 * ($desconto / 100)), 2, ',', '.');
        }
        $movement = new MovementModel();
        $comissao = new ComissaoModel();
        $comissao2 = new ComissaoModel();

        if ($tipo == 0) {
            $movement->value = $valor;
            $movement->description = 'Venda em Dinheiro REF: ' . $idd;
            $movement->payment_type = $tipo;
            $movement->company_id = $company;
            $movement->cash_desk_id = $caixa;
            $movement->save();

            $comissao->client_id = $clienteid;
            $comissao->sale_id = $idd;
            $comissao->company_id = $company;
            $comissao->value = $valor;
            $comissao->value = str_replace('.','',$comissao->value);
            $comissao->description = 'Venda em Dinheiro REF: ' . $idd;
            $comissao->user_id = Auth::user()->id;
            $comissao->save();

            //alterar venda
            $client = SalesModel::findOrFail($idd);
            $client->status = 1;
            $client->payment_type = $tipo;
            $client->payment_description = 'Foi Realizado Pagamento em Dinheiro';
            $client->discount = $desconto;
            $client->save();
            //



            flash('Compra Realizada!')->success();
            return redirect()->route('sales.index');
        }
        if ($tipo == 1) {
            $entrada = $request->valor_entrada;
            $qtd_parcelas = $request->qtd_parcelas;
            $client = SalesModel::findOrFail($idd);
            $vl_parcela = number_format(((((str_replace(',', '.', str_replace('.', '', $valor))) - (str_replace(',', '.', str_replace('.', '', $entrada)))) / $qtd_parcelas)), 2, ',', '.');
            for ($i = 1; $i <= $qtd_parcelas; $i++) {
                $cliente = new ClientDebitModel();
                $cliente->value = $vl_parcela;
                $cliente->payment_value = '0,00';
                $cliente->status=0;
                $cliente->sale_id = $idd;
                $cliente->client_id = $clienteid;
                $cliente->company_id = $company;
                $cliente->venc_date =  date('Y-m-d', strtotime('+'.$i.' month'));
                $cliente->save();
            }

            $restante = number_format((str_replace(',', '.', str_replace('.', '', $valor))) - (str_replace(',', '.', str_replace('.', '', $entrada))), 2, ',', '.');

            if ($entrada != '0,00' && $entrada != '0.00') {
                $movementEnt = new MovementModel();
                $movementEnt->value = $entrada;
                $movementEnt->description = 'Entrada Dinheiro da Venda REF: ' . $idd;
                $movementEnt->payment_type = 0;
                $movementEnt->company_id = $company;
                $movementEnt->cash_desk_id = $caixa;
                $movementEnt->save();
                $client->payment_description = 'Entrada de R$ ' . $entrada . ' e R$ ' . $restante . ' em ' . $qtd_parcelas . 'X de ' . number_format(((((str_replace(',', '.', str_replace('.', '', $valor))) - (str_replace(',', '.', str_replace('.', '', $entrada)))) / $qtd_parcelas)), 2, ',', '.') . ' no Crediário ';

                $comissao->client_id = $clienteid;
                $comissao->sale_id = $idd;
                $comissao->company_id = $company;
                $comissao->value = $entrada;
                $comissao->value = str_replace('.','',$comissao->value);
                $comissao->description = 'Entrada Dinheiro da Venda: ' . $idd;
                $comissao->user_id = Auth::user()->id;
                $comissao->save();

            } else {
                $client->payment_description = 'R$ ' . $restante . ' em ' . $qtd_parcelas . 'X de ' . number_format(((((str_replace(',', '.', str_replace('.', '', $valor))) - (str_replace(',', '.', str_replace('.', '', $entrada)))) / $qtd_parcelas)), 2, ',', '.') . ' no Crediário';
            }
            $movement->value = $restante;
            $movement->description = 'Pagamento no Crediário dividido em ' . $qtd_parcelas . 'X de ' . number_format(((((str_replace(',', '.', str_replace('.', '', $valor))) - (str_replace(',', '.', str_replace('.', '', $entrada)))) / $qtd_parcelas)), 2, ',', '.') . ' - Venda REF.: ' . $idd;
            $movement->payment_type = $tipo;
            $movement->company_id = $company;
            $movement->cash_desk_id = $caixa;
            $movement->save();
            //alterar venda
            $client->status = 1;
            $client->payment_type = $tipo;
            $client->discount = $desconto;
            $client->save();
            //

            flash('Compra Realizada!')->success();
            $clientEdit2 = SalesModel::findOrFail($idd);
            return redirect()->route('sales.view', $clientEdit2);

        }
        if ($tipo == 2) {
            $entrada = $request->valor_entrada;
            $bandeira = $request->bandeira;
            $client = SalesModel::findOrFail($idd);
            $restante = number_format((str_replace(',', '.', str_replace('.', '', $valor))) - (str_replace(',', '.', str_replace('.', '', $entrada))), 2, ',', '.');
            if ($entrada != '0,00' && $entrada != '0.00') {
                $movementEnt = new MovementModel();
                $movementEnt->value = $entrada;
                $movementEnt->description = 'Entrada Dinheiro da Venda REF: ' . $idd;
                $movementEnt->payment_type = 0;
                $movementEnt->company_id = $company;
                $movementEnt->cash_desk_id = $caixa;
                $movementEnt->save();

                $comissao2->client_id = $clienteid;
                $comissao2->sale_id = $idd;
                $comissao2->company_id = $company;
                $comissao2->value = $entrada;
                $comissao2->value = str_replace('.','',$comissao2->value);
                $comissao2->description = 'Entrada Dinheiro da Venda: ' . $idd;
                $comissao2->user_id = Auth::user()->id;
                $comissao2->save();

                $client->payment_description = 'Entrada de R$ ' . $entrada . ' e R$ ' . $restante . ' no cartao de debito ' . $bandeira;
            } else {
                $client->payment_description = 'Pago no Débito';
            }

            $movement->value = $restante;
            $movement->description = 'Pagamento em Débito no Cartão ' . $bandeira . ' - Venda REF.: ' . $idd;
            $movement->payment_type = $tipo;
            $movement->company_id = $company;
            $movement->cash_desk_id = $caixa;
            $movement->save();

            $comissao->client_id = $clienteid;
            $comissao->sale_id = $idd;
            $comissao->company_id = $company;
            $comissao->value = $restante;
            $comissao->value = str_replace('.','',$comissao->value);
            $comissao->description = 'Pagamento em Débito no Cartão - Venda REF.: ' . $idd;
            $comissao->user_id = Auth::user()->id;
            $comissao->save();

            //alterar venda

            $client->status = 1;
            $client->payment_type = $tipo;
            $client->discount = $desconto;
            $client->save();
            //
            flash('Compra Realizada!')->success();
            return redirect()->route('sales.index');
        }
        if ($tipo == 3) {
            $qtd_parcelas = $request->qtd_parcelas;
            $entrada = $request->valor_entrada;
            $bandeira = $request->bandeira;
            $client = SalesModel::findOrFail($idd);
            $restante = number_format((str_replace(',', '.', str_replace('.', '', $valor))) - (str_replace(',', '.', str_replace('.', '', $entrada))), 2, ',', '.');
            if ($entrada != '0,00' && $entrada != '0.00') {
                $movementEnt = new MovementModel();
                $movementEnt->value = $entrada;
                $movementEnt->description = 'Entrada Dinheiro da Venda REF: ' . $idd;
                $movementEnt->payment_type = 0;
                $movementEnt->company_id = $company;
                $movementEnt->cash_desk_id = $caixa;
                $movementEnt->save();


                $comissao2->client_id = $clienteid;
                $comissao2->sale_id = $idd;
                $comissao2->company_id = $company;
                $comissao2->value = $entrada;
                $comissao2->value = str_replace('.','',$comissao2->value);
                $comissao2->description = 'Entrada Dinheiro da Venda: ' . $idd;
                $comissao2->user_id = Auth::user()->id;
                $comissao2->save();

                $client->payment_description = 'Entrada de R$ ' . $entrada . ' e R$ ' . $restante . ' em ' . $qtd_parcelas . 'X de ' . number_format(((((str_replace(',', '.', str_replace('.', '', $valor))) - (str_replace(',', '.', str_replace('.', '', $entrada)))) / $qtd_parcelas)), 2, ',', '.') . ' no Cartao ' . $bandeira;
            } else {
                $client->payment_description = 'Pago no Debito';
            }

            $movement->value = $restante;
            $movement->description = 'Pagamento no Cartão de Crédito ' . $bandeira . ' em ' . $qtd_parcelas . 'X de ' . number_format(((((str_replace(',', '.', str_replace('.', '', $valor))) - (str_replace(',', '.', str_replace('.', '', $entrada)))) / $qtd_parcelas)), 2, ',', '.') . ' - Venda REF.: ' . $idd;
            $movement->payment_type = $tipo;
            $movement->cash_desk_id = $caixa;
            $movement->company_id = $company;
            $movement->save();

            $comissao->client_id = $clienteid;
            $comissao->sale_id = $idd;
            $comissao->company_id = $company;
            $comissao->value = $restante;
            $comissao->value = str_replace('.','',$comissao->value);
            $comissao->description = 'Pagamento no Cartão de Crédito - Venda REF: ' . $idd;
            $comissao->user_id = Auth::user()->id;
            $comissao->save();

            //alterar venda

            $client->status = 1;
            $client->payment_type = $tipo;
            $client->discount = $desconto;
            $client->save();
            //
            flash('Compra Realizada!')->success();
            return redirect()->route('sales.index');
        }

        HomeController::log('Movimentação:');
        HomeController::log('Venda Alterada:');
    }


    public function destroy($id){
        $product = SalesModel::findOrFail($id);
        HomeController::log('Venda Excluida:');
        $product->delete();
        flash('Venda Excluída!')->success();
        return redirect()->route('sales.index');
    }

    public function gerarCarne($id){
        $produto = $id;
        $pdf = PDF::loadView('relatorios.carne', compact('produto'))->setPaper('a4', 'portrait');
        return $pdf->stream();

    }


    public function update_info(Request $request)
    {
        $idd = $request->sale_id;
        $client = SalesModel::findOrFail($idd);
        $client->informacoes = $request->informacoes;
        $client->save();
        flash('Informações Adicionais Atualizadas!')->success();
        return redirect()->route('products_sales.new',['id'=> $idd]);
    }

}
