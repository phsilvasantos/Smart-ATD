<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Eduardokum\LaravelBoleto\Boleto\Banco\Bb;
use Eduardokum\LaravelBoleto\Boleto\Banco\Bradesco;
use Eduardokum\LaravelBoleto\Pessoa;
use Illuminate\Http\Request;

class BoletoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bradesco()
    {
        $bradesco = new Bradesco();
        $bradesco->setLogo('http://atdsistemas.com.br/img/favicon.png')
            ->setDataVencimento(Carbon::instance( new \DateTime( '2019-01-01' ) ))
            ->setValor('100.50')
            ->setNumero(1)
            ->setNumeroDocumento(1)
            ->setPagador(Pessoa::create('Frederyk','09585196417','','','',''))
            ->setBeneficiario(Pessoa::create('Frederyk','09585196417','','','',''))
            ->setCarteira('09')
            ->setAgencia(3457)
            ->setConta(200585)
            ->setDescricaoDemonstrativo(['demonstrativo 1', 'demonstrativo 2', 'demonstrativo 3'])
            ->setInstrucoes(['instrucao 1', 'instrucao 2', 'instrucao 3']);

// You can add more ``Demonstrativos`` or ``Instrucoes`` on this way:

        $bradesco->addDescricaoDemonstrativo('demonstrativo 4');
        return $bradesco->renderHTML();
    }

    public function brasil()
    {
        $bb = new Bb();
        $bb->setLogo('http://atdsistemas.com.br/img/favicon.png')
            ->setDataVencimento(Carbon::instance( new \DateTime( '2019-01-01' ) ))
            ->setValor('100')
            ->setNumero(1)
            ->setNumeroDocumento(1)
            ->setPagador(Pessoa::create('Frederyk','09585196417','','','',''))
            ->setBeneficiario(Pessoa::create('Frederyk','09585196417','','','',''))
            ->setCarteira(11)
            ->setAgencia(1111)
            ->setConvenio(1231237)
            ->setConta(22222)
            ->setDescricaoDemonstrativo(['demonstrativo 1', 'demonstrativo 2', 'demonstrativo 3'])
            ->setInstrucoes(['instrucao 1', 'instrucao 2', 'instrucao 3']);

// You can add more ``Demonstrativos`` or ``Instrucoes`` on this way:

        $bb->addDescricaoDemonstrativo('demonstrativo 4');
        return $bb->renderHTML();
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
}
