<!--  footer -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-md-7 ">
                     <ul class="location_icon">
                        <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i></a><br> Location</li>
                        <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a><br> +01 1234567890</li>
                        <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a><br> demo@gmail.com</li>
                     </ul>
                  </div>
                  <div class="col-md-2 text-white">
                     <div class="ftco-footer-widget text-white">
                        <?php if ( is_active_sidebar( 'footer-widget-area-1' ) ) : ?>
                           <?php dynamic_sidebar( 'footer-widget-area-1' ); ?>
                        <?php endif; ?>
                     </div>
                  </div>
                  <div class="col-md-2 text-white">
                     <div class="ftco-footer-widget text-white ">
                        <?php if ( is_active_sidebar( 'footer-widget-area-2' ) ) : ?>
                           <?php dynamic_sidebar( 'footer-widget-area-2' ); ?>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <p>© 2019 All Rights Reserved. Design by<a href="https://html.design/"> Free Html Templates</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="<?= get_template_directory_uri() ?>/js/jquery.min.js"></script>
      <script src="<?= get_template_directory_uri() ?>/js/popper.min.js"></script>
      <script src="<?= get_template_directory_uri() ?>/js/bootstrap.bundle.min.js"></script>
      <script src="<?= get_template_directory_uri() ?>/js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="<?= get_template_directory_uri() ?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="<?= get_template_directory_uri() ?>/js/custom.js"></script>
      <script>
         // This example adds a marker to indicate the position of Bondi Beach in Sydney,
         // Australia.
         function initMap() {
           var map = new google.maps.Map(document.getElementById('map'), {
             zoom: 11,
             center: {lat: 40.645037, lng: -73.880224},
             });
         
         var image = 'images/maps-and-flags.png';
         var beachMarker = new google.maps.Marker({
             position: {lat: 40.645037, lng: -73.880224},
             map: map,
             icon: image
           });
         }
      </script>
      <!-- google map js -->
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script>
      <?php wp_footer() ?>
      <!-- end google map js --> 
   </body>
</html>