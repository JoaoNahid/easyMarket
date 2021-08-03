<?php
include('includes/header.php');

if(isset($_GET['idBanner'])){
  $query = "SELECT * FROM banner WHERE idBanner = '1'";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result)) {
    $texto = $row['texto'];

  }
}

if(isset($_POST['cadastrar'])){
  $texto = htmlspecialchars($_POST['texto'], ENT_QUOTES, 'utf-8');

  if(isset($_FILES['imagem'])){
    $imagem = $_FILES['imagem']['name'];
    $extensao = strtolower(pathinfo($imagem, PATHINFO_EXTENSION));
    $formatosImagem = array('png', 'jpg', 'jpeg', 'gif');
    if (in_array($extensao, $formatosImagem)) {
      $novoNome = md5(time()).rand(1000,99999).'.'.$extensao;
      $diretorio = '/var/www/html/sistema/uploads/';

      move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novoNome);

      $foto = $novoNome;
    }
    else{
      echo '
        <script>
          window.alert("Formato de imagem não suportado, escolha entre .jpg, .jpeg, .png, ou .gif")
        </script>
      ';
      $foto = '';
    }
  }

  $query = "INSERT INTO banner (texto, foto) VALUES ('$texto', '$foto')";
  $result = mysqli_query($conn, $query);
  if (mysqli_insert_id($conn)) {
    header('Location: editarBanner.php?idBanner=1');
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
  $texto = htmlspecialchars($_POST['texto'], ENT_QUOTES, 'utf-8');

  if(isset($_FILES['imagem'])){
    $imagem = $_FILES['imagem']['name'];
    $extensao = strtolower(pathinfo($imagem, PATHINFO_EXTENSION));
    $formatosImagem = array('png', 'jpg', 'jpeg', 'gif');
    if (in_array($extensao, $formatosImagem)) {
      $novoNome = md5(time()).rand(1000,99999).'.'.$extensao;
      $diretorio = '/var/www/html/sistema/uploads/';

      move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novoNome);

      $foto = $novoNome;
    }
    else{
      echo '
        <script>
          window.alert("Formato de imagem não suportado, escolha entre .jpg, .jpeg, .png, ou .gif")
        </script>
      ';
      $foto = '';
    }
  }


  $query = "UPDATE banner SET texto='$texto', foto='$foto'";
  $result = mysqli_query($conn, $query);
  if (mysqli_affected_rows($conn)) {
    header('Location: editarBanner.php?idBanner=1');
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
      <h3 class="colunasTop">Editar Banner</h3>

      <div class="btnsTop floatRight colunasTop">
        <?php
          if (isset($_GET['idSlide'])) {
            $idSlide = $_GET['idSlide'];
            echo '
            <div class="btnAdicionar btnRemover colunasTop">
              <a href="" onclick="excluirItem()"><span class="">Remover</span> <i class="fas fa-trash"></i></a>
            </div>
            ';
          }
        ?>
      </div>
    </div>


    <form class="boxInputs" method="post" enctype="multipart/form-data">
      <p class="tituloCampo">Titulo</p>
      <input type="text" autocomplete="off" name="texto" value="<?php if(isset($_GET['idBanner'])){echo $texto;} ?>">

      <p class="tituloCampo">Imagem</p>
      <input type="file" name="imagem">

      <br><br><br><br>
      <input type="submit" class="btnSalvar" name="<?php if(isset($_GET['idBanner'])){echo 'salvar';}else{echo 'cadastrar';} ?>" value="Salvar">

    </form>
  </div>
</div>

<script>
  function excluirItem(){
    if (window.confirm("Deseja mesmo excluir este item?")) {
      window.location.href = "listaSlides.php?slide-removido=<?php echo $idSlide; ?>"
    }
  }
</script>

<?php
  include('includes/footer.php');
?>
