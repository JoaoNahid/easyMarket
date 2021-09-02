<?php
    include("../conexao.php");

    $query = "SELECT * FROM produtos WHERE removido != 'sim' ORDER BY nomeProduto";
              $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
              while($row = mysqli_fetch_assoc($result)) {
              }
              $qtdPorPagina = '5'; // número de registros por página
              $pagina=$_GET['pagina'];
                if (!$pagina) {
                $paginaAtual = "1";
                } else {
                $paginaAtual = $pagina;
                }
                $inicio = $paginaAtual - 1;
                $inicio = $inicio * $qtdPorPagina;
                $limite = mysql_query("$busca LIMIT $inicio,$qtdPorPagina");
                $todos = mysql_query("$busca");

                $tr = mysql_num_rows($todos); // verifica o número total de registros
                $tp = $tr / $qtdPorPagina; // verifica o número total de páginas

                // vamos criar a visualização
                while ($dados = mysql_fetch_array($limite)) {
                $nome = $dados["nome"];
                echo "Nome: $nome<br>";
                }

                // agora vamos criar os botões "Anterior e próximo"
                $anterior = $paginaAtual -1;
                $proximo = $paginaAtual +1;
                if ($paginaAtual>1) {
                echo " <a href='?pagina=$anterior'><- Anterior</a> ";
                }
                echo "|";
                if ($paginaAtual<$tp) {
                echo " <a href='?pagina=$proximo'>Próxima -></a>";
                }
?>