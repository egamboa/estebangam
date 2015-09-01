<?php
/**
 * Template Name: Blog
 */
 global $theme_option;
 $textdoimain = 'vcard';
get_header(); ?>

<!--BLog full section-->
<section id="blogFull" class="blogFull singleOffset ofsBottom ">
	<!--Container-->
	<div class="container clearfix section" >
		<div class="sixteen columns"><h1 class="titleBig"><?php echo $theme_option['blog_title']; ?></h1></div>
	</div>
	<!--End container-->
	<!--Container-->
	<div class="container clearfix">
									
		<div class="eleven columns">
			 <?php 
				$j=0;
					$args = array(    
						'paged' => $paged,
						'post_type' => 'post',
						);
					$wp_query = new WP_Query($args);
					while ($wp_query -> have_posts()): $wp_query -> the_post(); 
				  $j++; ?> 						
							<!--Post large-->
							<div class="postLarge">
							<!--Post content-->
							<div class="postContent">
								<div class="postTitle">
									<h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>								
									<!--Post meta-->
									<div class="postMeta">
									<span class="metaAuthor"><?php the_time('j F Y');?> by <?php the_author_posts_link(); ?></span>
									<span class="metaCategory">in <?php 
										// Show all category for post
										$i = 1; foreach((get_the_category()) as $category) { 
										if ($i == 1){echo ''; }else {echo ' , ';}
										    echo '<a href="'.get_category_link($category->cat_ID).'">'.$category->category_nicename . ' '.'</a>'; 
										    
										    $i++;
										} ?></span>
									</div>
									<!--End post meta-->
								</div>
								
								<!--Post image-->
                                <?php $format = get_post_format($post->ID); ?>
                                <?php if($format=='image'){?>
									<?php if ( has_post_thumbnail() ) { ?>
                                    <div class="postMedia">
										<a href="<?php the_permalink();?>">
                                        <?php $params = array( 'width' => 640, 'height' => 385 );
										$image = bfi_thumb( wp_get_attachment_url(get_post_thumbnail_id()), $params ); ?>
											<img alt="<?php the_title(); ?>" src="<?php echo $image;?>" height="385" width="640" />
										</a>
									</div>
                                    <?php }?>
                                <?php }elseif($format=='gallery'){?>
                                <div class="postMedia postSliderLarge flexslider">
									<ul class="slides">
									<?php $gallery = get_post_gallery( get_the_ID(), false );
									      $gallery_ids = $gallery['ids'];
									      $img_ids = explode(",",$gallery_ids);
										  $i=0;
										if(isset($gallery['ids'])){  	
									        foreach( $img_ids AS $img_id ){
									        $image_src = wp_get_attachment_image_src($img_id,''); 
											$i++;		
									        ?>
												
												<?php $params = array( 'width' => 640, 'height' => 385 );
													$image = bfi_thumb( $image_src[0], $params ); ?>
												<li><a><img alt="<?php the_title(); ?>" src="<?php echo $image; ?>" height="385" width="640"/></a></li>													
												  
											<?php 
								            }
										}
									      ?>
									</ul>
								</div>
                                <?php }elseif($format=='video'){?>
                                <?php $link_video = get_post_meta(get_the_ID(),'_cmb_link_video', true);?>
                                <?php if($link_video !=''){?>
                                <div class="postMedia">
									<iframe height="400" src="<?php echo get_post_meta(get_the_ID(),'_cmb_link_video', true);?>" allowfullscreen></iframe>
								</div>
                                <?php }?>
                                <?php }elseif($format == 'audio'){?>
                                <div class="postMedia">
                                    <div class="video-wrapper">
    								<iframe width="100%" height="166" scrolling="no" frameborder="no" src="<?php echo get_post_meta(get_the_ID(), "_cmb_link_audio", true);?>&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=true"></iframe>
    			                     </div>
                                </div>
                                <?php }else{?>
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="postMedia">
											<a href="<?php the_permalink();?>">
											<?php $params = array( 'width' => 640, 'height' => 385 );
											$image = bfi_thumb( wp_get_attachment_url(get_post_thumbnail_id()), $params ); ?>
											<img alt="<?php the_title(); ?>" src="<?php echo $image;?>" height="385" width="640" />
											</a>
										</div>
									<?php }?>
                                <?php }?>
								<?php if($format == 'link' || $format == 'quote' ){ ?>
								<?php echo the_content(); ?>
								<?php }else{ ?>	
								<p><?php echo vcard_excerpt(); ?></p>
								<?php } ?>
								<div class="more">	
								<a class="btn" href="<?php the_permalink(); ?>"><?php global $theme_option; echo $theme_option['read_more']; ?></a>
								</div>
							</div>
							<!--End post content-->	
							</div>
							<!--End post large-->	
						<?php endwhile;?> 	
						<!--Pagination-->	
						<div class="pagination">
							<?php vcard_pagination();?>
						</div>
						<!--End pagination-->	
						</div>
				
		<div class="five columns sidebar">
			<?php get_sidebar();?>
		</div>													
	</div>
	<!--End container-->
</section>
<!--End blog full section-->
					
<?php
get_footer();
