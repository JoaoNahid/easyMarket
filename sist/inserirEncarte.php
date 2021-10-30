<?php
include('includes/header.php');
?>
<script src="https://cdn.tiny.cloud/1/5vtboiki0kpmozo3a4zfq8x4wzt3fn6201e6ykccdkvj2bhm/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '.tinymce',
  });
  function mascaraData(val) {
  var pass = val.value;
  var expr = /[0123456789]/;

  for (i = 0; i < pass.length; i++) {
    // charAt -> retorna o caractere posicionado no índice especificado
    var lchar = val.value.charAt(i);
    var nchar = val.value.charAt(i + 1);

    if (i == 0) {
      // search -> retorna um valor inteiro, indicando a posição do inicio da primeira
      // ocorrência de expReg dentro de instStr. Se nenhuma ocorrencia for encontrada o método retornara -1
      // instStr.search(expReg);
      if ((lchar.search(expr) != 0) || (lchar > 3)) {
        val.value = "";
      }

    } else if (i == 1) {

      if (lchar.search(expr) != 0) {
        // substring(indice1,indice2)
        // indice1, indice2 -> será usado para delimitar a string
        var tst1 = val.value.substring(0, (i));
        val.value = tst1;
        continue;
      }

      if ((nchar != '/') && (nchar != '')) {
        var tst1 = val.value.substring(0, (i) + 1);

        if (nchar.search(expr) != 0)
          var tst2 = val.value.substring(i + 2, pass.length);
        else
          var tst2 = val.value.substring(i + 1, pass.length);

        val.value = tst1 + '/' + tst2;
      }

    } else if (i == 4) {

      if (lchar.search(expr) != 0) {
        var tst1 = val.value.substring(0, (i));
        val.value = tst1;
        continue;
      }

      if ((nchar != '/') && (nchar != '')) {
        var tst1 = val.value.substring(0, (i) + 1);

        if (nchar.search(expr) != 0)
          var tst2 = val.value.substring(i + 2, pass.length);
        else
          var tst2 = val.value.substring(i + 1, pass.length);

        val.value = tst1 + '/' + tst2;
      }
    }

    if (i >= 6) {
      if (lchar.search(expr) != 0) {
        var tst1 = val.value.substring(0, (i));
        val.value = tst1;
      }
    }
  }

  if (pass.length > 10)
    val.value = val.value.substring(0, 10);
  return true;
}
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
if (isset($_POST['proximo'])) {
  $qtdProdutos = $_POST['qtdProdutos'];
  echo '
    <script>
      window.location.href = "inserirEncarte.php?Pagina2";
    </script>
  ';
}

if(isset($_POST['cadastrar'])){

  $codigoProduto = htmlspecialchars($_POST['codigoProduto'], ENT_QUOTES, 'utf-8');
  $dataExpiracao = htmlspecialchars($_POST['dataExpiracao'], ENT_QUOTES, 'utf-8');


  $query = "INSERT INTO projetos (titulo, texto, foto, link, removido) VALUES ('$titulo', '$texto', '$foto', '$link', '')";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if (mysqli_affected_rows($conn)) {
    header('Location: listaProjetos.php?Operacao realizada com sucesso');
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
      <?php
        if (!isset($_GET['Pagina2'])) {
      ?>
      <div class="row">
        <div class="col-md-6">
          <p class="tituloCampo">Quantidade de Produtos</p>
          <input type="number" autocomplete="off" id="qtdProdutos" name="qtdProdutos">
        </div>

        <div class="col-md-6">
          <p class="tituloCampo">Data de Expiração</p>
          <input type="text" maxlength="10" onkeypress="mascaraData(this)" autocomplete="off" placeholder="dd/mm/aaaa" name="link" value="<?php if(isset($_GET['idEncarte'])){echo $link;} ?>">
        </div>
      </div>
      <?php
        }
        else{

          echo $qtdProdutos;
        }
      ?>


      <br><br><br><br>
      <?php
        if (isset($_GET['pagina2'])) {  echo '<input type="submit" class="btnSalvar" name="cadastrar" value="Salvar">'; }
        else { echo '<input type="submit" class="btnSalvar" name="proximo" value="Próximo">';}
      ?>

    </form>
  </div>
</div>

<script>
  function excluirItem(){
    if (window.confirm("Deseja mesmo excluir este item?")) {
      window.location.href = "inserirProjeto.php?itemRemovido=<?php echo $idEncarte; ?>"
    }
  }

</script>

<?php
  include('includes/footer.php');
?>
