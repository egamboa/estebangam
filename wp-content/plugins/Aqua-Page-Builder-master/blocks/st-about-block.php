<?php
/* List Block */
if(!class_exists('ST_About_Block')) {
class ST_About_Block extends AQ_Block {

	function __construct() {
		$block_options = array(
		'name' => '<i class="fa fa-user-md"></i> About',
		'size' => 'col-md-12',
	);
	
	//create the widget
	parent::__construct('st_about_block', $block_options);
	
	//add ajax functions
	add_action('wp_ajax_aq_block_check_add_new', array($this, 'add_check_item'));
	add_action('wp_ajax_aq_block_checkbtn_add_new', array($this, 'add_checkbtn_btn'));
	
	}
	
   function form($instance){
        $defaults = array(
            'title' => '', 
			'job' =>'',        
            'image' =>'',  
            'id' => 'about',
            'items' => array(
	            1 => array(
		            'title' => 'New Title',
		            'icon' => 'icon-twitter',
                    'link' => '',						
	            )
            ),
			'subtitle' => '',
			'content' => '',
			'infomation' => '',
			'shortbtns' => array(
	            1 => array(
		            'title' => 'New Title',
		            'icon' => 'icon-print-1',
                    'linkitem' => '',
                    'color' => '#03CC85',                    		
	            )
            ),
			
        );
        $instance = wp_parse_args($instance, $defaults);
        extract($instance);

	?>
	
	<h3 style="text-align: center;">Content Box Left</h3>
    <br />
	
    <div class="description">
        <label for="<?php echo $this->get_field_id('title') ?>">
        Title <br />
        <?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
        </label>
    </div>
    
    <div class="description half">
        <label for="<?php echo $this->get_field_id('id') ?>">
        Id Section do you want <code>Ex: about</code> <br />
        <?php echo aq_field_input('id', $block_id, $id, $size = 'full') ?>
        </label>
    </div>    
    
    <div class="description half last">
		<label for="<?php echo $this->get_field_id('image') ?>">
			Pick a your image<br/>
			<?php echo aq_field_upload('image', $block_id, $image, $media_type = 'image') ?>
		</label>
	</div>
	<div class="description half">
        <label for="<?php echo $this->get_field_id('job') ?>">
        Your Job <br />
        <?php echo aq_field_textarea('job', $block_id, $job, $size = 'full')  ?>		
        </label>
    </div>
    	
	<div class="description half last">
        <label for="<?php echo $this->get_field_id('subtitle') ?>">
        Subtile <br />
        <?php echo aq_field_textarea('subtitle', $block_id, $subtitle, $size = 'full')  ?>		
        </label>
    </div>        
        
	<div class="description">
        <label for="<?php echo $this->get_field_id('content') ?>">
        Content <br />
        <?php echo aq_field_textarea('content', $block_id, $content, $size = 'full')  ?>		
        </label>
    </div>

	<div class="description">
        <label for="<?php echo $this->get_field_id('infomation') ?>">
        Infomation <br />
        <?php echo aq_field_textarea('infomation', $block_id, $infomation, $size = 'full')  ?>		
        </label>
    </div> 
	
	<div class="cf"></div>
	<h3 style="text-align: center;">Button Box Left</h3>
	<div class="description cf">
	    <ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
		    <?php
			    $shortbtns = is_array($shortbtns) ? $shortbtns : $defaults['shortbtns'];
			    $count = 1;
			    foreach($shortbtns as $shortbtn) {	
				    $this->shortbtn($shortbtn, $count);
				    $count++;
			    }
		    ?>
	    </ul>
	    <p></p>
	    	<a href="#" rel="checkbtn" class="aq-sortable-add-new button">Add New Btn</a>
	    <p></p>
    </div>
    <div class="cf"></div>
	<br />
	<hr />
	<h3 style="text-align: center;">Social</h3>
    <br />
	
    <div class="description cf">
	    <ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
		    <?php
			    $items = is_array($items) ? $items : $defaults['items'];
			    $count = 1;
			    foreach($items as $item) {	
				    $this->item($item, $count);
				    $count++;
			    }
		    ?>
	    </ul>
	    <p></p>
	    	<a href="#" rel="check" class="aq-sortable-add-new button">Add New</a>
	    <p></p>
    </div>
    <div class="cf"></div>
<?php
}
function shortbtn($shortbtn = array(), $count = 0) {

?>
	<li id="sortable-shortbtn-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
		<div class="sortable-head cf">
			<div class="sortable-title">
				<strong><?php echo $shortbtn['title'] ?></strong>
			</div>
			<div class="sortable-handle">
				<a href="#">Open / Close</a>
			</div>
		</div>
	<div class="sortable-body">
	<div class="tab-desc description half">
		<label for="<?php echo $this->get_field_id('shortbtns') ?>-<?php echo $count ?>-title">
			Title<br/>
	<input type="text" id="<?php echo $this->get_field_id('shortbtns') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('shortbtns') ?>[<?php echo $count ?>][title]" value="<?php echo $shortbtn['title'] ?>" />
		</label>
	</div>
	
	<div class="tab-desc description half last">
		<label for="<?php echo $this->get_field_id('shortbtns') ?>-<?php echo $count ?>-icon">
			Icon class<code>Ex: icon-picture</code><a target="_blank" href="http://fontello.com/"> view more icon </a><br/>
			<input type="text" id="<?php echo $this->get_field_id('shortbtns') ?>-<?php echo $count ?>-icon" class="input-full" name="<?php echo $this->get_field_name('shortbtns') ?>[<?php echo $count ?>][icon]" value="<?php echo $shortbtn['icon'] ?>" />
		</label>
	</div>

	<div class="tab-desc description half">
		<label for="<?php echo $this->get_field_id('shortbtns') ?>-<?php echo $count ?>-linkitem">
			Link shortBtn<br/>
			<input type="text" id="<?php echo $this->get_field_id('shortbtns') ?>-<?php echo $count ?>-linkitem" class="input-full" name="<?php echo $this->get_field_name('shortbtns') ?>[<?php echo $count ?>][linkitem]" value="<?php echo $shortbtn['linkitem'] ?>" />
		</label>
	</div>
	
	<div class="tab-desc description half last">
		<label for="<?php echo $this->get_field_id('shortbtns') ?>-<?php echo $count ?>-color">
			Pick a Background color<br/>
			<div class="aqpb-color-picker">
				<input type="text" id="<?php echo $this->get_field_id('shortbtns') ?>-<?php echo $count ?>-color" class="input-color-picker" value="<?php echo $shortbtn['color'] ?>" name="<?php echo $this->get_field_name('shortbtns') ?>[<?php echo $count ?>][color]" data-default-color="#343434"/>
			</div>
		</label>
	</div>

	<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
	</div>
	</li>

  <?php  
    }

function item($item = array(), $count = 0) {

?>
	<li id="sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
		<div class="sortable-head cf">
			<div class="sortable-title">
				<strong><?php echo $item['title'] ?></strong>
			</div>
			<div class="sortable-handle">
				<a href="#">Open / Close</a>
			</div>
		</div>
	<div class="sortable-body">
	<div class="tab-desc description">
		<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-title">
			Title<br/>
	<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][title]" value="<?php echo $item['title'] ?>" />
		</label>
	</div>
	
	<div class="description half">
		<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-icon">
			Icon class<code>Ex: icon-lamp</code><br/>
			<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-icon" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][icon]" value="<?php echo $item['icon'] ?>" />
		</label>
	</div>
    
	<div class="description half last">
    	<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-link">
    		Your Link Socials<code>Ex: http://facebook.com</code><br/>
    		<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-link" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][link]" value="<?php echo $item['link'] ?>" />
    	</label>
	</div>

	<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
	</div>
	</li>

  <?php  
    }
	
    function block($instance){
    extract($instance);
	
		 ?>
		 <section id="<?php echo esc_attr($id); ?>" class="about">
		
		<div class="imgAbout" style="background-image: url(<?php echo $image; ?>);"></div>
		
		<!--Light grey-->
		<div class="lightGrey">
			
		<!--Container-->
		<div class="container clearfix">
			
			
<div class="shortBtn "> 
	<?php 
	if (!empty($shortbtns)) {
	   $i=1;
		foreach( $shortbtns as $shortbtn ) {
	?>
	<a href="<?php echo esc_attr($shortbtn['linkitem']) ?>" class="print print<?php echo $i; ?>">
		<span><?php echo esc_attr($shortbtn['title']) ?></span>
		<i class="<?php echo esc_attr($shortbtn['icon']) ?>"></i>	
	</a>
    <style>
    .print<?php echo $i; ?>, .print<?php echo $i; ?> span, .print<?php echo $i; ?> i {
        background-color: <?php echo esc_attr($shortbtn['color']) ?> !important;
    }
    </style>
	<?php  
    $i++;
    }
    }
    ?>   		
</div>
	
		<div class="aboutContent overview row">
			<div class="aboutTitle">
				<h1><?php echo esc_attr($title); ?><span><?php echo esc_attr($job); ?></span></h1>
			</div>
			
			<div class="aboutIntro">
				<h1><?php echo esc_attr($subtitle); ?></h1>
				
				<p><?php echo esc_attr($content); ?></p>
			</div>
		</div>
		
		</div>
		<!--End container-->
		
		</div>
		<!--End light grey-->
		
		
		<!--Dark grey-->
		<div class="darkGrey">
				<!--Container-->
				<div class="container clearfix">

				<!--About content-->
				<div class="aboutContent row">
					<div class="aboutInfo">
						<ul>
						<?php echo htmlspecialchars_decode($infomation); ?>
						</ul>
						
					</div>
					
					<div class="aboutSocial">
						<ul>
                        <?php
    					if (!empty($items)) {
    						foreach( $items as $item ) {
    					?>
								<li><a href="<?php echo esc_attr($item['link']); ?>"><i class="<?php echo esc_attr($item['icon']) ?>"></i></a></li>
						<?php }
                        }?>		
						</ul>
					</div>
				
				</div>
				<!--End about content-->
				</div>
				<!--End container-->
		</div>
		<!--End dark grey-->
		
	</section>
	<!--End about-->
    
		 <?php
		    }
		/* AJAX add testimonial */
		function add_check_item() {
		$nonce = $_POST['security'];	
		if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
		
		$count = isset($_POST['count']) ? absint($_POST['count']) : false;
		$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
		
		//default key/value for the testimonial
		$item = array(
            'title' => 'New Title',
            'icon' => 'icon-twitter',
            'link' => '',
		);
		
		if($count) {
			$this->item($item, $count);
		} else {
			die(-1);
		}
		
		die();
		}
		
		function add_checkbtn_btn() {
		$nonce = $_POST['security'];	
		if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
		
		$count = isset($_POST['count']) ? absint($_POST['count']) : false;
		$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
		
		//default key/value for the testimonial
		$shortbtn = array(
            'title' => 'New Title',
            'icon' => 'icon-print-1',
            'linkitem' => '',
            'color' => '#03CC85', 
		);
		
		if($count) {
			$this->shortbtn($shortbtn, $count);
		} else {
			die(-1);
		}
		
		die();
		}
		
		
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
}
}