	
<!-- YOUR CODE HERE -->
<footer class="footer">
	<div class="footer-first">
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="col-md-3">
						<h5>About</h5>
						<h3><?=$site_options['site_name']?></h3>
						<p><?=$site_options['site_description']?></p>
						<p>
							<?php if(!empty($site_options['facebook_link'])) { ?>
							<a href="<?=$site_options['facebook_link']?>" target="_blank"><i class="fa fa-facebook"></i></a> 
							<?php } ?>
							<?php if(!empty($site_options['google_link'])) { ?>
							<a href="<?=$site_options['google_link']?>" target="_blank"><i class="fa fa-google-plus"></i></a> 
							<?php } ?>
							<?php if(!empty($site_options['twitter_link'])) { ?>
							<a href="<?=$site_options['twitter_link']?>" target="_blank"><i class="fa fa-twitter"></i></a> 
							<?php } ?>
							<?php if(!empty($site_options['linkedin_link'])) { ?>
							<a href="<?=$site_options['linkedin_link']?>" target="_blank"><i class="fa fa-linkedin"></i></a> 
							<?php } ?>
						</p>
					</div>
					<div class="col-md-3">
						<h5>Address</h5>					
						<address>
							  	<strong><?=$site_options['site_name']?></strong><br>
							  		<?php if(!empty($site_options['address1'])) :?>
							  		<?=$site_options['address1']?><br>
							  		<?php endif;?>
							  		<?php if(!empty($site_options['address2'])) :?>
							  		<?=$site_options['address2']?><br>
							  		<?php endif;?>
							  		<?php if(!empty($site_options['phone1'])) :?>
							  		<abbr title="Phone">P:</abbr> <?=$site_options['phone1']?> <br>
							  		<?php endif;?>
							  		<?php if(!empty($site_options['phone2'])) :?>
							  		<abbr title="Phone">P:</abbr> <?=$site_options['phone2']?> <br>
							  		<?php endif;?>
							  		<br>
							  		<?php if(!empty($site_options['phone2'])) :?>
							  		<a href="mailto:<?=$site_options['email1']?>"><?=$site_options['email1']?></a><br>
							  		<?php endif;?>
							  		<?php if(!empty($site_options['phone2'])) :?>
							  		<a href="mailto:<?=$site_options['email2']?>"><?=$site_options['email2']?></a>
							  		<?php endif;?>
							</address>
					</div>
					<div class="col-md-3">
						<h5>SiteLinks</h5>
						<?=$footer_blocks[0]['content_html']?>
					</div>
					<div class="col-md-3">
						<h5>Important Links</h5>
						<?=$footer_blocks[1]['content_html']?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-second">
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="pull-left links-below">
							<?=$footer_blocks[2]['content_html']?>
						</div>

						<div class="copyright pull-right">
							Copyright &copy; <script>document.write(new Date().getFullYear())</script> Made With <i class="fa fa-heart"></i> by <a href="http://sapricami.com">Sapricami</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>



    <script src="<?=base_url()?>assets/third_party/jQuery/jQuery-2.2.0.min.js"></script>
    <script src="<?=base_url()?>assets/front/bootstrap/js/bootstrap.min.js"></script>

    <?php if ( (isset($page_slug)) && (in_array($page_slug, array('photos','videos','projects')) )) {?>
    <script src="<?=base_url()?>assets/third_party/lity-2.2.0/lity.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function ($) {
            // delegate calls to data-toggle="lightbox"
            $(document).delegate('*[data-toggle="lightbox"]:not([data-gallery="navigateTo"])', 'click', function(event) {
                event.preventDefault();
                return $(this).ekkoLightbox({
                    onShown: function() {
                        if (window.console) {
                            return console.log('Checking our the events huh?');
                        }
                    },
					onNavigate: function(direction, itemIndex) {
                        if (window.console) {
                            return console.log('Navigating '+direction+'. Current item: '+itemIndex);
                        }
					}
                });
            });

            //Programatically call
            $('#open-image').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $('#open-youtube').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });

			// navigateTo
            $(document).delegate('*[data-gallery="navigateTo"]', 'click', function(event) {
                event.preventDefault();

                var lb;
                return $(this).ekkoLightbox({
                    onShown: function() {

                        lb = this;

						$(lb.modal_content).on('click', '.modal-footer a', function(e) {

							e.preventDefault();
							lb.navigateTo(2);

						});

                    }
                });
            });


        });
    </script>
    <?php } ?>
    <?php if ( (isset($page_slug)) && ($page_slug=='contact') ) {?>
    <!-- Plugin For Google Maps -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script type="text/javascript">
		$().ready(function(){
			var myLatlng = new google.maps.LatLng(27.1767,78.0081);
	        var mapOptions = {
	          zoom: 14,
	          center: myLatlng,
	          styles:
				[{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}],
	          scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
	        }
	        var map = new google.maps.Map(document.getElementById("contactUsMap"), mapOptions);

	        var marker = new google.maps.Marker({
	            position: myLatlng,
	            title:"Sapricami"
	        });
	        marker.setMap(map);
		});
	</script>
    <?php } ?>
    <?php  if ( (isset($page_slug)) && ($page_slug=='home') ) {?>
    <script src="<?=base_url()?>assets/third_party/owl/owl.carousel.min.js"></script>
    <script type="text/javascript">
    	$('#slider').each(
		  function() {
		    var no= $('.item', $(this)).length;
		       if (no > 1){
		    var autoPlayValue = 4000;
		   }else{
		    var autoPlayValue = false;
		   }
		   "use strict";
		   $("#slider").owlCarousel({
		      navigation : false, // Show next and prev buttons
		      slideSpeed : 300,
		      paginationSpeed : 400,
		      singleItem:true,
		      transitionStyle : "fade",
		      autoPlay:autoPlayValue
		 
		      // "singleItem:true" is a shortcut for:
		      // items : 1, 
		      // itemsDesktop : false,
		      // itemsDesktopSmall : false,
		      // itemsTablet: false,
		      // itemsMobile : false
		 
		  });
		  }
		);
    </script>
    <?php }  ?>
</body>
</html>