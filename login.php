<?php

include('includes/header.php');

$host = 'localhost';
  $user = 'root';
  $passwd = 'vertrigo';
  $bd = 'easymarketcliente';
  $conn = mysqli_connect($host, $user, $passwd, $bd);
	if(!$conn) {
		die('Falha ao conectar no servidor: ' . mysqli_error());
	}

	mysqli_query($conn, "SET SESSION sql_mode='';");
	mysqli_set_charset($conn, 'utf8');
	mysqli_query($conn, "SET NAMES 'utf8';");
	mysqli_query($conn, "SET CHARACTER SET 'utf8';");
	mysqli_query($conn, "SET COLLATION_CONNECTION = 'utf8_unicode_ci';");

	date_default_timezone_set('America/Sao_Paulo');
	setlocale(LC_TIME, 'portuguese');

if (isset($_POST['cadastrar'])) {
    $nomeCliente = htmlspecialchars($_POST['nomeCliente'], ENT_QUOTES, 'utf-8');
    $emailCliente = htmlspecialchars($_POST['emailCliente'], ENT_QUOTES, 'utf-8');
    $senhaCliente = htmlspecialchars($_POST['senhaCliente'], ENT_QUOTES, 'utf-8');
    $telefoneCliente = htmlspecialchars($_POST['telefoneCliente'], ENT_QUOTES, 'utf-8');
    $idadeCliente = htmlspecialchars($_POST['idadeCliente'], ENT_QUOTES, 'utf-8');
    $confirmaSenha = htmlspecialchars($_POST['confirmaSenha'], ENT_QUOTES, 'utf-8');

    if($senhaCliente === $confirmaSenha){
      $senhaCliente = md5($senhaCliente);
      $query = "INSERT INTO clientes  (nomeCliente, emailCliente, senhaCliente, telefoneCliente, idadeCliente) VALUES ('$nomeCliente','$emailCliente', '$senhaCliente', '$telefoneCliente', '$idadeCliente')";
      $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
      if (mysqli_affected_rows($conn)) {
        header('Location: index.php?Cadastro realizado com sucesso');
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

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Spicyo</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- owl css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
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


<body class="main-layout about_page">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="" /></div>
    </div>

    <div class="wrapper">
    <!-- end loader -->

     <div class="sidebar">
            <!-- Sidebar  -->
            <nav id="sidebar">

                <div id="dismiss">
                    <i class="fa fa-arrow-left"></i>
                </div>

                <ul class="list-unstyled components">

                    <li >
                        <a href="index.html">Home</a>
                    </li>
                    <li class="active">
                        <a href="about.html">About</a>
                    </li>
                    <li>
                        <a href="recipe.html">Recipe</a>
                    </li>
                    <li>
                        <a href="blog.html">Blog</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact Us</a>
                    </li>
                </ul>

            </nav>
        </div>


    <!-- footer -->
    <fooetr>
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                  <div class=" col-md-12">
                    <h2><strong> JÁ TENHO CADASTRO </strong></h2>
                  
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                      
                        <form class="col-xl-6" method="post">
                            <div class="row">
                             
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-control" placeholder="Email" type="text" name="emailCliente">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-control" placeholder="Senha" type="text" name="senhaCliente">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <button class="send">Entrar</button>
                                </div>
                            </div>
                            </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class=" col-md-12">
                  <h2> QUERO ME CADASTRAR</h2>
                        <div class="img-box">
                        <form class="col-xl-6 " method="post">
                            <div class="row">
                             
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-control" placeholder="Nome" type="text" name="nomeCliente">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-control" placeholder="Email" type="text" name="emailCliente">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-control" placeholder="Crie sua senha" type="text" name="senhaCliente">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-control" placeholder="Confirme a senha" type="text" name="confirmaSenha">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-control" placeholder="Telefone" type="text" name="telefoneCliente">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-control" placeholder="Idade" type="text" name="idadeCliente">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <button class="send">Cadastrar</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer_logo">
                          <a href="index.html"><img src="images/logo1.jpg" alt="logo" /></a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="lik">
                            <li > <a href="index.html">Home</a></li>
                            <li class="active"> <a href="about.html">About</a></li>
                            <li> <a href="recipe.html">Recipe</a></li>
                            <li> <a href="blog.html">blog</a></li>
                            <li> <a href="contact.html">Contact us</a></li>
                        </ul>
                    </div>
                   

    </fooetr>
    <!-- end footer -->

    </div>
    </div>
    <div class="overlay"></div>
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
     <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    
     <script src="js/jquery-3.0.0.min.js"></script>
   <script type="text/javascript">
        $(document).ready(function() {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function() {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>

</body>