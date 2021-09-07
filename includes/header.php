<!DOCTYPE html>
<?php
  include('arquivosDeSessao/cadastroELogin.php');
?>
<html lang="pt-br">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Easy Market</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- fontawesome -->
    <link href="fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="fontawesome/css/brands.css" rel="stylesheet">
  <link href="fontawesome/css/solid.css" rel="stylesheet">
    <!-- owl css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- flickity -->
    <link rel="stylesheet" href="css/flickity-docs.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- awesome fontfamily -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout">
    <!-- loader
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="" /></div>
    </div>

    <div class="wrapper">
     end loader -->

     <div class="sidebar">
            <!-- Sidebar  -->
            <nav id="sidebar">

                <div id="dismiss">
                    <i class="fa fa-arrow-left"></i>
                </div>

                <ul class="list-unstyled components">

                    <li class="active">
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="sobre.php">Sobre</a>
                    </li>
                    <li>
                        <a href="encarte.php">Encarte</a>
                    </li>
                    <?php
                      if(isset($_SESSION['logadoSite'])){
                        echo '
                        <li>
                            <a href="mercado.php">Mercado</a>
                        </li>
                        ';
                      }
                    ?>
                    <li>
                        <a href="contato.php">Contato</a>
                    </li>
                </ul>

            </nav>
        </div>

    <div id="content">
    <!-- header -->
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="full">
                        <a class="logo" href="index.php"><img src="images/easyLogoBranca.png" alt="#" /></a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="full">
                        <div class="right_header_info">
                            <ul>

                                <li class="dinone"><img style="margin-right: 15px;" src="images/mail_icon.png" alt="#"><a href="#">atendimento@easymarket.com</a></li>
                                <?php
                                  if(isset($_SESSION['logadoSite'])){
                                    echo '
                                      <li class="dinone"><a href="login.php">Olá '.$_SESSION['cliente'].'!</a></li>
                                      <li class="iconeMenu"><a href="minhaCestaDeCompras.php"><i class="fas fa-shopping-basket"></i></a></li>
                                      <li class="iconeMenu"><a href="arquivosDeSessao/logout.php"><i class="fas fa-sign-out-alt"></i></a></li>
                                    ';
                                  }
                                  else{
                                    echo '
                                      <li class="button_user"><a class=" active" href="login.php">Login</a><a class="" href="login.php">Registrar</a></li>
                                    ';
                                  }
                                ?>

                                    <button type="button" id="sidebarCollapse">
                                        <img src="images/menu_icon.png" alt="#">
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end header -->
