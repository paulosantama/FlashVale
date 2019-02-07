<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function verificaTipo(){
        if(((\Auth::user()->empresa_id==null)&&(\Auth::user()->funcionario_id==null))){
            return view('Universal.verificaTipo');
        }else{
            if (\Auth::user()->type == 1){
//                return view('Empresa.home');
                return \Redirect::to('/empresa/home');
            }else{
//                return view('Funcionario.home');
                return \Redirect::to('/funcionario/home');
            }
        }
    }
}
