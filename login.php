<?php
  include('includes/header.php');
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
                        <input class="form-control" placeholder="Nome" type="text" name="nome">
                      </div>

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <input class="form-control" placeholder="Email" type="text" name="email">
                      </div>

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <input class="form-control" placeholder="Teleone" type="text" name="telefone">
                      </div>

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <input class="form-control" placeholder="Senha" type="password" name="criarSenha">
                      </div>

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <input class="form-control" placeholder="Confirmar senha" type="password" name="confirmarSenha">
                      </div>

                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <button class="send">Cadastrar</button>
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
