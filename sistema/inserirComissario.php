<?php
include('includes/header.php');
include('includes/mostrarErros.php');


if (isset($_GET['idComissario'])) {
  $idComissario = $_GET['idComissario'];
  $query = "SELECT * FROM comissarios WHERE idComissario = '$idComissario'";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result)) {
    $nome = $row['nome'];
    $cidade = $row['cidade'];
    $idade = $row['idade'];
    $facebook = $row['facebook'];
    $instagram = $row['instagram'];
    $whatsapp = $row['whatsapp'];
    $twitter = $row['twitter'];
    $curso = $row['curso'];
  }
}

if (isset($_GET['itemRemovido'])) {
  $idProdutoRemovido = $_GET['itemRemovido'];
  $query = "UPDATE comissarios SET removido='sim' WHERE idComissario = '$idProdutoRemovido'";
  $result = mysqli_query($conn, $query);
  if (mysqli_affected_rows($conn)) {
    header('Location: listaComissarios.php?Item removido com sucesso');
  }
}

if(isset($_POST['cadastrar'])){
  $nome = htmlspecialchars($_POST['nome'], ENT_QUOTES, 'utf-8');
  $curso = htmlspecialchars($_POST['curso'], ENT_QUOTES, 'utf-8');
  $idade = htmlspecialchars($_POST['idade'], ENT_QUOTES, 'utf-8');
  $cidade = htmlspecialchars($_POST['cidade'], ENT_QUOTES, 'utf-8');
  $facebook = htmlspecialchars($_POST['facebook'], ENT_QUOTES, 'utf-8');
  $instagram = htmlspecialchars($_POST['instagram'], ENT_QUOTES, 'utf-8');
  $whatsapp = htmlspecialchars($_POST['whatsapp'], ENT_QUOTES, 'utf-8');
  $twitter = htmlspecialchars($_POST['twitter'], ENT_QUOTES, 'utf-8');

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


  $query = "INSERT INTO comissarios (nome, foto, curso, idade, cidade, facebook, instagram, whatsapp, twitter, removido ) VALUES ('$nome', '$foto', '$curso', '$idade', '$cidade', '$facebook', '$instagram', '$whatsapp', '$twitter', '')";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if (mysqli_insert_id($conn)) {
    header('Location: listaComissarios.php?Operacao realizada com sucesso');
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
  $nome = htmlspecialchars($_POST['nome'], ENT_QUOTES, 'utf-8');
  $curso = htmlspecialchars($_POST['curso'], ENT_QUOTES, 'utf-8');
  $idade = htmlspecialchars($_POST['idade'], ENT_QUOTES, 'utf-8');
  $cidade = htmlspecialchars($_POST['cidade'], ENT_QUOTES, 'utf-8');
  $facebook = htmlspecialchars($_POST['facebook'], ENT_QUOTES, 'utf-8');
  $instagram = htmlspecialchars($_POST['instagram'], ENT_QUOTES, 'utf-8');
  $whatsapp = htmlspecialchars($_POST['whatsapp'], ENT_QUOTES, 'utf-8');
  $twitter = htmlspecialchars($_POST['twitter'], ENT_QUOTES, 'utf-8');

  if(isset($_FILES['imagem'])){
    $imagem = $_FILES['imagem']['name'];
    $extensao = strtolower(pathinfo($imagem, PATHINFO_EXTENSION));
    $formatosImagem = array('png', 'jpg', 'jpeg', 'gif');
    if (in_array($extensao, $formatosImagem)) {
      $novoNome = md5(time()).rand(1000,99999).'.'.$extensao;
      $diretorio = 'uploads/';

      move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novoNome);

      $foto = $novoNome;
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


  $query = "UPDATE comissarios SET nome='$nome', idade='$idade', cidade='$cidade', facebook='$facebook', twitter='$twitter', instagram='$instagram', foto='$foto', curso='$curso', whatsapp='$whatsapp'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if (mysqli_affected_rows($conn)) {
    header('Location: listaComissarios.php?Item alterado com sucesso');
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
      <h3 class="colunasTop"><?php if(isset($_GET['idComissario'])){echo 'Editar Comissário';}else{ echo 'Adicionar Comissário';} ?></h3>

      <div class="btnsTop floatRight colunasTop">
        <?php
          if (isset($_GET['idComissario'])) {
            $idComissario = $_GET['idComissario'];
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
      <p class="tituloCampo">Nome</p>
      <input type="text" autocomplete="off" name="nome" value="<?php if(isset($_GET['idComissario'])){echo $nome;} ?>">

      <p class="tituloCampo">Curso</p>
      <input type="text" autocomplete="off" name="curso" value="<?php if(isset($_GET['idComissario'])){echo $curso;} ?>">

      <p class="tituloCampo">Cidade</p>
      <input type="text" autocomplete="off" name="cidade" value="<?php if(isset($_GET['idComissario'])){echo $cidade;} ?>">

      <p class="tituloCampo">Idade</p>
      <input type="text" autocomplete="off" name="idade" value="<?php if(isset($_GET['idComissario'])){echo $idade;} ?>">

      <p class="tituloCampo">Facebook</p>
      <input type="text" autocomplete="off" name="facebook" value="<?php if(isset($_GET['idComissario'])){echo $facebook;} ?>">

      <p class="tituloCampo">Instagram</p>
      <input type="text" autocomplete="off" name="instagram" value="<?php if(isset($_GET['idComissario'])){echo $instagram;} ?>">

      <p class="tituloCampo">Whatsapp</p>
      <input type="text" autocomplete="off" name="whatsapp" value="<?php if(isset($_GET['idComissario'])){echo $whatsapp;} ?>">

      <p class="tituloCampo">Twitter</p>
      <input type="text" autocomplete="off" name="twitter" value="<?php if(isset($_GET['idComissario'])){echo $twitter;} ?>">

      <p style="display: none;" class="tituloCampo">Categoria</p>
      <select style="display: none;" class="" name="categoria">
        <option value="1">teste 1</option>
        <option value="2">teste 2</option>
        <option value="3">teste 3</option>
      </select>

      <p class="tituloCampo">Imagem</p>
      <input type="file" name="imagem">

      <br><br><br><br>
      <input type="submit" class="btnSalvar" name="<?php if(isset($_GET['idComissario'])){echo 'salvar';}else{echo 'cadastrar';} ?>" value="Salvar">

    </form>
  </div>
</div>

<script>
  function excluirItem(){
    if (confirm("Deseja mesmo excluir este item?")) {
      window.location.href = "inserirComissario.php?itemRemovido=<?php echo $_GET['idComissario']; ?>";
    }
  }
</script>

<?php
  include('includes/footer.php');
?>
