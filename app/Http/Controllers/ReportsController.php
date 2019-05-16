<?php

namespace App\Http\Controllers;

use App\SalesModel;
use Illuminate\Http\Request;
use PDF;

class ReportsController extends Controller
{
    //

    public function clientsAll()
    {
        $pdf = PDF::loadView('relatorios.clients')->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
    public function productsAll()
    {
        $pdf = PDF::loadView('relatorios.products')->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
    public function providersAll()
    {
        $pdf = PDF::loadView('relatorios.providers')->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
    public function products_groupsAll()
    {
        $pdf = PDF::loadView('relatorios.products_groups')->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
    public function salesAll()
    {
        $pdf = PDF::loadView('relatorios.sales')->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    public function purchasesAll()
    {
        $pdf = PDF::loadView('relatorios.purchases')->setPaper('a4', 'landscape');
        return $pdf->stream();
    }


    public function contrato($id)
    {
        $produto = $id;
        $pdf = PDF::loadView('relatorios.contrato', compact('produto'))->setPaper('a4', 'portrait');
        return $pdf->stream();

    }

    public function sale($id)
    {
        $produto = $id;
        $pdf = PDF::loadView('relatorios.sale', compact('produto'))->setPaper('a4', 'portrait');
        return $pdf->stream();

    }

    public function purchase($id)
    {
        $produto = $id;
        $pdf = PDF::loadView('relatorios.purchase', compact('produto'))->setPaper('a4', 'portrait');
        return $pdf->stream();

    }

    public function provider($id)
    {
        $produto = $id;
        $pdf = PDF::loadView('relatorios.provider', compact('produto'))->setPaper('a4', 'portrait');
        return $pdf->stream();

    }

    public function cash($id)
    {
        $produto = $id;
        $pdf = PDF::loadView('relatorios.caixa', compact('produto'))->setPaper('a4', 'portrait');
        return $pdf->stream();

    }

    public function client($id)
    {
        $produto = $id;
        $pdf = PDF::loadView('relatorios.client', compact('produto'))->setPaper('a4', 'portrait');
        return $pdf->stream();

    }
}
