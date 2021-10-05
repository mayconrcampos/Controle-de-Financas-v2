<?php

namespace App\Model;


class TipoGasto {

    private $id;
    private $categoria;
    private $tipo;
    private $idUser;


    // Get Set ID
    public function getID(){
        return $this->id;
    }

    public function setID($id){
        $this->id = $id;
    }

    // Get Set Categoria

    public function getCategoria(){
        return $this->categoria;
    }

    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }

    // Get Set tipo = 1 = despesa | 2 = Receita

    public function getTipo(){
        return $this->tipo;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    // Get Set idUser = Cada usuário terá seu próprio cadastro de tipos de gastos.

    public function getIdUser(){
        return $this->idUser;
    }

    public function setIdUser($idUser){
        $this->idUser = $idUser;
    }
}