/**
 * Funções para abrir modal
 */



function addConta(){
    let modaladdConta = document.querySelector(".ModaddConta")

    modaladdConta.style.display = "block";
    recolheSidebar()
}

function listaConta(){
    let modalListaConta = document.querySelector(".ModlistaConta")

    modalListaConta.style.display = "block";
    recolheSidebar()   
}

function addCategoria(){
    let modalAddCateg = document.querySelector(".ModaddCategoria")

    modalAddCateg.style.display = "block";
    recolheSidebar()  
}

function listaCategorias(){
    let modalListaCateg = document.querySelector(".modlistaCategorias")

    modalListaCateg.style.display = "block";
    recolheSidebar()
}

/* Modal Relatorios */ 
function modRelatorios(){
    let modal = document.querySelector(".modRelatorios")

    modal.style.display = "block";
    recolheSidebar()
}

function listaCategorias1(){
    let modalListaCateg = document.querySelector(".modlistaCategorias1")

    modalListaCateg.style.display = "block";
    recolheSidebar()
}




/* Funções para fechar modal */


function fechalistaCategorias(){
    let modalFecha = document.querySelector(".modlistaCategorias")
    modalFecha.style.display = "none";
    abreSidebar()
}

function fechalistaCategorias1(){
    let modalFecha = document.querySelector(".modlistaCategorias1")
    modalFecha.style.display = "none";
    abreSidebar()
}

function fecharAddConta(){
    let modalFecha = document.querySelector(".ModaddConta")

    modalFecha.style.display = "none";
    abreSidebar()
}

function fecharListaContas(){
    let modal = document.querySelector(".ModlistaConta")

    modal.style.display = "none";
    abreSidebar()
}

function fecharAddCategoria() {
    let modal = document.querySelector(".ModaddCategoria")

    modal.style.display = "none";
    abreSidebar()
}
/* Fechar relatorios */
function fechaRelatorios() {
    let modal = document.querySelector(".modRelatorios")

    modal.style.display = "none";
    abreSidebar()
}

function recolheSidebar(){
    var sidebar1 = document.getElementById("sidebar1");
    sidebar1.style.marginLeft = "-250px";
}

function abreSidebar(){
    var sidebar1 = document.getElementById("sidebar1");
    sidebar1.style.marginLeft = "0px";
}


function fechaAlerta(){
    let modal = document.querySelector(".alerta")

    modal.style.display = "none";
    abreSidebar()
}




