<?php

namespace App\Http\Controllers;

use App\CashDeskModel;
use App\InOutModel;
use App\MovementModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $clients =  InOutModel::all()->where('company_id', Auth::user()->company_id);
        return view('in_out.list', compact('clients'));
    }

    public function new(){
        return view('in_out.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new InOutModel();
        $data->description = $request->description;
        if ($request->type==0){
            $valor = $request->value;
            $desc = 'Entrada de Dinheiro - '.$request->description;
        }else{
            $valor = '-'.$request->value;
            $desc = 'Saída de Dinheiro - '.$request->description;
        }
        $caixa = (CashDeskModel::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->where('status',0)->select('id')->first())->id;
        $data->value = $valor;
        $data->company_id = Auth::user()->company_id;
        $data->user_id = Auth::user()->id;
        $data->cash_desk_id = $caixa;
        HomeController::log('Entrada/Saida:');
        $data->save();

        $movement = new MovementModel();
        $movement->value = $valor;
        $movement->description = $desc;
        $movement->payment_type = 0;
        $movement->company_id = Auth::user()->company_id;
        $movement->cash_desk_id = $caixa;
        $movement->save();

        return redirect()->route('inout.index');
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
