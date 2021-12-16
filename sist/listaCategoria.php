<?php
include('includes/header.php');
// include('includes/menuAlteracao.php');
?>


<div class="container">
  <div class="conteudoFormulario" method="post">
    <div class="cabecalhoForm">
      <h3 class="colunasTop">Lista de Categorias</h3>

      <div class="btnsTop floatRight colunasTop">
        <div class="btnAdicionar colunasTop ">
          <a href="inserirCategoria.php"><span class="">Adicionar Categoria</span> <i class="fas fa-plus"></i></a>
        </div>
      </div>
    </div>

    <section class="boxLista">
      <?php
      $query = "SELECT * FROM categorias WHERE removido != 'sim'";
      $result = mysqli_query($conn, $query);
      $i=1;
      while($row = mysqli_fetch_assoc($result)) {
        $nomeCategoria = $row['nomeCategoria'];
        $idCategoria = $row['idCategoria'];
          echo '
          <a href="inserirCategoria.php?idCategoria='.$idCategoria.'">
            <div class="itemLista">
              '.$i.' - '.$nomeCategoria.'
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
