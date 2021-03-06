<?php
namespace App\Model;
// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Sao_Paulo');

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

    // select DB Controle

    public function select($id = null){
        $data_fim = date("Y/m/d");
        $data_inicio = date("Y/m")."/01";
        $iduser = "2";
        
        if(!empty($id)){
            

            $query = "SELECT * FROM controle WHERE id=?";

            $stmt = \App\Model\Conexao::getConn()->prepare($query);
            $stmt->bindValue(1, $id);
            $stmt->execute();
        }else{

            // Lista todos as entradas e saídas ocorridas no mês presente, desde o dia 01 até o dia atual, que estiverem com iduser do usuário.
            $mes_presente = date("m");
            $ano_presente = date("Y");
            
            $query = "SELECT id, descricao, valor, DATE_FORMAT(data, '%d/%m/%Y') as 'data', categoria, comentario, tipo, iduser FROM controle WHERE iduser=? AND EXTRACT(month from data)=? AND EXTRACT(year from data)=? ORDER BY data DESC";

            $stmt = \App\Model\Conexao::getConn()->prepare($query);
            $stmt->bindValue(1, $iduser);
            $stmt->bindValue(2, $mes_presente);
            $stmt->bindValue(3, $ano_presente);
            $stmt->execute();
        }

        if($stmt->rowCount() > 0){
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        }else{
            return [];
        }
    }


    // Select na soma do total por mês
    public function selectSomaMes($ano){

        $query = "SELECT EXTRACT(month from data) AS mes, SUM(valor) as total, tipo FROM controle WHERE EXTRACT(year from data)=? GROUP BY mes, tipo ORDER BY mes";
        
        $stmt = \App\Model\Conexao::getConn()->prepare($query);
        $stmt->bindValue(1, $ano);

        $stmt->execute();

        if($stmt->rowCount() > 0){
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        }else{
            return [];
        }
    }


    // select Relatorios

    public function selectRelatorios($pesquisa = null, $data_inicio = null, $data_fim = null, $userId=null){
        //$data_fim = date("Y/m/d");
        //$data_inicio = date("Y/m")."/01";
        

        if(!$pesquisa and !$data_inicio and !$data_fim){
            //echo "Não Não Não ok e funcionando filtro das datas";
            //$data_fim = date("Y/m/d");
            //$data_inicio = date("Y/m")."/01";

            $mes_presente = date("m");
            $ano_presente = date("Y");

            echo $mes_presente."/".$ano_presente;

            // Lista todos as entradas e saídas ocorridas no mês presente, desde o dia 01 até o dia atual, que estiverem com iduser do usuário.

            $query = "SELECT id, descricao, valor, DATE_FORMAT(data, '%d/%m/%Y') as 'data', categoria, comentario, tipo, iduser FROM controle WHERE iduser=? AND EXTRACT(month from data)=? AND EXTRACT(year from data)=? ORDER BY data DESC";

            $stmt = \App\Model\Conexao::getConn()->prepare($query);
            $stmt->bindValue(1, $userId);
            $stmt->bindValue(2, $mes_presente);
            $stmt->bindValue(3, $ano_presente);

            $stmt->execute();
        

        }elseif($pesquisa and !$data_inicio and !$data_fim){
            //echo "Sim Não Não ok, mas nao funciona filtro da data";

            $data_fim = date("Y/m/d");
            $data_inicio = date("Y/m")."/01";
            
            $query = "SELECT id, descricao, valor, DATE_FORMAT(data, '%d/%m/%Y') as 'data', categoria, comentario, tipo, iduser FROM controle WHERE (iduser=? AND descricao LIKE ? OR categoria LIKE ?) AND data BETWEEN ? AND ? ORDER BY data DESC";

            $pesquisa = "%".$pesquisa."%";

            //echo "pesquisa: ".$pesquisa."<br>";
            //echo "data ini: ".$data_inicio."<br>";
            //echo "data fim: ".$data_fim."<br>";
            //echo "iduser  : ".$userId."<br>";
            

            $stmt = \App\Model\Conexao::getConn()->prepare($query);
            $stmt->bindValue(1, $userId);
            $stmt->bindValue(2, $pesquisa, \PDO::PARAM_STR);
            $stmt->bindValue(3, $pesquisa, \PDO::PARAM_STR);
            $stmt->bindValue(4, $data_inicio, \PDO::PARAM_STR);
            $stmt->bindValue(5, $data_fim, \PDO::PARAM_STR);

            //$stmt->bindValue(2, $pesquisa);
            //$stmt->bindValue(3, $pesquisa);
            
            $stmt->execute();

        }elseif($pesquisa and $data_inicio and $data_fim){
            //echo "Sim Sim Sim ok, mas não funciona filtro entre datas";
            // Lista todos as entradas e saídas ocorridas no mês presente, desde o dia 01 até o dia atual, que estiverem com iduser do usuário.

            $query = "SELECT id, descricao, valor, DATE_FORMAT(data, '%d/%m/%Y') as 'data', categoria, comentario, tipo, iduser FROM controle WHERE (iduser=? AND descricao LIKE ? OR categoria LIKE ?) AND data BETWEEN ? AND ? ORDER BY data DESC";

            $pesquisa = "%".$pesquisa."%";

            $stmt = \App\Model\Conexao::getConn()->prepare($query);
            $stmt->bindValue(1, $userId);
            $stmt->bindValue(2, $pesquisa, \PDO::PARAM_STR);
            $stmt->bindValue(3, $pesquisa, \PDO::PARAM_STR);
            $stmt->bindValue(4, $data_inicio, \PDO::PARAM_STR);
            $stmt->bindValue(5, $data_fim, \PDO::PARAM_STR);
            $stmt->execute();

        }elseif(!$pesquisa and $data_inicio and $data_fim){
            //echo "Não Sim Sim ok, funciona filtro de data";

            // Lista todos as entradas e saídas ocorridas no mês presente, desde o dia 01 até o dia atual, que estiverem com iduser do usuário.

            $query = "SELECT id, descricao, valor, DATE_FORMAT(data, '%d/%m/%Y') as 'data', categoria, comentario, tipo, iduser FROM controle WHERE iduser=? AND data BETWEEN ? AND ? ORDER BY data ASC";

            $stmt = \App\Model\Conexao::getConn()->prepare($query);
            $stmt->bindValue(1, $userId);
            $stmt->bindValue(2, $data_inicio);
            $stmt->bindValue(3, $data_fim);
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