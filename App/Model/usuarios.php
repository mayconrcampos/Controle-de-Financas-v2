<?php

namespace App\Model;

class Usuario {
    private $id, $usuario, $senha, $status;

    // Get Set id
    public function getID(){
        return $this->id;
    }

    public function setID($id){
        $this->id = $id;
    }

    // Get Set Usuário
    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    // Get Set Senha
    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

    // Get Set Status
    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }
}

