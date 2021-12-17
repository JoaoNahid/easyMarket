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
        if (isset($_GET['produtoEncarte'])) {
          echo '
            <script>
              window.location.href = "encarte.php";
            </script>
          ';
        } else{
            echo '
              <script>
                window.location.href = "mercado.php";
              </script>
            ';
          }
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


?>




<?php
  include('includes/footer.php');
?>
