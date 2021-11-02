<?php
  include('includes/header.php');
  include('arquivosDeSessao/conexao.php');
  include('arquivosDeSessao/conexaoBancoInterno.php');

  $idCliente = $_SESSION['idCliente'];
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
                $result = mysqli_query($connBDInterno, $query) or die(mysqli_error($connBDInterno));
                while($row = mysqli_fetch_assoc($result)) {
                  $nomeProduto = $row['nomeProduto'];
                  $marcaProduto = $row['marcaProduto'];
                  $idProduto = $row['idProduto'];
                  $precoProduto = $row['precoProduto'];
                  $precoPromocao = $row['precoPromocao'];
                  $fotoProduto = $row['fotoProduto'];
                  $pesoProduto = $row['pesoProduto'];
                  $unidadePeso = $row['unidadePeso'];
                  $codigoProduto = $row['codigoProduto'];
                  $destaqueProduto = $row['destaqueProduto'];

                  $query2 = "SELECT * FROM cesta_cliente_$idCliente WHERE codigoProduto = '$codigoProduto'";
                  $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
                  if(mysqli_num_rows($result2) > 0){
                    $verificaSeTemNaCesta = '<a class="addCesta" "><i class="fas fa-check"></i></a>';
                  } else{
                    $verificaSeTemNaCesta ='<a class="addCesta" href="produto.php?adicionarACesta='.$codigoProduto.'&encarte"><i class="fas fa-shopping-basket"></i></a>';
                  }
            ?>
            <div class="col-xl-4 col-lg-4 col-md-4 boxExibicaoProduto col-sm-12 mar_bottom">
               <div class="produto_box">
                  <div class="blog_img_box">
                     <figure>
                       <img src="sist/uploads/<?php echo $fotoProduto ?>" alt="#"/>
                       <?php  echo '<span>oferta</span>';  ?>
                     </figure>
                     <?php echo $verificaSeTemNaCesta; ?>
                  </div>
                  <p><?php echo $nomeProduto.' '.$marcaProduto ?></p>
                  <h3>R$ <?php echo $precoPromocao; ?> </h3>
               </div>
            </div>
             <?php
              }
             ?>

          </div>
       </div>
    </div>


    <?php
      include('includes/footer.php');
    ?>
