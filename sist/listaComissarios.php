<?php
include('includes/header.php');
// include('includes/menuAlteracao.php');
?>
<script src="https://cdn.tiny.cloud/1/5vtboiki0kpmozo3a4zfq8x4wzt3fn6201e6ykccdkvj2bhm/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '.tinymce',
  });
</script>

<div class="container">
  <div class="conteudoFormulario" method="post">
    <div class="cabecalhoForm">
      <h3 class="colunasTop">Lista de Comissários</h3>

      <div class="btnsTop floatRight colunasTop">
        <div class="btnAdicionar colunasTop ">
          <a href="inserirComissario.php"><span class="">Adicionar Comissário</span> <i class="fas fa-plus"></i></a>
        </div>
      </div>
    </div>

    <section class="boxLista">
      <?php
      $query = "SELECT * FROM comissarios WHERE removido != 'sim'";
      $result = mysqli_query($conn, $query);
      $x = 1;
      while($row = mysqli_fetch_assoc($result)) {
        $nome = $row['nome'];
        $idComissario = $row['idComissario'];

          echo '
          <a href="inserirComissario.php?idComissario='.$idComissario.'">
            <div class="itemLista">
              '.$x.' - '.$nome.'
              <div class="btnEditar floatRight">
                <i class="fas fa-edit"></i>
              </div>
            </div>
          </a>
          ';
          $x++;
        }
      ?>

    </section>
    <br>

  </div>
</div>

<?php
  include('includes/footer.php');
?>
