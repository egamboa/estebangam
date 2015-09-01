<?php
/* Post Block */
if(!class_exists('ST_Post_Block')) {
class ST_Post_Block extends AQ_Block {

	function __construct() {
		$block_options = array(
		'name' => '<i class="fa fa-th"></i> Show post',
		'size' => 'col-md-12',
	);
	
	//create the widget
	parent::__construct('st_post_block', $block_options);


}
   function form($instance){
        $defaults = array(
			'title' => '',
            'show' =>'3',
			'linkblog' => '',
			'textlink' => 'View All Posts',
			'orderby' => 'title',
			'orderpost' => 'ASC',
            'id' =>'blog',
  
        );
        $instance = wp_parse_args($instance, $defaults);
        extract($instance); 
		
		$orderpost_options = array (
			'ASC' => 'ASC : lowest to highest',
			'DESC' => 'DESC : highest to lowest',	
		);
		
		$orderby_options = array (
			'title' => 'Title',
			'date' => 'Date',
			'rand' => 'Random'
		);
		?>
         <h3 style="text-align: center;">Show Post</h3>
		<div class="description half">
	        <label for="<?php echo $this->get_field_id('title') ?>">
		        Title<br/><em style="font-size: 0.8em;">Please enter title</em><br/>
		        <?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
	        </label>
	    </div>
        <div class="description half last">
	        <label for="<?php echo $this->get_field_id('id') ?>">
		        ID section do you want<br/><em style="font-size: 0.8em;">Ex: blog</em><br/>
		        <?php echo aq_field_input('id', $block_id, $id, $size = 'full') ?>
	        </label>
	    </div>
		<div class="cf"></div>		
    	<div class="description third">
		<label for="<?php echo $this->get_field_id('show') ?>">
			Show post<br/><em style="font-size: 0.8em;">(Number: 3)</em><br/>
			<?php echo aq_field_input('show', $block_id, $show, $size = 'full',$type = 'number') ?>
		</label>
    	</div>
		<div class="description third">
    		<label for="<?php echo $this->get_field_id('orderpost') ?>">
    			Sort Order<br/><em style="font-size: 0.8em;">Sort from lowest to highest (Default)</em><br/>
    			<?php echo aq_field_select('orderpost', $block_id, $orderpost_options, $orderpost, $size = 'full') ?>
    		</label>
    	</div>
		<div class="description third last">
    		<label for="<?php echo $this->get_field_id('orderby') ?>">
    			Order by<br/><em style="font-size: 0.8em;">Title (Default)</em><br/>
    			<?php echo aq_field_select('orderby', $block_id, $orderby_options, $orderby, $size = 'full') ?>
    		</label>
    	</div>
		<div class="cf"></div>
		<div class="description half">
    		<label for="<?php echo $this->get_field_id('linkblog') ?>">
    			Link to Blog page<br/>
    			<?php echo aq_field_input('linkblog', $block_id, $linkblog, $size = 'full') ?>
    		</label>
    	</div>
		<div class="description half last">
    		<label for="<?php echo $this->get_field_id('textlink') ?>">
    			Text Button <em style="font-size: 0.8em;">View All Posts (Default)</em><br/>
    			<?php echo aq_field_input('textlink', $block_id, $textlink, $size = 'full') ?>
    		</label>
    	</div>
		
  <?php
    }
    function block($instance){
    extract($instance);
    $title = (!empty($title) ? ' '.esc_attr($title) : '');
	$linkblog = (!empty($linkblog) ? ' '.esc_attr($linkblog) : '');  
	$textlink = (!empty($textlink) ? ' '.esc_attr($textlink) : '');  
    $textdoimain = 'vcard';
    global $theme_option;
    ?>
	<!--Blog section-->
 <section id="<?php echo $id;?>" class=" offset section bBottom">
    <!--Inner content-->
    <div class="innerContent ">
    
    	<!--Container-->
    	<div class="container clearfix">
    
    		<div class="sixteen columns">
    		<h1 class="titleBig"><?php echo htmlspecialchars_decode($title); ?></h1>
    		</div>
		</div>
		<!--End container-->
    	<!--Container-->
    	<div class="container clearfix">
    
    
    		<!--Blog latest-->
    		<div class="blogLatest tCenter clearfix">
                <?php
				$args=array(
					'post_type' => 'post',
					'posts_per_page'    => $show,
					'order' => $orderpost,
					'orderby' => $orderby, 
				);
				$wp_query=new WP_Query($args);
				while ($wp_query->have_posts()): $wp_query->the_post(); ?> 
    			<!--Blog post-->
    			<div class="sixteen columns post">
    
    
    				<!--Post media-->
    				<?php $format = get_post_format();?>
						<?php if($format == 'gallery'){?>
							<!--Post media-->
							<?php $gallery = get_post_gallery( get_the_ID(), false );
								if(isset($gallery['ids'])){ ?>
							<div class="postMedia postSlider flexslider">
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
										<div class="postCount short">
                        					<h3><i class="icon-chat"></i><?php comments_popup_link(__(' 0 comment', $textdoimain), __(' 1 comment', $textdoimain), ' % comments'.__('', $textdoimain)); ?></h3>
                    				    </div>
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
			                     <div class="postCount short">
                					<h3><i class="icon-chat"></i><?php comments_popup_link(__(' 0 comment', $textdoimain), __(' 1 comment', $textdoimain), ' % comments'.__('', $textdoimain)); ?></h3>
            				    </div>
                             </div>
							<?php }?>
							<!--End post media-->	
						<?php }elseif($format == 'image'){ ?>
							<!--Post media-->
							<div class="postMedia imgPost">
								<?php $params = array( 'width' => 640, 'height' => 385 );
								  $image = bfi_thumb( wp_get_attachment_url(get_post_thumbnail_id()), $params ); ?>
								<img width="640" height="385" src="<?php echo $image; ?>" alt="<?php the_title(); ?>" >																				
							     <div class="postCount short">
                					<h3><i class="icon-chat"></i><?php comments_popup_link(__(' 0 comment', $textdoimain), __(' 1 comment', $textdoimain), ' % comments'.__('', $textdoimain)); ?></h3>
            				    </div>
                            </div>	
							<!--End post media-->
						<?php }else{ ?>
                        <div class="postMedia imgPost">
						  <div class="postCount short">
    					       <h3><i class="icon-chat"></i><?php comments_popup_link(__(' 0 comment', $textdoimain), __(' 1 comment', $textdoimain), ' % comments'.__('', $textdoimain)); ?></h3>
                            </div>
                        </div>
						<?php }?>
    				<!--End post media-->
    
    				<!--Post details-->
    					
    					<!--Post details-->
    						<div class="postDetails ">
    						<h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
    
    						<!--Post meta-->
    						<div class="postMeta">
    						<span class="metaAuthor"><?php the_time('j F Y');?> by <?php the_author_posts_link(); ?></span>
    						<span class="metaCategory">in <?php the_category(', '); ?></span>
    						</div>
    						<!--End post meta-->
    
    						<p><?php echo vcard_excerpt($theme_option['blog_excerpt']); ?></p>
    
    
    						<div class="btn more">	
    						<a href="<?php the_permalink();?>"><?php global $theme_option; echo $theme_option['read_more']; ?></a>
    						</div>
    
    						</div>
    
    						<!--End post details-->
    
    				</div>
    				<!--End blog post-->
    
                <?php 
				endwhile;?>
    		</div>
    		<!--End blog latest-->
    			<!--All blog posts-->
    				<div class="allPosts top bottom  tCenter">
    				<a href="<?php echo $linkblog; ?>">
    				<?php echo $textlink; ?>
    				</a>
    				</div>
    			<!--End all blog posts-->
    
     
    	</div>
    	<!--End container-->
	</div>
	<!--End inner content-->

</section>

		<!--End blog section-->
  
    <?php
    }
    function update($new_instance, $old_instance) {
	    $new_instance = aq_recursive_sanitize($new_instance);
	    return $new_instance;
	}
}
}
 ?>