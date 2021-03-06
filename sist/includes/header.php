<?php
  session_start();
  include('conexao.php');
  include('verificaLogin.php');

  $idUsuario = $_SESSION['idUsuario'];
  $query = "SELECT * FROM usuarios WHERE idUsuario='$idUsuario'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  while($row = mysqli_fetch_assoc($result)) {
    $nomeUsuario = $row['nome'];
    $emailUsuario = $row['email'];
    $funcaoUsuario = $row['funcao'];
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
              if($funcaoUsuario == 'adm' OR $funcaoUsuario == 'dev'){
                echo '
                <li>
                  <a class="btnHover" href="listaProdutos.php">Produtos</a>
                </li>
                <li>
                  <a class="btnHover" href="listaEncarte.php">Encarte</a>
                </li>
                <li>
                <a class="btnHover" href="listaCategoria.php">Categoria</a>
              </li>
                ';
              }
              else{
                  echo '
                  <li>
                    <a class="btnHover" href="entrada.php">Easy Market</a>
                  </li>
                  ';

              }
            ?>

          </ul>
        </div>
      </div>
    </section>
