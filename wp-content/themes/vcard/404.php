<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
global $theme_option; 
get_header(); ?>
<section style="padding: 150px 0px 100px;">  
	<div class="text-center" style="text-align: center;">
		<h1 class="projTitle tCenter title"><?php echo $theme_option['404_title']; ?></h1>
		<?php echo $theme_option['404_content']; ?><br><br>
		<div class="btn"><a href="<?php echo home_url(); ?>">BACK TO HOME</a></div>
	</div><br><br><br>		
</section><!-- end postwrapper -->

<?php
get_footer();
