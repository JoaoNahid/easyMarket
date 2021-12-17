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
  else {
    echo '
    <section class="cabecalhosPagina">
      <div class="container">
        <div class="row">
           <div class="col-md-12">
              <div class="title">
                 <i><img src="images/title.png" alt="#"/></i>
                 <h2>Em Breve Novas Ofertas!!</h2>
                 <a href="mercado.php">Ir para o mercado</a>
              </div>
           </div>
        </div>
      </div>
    </section>
    ';
  }
?>

<!-- end oferta section -->
<br><br><br><br>

<?php
   include('includes/footer.php');
   ?>
