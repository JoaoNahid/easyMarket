<?php
include('includes/header.php');
?>
<script src="https://cdn.tiny.cloud/1/5vtboiki0kpmozo3a4zfq8x4wzt3fn6201e6ykccdkvj2bhm/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '.tinymce',
  });
</script>

<?php

if (isset($_GET['idEncarte'])) {
  $idEncarte = $_GET['idEncarte'];

  $query = "SELECT * FROM encarte WHERE idEncarte = '1'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  while($row = mysqli_fetch_assoc($result)) {
    $codigoProdutos = $row['titulo'];

  }
}

if(isset($_POST['cadastrar'])){

  $dataExpiracao = htmlspecialchars($_POST['dataExpiracao'], ENT_QUOTES, 'utf-8');
  $qtdProdutos = htmlspecialchars($_POST['qtdProdutos'], ENT_QUOTES, 'utf-8');
  $codigosProduto = '';
  for ($i=1; $i <= $qtdProdutos ; $i++) {
    $codigosProduto .= htmlspecialchars($_POST['produto'.$i], ENT_QUOTES, 'utf-8').';';
  }
  // $codigosProduto = htmlspecialchars($_POST['codigoProduto'], ENT_QUOTES, 'utf-8');


  $query = "INSERT INTO encarte (qtdProdutos, codigosProdutos, dataExpiracao) VALUES ('$qtdProdutos', '$codigosProduto', '$dataExpiracao')";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if (mysqli_affected_rows($conn)) {
    $produtoExplodido = explode(';', $codigosProduto);
    for ($x=0; $x < count($produtoExplodido)-1 ; $x++) {
      $query = "UPDATE produtos SET destaqueProduto='sim' WHERE codigoProduto = '$produtoExplodido[$x]'";
      $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if (mysqli_affected_rows($conn)){
          header('Location: listaEncarte.php?Operacao realizada com sucesso');
        }
    }


  }
  else{
    echo '
      <script>
        window.alert("Erro ao salvar, tente novamente!")
      </script>
    ';
  }

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
      <h3 class="colunasTop"><?php if(isset($_GET['idEncarte'])){echo 'Editar Projeto';}else{ echo 'Adicionar Projeto';} ?></h3>

      <div class="btnsTop floatRight colunasTop">
        <?php
          if (isset($_GET['idEncarte'])) {
            $idEncarte = $_GET['idEncarte'];
            echo '
            <div class="btnAdicionar btnRemover colunasTop">
              <div onclick="excluirItem()"><span class="">Remover</span> <i class="fas fa-trash"></i></div>
            </div>
            ';
          }
        ?>
      </div>
    </div>


    <form class="boxInputs" method="post" enctype="multipart/form-data">

      <div class="row">
        <div class="col-md-6">
          <p class="tituloCampo">Quantidade de Produtos</p>
          <div class="row">
            <div class="col-md-8">
              <input type="number" autocomplete="off" id="qtdProdutos" name="qtdProdutos">
            </div>
            <div class="col-md-4">
              <button type="button" onclick="adicionarCampo()" id="adicionar" name="button">Adicionar</button>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <p class="tituloCampo">Data de Expiração</p>
          <input type="text" data-js="data" autocomplete="off" placeholder="dd/mm/aaaa" name="dataExpiracao" value="<?php if(isset($_GET['idEncarte'])){echo $link;} ?>">
        </div>

      </div>

      <div id="camposAdicaoProdutos"> <!-- Campos adição produtos -->

      </div>
      <script>
        function adicionarCampo(){
          var valorInputQtd = document.getElementById('qtdProdutos').value;
          let camposProdutos = "";
          for (var i = 1; i <= valorInputQtd; i++) {
            camposProdutos += '<p class="tituloCampo">Produto '+i+' </p><input type="text" autocomplete="off" name="produto'+i+'" value="">';
          }
          document.getElementById('camposAdicaoProdutos').innerHTML = camposProdutos;
        }
      </script>
      <?php
        // $qtdProdutos = "<script>document.write(valorInputQtd)</script>";
        // echo $qtdProdutos;
      ?>


      <br><br><br><br>
      <input type="submit" class="btnSalvar" name="cadastrar" value="Salvar">
      <?php
        // if (isset($_GET['pagina2'])) {  echo '<input type="submit" class="btnSalvar" name="cadastrar" value="Salvar">'; }
        // else { echo '<input class="btnSalvar" onclick="proximoCampo()" id="proximo" value="Próximo">';}
      ?>

    </form>
  </div>
</div>

<script src="js/mascarasInput.js" >
</script>

<?php
  include('includes/footer.php');
?>
