<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients =  User::all()->where('company_id', Auth::user()->company_id);
        return view('users.list', compact('clients'));
    }

    public function index_all($id)
    {
        $clients =  User::all()->where('company_id', $id);
        return view('users.list_all', compact('clients'));
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

    public function new()
    {
        //
        return view('users.new');
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
    public function desativar($id)
    {
        $clientEdit = User::findOrFail($id);
        HomeController::log('Usuario Desativado:');
        $clientEdit->remember_token=$clientEdit->email;
        $clientEdit->email='-';
        $clientEdit->save();
        flash('Usuário Desativado!')->success();
        if(Auth::user()->email=='atd@atdsistemas.com.br'){
            return redirect()->route('users.indexall');
        }else {
            return redirect()->route('users.index');
        }
    }
    public function ativar($id)
    {
        $clientEdit = User::findOrFail($id);
        HomeController::log('Usuario Ativado:');
        $clientEdit->email=$clientEdit->remember_token;
        $clientEdit->remember_token='';
        $clientEdit->save();
        flash('Usuário Ativado!')->success();
        if(Auth::user()->email=='atd@atdsistemas.com.br'){
            return redirect()->route('users.indexall');
        }else {
            return redirect()->route('users.index');
        }
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
