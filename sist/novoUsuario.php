<?php
  include('includes/header.php');

  if (isset($_POST['cadastrar'])) {
    $nome = htmlspecialchars($_POST['nome'], ENT_QUOTES, 'utf-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'utf-8');
    $funcao = htmlspecialchars($_POST['funcao'], ENT_QUOTES, 'utf-8');
    $cpf = htmlspecialchars($_POST['cpf'], ENT_QUOTES, 'utf-8');
    $senha = htmlspecialchars($_POST['senha'], ENT_QUOTES, 'utf-8');
    $confirmaSenha = htmlspecialchars($_POST['confirmaSenha'], ENT_QUOTES, 'utf-8');

    if($senha === $confirmaSenha){
      $senha = md5($senha);
      $query = "INSERT INTO usuarios  (nome, cpf, email, senha, funcao) VALUES ('$nome', '$cpf', '$email', '$senha', '$funcao')";
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
      <h3 class="colunasTop">Adicionar Usuário</h3>

    </div>


    <form class="boxInputs" method="post" enctype="multipart/form-data">
      <p class="tituloCampo">Nome</p>
      <input type="text" autocomplete="off" name="nome" value="<?php if(isset($nome)){ echo $nome;} ?>">

      <p class="tituloCampo">cpf</p>
      <input type="text" oninput="mascara(this)" autocomplete="off" name="cpf" value="<?php if(isset($cpf)){ echo $cpf;} ?>">
      <script type="text/javascript">
      function mascara(i){
         var v = i.value;
         if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
            i.value = v.substring(0, v.length-1);
            return;
         }
         i.setAttribute("maxlength", "14");
         if (v.length == 3 || v.length == 7) i.value += ".";
         if (v.length == 11) i.value += "-";
        }
      </script>

      <p class="tituloCampo">Email</p>
      <input type="text" autocomplete="off" name="email" value="<?php if(isset($email)){ echo $email;}; ?>">

      <p class="tituloCampo">Função</p>
      <select required class="" name="funcao">
        <option value="">Selecione uma opção</option>
        <option value="adm" <?php if(isset($funcao) AND $funcao == 'adm'){ echo selected;} ?>>Administrador</option>
        <option value="dev" <?php if(isset($funcao) AND $funcao == 'dev'){ echo selected;} ?>>Desenvolvedor</option>
      </select>

      <p class="tituloCampo">Senha</p>
      <input type="password" autocomplete="off" name="senha">

      <p class="tituloCampo">Confirmar senha</p>
      <input type="password" autocomplete="off" name="confirmaSenha">

      <br><br><br><br>
      <input type="submit" class="btnSalvar" name="cadastrar" value="Criar Usuário">

    </form>
  </div>

</section>

<?php
  include('includes/footer.php');
?>
