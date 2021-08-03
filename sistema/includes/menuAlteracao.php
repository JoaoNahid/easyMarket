<section id="menuPaginas">
  <div class="menuPaginas">
    <div class="container">
      <ul>
        <?php
          if($funcaoUsuario == 'adm'){
            echo '
            <li>
              <a onclick="abrirMenu()">Home</a>
                <ul id="menuAlteracao" class="boxMenuAlteracao">
                  <a href="editarBanner.php?idBanner"> <li>Banner</li> </a>
                  <a href="editarSobre.php?idSobre"> <li>Sobre</li> </a>
                  <a href="listaProjetos.php"> <li>Projetos</li> </a>
                  <a href="listaComissarios.php"> <li>Comissários</li> </a>
                  <a href="listaDuvidas.php"> <li>Dúvidas</li> </a>
                </ul>
            </li>
            <li>
              <a href="bazar21.php">Bazar 21</a>
            </li>
            ';
          }
          else{
              echo '
              <li>
                <a href="bazar21.php">Bazar 21</a>
              </li>
              ';

          }
        ?>

      </ul>
    </div>
  </div>
</section>
<script>
  function abrirMenu(){
    var element = document.getElementById('menuAlteracao');
    element.classList.toggle('menuAberto');
  }
</script>
