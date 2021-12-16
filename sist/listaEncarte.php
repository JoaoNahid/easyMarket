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


      <?php
        $query = "SELECT * FROM encarte";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if (mysqli_num_rows($result) < 1) {
          echo '
            <div class="cabecalhoForm">
              <h3 class="colunasTop">Nenhum Encarte Ativo</h3>
              <div class="btnsTop floatRight colunasTop">
                <div class="btnAdicionar colunasTop ">
                  <a href="inserirEncarte.php"><span class="">Criar Encarte</span> <i class="fas fa-plus"></i></a>
                </div>
              </div>
            </div>
          ';
        }
        else {
            while($row = mysqli_fetch_assoc($result)) {
              $dataExpiracaoBanco = strtotime($row['dataExpiracao']);
              $dataAtual = strtotime(date('d/m/Y'));
              $codigosProdutoBanco = $row['codigosProdutos'];


              if ($dataAtual > $dataExpiracaoBanco) {
                $produtoExplodido = explode(';', $codigosProdutoBanco);
                for ($x=0; $x < count($produtoExplodido)-1 ; $x++) {
                  $query = "UPDATE produtos SET destaqueProduto='' WHERE codigoProduto = '$produtoExplodido[$x]'";
                  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                }
                if (mysqli_affected_rows($conn)){
                  $query = "TRUNCATE TABLE encarte";
                  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                }
              }
            }

          echo '
          <div class="cabecalhoForm">
            <h3 class="colunasTop">Produtos em Encarte</h3>
          </div>
          ';
      ?>
      <section class="boxLista">
        <div class="row">
          <div class="col-md-3 filtroBusca">
            <h3>Informações</h3>
            <ul>
              <?php
                $query = "SELECT * FROM encarte";
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                while($row = mysqli_fetch_assoc($result)) {
                  $dataExpiracao = $row['dataExpiracao'];
                  $qtdProdutosBanco = $row['qtdProdutos'];
                }
              ?>
              <a><li>Validade: <?php echo $dataExpiracao; ?></li></a>
              <a><li>Qtd. produtos: <?php echo $qtdProdutosBanco; ?></li></a>
            </ul>
          </div>
          <div class="col-md-9">

            <form action="inserirEncarte.php" class="listaParaEncarte">
              <div class="row">
                <?php


                  $query = "SELECT * FROM produtos WHERE removido != 'sim' AND destaqueProduto = 'sim' ORDER BY nomeProduto";
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

                        <label class="itemLista">
                          <a ><div class="imgProduto" style="background: url(../sist/uploads/'.$fotoProduto.') no-repeat center; background-size: cover;"></div></a>
                          <div class="descProduto">
                            <a><h3>'.$nomeProduto.' '.$marcaProduto.'</h3></a>
                            <p>'.$pesoProduto.'</p>
                            <p>'.$codigoProduto.'</p>
                            <h4><strong>R$ </strong>'.$precoProduto.'</h4>
                          </div>
                        </label>
                      </div>

                    ';
                  }
                ?>
              </div>
            </form>

          </div>

        </div>


      </section>
      <?php
        }
      ?>




    <br>

  </div>
</div>

<?php
  include('includes/footer.php');
?>
