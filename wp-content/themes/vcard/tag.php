<?php
/**
 * The template for displaying Tag pages
 */
 global $theme_option;
 $textdoimain = 'vcard';
get_header(); ?>

						<!--BLog full section-->
						<section id="blogFull" class="blogFull singleOffset ofsBottom ">
							<!--Container-->
							<div class="container clearfix section" >
									<div class="sixteen columns">
									<h1 class="titleBig"><?php printf( __( 'Tag Archives: %s', $textdoimain ), single_tag_title( '', false ) ); ?></h1>
									</div>

							</div>
							<!--End container-->
								<!--Container-->
								<div class="container clearfix">
									
								<div class="eleven columns">
								  <?php 
            				
            					$j=0;
                                    while (have_posts()): the_post(); 
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
							<?php }else{ ?>
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
						
								<!--End post image-->

								<?php if($format == 'quote' ){ ?>
									<div class="quote-post">
										<?php echo the_content(); ?>
									</div>
								<?php }elseif($format == 'link'){ ?>	
									<div class="post-link">
										<?php echo the_content(); ?>
									</div>	
								<?php }else{ ?>
								<p><?php echo vcard_excerpt(); ?></p>
								<?php } ?>
								<div class="more">	
								<a class="btn" href="<?php the_permalink();?>"><?php global $theme_option; echo $theme_option['read_more']; ?></a>
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

