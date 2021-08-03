<?php
  session_start();
  include('conexao.php');
  include('verificaLogin.php');

  $idUsuario = $_SESSION['idCliente'];
  $query = "SELECT * FROM clientes WHERE idCliente='$idUsuario'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  while($row = mysqli_fetch_assoc($result)) {
    $nomeUsuario = $row['nomeCliente'];
    $emailUsuario = $row['emailCliente'];
    $funcaoUsuario = $row['funcaoCliente'];
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <title>Entrada</title>
  </head>
  <body>

    <header id="header">
      <div class="container">
        <div class="colunasTop logoHeader">
          <a href="entrada.php"><span style="color: #009000">E</span>asy<span style="color: #f00;">M</span>arket</a>
        </div>
        <div class="colunasTop floatRight loginOptionsHeader">
          <div class="colunasTop usuarioHeader">

            <ul id="ulUser">
              <li class="menuDropdown" onclick="abrirMenuUser()">
                <span class="userName"> <span style="color: #fff;">Olá,</span> <span style="border-bottom: solid 1px #fff"><?php echo $nomeUsuario; ?> </span></span>
                <span class="userIcon"><i class="fas fa-user"></i></span>
              </li>
            </ul>
          </div>
          <div class="colunasTop configuracoes">
            <ul id="ulConfig">
              <li class="menuDropdown">
                <i onclick="abrirMenuConfig()" class="fas fa-cog"></i>
                <ul id="menuConfig">
                  <li> <a href="infoUsuario.php">Alterar Informações</a></li>
                  <?php if($funcaoUsuario == 'adm'){echo '<li> <a href="novoUsuario.php">Novo Usuário</a></li>';} ?>
                  <li><a href="logout.php">Logout</a></li>
                  </li>
                </ul>
              </li>
            </ul>

          </div>
        </div>
      </div>
    </header>

    <section id="menuPaginas">
      <div class="menuPaginas">
        <div class="container">
          <ul>
            <?php
              if($funcaoUsuario == 'adm'){
                echo '
                <li>
                  <a class="btnHover" onclick="abrirMenu()">Home</a>
                    <ul id="menuAlteracao" class="boxMenuAlteracao">
                      <a href="editarBanner.php?idBanner"> <li>Banner</li> </a>
                      <a href="editarSobre.php?idSobre"> <li>Sobre</li> </a>
                      <a href="listaProjetos.php"> <li>Projetos</li> </a>
                      <a href="listaComissarios.php"> <li>Comissários</li> </a>
                      <a href="listaDuvidas.php"> <li>Dúvidas</li> </a>
                    </ul>
                </li>
                <li>
                  <a class="btnHover" href="bazar21.php">Bazar 21</a>
                </li>
                ';
              }
              else{
                  echo '
                  <li>
                    <a class="btnHover" href="bazar21.php">Bazar 21</a>
                  </li>
                  ';

              }
            ?>

          </ul>
        </div>
      </div>
    </section>
    <script>
      function abrirMenu(){
        var element = document.getElementById('menuAlteracao');
        element.classList.toggle('menuAberto');
      }
    </script>
