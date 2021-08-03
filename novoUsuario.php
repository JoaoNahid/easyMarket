<?php
  include('includes/header.php');
  include('conexao.php');

  if (isset($_POST['cadastrar'])) {
    $cpf = htmlspecialchars($_POST['cpf'], ENT_QUOTES, 'utf-8');
    $idade = htmlspecialchars($_POST['idade'], ENT_QUOTES, 'utf-8');
    $nome = htmlspecialchars($_POST['nome'], ENT_QUOTES, 'utf-8');
    $sobrenome = htmlspecialchars($_POST['sobrenome'], ENT_QUOTES, 'utf-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'utf-8');
    $funcao = htmlspecialchars($_POST['funcao'], ENT_QUOTES, 'utf-8');
    $senha = htmlspecialchars($_POST['senha'], ENT_QUOTES, 'utf-8');
    $confirmaSenha = htmlspecialchars($_POST['confirmaSenha'], ENT_QUOTES, 'utf-8');

    $nomeCompleto = $nome.' '.$sobrenome;

    if($senha === $confirmaSenha){
      $senha = md5($senha);
      $query = "INSERT INTO clientes  (cpfCliente, nomeCliente, emailCliente, senhaCliente, funcaoCliente, idadeCliente) VALUES ('$cpf','$nomeCompleto', '$email', '$senha', '$funcao', '$idade')";
      $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
      if (mysqli_affected_rows($conn)) {
        header('Location: index.html?Alteracao realizada com sucesso');
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
<div style="width: 100%; background-color: red; color: #fff; padding: 10px; margin-bottom: 20px">Criar Login</div>
<section class="container">
  <div class="conteudoFormulario" method="post">
    <div class="cabecalhoForm">

    </div>


    <form class="boxInputs" method="post" enctype="multipart/form-data">
      <p class="tituloCampo">Nome</p>
      <input type="text" autocomplete="off" name="nome" >

      <p class="tituloCampo">Sobrenome</p>
      <input type="text" autocomplete="off" name="sobrenome" >

      <p class="tituloCampo">CPF</p>
      <input type="text" autocomplete="off" name="cpf" >

      <p class="tituloCampo">Idade</p>
      <input type="number" autocomplete="off" placeholder="" name="idade" >

      <p class="tituloCampo">Email</p>
      <input type="text" autocomplete="off" name="email" >

      <p class="tituloCampo">Função</p>
      <select required class="" name="funcao">
        <option value="">Selecione uma opção</option>
        <option value="adm">Administrador</option>
        <option value="estoquista">Estoquista</option>
      </select>

      <p class="tituloCampo">Senha</p>
      <input type="password" autocomplete="off" placeholder="senha" name="senha">

      <p class="tituloCampo">Confirmar senha</p>
      <input type="password" autocomplete="off" placeholder="confirmar senha" name="confirmaSenha">

      <br><br><br><br>
      <input type="submit" class="btnSalvar" name="cadastrar" value="Criar Usuário">

    </form>
  </div>

</section>

<?php
  include('includes/footer.php');
?>
