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
    $fotoBanco = $row['fotoProduto'];
    $pesoProduto = $row['pesoProduto'];
    $unidadePeso = $row['unidadePeso'];
    $localizacaoProduto = $row['localizacaoProduto'];
    $descricaoProduto = $row['descricaoProduto'];
    $codigoProduto = $row['codigoProduto'];
    $avaliacaoProduto = $row['avaliacaoProduto'];
    $destaqueProduto = $row['destaqueProduto'];

  }
}
if (isset($_GET['itemRemovido'])) {
  $idProdutoRemovido = $_GET['itemRemovido'];
  $query = "UPDATE produtos SET removido='sim' WHERE idProduto = '$idProdutoRemovido'";
  $result = mysqli_query($conn, $query);
  if (mysqli_affected_rows($conn)) {
    header('Location: listaProdutos.php?Item removido com sucesso');
  }
}

if(isset($_POST['cadastrar'])){

  $codigoProduto = htmlspecialchars($_POST['codigoProduto'], ENT_QUOTES, 'utf-8');
  $query = "SELECT * FROM produtos WHERE codigoProduto = '$codigoProduto'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if(mysqli_num_rows($result) == 0){
    $nomeProduto = htmlspecialchars($_POST['nomeProduto'], ENT_QUOTES, 'utf-8');
    $marcaProduto = htmlspecialchars($_POST['marcaProduto'], ENT_QUOTES, 'utf-8');
    $categoriaProduto = htmlspecialchars($_POST['idCategoria'], ENT_QUOTES, 'utf-8');

    $precoProduto = htmlspecialchars($_POST['precoProduto'], ENT_QUOTES, 'utf-8');
    $precoProduto = str_replace(',', '.', $precoProduto);

    $precoPromocao = htmlspecialchars($_POST['precoPromocao'], ENT_QUOTES, 'utf-8');
    $precoPromocao = str_replace(',', '.', $precoPromocao);


    $pesoProduto = htmlspecialchars($_POST['pesoProduto'], ENT_QUOTES, 'utf-8');
    $unidadePeso = htmlspecialchars($_POST['unidadePeso'], ENT_QUOTES, 'utf-8');
    $localizacaoProduto = htmlspecialchars($_POST['localizacaoProduto'], ENT_QUOTES, 'utf-8');
    $avaliacaoProduto = htmlspecialchars($_POST['avaliacaoProduto'], ENT_QUOTES, 'utf-8');
    $descricaoProduto = htmlspecialchars($_POST['descricaoProduto'], ENT_QUOTES, 'utf-8');
    $destaqueProduto = htmlspecialchars($_POST['destaqueProduto'], ENT_QUOTES, 'utf-8');


    if(isset($_FILES['imagem'])){
      echo $imagem = $_FILES['imagem']['name'];
      $extensao = strtolower(pathinfo($imagem, PATHINFO_EXTENSION));
      $formatosImagem = array('png', 'jpg', 'jpeg', 'gif');
      if (in_array($extensao, $formatosImagem)) {
        echo $novoNome = md5(time()).rand(1000,99999).'.'.$extensao;
        $diretorio = 'uploads/';

        if(move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novoNome)){

          echo $fotoProduto = $novoNome;
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
      $fotoProduto = '';
    }


    $query = "INSERT INTO produtos (codigoProduto, nomeProduto, fotoProduto, marcaProduto, idCategoria, precoProduto, precoPromocao, pesoProduto, unidadePeso, localizacaoProduto, avaliacaoProduto, descricaoProduto, destaqueProduto, removido) VALUES ('$codigoProduto', '$nomeProduto', '$fotoProduto', '$marcaProduto', '$categoriaProduto', '$precoProduto', '$precoPromocao', '$pesoProduto', '$unidadePeso', '$localizacaoProduto', '$avaliacaoProduto', '$descricaoProduto', '$destaqueProduto', '')";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
      header('Location: listaProdutos.php?Operacao realizada com sucesso');
    }
    else{
      echo '
        <script>
          window.alert("Erro ao salvar, tente novamente!")
        </script>
      ';
    }
  }
  else{
    echo '
      <script>
        window.location.href = "inserirProduto.php"
        window.alert("Código de barras já cadastrado")
      </script>
    ';
  }
}
if(isset($_POST['salvar'])){

  $codigoProduto = htmlspecialchars($_POST['codigoProduto'], ENT_QUOTES, 'utf-8');
  $query = "SELECT * FROM produtos WHERE codigoProduto = '$codigoProduto'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if(mysqli_num_rows($result) == 0){
    $nomeProduto = htmlspecialchars($_POST['nomeProduto'], ENT_QUOTES, 'utf-8');
    $fotoProduto = htmlspecialchars($_POST['fotoProduto'], ENT_QUOTES, 'utf-8');
    $marcaProduto = htmlspecialchars($_POST['marcaProduto'], ENT_QUOTES, 'utf-8');
    $categoriaProduto = htmlspecialchars($_POST['idCategoria'], ENT_QUOTES, 'utf-8');

    $precoProduto = htmlspecialchars($_POST['precoProduto'], ENT_QUOTES, 'utf-8');
    $precoProduto = str_replace(',', '.', $precoProduto);

    $precoPromocao = htmlspecialchars($_POST['precoPromocao'], ENT_QUOTES, 'utf-8');
    $precoPromocao = str_replace(',', '.', $precoPromocao);

    $pesoProduto = htmlspecialchars($_POST['pesoProduto'], ENT_QUOTES, 'utf-8');
    $unidadePeso = htmlspecialchars($_POST['unidadePeso'], ENT_QUOTES, 'utf-8');
    $localizacaoProduto = htmlspecialchars($_POST['localizacaoProduto'], ENT_QUOTES, 'utf-8');
    $avaliacaoProduto = htmlspecialchars($_POST['avaliacaoProduto'], ENT_QUOTES, 'utf-8');
    $descricaoProduto = htmlspecialchars($_POST['descricaoProduto'], ENT_QUOTES, 'utf-8');
    $destaqueProduto = htmlspecialchars($_POST['destaqueProduto'], ENT_QUOTES, 'utf-8');

    $fotoProduto = $fotoBanco;
    if(isset($_FILES['imagem'])){
      $imagem = $_FILES['imagem']['name'];
      $extensao = strtolower(pathinfo($imagem, PATHINFO_EXTENSION));
      $formatosImagem = array('png', 'jpg', 'jpeg', 'gif');
      if (in_array($extensao, $formatosImagem)) {
        $novoNome = md5(time()).rand(1000,99999).'.'.$extensao;
        $diretorio = 'uploads/';

        if(move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novoNome)){

          $fotoProduto = $novoNome;
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



    $query = "UPDATE produtos SET codigoProduto='$codigoProduto', nomeProduto='$nomeProduto', fotoProduto='$fotoProduto', marcaProduto='$marcaProduto', idCategoria='$categoriaProduto', precoProduto='$precoProduto', precoPromocao='$precoPromocao', pesoProduto='$pesoProduto', unidadePeso='$unidadePeso', localizacaoProduto='$localizacaoProduto', avaliacaoProduto='$avaliacaoProduto', descricaoProduto='$descricaoProduto', destaqueProduto= '$destaqueProduto' WHERE idProduto = '$idProduto'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
      header('Location: listaProdutos.php?Alteracao realizada com sucesso');
    }
    else{
      echo '
        <script>
          window.alert("Erro ao salvar, tente novamente!")
        </script>
      ';
    }
  }
  else{
    echo '
      <script>
        window.location.href = "inserirProduto.php"
        window.alert("Código de barras já cadastrado")
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
  <div class="conteudoFormulario">
    <div class="cabecalhoForm">
      <h3 class="colunasTop"><?php if(isset($_GET['idProduto'])){echo 'Editar Produto';}else{ echo 'Adicionar Produto';} ?></h3>

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
      <select class="" name="idCategoria">
        <option value="">Selecione uma opção</option>
        <?php
          $query = "SELECT * FROM categorias WHERE removido != 'sim' ORDER BY nomeCategoria";
          $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
          while($row = mysqli_fetch_assoc($result)) {
            $idCategoriaProduto = $row['idCategoria'];
            $nomeCategoriaProduto = $row['nomeCategoria'];
          ?>
              <option value="<?php echo $idCategoriaProduto ?>" <?php if(isset($categoriaProduto) AND $categoriaProduto == $idCategoriaProduto){echo 'selected';} ?>><?php echo $nomeCategoriaProduto ?></option>
        <?php
          }
        ?>
      </select>

      <p class="tituloCampo">Código do Produto</p>
      <input type="text" autocomplete="off" name="codigoProduto" value="<?php if(isset($_GET['idProduto'])){echo $codigoProduto;} ?>">

      <p class="tituloCampo">Imagem</p>
      <input type="file" name="imagem" value="">

      <p class="tituloCampo">Marca do Produto</p>
      <input type="text" autocomplete="off" name="marcaProduto" value="<?php if(isset($_GET['idProduto'])){echo $marcaProduto;} ?>">

      <p class="tituloCampo">Preço do Produto</p>
      <input type="text" autocomplete="off" data-js="preco" name="precoProduto" value="<?php if(isset($_GET['idProduto'])){echo $precoProduto;} ?>">

      <p class="tituloCampo">Preço em Promoção</p>
      <input type="text" autocomplete="off" data-js="preco" name="precoPromocao" value="<?php if(isset($_GET['idProduto'])){echo $precoPromocao;} ?>">

      <div class="row">
        <div class="col-md-8">
          <p class="tituloCampo">Peso do Produto</p>
          <input type="number" autocomplete="off" step=",01" name="pesoProduto" value="<?php if(isset($_GET['idProduto'])){echo $pesoProduto;} ?>">
        </div>
        <div class="col-md-4">
          <p class="tituloCampo">Unidade de Peso</p>
          <select class="" name="unidadePeso">
            <option value="">Selecione uma opção</option>
            <option value="L" <?php if(isset($unidadePeso) AND $unidadePeso == "L"){echo 'selected';} ?>>Litros</option>
            <option value="ml" <?php if(isset($unidadePeso) AND $unidadePeso == "ml"){echo 'selected';} ?>>Mililitros</option>
            <option value="Kg" <?php if(isset($unidadePeso) AND $unidadePeso == "Kg"){echo 'selected';} ?>>Quilogramas</option>
            <option value="mg" <?php if(isset($unidadePeso) AND $unidadePeso == "mg"){echo 'selected';} ?>>Miligramas</option>
            <option value="g" <?php if(isset($unidadePeso) AND $unidadePeso == "g"){echo 'selected';} ?>>Gramas</option>
          </select>
        </div>

      </div>

      <p class="tituloCampo">Localização do Produto</p>
      <input type="text" autocomplete="off" placeholder="ex.: Corredor 6, na área de limpeza." name="localizacaoProduto" value="<?php if(isset($_GET['idProduto'])){echo $localizacaoProduto;} ?>">

      <p class="tituloCampo">Avaliação sobre o Produto</p>
      <input type="text" autocomplete="off" step=",01" name="avaliacaoProduto" value="<?php if(isset($_GET['idProduto'])){echo $avaliacaoProduto;} ?>">

      <p class="tituloCampo">Descrição do Produto</p>
      <textarea name="descricaoProduto" class="tinymce" rows="15" cols="80"><?php if(isset($_GET['idProduto'])){echo $descricaoProduto;} ?></textarea>

      <p class="tituloCampo">Destaque</p>
      <input type="text" autocomplete="off" step=",01" name="destaqueProduto" value="<?php if(isset($_GET['idProduto'])){echo $destaqueProduto;} ?>">

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
<script src="js/mascarasInput.js"></script>
<?php
  include('includes/footer.php');
?>
