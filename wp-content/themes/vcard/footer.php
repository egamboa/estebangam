<?php
/**
 * The template for displaying the footer
 */
 global $theme_option; 
?>
						
<footer class="footer  offset">
	<!--Bottom footer-->
	<div class="footerholder">
			<!--Container-->
			<div class="container clearfix">
				<div class="eight columns">
					<?php if($theme_option['footer_text']!=''){ ?>
						<?php echo $theme_option['footer_text']; ?>
					<?php } ?>
				</div>
				<div class="eight columns ">
					<ul class="socialsFooter">
						<?php if($theme_option['facebook']!=''){ ?>
						<li><a href="<?php echo $theme_option['facebook']; ?>"><i class="icon-facebook"></i></a></li>
						<?php } ?>
						<?php if($theme_option['google']!=''){ ?>
						<li><a href="<?php echo $theme_option['google']; ?>"><i class="icon-gplus"></i></i></a></li>
						<?php } ?>
						<?php if($theme_option['twitter']!=''){ ?>
						<li><a href="<?php echo $theme_option['twitter']; ?>"><i class="icon-twitter"></i></a></li>
						<?php } ?>						
						<?php if($theme_option['linkedin']!=''){ ?>
						<li><a href="<?php echo $theme_option['linkedin']; ?>"><i class="icon-linkedin"></i></a></li>
						<?php } ?>
						<?php if($theme_option['dribbble']!=''){ ?>
						<li><a href="<?php echo $theme_option['dribbble']; ?>"><i class="icon-dribbble"></i></a></li>
						<?php } ?>
						<?php if($theme_option['pinterest']!=''){ ?>
						<li><a href="<?php echo $theme_option['pinterest']; ?>"><i class="icon-pinterest"></i></a></li>
						<?php } ?>
						<?php if($theme_option['instagram']!=''){ ?>
						<li><a href="<?php echo $theme_option['instagram']; ?>"><i class="icon-instagram"></i></a></li>
						<?php } ?>
						<?php if($theme_option['vimeo']!=''){ ?>
						<li><a href="<?php echo $theme_option['vimeo']; ?>"><i class="icon-vimeo"></i></a></li>
						<?php } ?>						
					</ul>
				</div>

			</div>
		<!--End container-->
	</div>
	<!--End bottom footer-->
</footer>
<!--End footer-->
								
</div>
<!--ENd wrapper-->

<?php wp_footer(); ?>
</body>
</html>