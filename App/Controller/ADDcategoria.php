<?php

session_start();

use App\Model\DBtipoGasto;
use App\Model\DBusuario;
use App\Model\TipoGasto;

include_once("../Model/DBtipoGasto.php");
include_once("../Model/TipoGasto.php");
include_once("../Model/DBusuario.php");


    $categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_STRING);
    $tipo = filter_input(INPUT_POST, "tipo");
    $idUser = "2";


    if(!empty($categoria)){

        //echo "Categoria: ".$categoria."<br>";
        //echo "Tipo: ".$tipo."<br>";
        //echo "idUser: ".$idUser."<br>";

        $tipoGasto = new \App\Model\TipoGasto();

        $tipoGasto->setCategoria($categoria);
        $tipoGasto->setTipo($tipo);
        $tipoGasto->setIdUser($idUser);

        //echo "Categoria: ".$tipoGasto->getCategoria()."<br>";
        //echo "tipo: ".$tipoGasto->getTipo()."<br>";
        //echo "iduser: ".$tipoGasto->getIdUser()."<br>";

        $DBCategoria = new \App\Model\DBtipoGasto();
        $DBCategoria->insert($tipoGasto);

        $_SESSION['sucesso'] = "Movimentação cadastrada com sucesso!";
        header("Location: ../../index.php");
    }else{
        $_SESSION['erro'] = "Erro! É preciso preencher o campo.";
        header("Location: ../../index.php");
    }