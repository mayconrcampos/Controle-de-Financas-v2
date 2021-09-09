function btnClique() {
  //var botao = document.getElementById('botao');
  var sidebar1 = document.getElementById("sidebar1");

  if (sidebar1.style.marginLeft == "-250px") {
    sidebar1.style.marginLeft = "0px";
  } else {
    sidebar1.style.marginLeft = "-250px";
  }
}

window.addEventListener("resize", function () {
  var sidebar1 = document.getElementById("sidebar1");

  if (this.window.innerWidth < 750) {
    sidebar1.style.marginLeft = "-250px";
  } else {
    sidebar1.style.marginLeft = "0px";
  }
});
