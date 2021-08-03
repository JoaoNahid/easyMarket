<?php
include('includes/header.php');
include('conexao.php');






if(isset($_POST['cadastrar'])){

  $nomeCategoria = htmlspecialchars($_POST['nomeCategoria'], ENT_QUOTES, 'utf-8');

  $query = "INSERT INTO categoria (nomeCategoria, removido) VALUES ('$nomeCategoria', '')";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if (mysqli_affected_rows($conn)) {
    header('Location: index.html?Operacao realizada com sucesso');
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
<div style="width: 100%; background-color: red; color: #fff; padding: 10px; margin-bottom: 20px">Adicionar categoria</div>
<div class="container">
  <div class="conteudoFormulario" method="post">
    <div class="cabecalhoForm">
      

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
      <p class="tituloCampo">Nome Da Categoria</p>
      <input type="text" autocomplete="off" name="nomeCategoria" value="<?php if(isset($_GET['idPergunta'])){echo $nomeCategoria;} ?>">

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
