<?php
include('includes/header.php');
include('conexao.php');
include('sist/includes/mostrarErros.php');

if (isset($_POST['cadastrarCliente'])) {
  $nomeCliente = htmlspecialchars($_POST['nomeCliente'], ENT_QUOTES, 'utf-8');
  $emailCliente = htmlspecialchars($_POST['emailCliente'], ENT_QUOTES, 'utf-8');
  $senhaCliente = htmlspecialchars($_POST['senhaCliente'], ENT_QUOTES, 'utf-8');
  $telefoneCliente = htmlspecialchars($_POST['telefoneCliente'], ENT_QUOTES, 'utf-8');
  $confirmarSenha = htmlspecialchars($_POST['confirmarSenha'], ENT_QUOTES, 'utf-8');

  if($senhaCliente === $confirmarSenha){
    $senhaCliente = md5($senhaCliente);
    echo $query = "INSERT INTO clientes  (nomeCliente, emailCliente, senhaCliente, telefoneCliente) VALUES ('$nomeCliente','$emailCliente', '$senhaCliente', '$telefoneCliente', ' ')";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
      //header('Location: index.php?Cadastro realizado com sucesso');
    }
    else{
      echo '
        <script>
          window.alert("Erro ao cadastrar, tente novamente!")
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
    <div class="yellow_bg">
      <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="title">
                     <h2>Login</h2>

                  </div>
               </div>
            </div>
      </div>

      <section class="loginArea">
        <div class="container-fluid">
          <div class="row">

            <!-- FORMULÁRIO LOGIN -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="boxFormLogin">
                  <h2>Já é cliente? Faça login!</h2>
                  <form class="" method="post">
                      <div class="row">

                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <input class="form-control" placeholder="Login" type="text" name="login">
                          </div>

                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <input class="form-control" placeholder="Senha" type="password" name="senha">
                          </div>

                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <button class="send" name="efetuarLogin">Login</button>
                          </div>

                      </div>
                  </form>
                </div>
            </div>

            <!-- FORMULÁRIO CADASTRO -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="boxFormLogin">
                  <h2>Não tem cadastro? Faça um agora mesmo!</h2>
                  <form class="" method="post">
                    <div class="row">

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <input class="form-control" placeholder="Nome" type="text" name="nomeCliente">
                      </div>

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <input class="form-control" placeholder="Email" type="text" name="emailCliente">
                      </div>

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <input class="form-control" placeholder="Teleone" type="text" name="telefoneCliente">
                      </div>

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <input class="form-control" placeholder="Senha" type="password" name="senhaCliente">
                      </div>

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <input class="form-control" placeholder="Confirmar senha" type="password" name="confirmarSenha">
                      </div>

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <button class="send" name="cadastrarCliente">Cadastrar</button>
                      </div>

                    </div>
                  </form>
                </div>
            </div>

          </div>
        </div>
      </section>

    </div>
<?php
  include('includes/footer.php');
?>
