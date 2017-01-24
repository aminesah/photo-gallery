<div class="container">
  <div class="row twelve columns">
    <ul class="social">
      <li class="twitter"><a href="#"><i class="fa fa-twitter-square fa-lg"></a></i></li>
      <li class="github"><a href="#"><i class="fa fa-github-square fa-lg"></a></i></li>
      <li class="linkedin"><a href="#"><i class="fa fa-linkedin-square fa-lg"></a></i></li>
    </ul>
  </div>
  <div class="row twelve columns">
    <p class="copyright">&copy; 2016 Sahmoudi Amine, Software Developer. All Rights Reserved.</p>
  </div>
</div>
</footer>

<!-- End Document
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<script src="scripts/jquery-magnific-popup.js"></script>
<script type="text/javascript">
// Initialize popup as usual
$('.image-link').magnificPopup({
type: 'image',
mainClass: 'mfp-with-zoom', // this class is for CSS animation below

zoom: {
  enabled: true, // By default it's false, so don't forget to enable it

  duration: 300, // duration of the effect, in milliseconds
  easing: 'ease-in-out', // CSS transition easing function

  // The "opener" function should return the element from which popup will be zoomed in
  // and to which popup will be scaled down
  // By defailt it looks for an image tag:
  opener: function(openerElement) {
    // openerElement is the element on which popup was initialized, in this case its <a> tag
    // you don't need to add "opener" option if this code matches your needs, it's defailt one.
    return openerElement.is('img') ? openerElement : openerElement.find('img');
  }
}

});

</script>
</body>
</html>

<?php if(isset($database)){ $database->close_connection();} ?>
