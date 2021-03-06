<?php
  include('includes/header.php');
  include('arquivosDeSessao/conexao.php');
  include('arquivosDeSessao/verificaLogin.php');
  include('arquivosDeSessao/conexaoBancoInterno.php');

  $idCliente = $_SESSION['idCliente'] ;

// removendo da lista de compras
  if (isset($_GET['itemRemovido'])) {
    $codigoProdutoRemovido = $_GET['itemRemovido'];
    $query = "DELETE FROM cesta_cliente_$idCliente WHERE codigoProduto = '$codigoProdutoRemovido'";
    $result = mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn)) {
      echo '
          window.location.href = "minhaCestaDeCompras.php?Item removido com sucesso"
      ';
    }
  }


// criando cesta de compras
  if (isset($_POST['criarCesta'])) {
    $criaTabela = "CREATE TABLE cesta_cliente_$idCliente(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    codigoProduto VARCHAR(255) NOT NULL,
    lixeira TEXT(3) NOT NULL,
    reg_date TIMESTAMP
    ) ";
    if (mysqli_query($conn, $criaTabela)) {
      $query = "UPDATE clientes SET cestaDeCompra='sim' WHERE idCliente = '$idCliente' ";
      $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
      echo '
        <script>
          window.alert("Cesta pronta para encher!")
        </script>
      ';
    }
    else {
      echo '
        <script>
          window.alert("Erro ao criar cesta :(")
        </script>
      ';
     }
  }
// fim criação da cestaDeCompra


  $query = "SELECT cestaDeCompra FROM clientes WHERE idCliente = '$idCliente'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  while($row = mysqli_fetch_assoc($result)){
    $verificaExistenciaCesta = $row['cestaDeCompra'];

    if($verificaExistenciaCesta != 'sim'){
      echo '
      <section class="cabecalhosPagina">
        <div class="container">
          <div class="row">
             <div class="col-md-12">
                <div class="title">
                   <i><img src="images/title.png" alt="#"/></i>
                   <h2>Você ainda não possui uma cesta :(</h2>
                   <form class="" method="post">
                     <input type="submit" name="criarCesta" value="Criar Cesta de compras agora">
                   </form>
                </div>
             </div>
          </div>
        </div>
      </section>
      ';
    }
  }

?>


<!-- após criado a cesta -->
<?php

  $verificaExistenciaDb = mysqli_query($conn, "SHOW TABLES LIKE 'cesta_cliente_$idCliente'") or die(mysqli_error($conn));
  if ($verificaExistenciaDb ->num_rows > 0) {

    $totalPreco = 0;
    $query = "SELECT codigoProduto FROM cesta_cliente_$idCliente";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_num_rows($result) == 0) {
      echo '
      <section class="cabecalhosPagina">
        <div class="container">
          <div class="row">
             <div class="col-md-12">
                <div class="title">
                   <i><img src="images/title.png" alt="#"/></i>
                   <h2>Sua cesta está vazia</h2>
                   <a href="mercado.php">Ir para o mercado</a>
                </div>
             </div>
          </div>
        </div>
      </section>
      ';
    }
    else{
      echo '
      <section class="cabecalhosPagina">
        <div class="container">
          <div class="row">
             <div class="col-md-12">
                <div class="title">
                   <i><img src="images/title.png" alt="#"/></i>
                   <h2>Cesta de compras</h2>
                </div>
             </div>
          </div>
        </div>
      </section>
        <section class="">
          <div class="container">
            <div class="boxCestaCompras">
      ';
      while($row = mysqli_fetch_assoc($result)) {
        $codigoProduto = $row['codigoProduto'];
        $query2 = "SELECT * FROM produtos WHERE codigoProduto = '$codigoProduto'";
        $result2 = mysqli_query($connBDInterno, $query2) or die(mysqli_error($connBDInterno));
        while($row2 = mysqli_fetch_assoc($result2)) {
          $nomeProduto = $row2['nomeProduto'];
          $marcaProduto = $row2['marcaProduto'];
          $idProduto = $row2['idProduto'];
          $destaqueProduto = $row2['destaqueProduto'];
          if ($destaqueProduto == 'sim') {
            $precoProduto = $row2['precoPromocao'];
          } else{
            $precoProduto = $row2['precoProduto'];
          }
          $localizacaoProduto = $row2['localizacaoProduto'];
          $fotoProduto = $row2['fotoProduto'];


          echo '
                  <div class="itemCesta">
                    <div class="imagemProdutoCesta" style="background: url(sist/uploads/'.$fotoProduto.') no-repeat center; background-size: cover"></div>
                    <h3 class="nomeProdutoCesta">'.$nomeProduto.' '.$marcaProduto.'</h3>
                    <h3 class="locProdutoCesta">localização: '.$localizacaoProduto.'</h3>
                    <form class="opcoesItemCesta" method="post">
                      <a href="minhaCestaDeCompras.php?itemRemovido='.$codigoProduto.'" name="excluirItemCesta">
                        <i class="fas fa-trash"></i>
                      </a>
                    </form>
                  </div>

          ';

          $totalPreco = $totalPreco + $precoProduto;
        }
      }
      echo '

            </div>
          </div>
        </section>
      ';
      
      $totalPreco = number_format($totalPreco, 2, ',', '');
    }
  }

  echo '
    <div class="container">
      <div class="totalCesta">Total: <span>R$</span> '.$totalPreco.'</div>
    </div>
  ';
?>

<?php
  include('includes/footer.php');
?>
