<?php

namespace App\Http\Controllers;

use App\LicensingModel;
use App\ModelCompany;
use Illuminate\Http\Request;

class LicensingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients =  ModelCompany::all();
        return view('licensing.list', compact('clients'));
    }

    public function all($id)
    {
        $clients =  LicensingModel::all()->where('company_id', $id);
        if (count($clients)==0) {
            $clients =  ModelCompany::all();
            flash('Nenhuma renovação de licença para essa empresa!')->warning();
            return view('licensing.list', compact('clients'));
        }
        return view('licensing.licenses_company', compact('clients'));
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

    public function expired()
    {
        return view('licensing.expired');
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
        $lic = $request->licensing;
        $productData = $request->all();
        $product = new LicensingModel();
        $product->create($productData);
        $company = ModelCompany::findOrFail($id);
        $company->licensing = $lic;
        $company->save();
        $clients =  ModelCompany::all();
        flash('Licença de Software Renovada com Sucesso!')->success();
        return view('licensing.list', compact('clients'));

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
