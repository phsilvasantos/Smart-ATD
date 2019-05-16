<?php

namespace App\Http\Controllers;

use App\ModelCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public static function valor_sem($valor){
        return str_replace(',','.', str_replace('.','',$valor));
    }
    public static function valor_com($valor){
        return number_format($valor,2,',','.');
    }

    public static function log($loginformacao){
        $log = new Logger('AÇÕES');
        $empresa='';
        foreach (ModelCompany::all()->where('id',Auth::user()->company_id) as $item) {
            $empresa = $item->name;
        }
        $emp = strtr(utf8_decode(trim($empresa)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-");
        $log->pushHandler(new StreamHandler('path/to/'.$emp.'.log', Logger::WARNING));
        $log->warning($loginformacao.' - Usuário: '.Auth::user()->name.' -ID:'.Auth::user()->id);
    }



    public function alterar_senha(UpdateAccount $request)
{
    $usuario = Auth::user(); // resgata o usuario

    $usuario->username = Request::input('username'); // pega o valor do input username
    $usuario->email = Request::input('email'); // pega o valor do input email

    if ( ! Request::input('password') == '') // verifica se a senha foi alterada
    {
        $user->password = bcrypt(Request::input('password')); // muda a senha do seu usuario já criptografada pela função bcrypt
    }

    $user->save(); // salva o usuario alterado =)

    Flash::message('Atualizado com sucesso!');
    return Redirect::to('home');
}

}
