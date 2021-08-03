<?php
include('includes/header.php');

if(isset($_GET['idSobre'])){
  $query = "SELECT * FROM sobre WHERE idSobre='1'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  while($row = mysqli_fetch_assoc($result)) {
    $texto = $row['texto'];
    $titulo = $row['titulo'];
  }
}

if (isset($_POST['cadastrar'])) {
  $titulo = htmlspecialchars($_POST['titulo'], ENT_QUOTES, 'utf-8');
  $texto = htmlspecialchars($_POST['texto'], ENT_QUOTES, 'utf-8');

  $query = "UPDATE sobre SET titulo='$titulo', texto='$texto', foto='$foto' WHERE idSobre = '1'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if (mysqli_affected_rows($conn)) {
    header('Location: entrada.php?Alteracao realizada com sucesso');
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
  <div class="conteudoFormulario" method="post" enctype="multipart/form-data">
    <div class="cabecalhoForm">
      <h3 class="colunasTop">Editar Sobre</h3>


    </div>


    <form class="boxInputs" method="post" enctype="multipart/form-data">
      <p class="tituloCampo">Titulo</p>
      <input type="text" autocomplete="off" name="titulo" value="<?php echo $titulo; ?>">

      <p class="tituloCampo">Texto</p>
      <textarea name="texto" class="tinymce" rows="15" cols="80"><?php echo $texto; ?></textarea>

      <p class="tituloCampo">Imagem</p>
      <input type="file" name="imagem" value="">

      <br><br><br><br>
      <input type="submit" class="btnSalvar" name="cadastrar" value="Salvar">

    </form>
  </div>
</div>

<script>
  function excluirItem(){
    if (window.confirm("Deseja mesmo excluir este item?")) {
      window.location.href = "listaSlides.php?slide-removido=<?php echo $idSobre; ?>"
    }
  }
</script>

<?php
  include('includes/footer.php');
?>
