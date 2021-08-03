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
          <a href="inserirProduto.php"><span class="">Adicionar Produto</span> <i class="fas fa-plus"></i></a>
        </div>
      </div>
    </div>

    <section class="boxLista">
      <div class="row">
        <div class="col-md-3 filtroBusca">
          <h3>Buscar Por:</h3>
          <ul>
            <a href="bazar21.php"><li>Todos</li></a>
            <a href="bazar21.php?categoria=acessorio"><li>Acessórios</li></a>
            <a href="bazar21.php?categoria=calcado"><li>Calçados</li></a>
            <a href="bazar21.php?categoria=livro"><li>Livros</li></a>
            <a href="bazar21.php?categoria=roupa"><li>Roupas</li></a>
            <a href="bazar21.php?categoria=outros"><li>Outros</li></a>
          </ul>
        </div>
        <div class="col-md-9">
          <div class="row">
            <?php
            if(isset($_GET['categoria'])){
              $categoriaBusca = htmlspecialchars($_GET['categoria'], ENT_QUOTES, 'utf-8');
              $query = "SELECT * FROM bazar WHERE removido != 'sim' AND categoria='$categoriaBusca' ORDER BY produto";
            }
            else{
              $query = "SELECT * FROM bazar WHERE removido != 'sim' ORDER BY produto";
            }

              $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
              while($row = mysqli_fetch_assoc($result)) {
                $produto = $row['produto'];
                $idProduto = $row['idProduto'];
                $categoria = $row['categoria'];
                $preco = $row['preco'];
                $cor = $row['cor'];
                $tamanho = $row['tamanho'];
                $status = $row['status'];
                $descricao = $row['descricao'];
                $estado = $row['estado'];

                echo '
                <div class="col-md-4">
                  <div class="itemLista">
                    <a href="inserirProduto.php?idProduto='.$idProduto.'"><div class="imgProduto" style="background: url(img/golaV.jpg) no-repeat center; background-size: cover;"></div></a>
                    <div class="descProduto">
                      <a href="inserirProduto.php?idProduto='.$idProduto.'"><h3>'.$produto.' '.$tamanho.'</h3></a>
                      <p>'.$categoria.'</p>
                      <p>'.$status.'</p>
                      <h4><strong>R$ </strong>'.$preco.'</h4>
                    </div>
                  </div>
                </div>
                ';

              }
            ?>
          </div>
        </div>

      </div>


    </section>
    <br>

  </div>
</div>

<?php
  include('includes/footer.php');
?>
