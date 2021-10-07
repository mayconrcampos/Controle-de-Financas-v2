<?php

session_start();

use App\Model\DBcontrole;
use App\Model\TipoGasto;

include_once("../Model/DBcontrole.php");
include_once("../Model/Controle.php");

$id = $_GET['id'];

echo "ID recebido por GET: ".$id;