@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Nova Empresa</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div>
                        <form action="{{route('company.store')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="name" placeholder="Nome Fantasia" required>
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="razao" placeholder="Razão Social" required>
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="cnpj" placeholder="CNPJ" required>
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                                <input type="file" class="form-control has-feedback-left" id="inputSuccess2" name="logo" placeholder="Logo" required>
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="address" placeholder="Endereço" required>
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="bairro" placeholder="Bairro" required>
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="cep" placeholder="CEP" required>
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="city" placeholder="Cidade" required>
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="uf" placeholder="UF" required>
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                                <select type="text" class="form-control has-feedback-left" id="inputSuccess2" name="service" required>
                                    <option>Selecione o tipo da empresa...</option>
                                    <option value="0">Comércio Padrão</option>
                                    <option value="1">Ótica</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                                <button style="width: 100%" type="submit" class="btn btn-success">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
