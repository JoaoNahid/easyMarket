<?php
include('includes/header.php');



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
      <h3 class="colunasTop">Produtos</h3>

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
            <a href="listaProdutos.php"><li>Todos</li></a>
            <?php
              $query = "SELECT * FROM categorias WHERE removido != 'sim' ORDER BY nomeCategoria";
              $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
              while($row = mysqli_fetch_assoc($result)) {
                $idCategoria = $row['idCategoria'];
                $nomeCategoria = $row['nomeCategoria'];
                echo '
                  <a href="listaProdutos.php?categoria='.$idCategoria.'"><li>'.$nomeCategoria.'</li></a>
                ';
              }
            ?>
<?php
// Page Count 1.0 - Renan Orati
// ----------------------------
// Gerando variáveis de paginas! Legenda:
// $pa - Página Atual
// $nrResult - Indice para ser usado no While, (numero de registros - 1)
// $nrResult - Aqui eu guardo o numero de registros...
// $pags - Número de Páginas.
// nReg - Numero de Registros por pagina!

//Coloque aqui a instrução sql de busca!
$SQL = "SELECT * FROM categorias";

//Executando instrução
$EXEC = pg_query($SQL);

// Coloque o numero de registros que deve ser mostrado por paginas
$nReg = 10;
//recebendo pagina atual
$pa = $_GET['pa'];
$pa = (int)$pa;
$nrResult = pg_num_rows($CHECA);
$nrResultX = $nrprof;
/* OBS: Pra ficar claro... a função "pg_num_rows" ela retorna o numero 

de registros gerados pelo select... mas na hora de mostrar, como o php 

gera os resultados apartir de 0 ( 0 .. n ) então eu subtraio 1 no 

numero de registros para nao mostrar registro a mais!*/
$nrResult -=1;
//Calculando o numero de paginas
$pags = (int)(($nrResult/$nReg)+1);
//Calculando o registro inicial
$iniciopag = ($nReg*$pa)-$nReg;
//Calculando o registro final
$fimpag = ($nReg*$pa)-1;

//Pronto... voce pode utilizar para qualquer consulta...
//Pra fica mais facil eu vou usar uma consulta de exemplo
?>

<html>
<body>
<table width=200>

<?
   $i = $iniciopag;
   while(($i<=$nrResult) and ($i<=$fimpag)){
   $nome = pg_result($EXEC,$i,"nome");
   $sobrenome = pg_result($EXEC,$i,"sobrenome");
?>

<tr>
   <td width=100><?=$nome?></td>
   <td width=100><?=$sobrenome?></td>
</tr>

<? $i+=1; } ?>

<br>

<?
//Agora vou mostra o " Paginas - 1 2 3 n "
// $z - é um tipo de contador
// $pagina - pagina atual... caso for mandar para uma outra pagina substitua pelo nome da pagina

$pagina = $_SERVER['SCRIPT_NAME'];
$pagina = substr($aaa,1,255);

$z=1;
while($z<=$pags){

?>

<a href="<?=$pagina?>?pa=<?=$z?>">
<?=$z." "?>
</a>
<? $z+=1; }?>
          </ul>
        </div>
        <div class="col-md-9">
          <div class="row">
            <?php
            if(isset($_GET['categoria'])){
              $categoriaBusca = htmlspecialchars($_GET['categoria'], ENT_QUOTES, 'utf-8');
              $query = "SELECT * FROM produtos WHERE removido != 'sim' AND idCategoria='$categoriaBusca' ORDER BY nomeProduto";
            }
            else{
              $query = "SELECT * FROM produtos WHERE removido != 'sim' ORDER BY nomeProduto";
            }

              $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
              while($row = mysqli_fetch_assoc($result)) {
                $nomeProduto = $row['nomeProduto'];
                $marcaProduto = $row['marcaProduto'];
                $idProduto = $row['idProduto'];
                $categoriaProduto = $row['idCategoria'];
                $precoProduto = $row['precoProduto'];
                $fotoProduto = $row['fotoProduto'];
                $pesoProduto = $row['pesoProduto'];
                $unidadePeso = $row['unidadePeso'];
                $codigoProduto = $row['codigoProduto'];
                $descricaoProduto = $row['descricaoProduto'];

                echo '
                <div class="col-md-4">
                  <div class="itemLista">
                    <a href="inserirProduto.php?idProduto='.$idProduto.'"><div class="imgProduto" style="background: url(uploads/'.$fotoProduto.') no-repeat center; background-size: cover;"></div></a>
                    <div class="descProduto">
                      <a href="inserirProduto.php?idProduto='.$idProduto.'"><h3>'.$nomeProduto.' - '.$marcaProduto.'</h3></a>
                      <p>'.$pesoProduto.' '.$unidadePeso.'</p>
                      <p><strong>Código: </strong> '.$codigoProduto.'</p>
                      <h4><strong>R$ </strong>'.$precoProduto.'</h4>
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
