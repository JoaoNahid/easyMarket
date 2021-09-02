<?php
include('includes/header.php');
  $query = "SELECT * FROM produtos WHERE removido != 'sim' ORDER BY nomeProdutos";
  
  $qtdPorPagina = '5'; // número de registros por página
  
  if(isset($_GET['pagina'])){
    $pagina=$_GET['pagina'];
      $paginaAtual = $pagina;
  }
  else {
    $paginaAtual = '1';
  }
  
    $inicio = $paginaAtual - 1;
    $inicio = $inicio * $qtdPorPagina;
    $limite = "SELECT * FROM produtos WHERE removido != 'sim' ORDER BY nomeProdutos LIMIT $inicio,$qtdPorPagina";
    $todos = "SELECT * FROM produtos WHERE removido != 'sim' ORDER BY nomeProdutos";

    $numRegistros =  mysqli_num_rows(mysqli_query($conn, $todos)); // verifica o número total de registros
    $qtdPaginas = $numRegistros / $qtdPorPagina; // verifica o número total de páginas

    // vamos criar a visualização
    while ($dados = mysqli_fetch_array($limite)) {
    $nome = $dados["nome"];
    echo "Nome: $nome<br>";
    }
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
              $query = "SELECT * FROM produtos WHERE removido != 'sim' AND idCategoria='$categoriaBusca' ORDER BY nomeProduto";
            }
            else{
              $query = "SELECT * FROM produtos WHERE removido != 'sim' ORDER BY nomeProduto";
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
          echo " <a href='?pagina=$anterior'><- Anterior</a> ";
          }
          echo "|";
          if ($paginaAtual<$tp) {
          echo " <a href='?pagina=$proximo'>Próxima -></a>";
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
