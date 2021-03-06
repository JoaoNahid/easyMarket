<?php
  include('includes/header.php');
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

  $result = mysqli_query($conn, $todos);
  $numRegistros =  mysqli_num_rows($result); // verifica o número total de registros
  $qtdPaginas = $numRegistros / $qtdPorPagina; // verifica o número total de páginas
?>
<script src="https://cdn.tiny.cloud/1/5vtboiki0kpmozo3a4zfq8x4wzt3fn6201e6ykccdkvj2bhm/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '.tinymce',
  });
</script>

<div class="container">
  <div class="conteudoFormulario" method="post">
    <div class="cabecalhoForm">
      <h3 class="colunasTop">Produtos</h3>

      <div class="btnsTop floatRight colunasTop">
        <div class="btnAdicionar colunasTop ">
          <a href="inserirProduto.php"><span class="">Adicionar Produto</span> <i class="fas fa-plus"></i></a>
        </div>
      </div>
    </div>

    <section class="boxLista">
      <div class="row">
        <div class="col-md-3 filtroBusca">
          <h3>Buscar Por:</h3>
          <ul>
            <a href="listaProdutos.php"><li>Todos</li></a>
            <?php
              $query = "SELECT * FROM categorias WHERE removido != 'sim' ORDER BY nomeCategoria";
              $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
              while($row = mysqli_fetch_assoc($result)) {
                $idCategoria = $row['idCategoria'];
                $nomeCategoria = $row['nomeCategoria'];
                echo '
                  <a href="listaProdutos.php?categoria='.$idCategoria.'"><li>'.$nomeCategoria.'</li></a>
                ';
              }
            ?>

          </ul>
        </div>
        <div class="col-md-9">
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
                $categoriaProduto = $row['idCategoria'];
                $precoProduto = $row['precoProduto'];
                $fotoProduto = $row['fotoProduto'];
                $pesoProduto = $row['pesoProduto'];
                $unidadePeso = $row['unidadePeso'];
                $codigoProduto = $row['codigoProduto'];
                $descricaoProduto = $row['descricaoProduto'];

                echo '
                <div class="col-md-4">
                  <div class="itemLista">
                    <a href="inserirProduto.php?idProduto='.$idProduto.'"><div class="imgProduto" style="background: url(uploads/'.$fotoProduto.') no-repeat center; background-size: cover;"></div></a>
                    <div class="descProduto">
                      <a href="inserirProduto.php?idProduto='.$idProduto.'"><h3>'.$nomeProduto.' - '.$marcaProduto.'</h3></a>
                      <p>'.$pesoProduto.' '.$unidadePeso.'</p>
                      <p><strong>Código: </strong> '.$codigoProduto.'</p>
                      <h4><strong>R$ </strong>'.$precoProduto.'</h4>
                    </div>
                  </div>
                </div>
                ';

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


    </section>
    <br>

  </div>
</div>

<?php
  include('includes/footer.php');
?>
