<?php
include('includes/header.php');

if (isset($_GET['idProduto'])) {
  $idProduto = $_GET['idProduto'];

  $query = "SELECT * FROM produtos WHERE idProduto = '$idProduto'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  while($row = mysqli_fetch_assoc($result)) {
    $nomeProduto = $row['nomeProduto'];
    $marcaProduto = $row['marcaProduto'];
    $idProduto = $row['idProduto'];
    $categoriaProduto = $row['idCategoria'];
    $precoProduto = $row['precoProduto'];
    $precoPromocao = $row['precoPromocao'];
    $fotoProduto = $row['fotoProduto'];
    $pesoProduto = $row['pesoProduto'];
    $localizacaoProduto = $row['localizacaoProduto'];
    $descricaoProduto = $row['descricaoProduto'];
    $codigoProduto = $row['codigoProduto'];

  }
}
if (isset($_GET['itemRemovido'])) {
  $idProdutoRemovido = $_GET['itemRemovido'];
  $query = "UPDATE produtos SET removido='sim' WHERE idProduto = '$idProdutoRemovido'";
  $result = mysqli_query($conn, $query);
  if (mysqli_affected_rows($conn)) {
    header('Location: bazar21.php?Item removido com sucesso');
  }
}

if(isset($_POST['cadastrar'])){

  $produto = htmlspecialchars($_POST['produto'], ENT_QUOTES, 'utf-8');
  $categoria = htmlspecialchars($_POST['categoria'], ENT_QUOTES, 'utf-8');
  $sexo = htmlspecialchars($_POST['sexo'], ENT_QUOTES, 'utf-8');
  $cor = htmlspecialchars($_POST['cor'], ENT_QUOTES, 'utf-8');
  $tamanho = htmlspecialchars($_POST['tamanho'], ENT_QUOTES, 'utf-8');
  $status = htmlspecialchars($_POST['status'], ENT_QUOTES, 'utf-8');
  $descricao = htmlspecialchars($_POST['descricao'], ENT_QUOTES, 'utf-8');
  $estado = htmlspecialchars($_POST['estado'], ENT_QUOTES, 'utf-8');
  $preco = htmlspecialchars($_POST['preco'], ENT_QUOTES, 'utf-8');

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

  if($status == 'vendido'){
    $vendido = 'sim';
  }
  else {
    $vendido = '';
  }

  $query = "INSERT INTO produtos (produto, categoria, foto, sexo, cor, tamanho, estado, descricao, status, vendido, preco, removido) VALUES ('$produto', '$categoria', '$foto', '$sexo', '$cor', '$tamanho', '$estado', '$descricao', '$status', '$vendido', '$preco', '')";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if (mysqli_affected_rows($conn)) {
    header('Location: bazar21.php?Operacao realizada com sucesso');
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
  $produto = htmlspecialchars($_POST['produto'], ENT_QUOTES, 'utf-8');
  $categoria = htmlspecialchars($_POST['categoria'], ENT_QUOTES, 'utf-8');
  $preco = htmlspecialchars($_POST['preco'], ENT_QUOTES, 'utf-8');
  $sexo = htmlspecialchars($_POST['sexo'], ENT_QUOTES, 'utf-8');
  $cor = htmlspecialchars($_POST['cor'], ENT_QUOTES, 'utf-8');
  $tamanho = htmlspecialchars($_POST['tamanho'], ENT_QUOTES, 'utf-8');
  $status = htmlspecialchars($_POST['status'], ENT_QUOTES, 'utf-8');
  $descricao = htmlspecialchars($_POST['descricao'], ENT_QUOTES, 'utf-8');
  $estado = htmlspecialchars($_POST['estado'], ENT_QUOTES, 'utf-8');

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

  if($status == 'vendido'){
    $vendido = 'sim';
  }
  else {
    $vendido = '';
  }

  $query = "UPDATE produtos SET produto='$produto', categoria='$categoria', sexo='$sexo', preco='$preco', cor='$cor', tamanho='$tamanho', estado='$estado', descricao='$descricao', status='$status', vendido='$vendido', foto='$foto' WHERE idProduto = '$idProduto'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if (mysqli_affected_rows($conn)) {
    header('Location: bazar21.php?Alteracao realizada com sucesso');
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
      <h3 class="colunasTop"><?php if(isset($_GET['idProduto'])){echo 'Editar Projeto';}else{ echo 'Adicionar Projeto';} ?></h3>

      <div class="btnsTop floatRight colunasTop">
        <?php
          if (isset($_GET['idProduto'])) {
            $idProduto = $_GET['idProduto'];
            echo '
            <div class="btnAdicionar btnRemover colunasTop">
              <div onclick="excluirItem()">Remover <i class="fas fa-trash"></i></div>
            </div>
            ';
          }
        ?>
      </div>
    </div>


    <form class="boxInputs" method="post" enctype="multipart/form-data">
      <p class="tituloCampo">Nome do Produto</p>
      <input type="text" autocomplete="off" name="nomeProduto" value="<?php if(isset($_GET['idProduto'])){echo $nomeProduto;} ?>">

      <p class="tituloCampo">Categoria</p>
      <select class="" name="categoria">
        <option value="">Selecione uma opção</option>
        <?php
          $query = "SELECT * FROM categorias WHERE removido != 'sim' ORDER BY nomeCategoria";
          $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
          while($row = mysqli_fetch_assoc($result)) {
            $idCategoriaProduto = $row['idCategoria'];
            $nomeCategoriaProduto = $row['nomeCategoria'];
          ?>
              <option value="<?php echo $idCategoriaProduto ?>" <?php if(isset($idCategoria) AND $idCategoria == $idCategoriaProduto){echo 'selected';} ?>><?php echo $nomeCategoriaProduto ?></option>
        <?php
          }
        ?>
      </select>

      <p class="tituloCampo">Marca do Produto</p>
      <input type="text" autocomplete="off" name="marcaProduto" value="<?php if(isset($_GET['idProduto'])){echo $marcaProduto;} ?>">

      <p class="tituloCampo">Preço do Produto</p>
      <input type="number" autocomplete="off" step=",01" name="precoProduto" value="<?php if(isset($_GET['idProduto'])){echo $precoProduto;} ?>">

      <p class="tituloCampo">Preço em Promoção</p>
      <input type="number" autocomplete="off" step=",01" name="precoPromocao" value="<?php if(isset($_GET['idProduto'])){echo $precoPromocao;} ?>">

      <p class="tituloCampo">Cor</p>
      <input type="text" autocomplete="off" placeholder="ex.: preto como detalhes brancos" name="cor" value="<?php if(isset($_GET['idProduto'])){echo $cor;} ?>">

      <p class="tituloCampo">Tamanho</p>
      <input type="text" autocomplete="off" placeholder="ex.: P, M, G. (se for calçado colocar o nº)" name="tamanho" value="<?php if(isset($_GET['idProduto'])){echo $tamanho;} ?>">

      <p class="tituloCampo">Estado</p>
      <input type="text" autocomplete="off" placeholder="ex.: usado, novo, etc." name="estado" value="<?php if(isset($_GET['idProduto'])){echo $tamanho;} ?>">

      <p class="tituloCampo">Descrição</p>
      <textarea name="descricao" class="tinymce" rows="15" cols="80"><?php if(isset($_GET['idProduto'])){echo $descricao;} ?></textarea>

      <p class="tituloCampo">Status</p>
      <select class="" name="status">
        <option value="">Selecione uma opção</option>
        <option value="postado" <?php if(isset($status) AND $status == 'postado'){echo 'selected';} ?>>Postado</option>
        <option value="pendente" <?php if(isset($status) AND $status == 'pendente'){echo 'selected';} ?>>Pendente</option>
        <option value="reservado" <?php if(isset($status) AND $status == 'reservado'){echo 'selected';} ?>>Reservado</option>
        <option value="vendido" <?php if(isset($status) AND $status == 'vendido'){echo 'selected';} ?>>Vendido</option>
      </select>

      <p class="tituloCampo">Imagem</p>
      <input type="file" name="imagem" value="">

      <br><br><br><br>
      <input type="submit" class="btnSalvar" name="<?php if(isset($_GET['idProduto'])){echo 'salvar';}else{echo 'cadastrar';} ?>" value="Salvar">

    </form>
  </div>
</div>

<script>
  function excluirItem(){
    if (window.confirm("Deseja mesmo excluir este item?")) {
      window.location.href = "inserirProduto.php?itemRemovido=<?php echo $idProduto; ?>"
    }
  }
</script>

<?php
  include('includes/footer.php');
?>
