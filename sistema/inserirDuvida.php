<?php
include('includes/header.php');

if (isset($_GET['idPergunta'])) {
  $idPergunta = $_GET['idPergunta'];
  $query = "SELECT * FROM duvidas WHERE idPergunta = '$idPergunta'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  while($row = mysqli_fetch_assoc($result)) {
    $pergunta = $row['pergunta'];
    $resposta = $row['resposta'];

  }
}

if (isset($_GET['itemRemovido'])) {
  $idProdutoRemovido = $_GET['itemRemovido'];
  $query = "UPDATE duvidas SET removido='sim' WHERE idPergunta = '$idProdutoRemovido'";
  $result = mysqli_query($conn, $query);
  if (mysqli_affected_rows($conn)) {
    header('Location: listaDuvidas.php?Item removido com sucesso');
  }
}


if(isset($_POST['cadastrar'])){

  $pergunta = htmlspecialchars($_POST['pergunta'], ENT_QUOTES, 'utf-8');
  $resposta = htmlspecialchars($_POST['resposta'], ENT_QUOTES, 'utf-8');

  $query = "INSERT INTO duvidas (pergunta, resposta, removido) VALUES ('$pergunta', '$resposta', '')";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if (mysqli_affected_rows($conn)) {
    header('Location: listaDuvidas.php?Operacao realizada com sucesso');
  }
  else{
    echo '
      <script>
        window.alert("Erro ao salvar, tente novamente!")
      </script>
    ';
  }


}
if(isset($_POST['salvar'])){
  $pergunta = htmlspecialchars($_POST['pergunta'], ENT_QUOTES, 'utf-8');
  $resposta = htmlspecialchars($_POST['resposta'], ENT_QUOTES, 'utf-8');

  $query = "UPDATE duvidas SET pergunta='$pergunta', resposta='$resposta' WHERE idPergunta = '$idPergunta'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if (mysqli_affected_rows($conn)) {
    header('Location: listaDuvidas.php?Alteracao realizada com sucesso');
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
      <h3 class="colunasTop"><?php if(isset($_GET['idPergunta'])){echo 'Editar Pergunta';}else{ echo 'Adicionar Pergunta';} ?></h3>

      <div class="btnsTop floatRight colunasTop">
        <?php
          if (isset($_GET['idPergunta'])) {
            $idPergunta = $_GET['idPergunta'];
            echo '
            <div class="btnAdicionar btnRemover colunasTop">
              <div onclick="excluirItem()"><span class="">Remover</span> <i class="fas fa-trash"></i></div>
            </div>
            ';
          }
        ?>
      </div>
    </div>


    <form class="boxInputs" method="post">
      <p class="tituloCampo">Pergunta</p>
      <input type="text" autocomplete="off" name="pergunta" value="<?php if(isset($_GET['idPergunta'])){echo $pergunta;} ?>">

      <p class="tituloCampo">Resposta</p>
      <input type="text" autocomplete="off" name="resposta" value="<?php if(isset($_GET['idPergunta'])){echo $resposta;} ?>">


      <br><br><br><br>
      <input type="submit" class="btnSalvar" name="<?php if(isset($_GET['idPergunta'])){echo 'salvar';}else{echo 'cadastrar';} ?>" value="Salvar">

    </form>
  </div>
</div>

<script>
  function excluirItem(){
    if (window.confirm("Deseja mesmo excluir este item?")) {
      window.location.href = "inserirDuvida.php?itemRemovido=<?php echo $idPergunta; ?>"
    }
  }
</script>

<?php
  include('includes/footer.php');
?>
