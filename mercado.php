<?php
  include('includes/header.php');
  include('arquivosDeSessao/verificaLogin.php');
  include('sist/conexao.php');

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
  $todos = "SELECT * FROM produtos WHERE removido != 'sim' ORDER BY nomeProduto";

  $result = mysqli_query($conn, $todos);
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
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
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

              $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
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
                      <a class="addCesta" href="produto.php?adicionarACesta=<?php echo $codigoProduto; ?>">
                        <i class="fas fa-shopping-basket"></i>
                      </a>
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
        echo " <a href='?pagina=$anterior'><i class='fas fa-angle-left'></i> Anterior</a> ";
        }

        echo "|";
        if ($paginaAtual<$qtdPaginas) {
        echo " <a href='?pagina=$proximo'>Próxima <i class='fas fa-angle-right'></i></a>";
        }
        ?>
      </div>
    </div>
  </div>
</section>


<?php
  include('includes/footer.php');
?>
