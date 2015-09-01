<?php
/** Contact Form Block **/

class ST_Contact_Block extends AQ_Block {

    //set and create block
    function __construct() {
        $block_options = array(
            'name' => '<i class="fa fa-envelope"></i> Contact Form',
            'size' => 'col-md-12',
        );

        //create the block
        parent::__construct('st_contact_block', $block_options);
    }

    function form($instance) { 
    	
		$args = array (
			'nopaging' => true,
			'post_type' => 'wpcf7_contact_form',
			'status' => 'publish',
		);
		$contacts = get_posts($args);
		
    	$contact_options = array(); $default_contact = '';
		foreach ($contacts as $contact) {
			$default_contact = empty($default_contact) ? $contact->ID : $default_contact;
			$contact_options[$contact->ID] = htmlspecialchars($contact->post_title);
		}
				
        $defaults = array(
        	'contact' => $default_contact,
			'title' => '',
			'subtitle' => '',
            'id' => 'contact'
        ); 
        $instance = wp_parse_args($instance, $defaults);
        extract( $instance);

        ?>
         <h3 style="text-align: center;">Contact</h3>
		<div class="description half">
			<label for="<?php echo $block_id ?>_title">
				Title (optional)<br/><em style="font-size: 0.8em;">Please enter title contact</em><br/>
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
		<div class="description">
			<label for="<?php echo $block_id ?>_subtitle">
				Subtitle (optional)<br/>
				<?php echo aq_field_textarea('subtitle', $block_id, $subtitle, $size = 'full') ?>
			</label>
		</div>
		<div class="description">
			<label for="">
				Choose contact form<br/>
				<?php echo aq_field_select('contact', $block_id, $contact_options, $contact); ?>
			</label>
		</div>
		<div class="cf"></div>
		
	<?php
    }

    function block($instance) {
        extract($instance);
        $title = (!empty($title) ? ' '.esc_attr($title) : '');
        $subtitle = (!empty($subtitle) ? ' '.esc_attr($subtitle) : '');
    ?>
<section id="<?php echo $id;?>" class="offset section">
		<!--Inner content-->
		<div class="innerContent">

		<!--Container-->
		<div class="container clearfix">

			<div class="sixteen columns">
			<h1 class="titleBig"><?php echo $title;?></h1>
			</div>

		

				<div class="sixteen columns contactForm">
					<p><?php echo htmlspecialchars_decode($subtitle); ?></p>

					<div class="cForm">
					<?php 
						//echo do_shortcode(htmlspecialchars_decode($title));	
						echo do_shortcode('[contact-form-7 id="'.$contact.'" title="contact form 2"]');
					?>
				</div>	
				</div>
				</div>
				<!--End container-->

 
			</div>
			<!--End inner content-->

			</section>

				<!--End contact section-->				
    <?php  
    }
}