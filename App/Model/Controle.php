<?php

namespace App\Model;


class Controle {

    private $id;
    private $descricao;
    private $valor;
    private $data;
    private $categoria;
    private $comentario;
    private $tipo;
    private $iduser;

    // Get e Set id

    public function getID(){
        return $this->id;
    }

    public function setID($id){
        $this->id = $id;
    }

    // Get e Set Descrição

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    // Get e Set valor

    public function getValor(){
        return $this->valor;
    }

    public function setValor($valor){
        $this->valor = $valor;
    }

    // Get e Set Data

    public function getData(){
        return $this->data;
    }

    public function setData($data){
        $this->data = $data;
    }

    // Get e Set Categoria

    public function getCategoria(){
        return $this->categoria;
    }
    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }

    // Get e Set Comentário

    public function getComentario(){
        return $this->comentario;
    }

    public function setComentario($comentario){
        $this->comentario = $comentario;
    }

    // Get e Set Tipo

    public function getTipo(){
        return $this->tipo;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    // Get e Set IdUser

    public function getIdUser(){
        return $this->iduser;
    }
    public function setIdUser($iduser){
        $this->iduser = $iduser;
    }



}