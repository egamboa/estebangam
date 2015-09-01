<?php
/**
 * The Template for displaying all single posts
 */
global $theme_option; 
get_header(); ?>
<?php while(have_posts()) :the_post(); ?>
<!-- Project details-->
<section id="projectDetail" class="ofsBottom singleOffset">
	<!--Container-->
	<div class="container clearfix singleProject">
			<h1 class="projTitle tCenter title"><?php the_title();?>
				<span>
				<?php
					$categorie_name ='';
					$categorie_slug ='';
					$categories = get_the_terms(get_the_ID(),'categories');  
					$tax = array();
					$i = 1;
					 foreach( (array)$categories as $categorie){
						  if(count($categories)>0){
						  $cat_slug = $categorie->slug;
						$tax[$i] = array(
							'taxonomy' => 'categories',
							'field' => 'slug',
							'terms' => $cat_slug,
						);
						$categorie_name .= $categorie->name.' ,' ;
						$categorie_slug .= $categorie->slug .' ';  
						$i++;
					}}
					echo $categorie_name;
					$port_id = get_the_ID();
				?>
				</span>
			</h1>

			<!--Extra-->
			<div class="extra clearfix">
				<div class="eight columns projSocials">			
					<ul>
						<?php 
							$facebook = get_post_meta(get_the_ID(),'_cmb_portfolio_facebook', true);
							$linkedin =  get_post_meta(get_the_ID(),'_cmb_portfolio_linkedin', true);
							$instagram = get_post_meta(get_the_ID(),'_cmb_portfolio_instagram', true);
						?>
						<?php if($facebook!=''){?>
						<li><a href="<?php echo $facebook;?>"><i class="icon-facebook"></i></a></li>
						<?php }?>
						<?php if($linkedin!=''){?>
						<li><a href="<?php echo $linkedin;?>"><i class="icon-linkedin"></i></a></li>
						<?php }?>
						<?php if($instagram!=''){?>
						<li><a href="<?php echo $instagram;?>"><i class="icon-instagram"></i></a></li>
						<?php }?>
					</ul>
				</div>
				<div class="eight columns projNav">					
					<ul>
						<li><?php previous_post_link('%link', $excluded_terms = '');?></li>
						<li><a href="#"><i class="icon-layout"></i></a></li>
						<li><?php next_post_link('%link', $excluded_terms = '');?></li>
					</ul>
				</div>
			</div>
			<!--End extra-->
			<?php $format = get_post_format();?>
		   <?php if($format == 'gallery'){?>
		   <?php $gallery = get_post_gallery( get_the_ID(), false );
				 if(isset($gallery['ids'])){
				?>
				<!--Project details slider-->	
				<div class="projectSlider flexslider">
					<ul class="slides">
					  <?php
						$gallery_ids = $gallery['ids'];
						$img_ids = explode(",",$gallery_ids);               
						foreach( $img_ids AS $img_id ){
						$image_src = wp_get_attachment_image_src($img_id,'');
						$params = array( 'width' => 940, 'height' => 544 );
						$image = bfi_thumb( $image_src[0], $params );
					  ?>
						<li><img src="<?php echo $image;?>" alt=""/></li>
					  <?php }?>
				</ul>
			</div>
			<?php }?>
			<!--End project details slider-->
			<?php }elseif($format == 'video'){?>
				<?php if(get_post_meta(get_the_ID(),'_cmb_portfolio_video', true)!=''){?>
					<!--Project details video-->	
					<div class="videoHolder" >
						<iframe width="940" height="600" src="<?php echo get_post_meta(get_the_ID(),'_cmb_portfolio_video', true);  ?>" allowfullscreen></iframe>
					</div>
					<!--End project details video-->	
			   <?php }?>
		    <?php }elseif($format == 'audio'){?>
			<!--Post media-->
			<div class="postMedia large">
				<iframe width="100%" height="166" scrolling="no" frameborder="no" src="<?php echo get_post_meta(get_the_ID(), "_cmb_portfolio_audio", true);?>&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=true"></iframe>
			</div>
			<!--End post media-->	    
		   <?php }else{
			$params = array( 'width' => 940, 'height' => 544 );
			$image = bfi_thumb( wp_get_attachment_url( get_post_thumbnail_id()), $params );?>
			<!--Post media-->
			<div class="postMedia large">
				<img width="940" height="544" class="thumb-single" src="<?php echo $image;?>" />
			</div>
			<?php }?>			

			<!--Project single details-->
			<div class="singleDetails clearfix">

				<div class="four columns info">
					<h1>Information</h1>
					<ul class="iList">
						<?php
							$tags = get_the_terms(get_the_ID(),'tags');
							if ($tags!=''){
							 foreach( (array)$tags as $tag){
							$tag_name = $tag->name;
							//$tag_slug = $tag->slug;
						?>
						<li><i class="icon-circle"></i><?php echo $tag_name;?></li>
						<?php } }?>
					</ul>
				</div>

				<div class="twelve columns">
					<h1>Project Details</h1>
					<?php the_content();?>
					<div class="btn"><a  href="<?php echo get_post_meta(get_the_ID(),'_cmb_portfolio_project', true)?>">Launch Project</a></div>
				</div>
			</div>
			<!--End project single details-->
		</div>
		<!--End container-->
	</section>
	<!--End project details-->
