<!-- footer -->
<fooetr>
    <div class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer_logo">
                      <a href="index.html"><img src="images/logo1.jpg" alt="logo" /></a>
                    </div>
                </div>
                <div class="col-md-12">
                    <ul class="lik">
                        <li > <a href="index.html">Home</a></li>
                        <li class="active"> <a href="about.html">About</a></li>
                        <li> <a href="recipe.html">Recipe</a></li>
                        <li> <a href="blog.html">blog</a></li>
                        <li> <a href="contact.html">Contact us</a></li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="new">
                        <h3>Newsletter</h3>
                        <form class="newtetter">
                            <input class="tetter" placeholder="Your email" type="text" name="Your email">
                            <button class="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <p>© 2019 All Rights Reserved. Design by<a href="https://html.design/"> Free Html Templates</a></p>
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
