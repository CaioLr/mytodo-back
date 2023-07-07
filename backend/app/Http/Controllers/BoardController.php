<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use Illuminate\Http\Request;

class BoardController extends Controller
{

    public function findAll()
    {
        try {
            $response = Board::get();
        } catch (\Throwable $th) {
            return "Erro ao realizar a busca.";
        }
        return $response;
    }

    public function findOne(Request $req)
    {
        try {
            $id = $req->get('id');
            $response = Board::where('id',$id)->get();
        } catch (\Throwable $th) {
            return "Erro ao realizar a(s) busca(s).";
        }
        return $response;
    }

    public function store(Request $req)
    {
        try{
            $board = new Board();
            $board->user_id = $req->uuid;
            $board->name = $req->name;

            $res = $board->save();

            if($res){
                return 'Registro(s) inseridos com sucesso!';
            }
            return 'Erro ao inserir registro(s).'; //caso ocorra erro ao inserir no BD

        } catch (\Throwable $th) {
            return "Erro ao inserir registro(s).";
            // return $th;
        }
    }



    public function update(Request $req)
    {
        try {
            $id =$req->get('id');
            $name = $req->get('name');
           
            Board::where('id',$id)->update(['name' => $name]);

        } catch (\Throwable $th) {
            return "Erro ao atualizar o(s) registro(s).";
        }
        return "Registro(s) atualizados com sucesso!";
    }


    public function delete(Request $req)
    {
        try {

            $id =$req->get('id');

            if (Board::where('id', $id)->get() == '[]') return "Erro ao deletar o(s) registro(s).";

            Board::where('id', $id)->delete();

        } catch (\Throwable $th) {
            return "Erro ao deletar o(s) registro(s).";
        }
        return "Registro(s) deletados com sucesso!";
    }
}
