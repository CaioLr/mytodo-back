<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    public function findAll(){
        try {
            $response = User::get();
        } catch (\Throwable $th) {
            return response("Erro ao realizar a busca.",400);
        }
        return $response;
    }

    public function findOne(Request $req){
        try {
            $uuid = $req->get('uuid');
            $response = User::where('id',$uuid)->get();
        } catch (\Throwable $th) {
            return "Erro ao realizar a(s) busca(s).";
        }
        return $response;
    }

    public function store(Request $req){
        try {
          

            $req->validate([ //validação
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:5|max:20',
                'conf_password' => 'required',
            ]);
            
            if($req->password != $req->conf_password){ //retorno especifico de erro
                return response('Confirmação de e-mail diferente!',400);
            }
    
            $user = new User();
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
    
            $res = $user->save();
    
            if($res){
                return response('Registro(s) inseridos com sucesso!',200);
            }
            return response('Erro ao inserir registro(s).',400); //caso ocorra erro ao inserir no BD

        } catch (\Throwable $th) {
            return response("Erro ao inserir registro(s).",400);
            // return $th;
        }

    }

    public function update(Request $req){
        try {
           
        } catch (\Throwable $th) {
            return $th;
            return "Erro ao atualizar o(s) registro(s).";
        }
        return "Registro(s) atualizados com sucesso!";
    }

    public function delete(Request $req){
        try {

            $uuid =$req->get('uuid');

            if (User::where('id', $uuid)->get() == '[]') return "Erro ao deletar o(s) registro(s).";

            User::where('id', $uuid)->delete();

        } catch (\Throwable $th) {
            return response("Erro ao deletar o(s) registro(s).",400);
        }
        return response("Registro(s) deletados com sucesso!",200);
    }
}
