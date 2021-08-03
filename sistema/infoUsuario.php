<?php
  include('includes/header.php');

  if (isset($_POST['cadastrar'])) {
    $nome = htmlspecialchars($_POST['nome'], ENT_QUOTES, 'utf-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'utf-8');
    $login = htmlspecialchars($_POST['login'], ENT_QUOTES, 'utf-8');
    $senha = htmlspecialchars($_POST['senha'], ENT_QUOTES, 'utf-8');
    $confirmaSenha = htmlspecialchars($_POST['confirmaSenha'], ENT_QUOTES, 'utf-8');

    if($senha === $confirmaSenha){
      $senha = md5($senha);
      $query = "UPDATE usuarios SET nome='$nome', email='$email', senha='$senha', login='$login' WHERE idUsuario = '$idUsuario'";
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
    else {
      echo '
        <script>
          window.alert("As senhas não conferem.")
        </script>
      ';
    }
  }
?>

<section class="container">
  <div class="conteudoFormulario" method="post">
    <div class="cabecalhoForm">
      <h3 class="colunasTop">Informações da conta</h3>

    </div>


    <form class="boxInputs" method="post" enctype="multipart/form-data">
      <p class="tituloCampo">Nome</p>
      <input type="text" autocomplete="off" name="nome" value="<?php echo $nomeUsuario; ?>">

      <p class="tituloCampo">Email</p>
      <input type="text" autocomplete="off" name="email" value="<?php echo $emailUsuario; ?>">

      <p class="tituloCampo">Login</p>
      <input type="text" autocomplete="off" name="login" value="<?php echo $loginUsuario; ?>">

      <p class="tituloCampo">Senha</p>
      <input type="password" autocomplete="off" placeholder="nova senha" name="senha">

      <p class="tituloCampo">Confirmar senha</p>
      <input type="password" autocomplete="off" placeholder="confirmar senha" name="confirmaSenha">

      <br><br><br><br>
      <input type="submit" class="btnSalvar" name="cadastrar" value="Alterar dados">

    </form>
  </div>

</section>

<?php
  include('includes/footer.php');
?>
