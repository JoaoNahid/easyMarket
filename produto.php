<?php
  include('includes/header.php');
  include('arquivosDeSessao/verificaLogin.php');

  $idCliente = $_SESSION['idCliente'];
  if (isset($_GET['adicionarACesta'])) {
    $codigoProdutoParaAdicionar = $_GET['adicionarACesta'];
    // echo '<br>';
    echo $query = "SELECT codigoProduto FROM cesta_cliente_$idCliente WHERE codigoProduto = '$codigoProdutoParaAdicionar'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if(mysqli_num_rows($result) == 0){
      $query = "INSERT INTO cesta_cliente_$idCliente (codigoProduto) VALUES ('$codigoProdutoParaAdicionar')";
      $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
      if ($result) {
        echo '
          <script>
            window.location.href = "mercado.php";
          </script>
        ';
      }
    }
    else {
      echo '
        <script>
          if (window.confirm("Este produto ja está em sua cesta de compras")) {
            window.location.href = "mercado.php";
          }
        </script>
      ';
    }
  }

    // echo '
    //   <script>
    //       window.location.href = "index.php?id='.$idProduto.'";
    //   </script>
    // ';

?>
<!-- <div class="yellow_bg">
   <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="title">
                     <h2>Nome Produto</h2>

                  </div>
               </div>
            </div>
          </div>
</div> -->




<?php
  include('includes/footer.php');
?>
