<?php

namespace App\Http\Controllers;

use App\ClientsModel;
use App\ComissaoModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComissaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('comission.new');
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
    public function view(Request $request)
    {
        $tudo = $request->all();
        $id = $tudo['id'];
        $start = $tudo['start'];
        $final = $tudo['final'];
        $rel = 'Inicio: '. \Carbon\Carbon::parse($start)->format('d/m/Y') .'  -   Fim: '. \Carbon\Carbon::parse($final)->format('d/m/Y');
        if($id==0){
            return view('comission.list', compact('start'), compact('final'));
        }else{
            $dados =  ComissaoModel::where('user_id', $id)->whereBetween('created_at', array($start.' 00:00:00', $final.' 23:59:59'))->orderBy('created_at', 'ASC')->get();
            return view('comission.view', compact('dados'), compact('rel'));
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
