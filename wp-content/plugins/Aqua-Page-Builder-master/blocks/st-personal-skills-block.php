<?php
/* List Block */
if(!class_exists('ST_Personal_Block')) {
class ST_Personal_Block extends AQ_Block {

	function __construct() {
		$block_options = array(
		'name' => '<i class="fa fa-trophy"></i> Personal Skills',
		'size' => 'col-md-6',
	);
	
	//create the widget
	parent::__construct('st_personal_block', $block_options);
	
	//add ajax functions
	add_action('wp_ajax_aq_block_personal_add_new', array($this, 'add_personal_item'));
	
	}
	
   function form($instance){
        $defaults = array(
            'title' => 'New Skills', 
			'des' => '',	
            'items' => array(
	            1 => array(
		            'title' => 'New Skill',		            
	            )
            ),
        );
        $instance = wp_parse_args($instance, $defaults);
        extract($instance);
	?>
    <div class="description">
        <label for="<?php echo $this->get_field_id('title') ?>">
        Title (Option) <em style="font-size: 0.8em;">(Please enter title)</em><br/>
        <?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
        </label>
    </div>
	<div class="description">
        <label for="<?php echo $this->get_field_id('des') ?>">
        Description (Option) <br />
        <?php echo aq_field_textarea('des', $block_id, $des, $size = 'full')  ?>		
        </label>
    </div>
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
	    	<a href="#" rel="personal" class="aq-sortable-add-new button">Add New</a>
	    <p></p>
    </div>
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
				Personal Skill <em style="font-size: 0.8em;">(Please enter Name Skill)</em><br/>
				<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][title]" value="<?php echo $item['title'] ?>" />
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
	
	<!--Widget-->
	<div class="widget">
		<h2 class="titleSmall"><?php echo htmlspecialchars_decode($title);?></h2>
		<p><?php echo htmlspecialchars_decode($des);?></p>
		<ul class="pList">
		<?php if(!empty($items)){
                foreach($items as $item){ 					
			?>			
			<li><i class="icon-ok"></i><?php echo $item['title']; ?></li>
			<?php 
                    }
                } 
			?>
		</ul>
	</div>
	<!--End widget-->
	
    <?php 
	}
		/* AJAX add testimonial */
		function add_personal_item() {
		$nonce = $_POST['security'];	
		if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
		
		$count = isset($_POST['count']) ? absint($_POST['count']) : false;
		$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
		
		//default key/value for the testimonial
		$item = array(
			'title' => 'New Skill',		    
		);
		
		if($count) {
			$this->item($item, $count);
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