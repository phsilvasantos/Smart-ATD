<?php

namespace App\Http\Controllers;

use App\ProductsModel;
use PDF;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('ticket.new');
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
    public function store(Request $request)
    {
        //
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

    public function gerar(Request $request)
    {
        $produto = new ProductsModel();
        $produto->name = $request->produto;
        $produto->code = $request->qtd;
        $tipo = $request->tipo;
        if($tipo==2){
            $pdf = PDF::loadView('ticket.ticketA4Placa33', compact('produto'))->setPaper('a4', 'landscape');
            return $pdf->stream();
        }
        if($tipo==3){
            $pdf = PDF::loadView('ticket.ticketA4Placa44', compact('produto'))->setPaper('a4', 'landscape');
            return $pdf->stream();
        }
        if($tipo==4){
            $pdf = PDF::loadView('ticket.ticketA4Placa55', compact('produto'))->setPaper('a4', 'landscape');
            return $pdf->stream();
        }


    }



}
