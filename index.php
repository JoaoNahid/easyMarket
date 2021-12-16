<?php
  include('includes/header.php');
  include('arquivosDeSessao/conexaoBancoInterno.php');
?>
<!-- start slider section -->
<div class="bannerSection">
  <img src="images/bannerHome2.png" alt="">
</div>
<!-- end slider section -->

<!-- ofertas section -->
<?php
  $query = "SELECT * FROM encarte";
  $result = mysqli_query($connBDInterno, $query) or die(mysqli_error($connBDInterno));
  if (mysqli_num_rows($result) > 0) {
?>

<section class="resip_section">
   <div class="containerSlider">
      <div class="row">
         <div class="col-md-12">
            <div class="ourheading">
               <h2>Nossas ofertas</h2>
            </div>
         </div>
         <div class="containerSlider">
            <div class="row">
               <div class="col-md-12">
                  <div class="carousel" data-flickity='{ "autoPlay": true, "wrapAround": true }'>
                    <?php
                    $query = "SELECT * FROM produtos WHERE destaqueProduto='sim' ORDER BY rand() LIMIT 6 ";
                      $result = mysqli_query($connBDInterno, $query) or die(mysqli_error($connBDInterno));
                      while($row = mysqli_fetch_assoc($result)) {
                        $nomeProdutoDestaque = $row['nomeProduto'];
                        $marcaProdutoDestaque = $row['marcaProduto'];
                        $idProdutoDestaque = $row['idProduto'];
                        $precoProdutoDestaque = $row['precoPromocao'];
                        $fotoBancoDestaque = $row['fotoProduto'];
                        $pesoProdutoDestaque = $row['pesoProduto'];
                        $unidadePesoDestaque = $row['unidadePeso'];

                        echo '
                        <div class="carousel-cell">
                           <div class="item">
                              <div class="product_blog_img boxImgDestaque">
                                 <img src="sist/uploads/'.$fotoBancoDestaque.'" alt="#" />
                              </div>
                              <div class="product_blog_cont">
                                 <h3>'.$nomeProdutoDestaque.' '.$pesoProdutoDestaque.' '.$unidadePesoDestaque.'</h3>
                                 <h4><span class="theme_color">$</span>'.$precoProdutoDestaque.'</h4>
                              </div>
                           </div>
                        </div>
                        ';
                      }
                    ?>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?php
  }
?>
<!-- end oferta section -->

<div class="bg_bg">
   <!-- about -->
   <div class="about">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="title">
                  <i><img src="images/title.png" alt="#"/></i>
                  <h2>Sobre nossa comida e restaurante</h2>
                  <span>É um fato há muito estabelecido que um leitor será distraído pelo conteúdo legível de um
                  <br> página ao olhar para seu layout. O objetivo de usar Lorem
                  </span>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
               <div class="about_box">
                  <h3>Melhor comida</h3>
                  <p>Ao contrário da crença popular, Lorem Ipsum não é simplesmente um texto aleatório. Tem raízes em uma peça da literatura clássica latina de 45 aC, com mais de 2.000 anos. Richard McClintock, professor de latim no Hampden-Sydney College, na Virgínia, pesquisou um dos mais obscuros. Ao contrário da crença popular, Lorem Ipsum não é simplesmente um texto aleatório. Tem raízes em uma peça da literatura clássica latina de 45 aC, com mais de 2.000 anos. Richard</p>
                  <a href="#">Consulte mais informações <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
               </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-10 col-sm-12 about_img_boxpdnt">
               <div class="about_img">
                  <figure><img src="images/about-img.jpg" alt="#/"></figure>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end about -->

   <!-- Our Client -->
   <div class="Client">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="title">
                  <i><img src="images/title.png" alt="#"/></i>
                  <h2>Nosso cliente</h2>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6 offset-md-3">
               <div class="Client_box">
                  <img src="images/client.jpg" alt="#"/>
                  <h3>Roock Due</h3>
                  <p>Existem muitas variações de passagens de Lorem Ipsum disponíveis, mas a maioria sofreu alteração de alguma forma, por humor injetado ou palavras aleatórias que não parecem nem um pouco críveis. Se você for usar uma passagem de Lorem Ipsum, precisa ter certeza de que não há nada embaraçoso escondido no meio do texto.</p>
                  <i><img src="images/client_icon.png" alt="#"/></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end Our Client -->
</div>
<?php
   include('includes/footer.php');
   ?>
