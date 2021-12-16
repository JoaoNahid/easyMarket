<?php
include('includes/header.php');
// include('includes/menuAlteracao.php');
?>


<div class="container">
  <div class="conteudoFormulario" method="post">
    <div class="cabecalhoForm">
      <h3 class="colunasTop">Lista de Dúvidas</h3>

      <div class="btnsTop floatRight colunasTop">
        <div class="btnAdicionar colunasTop ">
          <a href="inserirDuvida.php"><span class="">Adicionar Pergunta</span> <i class="fas fa-plus"></i></a>
        </div>
      </div>
    </div>

    <section class="boxLista">
      <?php
      $query = "SELECT * FROM duvidas WHERE removido != 'sim'";
      $result = mysqli_query($conn, $query);
      $i=1;
      while($row = mysqli_fetch_assoc($result)) {
        $pergunta = $row['pergunta'];
        $idPergunta = $row['idPergunta'];

          echo '
          <a href="inserirDuvida.php?idPergunta='.$idPergunta.'">
            <div class="itemLista">
              '.$i.' - '.$pergunta.'
              <div class="btnEditar floatRight">
                <i class="fas fa-edit"></i>
              </div>
            </div>
          </a>
          ';
          $i++;
        }
      ?>

    </section>
    <br>

  </div>
</div>

<?php
  include('includes/footer.php');
?>
