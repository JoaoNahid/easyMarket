<?php
  include('includes/header.php');
  include('sist/conexao.php');
?>
    <!-- section -->
    <div class="blog">
       <div class="container">
          <div class="row">
             <div class="col-md-12">
                <div class="title">
                   <i><img src="images/title.png" alt="#"/></i>
                   <h2>Nosso Encarte</h2>
                   <span>Aproveite essas promoções incríveis</span>
                </div>
             </div>
          </div>
          <div class="row">
            <?php
                $query = "SELECT * FROM produtos WHERE removido != 'sim' AND destaqueProduto = 'sim'  ORDER BY nomeProduto";
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                while($row = mysqli_fetch_assoc($result)) {
                  $nomeProduto = $row['nomeProduto'];
                  $marcaProduto = $row['marcaProduto'];
                  $idProduto = $row['idProduto'];
                  $precoProduto = $row['precoProduto'];
                  $fotoProduto = $row['fotoProduto'];
                  $pesoProduto = $row['pesoProduto'];
                  $unidadePeso = $row['unidadePeso'];
                  $codigoProduto = $row['codigoProduto'];
                  $destaqueProduto = $row['destaqueProduto'];
            ?>
             <div class="col-xl-3 col-lg-3 col-md-3 boxExibicaoProduto col-sm-12 mar_bottom">
                <div class="produto_box">
                   <div class="blog_img_box">
                     <figure><img src="sist/uploads/<?php echo $fotoProduto ?>" alt="#"/>
                       <span>oferta</span>
                     </figure>
                  </div>
                  <p><?php echo $nomeProduto.' '.$marcaProduto ?></p>
                  <h3>R$ <?php echo $precoProduto ?> </h3>
                </div>
             </div>
             <?php
              }
             ?>
             <!-- <div class="col-xl-3 col-lg-3 col-md-3 boxExibicaoProduto col-sm-12 mar_bottom">
                <div class="produto_box">
                   <div class="blog_img_box">
                      <figure><img src="images/blog_img2.png" alt="#"/>
                         <span>oferta</span>
                      </figure>
                   </div>
                   <h3>R$ 23,50 </h3>
                   <p>descrição</p>
                </div>
             </div>
             <div class="col-xl-3 col-lg-3 col-md-3 boxExibicaoProduto col-sm-12">
                <div class="produto_box">
                   <div class="blog_img_box">
                      <figure><img src="images/blog_img3.png" alt="#"/>
                         <span>oferta</span>
                      </figure>
                   </div>
                   <h3>R$ 23,50 </h3>
                   <p>descrição</p>
                </div>
             </div>
             <div class="col-xl-3 col-lg-3 col-md-3 boxExibicaoProduto col-sm-12">
                <div class="produto_box">
                   <div class="blog_img_box">
                      <figure><img src="images/blog_img3.png" alt="#"/>
                         <span>oferta</span>
                      </figure>
                   </div>
                   <h3>R$ 23,50 </h3>
                   <p>descrição</p>
                </div>
             </div>

             <div class="col-xl-3 col-lg-3 col-md-3 boxExibicaoProduto col-sm-12 mar_bottom">
                <div class="produto_box">
                   <div class="blog_img_box">
                      <figure><img src="images/blog_img1.png" alt="#"/>
                         <span>oferta</span>
                      </figure>
                   </div>
                   <h3>R$ 23,50 </h3>
                   <p>descrição</p>
                </div>
             </div>
             <div class="col-xl-3 col-lg-3 col-md-3 boxExibicaoProduto col-sm-12 mar_bottom">
                <div class="produto_box">
                   <div class="blog_img_box">
                      <figure><img src="images/blog_img2.png" alt="#"/>
                         <span>oferta</span>
                      </figure>
                   </div>
                   <h3>R$ 23,50 </h3>
                   <p>descrição</p>
                </div>
             </div>
             <div class="col-xl-3 col-lg-3 col-md-3 boxExibicaoProduto col-sm-12">
                <div class="produto_box">
                   <div class="blog_img_box">
                      <figure><img src="images/blog_img3.png" alt="#"/>
                         <span>oferta</span>
                      </figure>
                   </div>
                   <h3>R$ 23,50 </h3>
                   <p>descrição</p>
                </div>
             </div> -->

          </div>
       </div>
    </div>


    <?php
      include('includes/footer.php');
    ?>
