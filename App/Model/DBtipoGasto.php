<?php
namespace App\Model;

use App\Model\Conexao;
use App\Model\Usuario;
include_once("./conexao.php");
include_once("./TipoGasto.php");


class DBtipoGasto {

    // insert
    
    public function insert(TipoGasto $tipo){
        $query = "INSERT INTO TipoGasto (categoria, tipo, iduser) VALUES (?, ?, ?)";

        $stmt = \App\Model\Conexao::getConn()->prepare($query);
        $stmt->bindValue(1, $tipo->getCategoria());
        $stmt->bindValue(2, $tipo->getTipo());
        $stmt->bindValue(3, $tipo->getIdUser());

        $stmt->execute();
    }

    // select

    public function select($id = null){
        if(!empty($id)){
            $query = "SELECT * FROM TipoGasto WHERE id=?";

            $stmt = \App\Model\Conexao::getConn()->prepare($query);
            $stmt->bindValue(1, $id);

            $stmt->execute();
            
        }else{
            $query = "SELECT * FROM TipoGasto ORDER BY tipo ASC";

            $stmt = \App\Model\Conexao::getConn()->prepare($query);
            $stmt->execute();
        }

        if($stmt->rowCount() > 0){
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        }else{
            return [];
        }
    }

    // update

    public function update(TipoGasto $tipo){
        $query = "UPDATE TipoGasto SET categoria=?, tipo=?, iduser=? WHERE id=?";

        $stmt = \App\Model\Conexao::getConn()->prepare($query);
        $stmt->bindValue(1, $tipo->getCategoria());
        $stmt->bindValue(2, $tipo->getTipo());
        $stmt->bindValue(3, $tipo->getIdUser());
        $stmt->bindValue(4, $tipo->getID());

        $stmt->execute();
    }

    // delete
}