<?php

use App\User;
use App\Conteudo;
use App\Comentario;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/cadastro','UsuarioControler@cadastro');
Route::post('/login','UsuarioControler@login');
Route::middleware('auth:api')->put('/perfil', 'UsuarioControler@perfil');

Route::middleware('auth:api')->post('/conteudo/adicionar', 'ConteudoControler@adicionar');
Route::middleware('auth:api')->get('/conteudo/lista', 'ConteudoControler@lista');
Route::middleware('auth:api')->put('/conteudo/curtir/{id}', 'ConteudoControler@curtir');
Route::middleware('auth:api')->put('/conteudo/comentar/{id}', 'ConteudoControler@comentar');
Route::middleware('auth:api')->put('/conteudo/curtirpagina/{id}', 'ConteudoControler@curtirpagina');
Route::middleware('auth:api')->put('/conteudo/comentarpagina/{id}', 'ConteudoControler@comentarpagina');

Route::middleware('auth:api')->get('/conteudo/pagina/lista/{id}', 'ConteudoControler@pagina');

Route::middleware('auth:api')->post('/usuario/amigo', 'UsuarioControler@amigo');
Route::middleware('auth:api')->get('/usuario/listaamigos', 'UsuarioControler@listaamigos');
Route::middleware('auth:api')->get('/usuario/listaamigospagina/{id}', 'UsuarioControler@listaamigospagina');

Route::get('/testes', function(){
    
    //whereIn('id',[1, 2, 3]);
    $user = User::find(1);
    $amigos = $user->amigos()->pluck('id');
    $amigos->push($user->id);
    $conteudos = Conteudo::whereIn('user_id',$amigos)->with('user')->orderBy('data', 'DESC')->paginate(5);

    dd($conteudos);
});