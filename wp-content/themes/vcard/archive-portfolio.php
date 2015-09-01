<?php 
/*
 *  The template for displaying Archive pages
 */
$textdoimain = 'theway';
get_header();?>
<!--Portfolio section-->
<section id="portfolio" class="tCenter ofsTop ofsBottom">
	<!--Container-->
	<div class="container clearfix">
		<h1 class="title tCenter">
			<?php
				if ( is_day() ) :
					printf( __( 'Daily Archives Portfolio: %s', '$textdoimain' ), get_the_date() );

				elseif ( is_month() ) :
					printf( __( 'Monthly Archives Portfolio: %s', '$textdoimain' ), get_the_date( _x( 'F Y', 'monthly archives date format', '$textdoimain' ) ) );

				elseif ( is_year() ) :
					printf( __( 'Yearly Archives Portfolio: %s', '$textdoimain' ), get_the_date( _x( 'Y', 'yearly archives date format', '$textdoimain' ) ) );

				else :
					_e( 'Archives Portfolio', '$textdoimain' );

				endif;
			?>
		</h1>
		<!--Filter nav-->
		<div class="filterNav">
			<ul class="filter" id="category">
				<li class="all current"><a href="#">All</a></li>
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
		<!--End filter nav-->
	</div>
	<!--End container-->
		
	<!-- Works list -->
	<div class=" works clearfix ">
		<!--Portfolio-->
		<ul class="portfolio clearfix">
			<?php 
				$args = array(   
						'post_type' => 'portfolio',   
						'paged' => $paged,
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
			?>		
			<li class="item" data-id="id-<?php echo $i;?>" data-type="<?php echo $cate_slug;?>">
				<div class="itemDesc">
					<div class="itemDescInner">
					<h3><?php the_title();?><span><?php echo $cate_name;?></span></h3>
					<div class="doubleBtn itemBtn ">
						<a  href="<?php echo wp_get_attachment_url( get_post_thumbnail_id());?>" class="doubleLeft folio"><i class="icon-eye"></i></a>
						<a href="<?php the_permalink(); ?>" class="doubleRight"><i class="icon-link"></i></a>
					</div>
					</div>
				</div>
				<?php $params = array( 'width' => 900, 'height' => 700 );
				  $image = bfi_thumb( wp_get_attachment_url(get_post_thumbnail_id()), $params ); ?>
				<img width="900" height="700" src="<?php echo $image; ?>" alt="<?php the_title(); ?>" >
			</li>
			<?php $i++;
				endwhile;?>
		</ul>
		<!--End portfolio-->
	</div>
	<!-- End works list -->
</section>
<!--End portfolio section-->
<?php get_footer();?>