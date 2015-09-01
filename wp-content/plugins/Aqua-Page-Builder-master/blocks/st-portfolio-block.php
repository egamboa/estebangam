<?php
/* Work Block */
if(!class_exists('ST_Portfolio_Block')) {
class ST_Portfolio_Block extends AQ_Block {
   
   function __construct() {
	    $block_options = array(
	    'name' => '<i class="fa fa-archive"></i> Portfolio',
	    'size' => 'col-md-12',
    );
    
	    //create the widget
	    parent::__construct('st_portfolio_block', $block_options);
    } 
    
   function form($instance){
        $defaults = array(
			'title' => 'Title Portfolio',
		    'show' => '6',
			'orderby' => 'title',
			'orderpost' => 'ASC',
			'text' => 'All',
            'id' => 'portfolio',
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
        <h3 style="text-align: center;">Portfolio</h3>
		<div class="description">
	        <label for="<?php echo $this->get_field_id('title') ?>">
	        Title<br/><em style="font-size: 0.8em;">(Please enter title portfolio)</em><br/>
	        <?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
	        </label>
	    </div>
		<div class="cf"></div>
		<div class="description fourth">
	        <label for="<?php echo $this->get_field_id('text') ?>">
	        Text All<br/><em style="font-size: 0.8em;">(Ex: All)</em><br/>
	        <?php echo aq_field_input('text', $block_id, $text, $size = 'full') ?>
	        </label>
	    </div>
    	<div class="description fourth">
    		<label for="<?php echo $this->get_field_id('show') ?>">
    			Show portfolio<br/><em style="font-size: 0.8em;">(Chosen number portfolio. Ex: 6)</em><br/>
    			<?php echo aq_field_input('show', $block_id, $show, $size = 'full',$type = 'number') ?>
    		</label>
    	</div>
		<div class="description fourth">
    		<label for="<?php echo $this->get_field_id('orderpost') ?>">
    			Sort Order<br/><em style="font-size: 0.8em;">Sort from lowest to highest (Default)</em><br/>
    			<?php echo aq_field_select('orderpost', $block_id, $orderpost_options, $orderpost, $size = 'full') ?>
    		</label>
    	</div>
		<div class="description fourth last">
    		<label for="<?php echo $this->get_field_id('orderby') ?>">
    			Order by<br/><em style="font-size: 0.8em;">Title (Default)</em><br/>
    			<?php echo aq_field_select('orderby', $block_id, $orderby_options, $orderby, $size = 'full') ?>
    		</label>
    	</div>
        <div class="description half">
            <label for="<?php echo $this->get_field_id('id') ?>">
            Id Section do you want <code>Ex: portfolio</code> <br />
            <?php echo aq_field_input('id', $block_id, $id, $size = 'full') ?>
            </label>
        </div> 		
		<div class="cf"></div>
        <?php
        } 
   function block($instance){
    extract($instance);
    $title1 = (!empty($title) ? ' '.esc_attr($title) : '');    
    $show1 = (!empty($show) ? ' '.esc_attr($show) : '');
    $text1 = (!empty($text) ? ' '.esc_attr($text) : '');
	?>
	
	<!--Portfolio section-->
	<section id="<?php echo $id; ?>" class="offset section bBottom">


				<!--Inner content-->
				<div class="innerContent ">

				<!--Container-->
				<div class="container clearfix">
					

					<div class="sixteen columns">
					<h1 class="titleBig"><?php echo $title1;?></h1>
					</div>
					
					
					<!-- Filter nav -->
					<div class="filterNav">
						<ul id="category" class="filter">
							<li class="all current"><a href="#"><?php echo $text1?></a></li>
                            <?php 
            				     $categories = get_terms('categories');   
                				 foreach( (array)$categories as $categorie){
                					$cat_name = $categorie->name;
                					$cat_slug = $categorie->slug;
            				?>
							<li class="<?php echo $cat_slug?>"><a href="#"> <?php echo $cat_name?></a></li>
							<?php } ?>
						</ul>
						</div>
					<!-- End filter nav -->
					
						<!-- Works list -->
						<div id="works" class="clearfix ">
							<!--Portfolio-->
							<ul class="portfolio clearfix">
						<?php 
							$args = array(   
								'post_type' => 'portfolio',   
								'posts_per_page' => $show1,
								'order' => $orderpost,
								'orderby' => $orderby, 
							);  
							$wp_query = new WP_Query($args);
							$i = 1;
							while ($wp_query -> have_posts()) : $wp_query -> the_post(); 
							$cates = get_the_terms(get_the_ID(),'categories');
							$cate_name ='';
							$cate_slug = '';
								  foreach((array)$cates as $cate){
									if(count($cates)>0){
										$cate_name .= $cate->name.' ' ;
										$cate_slug .= $cate->slug .' ';     
									} 
							}
                            $params=array('width' => 320,'height' => 343);
                            $image=bfi_thumb(wp_get_attachment_url(get_post_thumbnail_id()),$params); 
						?>			

					<li class="one-third column  item " data-id="id-<?php echo $i; ?>" data-type="<?php echo $cate_slug;?>"><div >
						<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id());?>" class="folio">
							<div class="desc">
							<h3 class="projDesc"><?php the_title();?> <span>&#8213; <?php echo $cate_name;?> &#8213;</span></h3>

							</div>
							<img src="<?php echo $image;?>" alt="">
						</a>
					</div></li>										
                        <?php $i++;
						endwhile;?>
					</ul>
					<!--End portfolio-->
					</div>
						<!-- End works list -->

					</div>
					<!--End container-->


				</div>
				<!--End inner content-->

</section>
<!--End portfolio section-->
    <?
    }
    function update($new_instance, $old_instance) {
	    $new_instance = aq_recursive_sanitize($new_instance);
	    return $new_instance;
	}      
}
}