<?php
  session_start();
  include('conexao.php');

  // INÍCIO CADASTRO
  if (isset($_POST['cadastrarCliente'])) {
    $nomeCliente = htmlspecialchars($_POST['nomeCliente'], ENT_QUOTES, 'utf-8');
    $emailCliente = htmlspecialchars($_POST['emailCliente'], ENT_QUOTES, 'utf-8');
    $senhaCliente = htmlspecialchars($_POST['senhaCliente'], ENT_QUOTES, 'utf-8');
    $confirmarSenha = htmlspecialchars($_POST['confirmarSenha'], ENT_QUOTES, 'utf-8');
    $telefoneCliente = htmlspecialchars($_POST['telefoneCliente'], ENT_QUOTES, 'utf-8');

    if ($nomeCliente != '' AND $emailCliente != '' AND $senhaCliente != '' AND $telefoneCliente != '' AND $confirmarSenha != '') {

      $query = "SELECT emailCliente FROM clientes WHERE emailCliente='$emailCliente'";
      $result = mysqli_query($conn, $query);
      if(mysqli_num_rows($result) == 0){

        if($senhaCliente === $confirmarSenha){
          $senhaCliente = md5($senhaCliente);
          echo $query = "INSERT INTO clientes  (nomeCliente, emailCliente, senhaCliente, telefoneCliente, removido) VALUES ('$nomeCliente','$emailCliente', '$senhaCliente', '$telefoneCliente', ' ')";
          $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

          if (mysqli_affected_rows($conn)) {
            $query = "SELECT * FROM clientes WHERE emailCliente='$emailCliente'";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)){
              $_SESSION['cliente'] = $row['nomeCliente'];
              $_SESSION['idCliente'] = $row['idCliente'];
            }
            $_SESSION['logadoSite'] = true;
            header('Location: ../index.php?Cadastro realizado com sucesso');
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
              window.alert("As senhas são diferentes.")
            </script>
          ';
          header('Location: ../login.php');
        }
      }
      else{
        echo '
          <script>
            window.alert("E-mail já cadastrado.")
            window.location.href="login.php";
          </script>
        ';
      }
    }
    else{
      echo '
        <script>
          window.alert("Preencha todos os campos.")
        </script>
      ';
    }
  }
  // FIM CADASTRO

  // INÍCIO LOGIN

  if(isset($_POST['efetuarLogin'])){
    $login = trim(htmlspecialchars($_POST['login'], ENT_QUOTES, 'utf-8'));
    $senhaLogin = trim(htmlspecialchars($_POST['senhaLogin'], ENT_QUOTES, 'utf-8'));
    $senhaLogin = md5($senhaLogin);

    $query = "SELECT nomeCliente, emailCliente FROM clientes WHERE emailCliente='$login'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
      $query = "SELECT * FROM clientes WHERE senhaCliente='$senhaLogin'";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          $_SESSION['cliente'] = $row['nomeCliente'];
          $_SESSION['idCliente'] = $row['idCliente'];
        }
        $_SESSION['logadoSite'] = true;
        header('Location: ../index.php');
      }
      else{
        echo '
          <script>
            window.alert("Email e senha incorretos.")
          </script>
        ';
      }
    }
    else{
      echo '
        <script>
          window.alert("Email não encontrado.")
        </script>
      ';
    }
  }

  // FIM LOGIN
?>
