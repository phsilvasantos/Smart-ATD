@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Inserir Nova Conta</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div>
                        <form action="{{route('bills.store')}}" method="post">
                            {{csrf_field()}}
                            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                                <h6>Conta</h6>
                                <div id="gender" class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-dark" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="type" value="1" required> &nbsp; A Pagar &nbsp;
                                    </label>
                                    <label class="btn btn-dark" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="type" value="0" required> A Receber
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-11 form-group has-feedback">
                                <h6>Descrição</h6>
                                <input type="text" class="form-control has-feedback-left" name="description" required/>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-11 form-group has-feedback">
                                <h6>Valor R$</h6>
                                <input type="text" class="form-control has-feedback-left" name="value" onKeyPress="return(moeda(this,'.',',',event));" required/>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-11 form-group has-feedback">
                                <h6>Venvimento</h6>
                                <input type="date" class="form-control has-feedback-left" name="venc_date" required/>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                                <h6>Gerar</h6>
                                <select type="text" class="form-control has-feedback-left" id="inputSuccess2" name="qtd" required>
                                    <option value="1">1 Débito</option>
                                    <option value="2">2 Débitos</option>
                                    <option value="3">3 Débitos</option>
                                    <option value="4">4 Débitos</option>
                                    <option value="5">5 Débitos</option>
                                    <option value="6">6 Débitos</option>
                                    <option value="7">7 Débitos</option>
                                    <option value="8">8 Débitos</option>
                                    <option value="9">9 Débitos</option>
                                    <option value="10">10 Débitos</option>
                                    <option value="11">11 Débitos</option>
                                    <option value="12">12 Débitos</option>
                                </select>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback"align="right">
                                <h6>&nbsp;</h6>
                                <button type="submit" class="btn btn-success">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
