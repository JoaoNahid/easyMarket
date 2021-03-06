<?php
  include('includes/header.php');
  include('arquivosDeSessao/verificaLogin.php');
  include('arquivosDeSessao/conexaoBancoInterno.php');

  $idCliente = $_SESSION['idCliente'];

  $query = "SELECT * FROM produtos WHERE removido != 'sim' ORDER BY nomeProdutos";

  if(isset($_GET['pagina'])){
    $pagina=$_GET['pagina'];
      $paginaAtual = $pagina;
  }
  else {
    $paginaAtual = '1';
  }

  $qtdPorPagina = '6'; // número de registros por página
  $inicio = $paginaAtual - 1;
  $inicio = $inicio * $qtdPorPagina;
  $limite = $inicio.','.$qtdPorPagina;

  $verificaCategoriaParaPaginacao = '';
  if(isset($_GET['categoria'])){
    $categoriaPaginacao = htmlspecialchars($_GET['categoria'], ENT_QUOTES, 'utf-8');
    $verificaCategoriaParaPaginacao = 'categoria='.$categoriaPaginacao.'&';
    $todos = "SELECT * FROM produtos WHERE removido != 'sim' AND idCategoria = $categoriaPaginacao ORDER BY nomeProduto";
  }
  else {
    $todos = "SELECT * FROM produtos WHERE removido != 'sim' ORDER BY nomeProduto";
  }

  $result = mysqli_query($connBDInterno, $todos);
  $numRegistros =  mysqli_num_rows($result); // verifica o número total de registros
  $qtdPaginas = $numRegistros / $qtdPorPagina; // verifica o número total de páginas
?>

<section class="cabecalhosPagina">
  <div class="container">
    <div class="row">
       <div class="col-md-12">
          <div class="title">
             <i><img src="images/title.png" alt="#"/></i>
             <h2>Nossos Produtos</h2>
             <span>Fique por dentro do melhor que há em nosso supermercado</span>
          </div>
       </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="boxOrdenacao">
          <h2>Filtre sua busca</h2>
          <div class="ordenacaoDeExibicao">
            <h3>Preço</h3>
            <ul>
              <li><a href="#">Maior preço</a></li>
              <li><a href="#">Menor preço</a></li>
            </ul>
          </div>
          <div class="ordenacaoDeExibicao">
            <h3>Categorias</h3>
            <ul>
              <?php
                $query = "SELECT * FROM categorias WHERE removido != 'sim' ORDER BY nomeCategoria";
                $result = mysqli_query($connBDInterno, $query) or die(mysqli_error($connBDInterno));
                while($row = mysqli_fetch_assoc($result)) {
                  $idCategoria = $row['idCategoria'];
                  $nomeCategoria = $row['nomeCategoria'];
                  echo '
                    <li><a href="mercado.php?categoria='.$idCategoria.'"> '.$nomeCategoria.' </a></li>
                  ';
                }
              ?>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-9">  <!--  exibição produtos -->
        <div class="row">
          <?php
            if(isset($_GET['categoria'])){
              $categoriaBusca = htmlspecialchars($_GET['categoria'], ENT_QUOTES, 'utf-8');
              $query = "SELECT * FROM produtos WHERE removido != 'sim' AND idCategoria='$categoriaBusca' ORDER BY nomeProduto LIMIT $limite";
            }
            else{
              $query = "SELECT * FROM produtos WHERE removido != 'sim'  ORDER BY nomeProduto LIMIT $limite";
            }

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


                $verificaSeTemNaCesta ='<a class="addCesta" href="produto.php?adicionarACesta='.$codigoProduto.'"><i class="fas fa-shopping-basket"></i></a>';
                $verificaExistenciaDb = mysqli_query($conn, "SHOW TABLES LIKE 'cesta_cliente_$idCliente'") or die(mysqli_error($conn));
                if ($verificaExistenciaDb ->num_rows > 0) {

                  $query2 = "SELECT * FROM cesta_cliente_$idCliente WHERE codigoProduto = '$codigoProduto'";
                  $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
                  if(mysqli_num_rows($result2) > 0){
                    $verificaSeTemNaCesta = '<a class="addCesta" "><i class="fas fa-check"></i></a>';
                  }
                }


            ?>
           <div class="col-xl-4 col-lg-4 col-md-4 boxExibicaoProduto col-sm-12 mar_bottom">
              <div class="produto_box">
                 <div class="blog_img_box">
                    <figure>
                      <img src="sist/uploads/<?php echo $fotoProduto ?>" alt="#"/>
                      <?php
                        if ($destaqueProduto == 'sim') {
                          echo '<span>oferta</span>';
                        }
                       ?>
                    </figure>
                    <?php echo $verificaSeTemNaCesta; ?>
                 </div>
                 <p><?php echo $nomeProduto.' '.$marcaProduto ?></p>
                 <h3>R$ <?php if($destaqueProduto == 'sim'){echo $precoPromocao; } else{echo $precoProduto;} ?> </h3>
              </div>
           </div>
           <?php
            }
           ?>

        </div>
        <?php

          $anterior = $paginaAtual -1;
          $proximo = $paginaAtual +1;
          if ($paginaAtual>1) {
              echo ' <a href="?'.$verificaCategoriaParaPaginacao.'pagina='.$anterior.'"><i class="fas fa-angle-left"></i> Anterior</a> ';
          }

          echo "|";
          if ($paginaAtual<$qtdPaginas) {
            echo ' <a href="?'.$verificaCategoriaParaPaginacao.'pagina='.$proximo.'"><i class="fas fa-angle-right"></i> Próximo</a> ';
          }
        ?>
      </div>
    </div>
  </div>
</section>


<?php
  include('includes/footer.php');
?>
