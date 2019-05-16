<?php

namespace App\Http\Controllers;

use App\CashDeskModel;
use App\MovementModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Array_;

class CashDeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $clients =  CashDeskModel::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->get();
        return view('cash_desk.list', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function new()
    {
        $client = CashDeskModel::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->first();
        if($client->status==0){
            flash('Já Existe um Caixa Aberto!')->error();
            return $this->index();
        }else{
            flash('É necessário incialmente realizar a abertura de caixa!')->warning();
            return view('cash_desk.open', compact('client'));
        }
    }

    public function close()
    {
        $clients = CashDeskModel::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->where('status',0)->first();
        return view('cash_desk.close', compact('clients'));
    }
    public function close_confirm()
    {
        $caixa = CashDeskModel::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->where('status',0)->first();
        $dinheiro=0.00;

        foreach (\App\MovementModel::all()->where('cash_desk_id', $caixa->id) as $caix){
            $valor = str_replace(',','.',str_replace('.','',$caix->value));
            if($caix->payment_type==0){
                $dinheiro = $dinheiro+$valor;
            }
        }
        $caixa->close_value=number_format($dinheiro,2,',','.');
        $caixa->status=1;
        $caixa->close_user_id=Auth::user()->id;
        HomeController::log('Caixa Fechado:');
        $caixa->save();

        flash('Caixa Fechado com Sucesso!')->success();
        $client = CashDeskModel::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->first();

        return redirect()->route('cash_desk.new');
    }

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
    public function store(Request $request)
    {
        $clientData = $request->all();
        $valor = $request->open_value;
        $client = new CashDeskModel();
        $client->create($clientData);
        HomeController::log('Caixa Aberto:');

        $caixa = (CashDeskModel::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->where('status',0)->select('id')->first())->id;
        $movement = new MovementModel();
        $movement->value = $valor;
        $movement->description = 'Abertura de Caixa';
        $movement->payment_type = 0;
        $movement->company_id = Auth::user()->company_id;
        $movement->cash_desk_id = $caixa;
        HomeController::log('Movimentação:');
        $movement->save();

        flash('Caixa Aberto com Sucesso!')->success();
        return redirect()->route('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function firstCash(){
        $caixa = new CashDeskModel();
        $caixa->open_value='0,00';
        $caixa->close_value='0,00';
        $caixa->status=1;
        $caixa->open_user_id=Auth::user()->id;
        $caixa->close_user_id=Auth::user()->id;
        $caixa->company_id=Auth::user()->company_id;
        HomeController::log('Primeiro Caixa:');
        $caixa->save();

    }
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

    public static function pegarUltimasVendasDinheiro(){

        $dados = '';
            $dinheiro=0.00;
            $i=0;
            $valorIni=0.00;
        foreach (\App\CashDeskModel::orderBy('id','asc')->where('company_id', Auth::user()->company_id)->take(10)->get() as $caixas){
            $valorIni = HomeController::valor_sem($caixas->open_value);
            foreach (\App\MovementModel::all()->where('cash_desk_id', $caixas->id) as $caixa){
                $valor = str_replace(',','.',str_replace('.','',$caixa->value));

                if($caixa->payment_type==0){
                    $dinheiro = $dinheiro+$valor;
                }
            }
            $dinheiro = $dinheiro - $valorIni;
            $dados=$dados.$dinheiro.',';
            $dinheiro=0.00;
        }
        $size = strlen($dados);
        $dados=substr($dados,0, $size-1);
        return $dados;
    }

    public static function pegarUltimasVendasCrediario(){
        $dados = '';
        $dinheiro=0.00;
        $i=0;
        foreach (\App\CashDeskModel::orderBy('id','asc')->where('company_id', Auth::user()->company_id)->take(10)->get() as $caixas){
            foreach (\App\MovementModel::all()->where('cash_desk_id', $caixas->id) as $caixa){
                $valor = str_replace(',','.',str_replace('.','',$caixa->value));

                if($caixa->payment_type==1){
                    $dinheiro = $dinheiro+$valor;
                }
            }

            $dados=$dados.$dinheiro.',';
            $dinheiro=0.00;
        }
        $size = strlen($dados);
        $dados=substr($dados,0, $size-1);
        return $dados;
    }

    public static function pegarUltimasVendasCartao(){
        $dados = '';
        $dinheiro=0.00;
        $i=0;
        foreach (\App\CashDeskModel::orderBy('id','asc')->where('company_id', Auth::user()->company_id)->take(10)->get() as $caixas){
            foreach (\App\MovementModel::all()->where('cash_desk_id', $caixas->id) as $caixa){
                $valor = str_replace(',','.',str_replace('.','',$caixa->value));

                if($caixa->payment_type==2||$caixa->payment_type==3){
                    $dinheiro = $dinheiro+$valor;
                }
            }

            $dados=$dados.$dinheiro.',';
            $dinheiro=0.00;
        }
        $size = strlen($dados);
        $dados=substr($dados,0, $size-1);
        return $dados;
    }

    public static function pegarUltimasDatas(){
        $dados = '';
        setlocale(LC_TIME, 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        foreach (\App\CashDeskModel::orderBy('id','asc')->where('company_id', Auth::user()->company_id)->take(10)->get() as $caixas){
            $dados=$dados.'"'.strftime("%d de %B", strtotime($caixas->created_at)).'",';
        }
        $size = strlen($dados);
        $dados=substr($dados,0, $size-1);
        return $dados;
    }

    public static function teste(){

        return date('d/m/Y H:i');
    }
}
