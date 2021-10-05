<?php
namespace App\Model;

use App\Model\Conexao;
use App\Model\Usuario;
include_once("conexao.php");
include_once("./Controle.php");


class DBcontrole {

    // insert
    public function insert(Controle $controle){
        $query = "INSERT INTO controle (descricao, valor, data, categoria, comentario, tipo, iduser) VALUES (?, ?, ?, ?, ?, ?, ?)";

        
    }

    // select

    // update

    // delete
}