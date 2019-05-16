@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Entrada / Saída</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div>
                        <form action="{{route('inout.store')}}" method="post">
                            {{csrf_field()}}
                            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                                <h6>Selecione o Tipo...</h6>
                                <select type="text" class="form-control has-feedback-left" id="inputSuccess2" name="type" required>
                                    <option value="0">Entrada</option>
                                    <option value="1">Saída</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-11 form-group has-feedback">
                                <h6>Descrição</h6>
                                <input type="text" class="form-control has-feedback-left" name="description" required/>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-11 form-group has-feedback">
                                <h6>Valor R$</h6>
                                <input type="text" class="form-control has-feedback-left" name="value" onKeyPress="return(moeda(this,'.',',',event));" required/>
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
