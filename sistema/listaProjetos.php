<?php
include('includes/header.php');
// include('includes/menuAlteracao.php');
?>


<div class="container">
  <div class="conteudoFormulario" method="post">
    <div class="cabecalhoForm">
      <h3 class="colunasTop">Lista de Projetos</h3>

      <div class="btnsTop floatRight colunasTop">
        <div class="btnAdicionar colunasTop ">
          <a href="inserirProjeto.php"><span class="">Adicionar Projeto</span> <i class="fas fa-plus"></i></a>
        </div>
      </div>
    </div>

    <section class="boxLista">
      <?php
      $query = "SELECT * FROM projetos WHERE removido != 'sim'";
      $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
      $i=1;
      while($row = mysqli_fetch_assoc($result)) {
        $titulo = $row['titulo'];
        $idProjeto = $row['idProjeto'];

          echo '
          <a href="inserirProjeto.php?idProjeto='.$idProjeto.'">
            <div class="itemLista">
              '.$i.' - '.$titulo.'
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
