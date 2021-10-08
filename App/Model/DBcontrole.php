<?php
namespace App\Model;

use App\Model\Conexao;
use App\Model\Controle;

include_once("conexao.php");
include_once("./Controle.php");


class DBcontrole {

    // insert
    public function insert(Controle $controle){
        $query = "INSERT INTO controle (descricao, valor, data, categoria, comentario, tipo, iduser) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = \App\Model\Conexao::getConn()->prepare($query);
        $stmt->bindValue(1, $controle->getDescricao());
        $stmt->bindValue(2, $controle->getValor());
        $stmt->bindValue(3, $controle->getData());
        $stmt->bindValue(4, $controle->getCategoria());
        $stmt->bindValue(5, $controle->getComentario());
        $stmt->bindValue(6, $controle->getTipo());
        $stmt->bindValue(7, $controle->getIdUser());

        $stmt->execute();
    }

    // select

    public function select($id = null){
        $data_fim = date("Y/m/d");
        $data_inicio = date("Y/m")."/01";
        
        if(!empty($id)){
            

            $query = "SELECT * FROM controle WHERE id=?";

            $stmt = \App\Model\Conexao::getConn()->prepare($query);
            $stmt->bindValue(1, $id);
            $stmt->execute();
        }else{

            // Lista todos as entradas e saídas ocorridas no mês presente, desde o dia 01 até o dia atual, que estiverem com iduser do usuário.

            $query = "SELECT id, descricao, valor, DATE_FORMAT(data, '%d/%m/%Y') as 'data', categoria, comentario, tipo, iduser FROM controle WHERE iduser='2' AND data BETWEEN '$data_inicio' AND '$data_fim' ORDER BY data DESC";

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

    public function update(Controle $controle){
        $query = "UPDATE controle SET descricao=?, valor=?, data=?, categoria=?, comentario=?, tipo=? WHERE id=?";

        $stmt = \App\Model\Conexao::getConn()->prepare($query);
        $stmt->bindValue(1, $controle->getDescricao());
        $stmt->bindValue(2, $controle->getValor());
        $stmt->bindValue(3, $controle->getData());
        $stmt->bindValue(4, $controle->getCategoria());
        $stmt->bindValue(5, $controle->getComentario());
        $stmt->bindValue(6, $controle->getTipo());
        $stmt->bindValue(7, $controle->getID());
        
        $stmt->execute();

    }

    // delete

    public function delete($id){
        $query = "DELETE FROM controle WHERE id=?";

        $stmt = \App\Model\Conexao::getConn()->prepare($query);
        $stmt->bindValue(1, $id);

        $stmt->execute();
    }
}