<?php endwhile;?>
																
	<!--Related section-->
	<section id="related" class="tCenter bgGrey ofsTSmall">
		<!--Container-->
		<div class="container clearfix ">
			<h1 class="title"><?php echo $theme_option['portfolio_title_related']; ?></h1>
			<p class="introShort"><?php echo $theme_option['portfolio_subtitle_related']; ?></p>
		</div>
		<!--End container-->
		<!-- Works list -->
		<div class=" works clearfix ">
			<!--Portfolio-->
			<ul class="portfolio clearfix">
			<?php											 
						// get the custom post type's taxonomy terms
						 
						$custom_taxterms = wp_get_object_terms( $post->ID, 'categories', array('fields' => 'ids') );
						// arguments
						$args = array(
						'post_type' => 'portfolio',
						'post_status' => 'publish',
						'posts_per_page' => 3, // you may edit this number
						'orderby' => 'rand',
						'tax_query' => array(
							array(
								'taxonomy' => 'categories',
								'field' => 'id',
								'terms' => $custom_taxterms
							)
						),
						'post__not_in' => array ($post->ID),
						);
						$related_items = new WP_Query( $args );
						// loop over query
						$i = 0;
						if ($related_items->have_posts()) :											
						while ( $related_items->have_posts() ) : $related_items->the_post(); $i++;
						$cates = get_the_terms(get_the_ID(),'categories');
						$cate_name ='';
						$cate_slug = '';
						foreach((array)$cates as $cate){
							if(count($cates)>0){
								$cate_name .= $cate->name.' ' ;
								$cate_slug .= $cate->slug .' ';     
							} 
						} 
						?>
							<li class="item" data-id="id-<?php echo $i;?>" data-type="<?php echo $cate_slug;?>">
								<div class="itemDesc">
									<div class="itemDescInner">
										<h3><?php the_title();?><span><?php echo $cate_slug;?></span></h3>
										<div class="doubleBtn itemBtn ">
											<a  href="<?php echo wp_get_attachment_url( get_post_thumbnail_id());?>" class="doubleLeft folio"><i class="icon-eye"></i></a>
											<a href="<?php the_permalink(); ?>" class="doubleRight"><i class="icon-link"></i></a>
										</div>
									</div>
								</div>
								<?php $params = array( 'width' => 900, 'height' => 700 );
									  $image = bfi_thumb( wp_get_attachment_url( get_post_thumbnail_id()), $params ); ?>
								<img src="<?php echo $image;?>" alt="">
							</li>
						<?php
						endwhile;											
					endif;
				// Reset Post Data
				wp_reset_postdata();?>						
			</ul>
			<!--End portfolio-->
		</div>
		<!-- End works list -->
		<div class="allWorks btn">
			<a href="<?php echo home_url('/'); ?>#portfolio">View all works</a>
		</div>
	</section>
	<!--End related section-->
<?php get_footer();?>