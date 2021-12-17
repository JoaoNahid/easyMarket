<!-- footer -->
<fooetr>
    <div class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer_logo">
                      <a href="index.php">
                        <img src="images/easyLogoBranca.png" alt="logo" />
                      </a>
                    </div>
                </div>
                <div class="col-md-12">
                    <ul class="lik">
                        <li > <a href="index.php">Home</a></li>
                        <li> <a href="sobre.php">Sobre</a></li>
                        <li> <a href="encarte.php">Encarte</a></li>
                        <li> <a href="mercado.php">Mercado</a></li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <p>© 2021 All Rights Reserved. Design by<a href="index.php"> Easy Market Group</a></p>
            </div>
        </div>
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
 <script src="js/flickity-docs.min.js"></script>

 <!-- mascara inputs -->
 <script src="js/mascarasInput.js"></script>

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

</html>
