<?php
// requisição da classe PHPlot
require_once './phplot/phplot.php';
use App\Model\DBcontrole;
use App\Model\DBtipoGasto;
use App\Model\DBusuario;
use App\Model\TipoGasto;

include_once("../Model/DBcontrole.php");
include_once("../Model/DBtipoGasto.php");
include_once("../Model/DBusuario.php");
include_once("../Model/Controle.php");
include_once("../Controller/Funcoes.php");


  
// Array com dados de Ano x Índice de fecundidade Brasileira 1940-2000
// Valores por década
$data = array();     

             $somames = new \App\Model\DBcontrole();
             $anoAtual = date("Y");
             foreach($somames->selectSomaMes($anoAtual) as $soma){
               $data[] = array(Funcoes::mesesDoAno($soma['mes']), $soma['total']) ;
             }
# Cria um novo objeto do tipo PHPlot com 500px de largura x 350px de altura                 
$plot = new PHPlot(950 , 350);     
  
// Organiza Gráfico -----------------------------
$plot->SetTitle('Balanços de gastos e receitas mensais');
# Precisão de uma casa decimal
$plot->SetPrecisionY(1);
# tipo de Gráfico em barras (poderia ser linepoints por exemplo)
$plot->SetPlotType("bars");
# Tipo de dados que preencherão o Gráfico text(label dos anos) e data (valores de porcentagem)
$plot->SetDataType("text-data");
# Adiciona ao gráfico os valores do array
$plot->SetDataValues($data);
// -----------------------------------------------
  
// Organiza eixo X ------------------------------
# Seta os traços (grid) do eixo X para invisível
$plot->SetXTickPos('none');
# Texto abaixo do eixo X
//$plot->SetXLabel("Fonte: Censo Demográfico 2000, Fecundidade e Mortalidade Infantil, Resultados\n Preliminares da Amostra IBGE, 2002");
# Tamanho da fonte que varia de 1-5
//$plot->SetXLabelFontSize(2);
//$plot->SetAxisFontSize(2);
// -----------------------------------------------
  
// Organiza eixo Y -------------------------------
# Coloca nos pontos os valores de Y
$plot->SetYDataLabelPos('plotin');
// -----------------------------------------------
  
// Desenha o Gráfico -----------------------------
$plot->DrawGraph();
// -----------------------------------------------
?>