<?php
namespace App\Model;

use App\Model\Conexao;
use App\Model\Usuario;
include_once("conexao.php");
include_once("./usuarios.php");

class DBusuario {

    // Insert

    public function insert(Usuario $user){

        $query = "INSERT INTO userlogin (usuario, senha, status) VALUES (?, ?, ?)";

        $stmt = \App\Model\Conexao::getConn()->prepare($query);
        $stmt->bindValue(1, $user->getUsuario());
        $stmt->bindValue(2, $user->getSenha());
        $stmt->bindValue(3, $user->getStatus());

        $stmt->execute();
    }

    // Select


    public function select($id=null){

        if(!empty($id)){
            $query = "SELECT * FROM userlogin WHERE id=?";

            $stmt = \App\Model\Conexao::getConn()->prepare($query);
            $stmt->bindValue(1, $id);
            $stmt->execute();

        }else{
            $query = "SELECT * FROM userlogin ORDER BY nome ASC";

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

    // Update

    public function update(Usuario $user){

        $query = "UPDATE userlogin SET usuario=?, senha=? WHERE id=?";

        $stmt = \App\Model\Conexao::getConn()->prepare($query);
        $stmt->bindValue(1, $user->getUsuario());
        $stmt->bindValue(2, $user->getSenha());
        $stmt->bindValue(3, $user->getID());

        $stmt->execute();
    }
    
    // Delete

    public function delete($id){
        $query = "DELETE FROM userlogin WHERE id=?";

        $stmt = \App\Model\Conexao::getConn()->prepare($query);
        $stmt->bindValue(1, $id);

        $stmt->execute();
    }
}
