<?php
  include('includes/header.php');
  include('sist/includes/mostrarErros.php');
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
                  <form class="" action="arquivosDeSessao/cadastroELogin.php" method="post">
                      <div class="row">

                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <input autocomplete="off" class="form-control" placeholder="Email" type="text" name="login">
                          </div>

                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <input autocomplete="off" class="form-control" placeholder="Senha" type="password" name="senhaLogin">
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
                  <form class="" action="arquivosDeSessao/cadastroELogin.php" method="post">
                    <div class="row">

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <input class="form-control" required placeholder="Nome" type="text" name="nomeCliente">
                      </div>

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <input class="form-control" required placeholder="Email" type="text" name="emailCliente">
                      </div>

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <input class="form-control" required data-js="telefone" placeholder="Telefone" type="text" name="telefoneCliente">
                      </div>

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <input class="form-control" required placeholder="Senha" type="password" name="senhaCliente">
                      </div>

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <input class="form-control" required placeholder="Confirmar senha" type="password" name="confirmarSenha">
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
