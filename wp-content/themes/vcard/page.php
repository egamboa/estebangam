<?php
/**
 * The template for displaying all pages
 */

get_header(); ?>
<!--BLog single section-->
<section id="blogSingle" class="blogSingle singleOffset ofsBottom">
	<!--Container-->
	<div class="container clearfix">
		<div class="eleven columns">
									
			<!--Post Single-->
			<div class="postSingle">
				<!--Post content-->
				<div class="postContent">
				<?php
					// Start the Loop.
					while ( have_posts() ) : the_post(); 
					get_template_part( 'content', get_post_format() ); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
						<div class="postTitle">
							<h1><?php the_title(); ?></h1>					
						</div>
						
						<div class="postMedia large">
							<?php the_post_thumbnail(); ?>																				
						</div>		
						
						<?php the_content(); ?>	
						
						<?php wp_link_pages(); ?>
					</div>
				<?php endwhile; ?>	 
				</div>
				<!--End post content-->	
			</div>
			<!--End post single-->	
			
		</div>					
		<div class="five columns sidebar">
			<?php get_sidebar(); ?>
		</div>		
	</div>
	<!--End container-->
</section>
<!--End blog single section-->
<?php
get_footer();
