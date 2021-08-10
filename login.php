<?php
include('includes/header.php');
include('sist/conexao.php');

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

<head>
    <!-- basic -->
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
<!-- body -->

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
                    <h2>JÁ TENHO CADASTRO <strong class="white"> QUERO ME CADASTRAR</strong></h2>
                  </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                      
                        <form class="main_form">
                            <div class="row">
                             
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-control" placeholder="Email" type="text" name="Email">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-control" placeholder="Senha" type="text" name="Senha">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <button class="send">Entrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="img-box">
                        <form class="main_form">
                            <div class="row">
                             
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-control" placeholder="Email" type="text" name="Email">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-control" placeholder="Crie sua senha" type="text" name="Crie sua senha">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-control" placeholder="Confirme a senha" type="text" name="Confirme a senha">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-control" placeholder="Digite o CPF" type="text" name="Digite o CPF"><
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

?>

