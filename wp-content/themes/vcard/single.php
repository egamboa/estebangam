<?php
/**
 * The Template for displaying all single posts
 */
$textdoimain = 'vcard';
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
					while ( have_posts() ) : the_post();?>
								<div class="postTitle">
								<h1><?php the_title();?></h1>
								
									<!--Post meta-->
									<div class="postMeta">
									<span class="metaAuthor"><?php the_time('j F Y'); ?> by <a href="#"><?php the_author_posts_link(); ?></a></span>
									<span class="metaCategory">in <?php the_category(', '); ?></span>
									</div>
									<!--End post meta-->
								
								</div>
								
									<!--Post image-->
								
					<?php $format = get_post_format();?>
						<?php if($format == 'gallery'){?>
							<!--Post media-->
							<?php $gallery = get_post_gallery( get_the_ID(), false );
								if(isset($gallery['ids'])){ ?>
							<div class="postMedia postSliderLarge flexslider">
									<ul class="slides">
									<?php
											$gallery_ids = $gallery['ids'];
											$img_ids = explode(",",$gallery_ids);
											foreach( $img_ids AS $img_id ){
											$image_src = wp_get_attachment_image_src($img_id,'');
										?>
										<li>
											<?php $params = array( 'width' => 640, 'height' => 385 );
											  $image = bfi_thumb( $image_src[0], $params ); ?>
											<img width="640" height="385" src="<?php echo $image; ?>" alt="<?php the_title(); ?>" >											
										</li>
									
									<?php }?>
								</ul>
							</div>
						<?php }?>
							<!--End post media-->
						<?php }elseif($format == 'video'){?>
							<!--Post media-->
						<!--Post media-->
						<?php $link_video = get_post_meta(get_the_ID(),'_cmb_link_video', true);?>
						<?php if($link_video !=''){?>
                            <div class="postMedia">
									<iframe height="400" src="<?php echo get_post_meta(get_the_ID(),'_cmb_link_video', true);?>" allowfullscreen></iframe>
			                 </div>
							<?php }?>
							<!--End post media-->	
						<?php }elseif($format == 'image'){ ?>
							<!--Post media-->
							<div class="postMedia">
								<?php $params = array( 'width' => 640, 'height' => 385 );
								  $image = bfi_thumb( wp_get_attachment_url(get_post_thumbnail_id()), $params ); ?>
								<img width="640" height="385" src="<?php echo $image; ?>" alt="<?php the_title(); ?>" >																				
							</div>	
							<!--End post media-->
						<?php }else{}?>
						
								<!--End post image-->

								<?php the_content(); ?>	
                                <?php wp_link_pages(); ?>		
									<div class="tagsSingle clearfix">
										<h4><i class="icon-tag-1"></i>Tags :</h4>
										<?php
								if(get_the_tag_list()) {
									echo get_the_tag_list('<ul class="tagsListSingle"><li>','</li><li>','</li></ul>');
								}
							?>
									</div>

								
							<?php endwhile; ?>		
							</div>
							<!--End post content-->	

							</div>
							<!--End post single-->	
							
							<?php comments_template();?>
						</div>
								
								
								
								<div class="five columns sidebar">
									<?php get_sidebar();?>
								</div>
								
									
								</div>
								<!--End container-->

						</section>
						<!--End blog single section-->
					
<?php
get_footer();
?>						
