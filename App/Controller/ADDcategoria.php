<?php

session_start();

use App\Model\DBtipoGasto;
use App\Model\DBusuario;
use App\Model\TipoGasto;

include_once("../Model/DBtipoGasto.php");
include_once("../Model/DBusuario.php");
include_once("../Model/Controle.php");


    $categoria = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_STRING);
    $tipo = filter_input(INPUT_POST, "tipo");
    $idUser = "2";


    if(!empty($categoria)){

        echo "Categoria: ".$categoria."<br>";
        echo "Tipo: ".$tipo."<br>";
        echo "idUser: ".$idUser."<br>";

        $tipoCat = new \App\Model\TipoGasto();
        $tipoCat->setCategoria($categoria);
        $tipoCat->setTipo($tipo);
        $tipoCat->setIdUser($idUser);

        $DBCategoria = new \App\Model\DBtipoGasto();
        $DBCategoria->insert($tipoCat);

        $_SESSION['sucesso'] = "Movimentação cadastrada com sucesso!";
        header("Location: ../../index.php");
    }else{
        $_SESSION['erro'] = "Erro! É preciso preencher os campos.";
        header("Location: ../../index.php");
    }