

$(document).ready(function(){
  $('.menu-anchor').on('click touchstart', function(e){
      $('html').toggleClass('menu-active');
      e.preventDefault();
  });
});

$('.divMenu').bind('click', function(){
    var menuClicado = $(this).attr('id');
    $('div#'+menuClicado+' ul div.corpoCategoriaMenu').toggleClass('corpoCategoriaMenuBlock');
    $('div#'+menuClicado+' ul div.setaVetorTop').toggleClass('setaVetorBottom');
    localStorage.setItem("menuAberto", menuClicado);
    console.log(menuClicado);
});




if(localStorage.getItem("menuAberto")){
  var menuAbertoAtual = localStorage.getItem("menuAberto");
  console.log(menuAbertoAtual);
  if (window.innerWidth > 1000) {
      $('div#'+menuAbertoAtual+' ul div.corpoCategoriaMenu').toggleClass('corpoCategoriaMenuBlock');
      $('div#'+menuAbertoAtual+' ul div.setaVetorTop').toggleClass('setaVetorBottom');
  }
}

$('.telefone').mask('(00) 0 0000-0000');
$('.dinheiro').mask('#.##0,00', {reverse: true});
$('.estado').mask('AA');
