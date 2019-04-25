<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@verificaTipo')->name('home');

// Universal
Route::get('/verifica/tipo', 'HomeController@verificaTipo');

// Funcionário
Route::get('/funcionario/home', 'FuncionarioController@homepage');
Route::get('/funcionario/cadastro', 'FuncionarioController@telaCadastrar');
Route::get('/funcionario/editar', 'FuncionarioController@editar')->name('funcEdit');
Route::post('/funcionario/salvar', 'FuncionarioController@salvar');
Route::post('/funcionario/atualizar', 'FuncionarioController@salvar');

// Empresa
Route::get('/empresa/home', 'EmpresaController@homepage');
Route::get('/empresa/cadastro', 'EmpresaController@telaCadastrar');
Route::get('/empresa/editar', 'EmpresaController@editar')->name('empEdit');
Route::post('/empresa/salvar', 'EmpresaController@salvar');
Route::post('/empresa/atualizar', 'EmpresaController@salvar');
Route::get('/empresa/funcionarios/solicitacoes', 'EmpresaController@solicitacoesCadastro');
Route::get('/empresa/funcionarios/{sol}','EmpresaController@getFuncionario');
Route::get('/empresa/funcionarios/{sol}/aprovar','SolicitacaoCadastroController@cadastroAprovar');
Route::get('/empresa/funcionarios/{sol}/reprovar','SolicitacaoCadastroController@cadastroReprovar');
Route::get('/empresa/funcionarios/','EmpresaController@listagemFuncionarios');
Route::get('/empresa/funcionarios/perfil/{id}','EmpresaController@getFuncionarioPerfil');
Route::get('/empresa/retornarEmpresa','EmpresaController@retornaEmpresa');
Route::get('/empresa/funcionarios/desativar/{id}','EmpresaController@desativarFuncionario');
Route::get('/empresa/relatorios/','EmpresaController@telaHomeRelatorios');
Route::get('/empresa/relatorios/valesPorFuncionario','EmpresaController@telaValesPorFuncionario');


// Solicitacao de Vale
Route::get('vale/solicitacoes', 'SolicitacaoValeController@telaSolicitacoes');
Route::get('vale/solicitar', 'SolicitacaoValeController@telaSolicitar');
Route::post('vale/salvar', 'SolicitacaoValeController@salvar');
Route::get('vale/{val}/aprovar', 'SolicitacaoValeController@aprovar');
Route::get('vale/{val}/reprovar', 'SolicitacaoValeController@reprovar');

// Folha Salarial
Route::get('folha/', 'FolhaSalarialController@listar');
Route::get('folha/{func}/cadastrar','FolhaSalarialController@cadastrar');
Route::post('folha/salvar', 'FolhaSalarialController@salvar');
Route::get('folha/{func}/editar', 'FolhaSalarialController@editar');
Route::get('folha/{func}/visualizar', 'FolhaSalarialController@visualizar');
Route::get('folha/renovar', 'FolhaSalarialController@renovarFolha');

// Admin
//Route::get('nimda', 'AdminController@loginAdmin');
Route::get('admin/home', 'AdminController@menuAdmin');
Route::get('admin/solicitacoesEmpresa','AdminController@telasolicitacoesEmpresa');
Route::get('admin/solicitacoesEmpresa/{empresa}','AdminController@getEmpresa');
Route::get('admin/empresa/{empresa}/aprovar','AdminController@aprovarEmpresa');
Route::get('admin/empresa/{empresa}/reprovar','AdminController@reprovarEmpresa');
