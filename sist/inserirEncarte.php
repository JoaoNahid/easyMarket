<?php
include('includes/header.php');
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
      <h3 class="colunasTop">Criando Encarte</h3>

      <div class="btnsTop floatRight colunasTop">
        <div class="btnAdicionar colunasTop ">
          <a href="criarEncarte.php"><span class="">Próximo</span></a>
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
                $codigoProduto = $row['codigoProduto'];
                $descricaoProduto = $row['descricaoProduto'];

                echo '
                <div class="col-md-4">
                  <div class="itemLista">
                    <a href="inserirProduto.php?idProduto='.$idProduto.'"><div class="imgProduto" style="background: url(sist/uploads/'.$fotoProduto.') no-repeat center; background-size: cover;"></div></a>
                    <div class="descProduto">
                      <a href="inserirProduto.php?idProduto='.$idProduto.'"><h3>'.$nomeProduto.' '.$marcaProduto.'</h3></a>
                      <p>'.$pesoProduto.'</p>
                      <p>'.$codigoProduto.'</p>
                      <h4><strong>R$ </strong>'.$precoProduto.'</h4>
                    </div>
                  </div>
                </div>
                ';

              }
            ?>
          </div>
        </div>

      </div>


    </section>
    <br>

  </div>
</div>

<?php
  include('includes/footer.php');
?>
