<?php
include('includes/header.php');

if (isset($_GET['idCategoria'])) {
  $idCategoria = $_GET['idCategoria'];

  $query = "SELECT * FROM categorias WHERE idCategoria = '$idCategoria'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  while($row = mysqli_fetch_assoc($result)) {
    $nomeCategoria = $row['nomeCategoria'];
  }
}

if (isset($_GET['itemRemovido'])) {
  $idProdutoRemovido = $_GET['itemRemovido'];
  $query = "UPDATE categorias SET removido='sim' WHERE idCategoria = '$idProdutoRemovido'";
  $result = mysqli_query($conn, $query);
  if (mysqli_affected_rows($conn)) {
    header('Location: listaCategoria.php?Item removido com sucesso');
  }
}


if(isset($_POST['cadastrar'])){

  $nomeCategoria = htmlspecialchars($_POST['nomeCategoria'], ENT_QUOTES, 'utf-8');
  $query = "INSERT INTO categorias (nomeCategoria, removido) VALUES ('$nomeCategoria', '')";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if (mysqli_affected_rows($conn)) {
    header('Location: listaCategoria.php?Operacao realizada com sucesso');
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
  $nomeCategoria = htmlspecialchars($_POST['nomeCategoria'], ENT_QUOTES, 'utf-8');

  $query = "UPDATE categorias SET nomeCategoria='$nomeCategoria' WHERE idCategoria = '$idCategoria'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if (mysqli_affected_rows($conn)) {
    header('Location: listaCategoria.php?Alteracao realizada com sucesso');
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
      <h3 class="colunasTop"><?php if(isset($_GET['idCategoria'])){echo 'Editar Categoria';}else{ echo 'Adicionar Categoria';} ?></h3>

      <div class="btnsTop floatRight colunasTop">
        <?php
          if (isset($_GET['idCategoria'])) {
            $idCategoria = $_GET['idCategoria'];
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
      <p class="tituloCampo">Categoria</p>
      <input type="text" autocomplete="off" name="nomeCategoria" value="<?php if(isset($_GET['idCategoria'])){echo $nomeCategoria;} ?>">

      <br><br><br><br>
      <input type="submit" class="btnSalvar" name="<?php if(isset($_GET['idCategoria'])){echo 'salvar';}else{echo 'cadastrar';} ?>" value="Salvar">

    </form>
  </div>
</div>

<script>
  function excluirItem(){
    if (window.confirm("Deseja mesmo excluir este item?")) {
      window.location.href = "inserirCategoria.php?itemRemovido=<?php echo $idCategoria; ?>"
    }
  }
</script>

<?php
  include('includes/footer.php');
?>
