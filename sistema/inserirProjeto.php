<?php
include('includes/header.php');

if (isset($_GET['idProjeto'])) {
  $idProjeto = $_GET['idProjeto'];

  $query = "SELECT * FROM projetos WHERE idProjeto = '$idProjeto'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  while($row = mysqli_fetch_assoc($result)) {
    $titulo = $row['titulo'];
    $texto = $row['texto'];
    $link = $row['link'];

  }
}

if (isset($_GET['itemRemovido'])) {
  $idProdutoRemovido = $_GET['itemRemovido'];
  $query = "UPDATE projetos SET removido='sim' WHERE idProjeto = '$idProdutoRemovido'";
  $result = mysqli_query($conn, $query);
  if (mysqli_affected_rows($conn)) {
    header('Location: listaProjetos.php?Item removido com sucesso');
  }
}


if(isset($_POST['cadastrar'])){

  $titulo = htmlspecialchars($_POST['titulo'], ENT_QUOTES, 'utf-8');
  $texto = htmlspecialchars($_POST['texto'], ENT_QUOTES, 'utf-8');
  $link = htmlspecialchars($_POST['link'], ENT_QUOTES, 'utf-8');

  $msg = false;
if(isset($_FILES['arquivo'])){
    $arquivo = $_FILES['arquivo']['name'];
    $extensao = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));

    $novo_nome = md5(time()).".".$extensao;

    $diretorio = "upload/";

    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

    $sql_code = "INSERT INTO arquivo(id, arquivo, data) VALUES('','$novo_nome', NOW())";

    if(mysqli_query($conn, $sql_code))
        $msg = "Arquivo enviado com sucesso!";
    else
        $msg = "Falha ao enviar arquivo!";
}
  else {
    $foto = '';
  }

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
if(isset($_POST['salvar'])){
  $titulo = htmlspecialchars($_POST['titulo'], ENT_QUOTES, 'utf-8');
  $texto = htmlspecialchars($_POST['texto'], ENT_QUOTES, 'utf-8');
  $link = htmlspecialchars($_POST['link'], ENT_QUOTES, 'utf-8');

  if(isset($_FILES['imagem'])){
    $imagem = $_FILES['imagem']['name'];
    $extensao = strtolower(pathinfo($imagem, PATHINFO_EXTENSION));
    $formatosImagem = array('png', 'jpg', 'jpeg', 'gif');
    if (in_array($extensao, $formatosImagem)) {
      $novoNome = md5(time()).rand(1000,99999).'.'.$extensao;
      $diretorio = 'uploads/';

      if(move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novoNome)){

        $foto = $novoNome;
      }
      else {
        exit();
      }
    }
    else{
      echo '
        <script>
          window.alert("Formato de imagem não suportado, escolha entre .jpg, .jpeg, .png, ou .gif")
        </script>
      ';
    }
  }
  else {
    $foto = '';
  }
  $query = "UPDATE projetos SET titulo='$titulo', texto='$texto', link='$link', foto='$foto' WHERE idProjeto = '$idProjeto'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if (mysqli_affected_rows($conn)) {
    header('Location: listaProjetos.php?Alteracao realizada com sucesso');
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
      <h3 class="colunasTop"><?php if(isset($_GET['idProjeto'])){echo 'Editar Projeto';}else{ echo 'Adicionar Projeto';} ?></h3>

      <div class="btnsTop floatRight colunasTop">
        <?php
          if (isset($_GET['idProjeto'])) {
            $idProjeto = $_GET['idProjeto'];
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
      <p class="tituloCampo">Titulo</p>
      <input type="text" autocomplete="off" name="titulo" value="<?php if(isset($_GET['idProjeto'])){echo $titulo;} ?>">

      <p class="tituloCampo">Link de redirecionamento</p>
      <input type="text" autocomplete="off" name="link" value="<?php if(isset($_GET['idProjeto'])){echo $link;} ?>">

      <p class="tituloCampo">Descrição</p>
      <textarea name="texto" class="tinymce" rows="15" cols="80"><?php if(isset($_GET['idProjeto'])){echo $texto;} ?></textarea>

      <p class="tituloCampo">Imagem</p>
      <input type="file" name="imagem" value="">

      <br><br><br><br>
      <input type="submit" class="btnSalvar" name="<?php if(isset($_GET['idProjeto'])){echo 'salvar';}else{echo 'cadastrar';} ?>" value="Salvar">

    </form>
  </div>
</div>

<script>
  function excluirItem(){
    if (window.confirm("Deseja mesmo excluir este item?")) {
      window.location.href = "inserirProjeto.php?itemRemovido=<?php echo $idProjeto; ?>"
    }
  }
</script>

<?php
  include('includes/footer.php');
?>
