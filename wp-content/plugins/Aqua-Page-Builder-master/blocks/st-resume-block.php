<?php 
class ST_Resume_Block extends AQ_Block{
    function __construct(){
        $block_option=array(
            'name' => '<i class="fa fa-mortar-board"></i> Resume',
            'size' => 'col-md-12',
        );
        parent::__construct('st_resume_block', $block_option);
        add_action('wp_ajax_aq_block_resume_add_new', array($this, 'add_resume_item'));
    }
    function form($instance){
        $defaults =array(
        'title' => '', 
		'class' => 'employment',
        'items'=> array(
            1=>array(
	            'title' => 'New Title',               	            
	            'icon'  => 'icon-suitcase',
				'year'=>'',
				'content' => '',
				'company' => ''
            )
        ),
        );        
        $instance=wp_parse_args($instance,$defaults);
        extract($instance);
    ?>    
  	<div class="description">
		<label for="<?php echo $this->get_field_id('title') ?>">
			Title <br/><em style="font-size: 0.8em;">(Please enter title Resume)</em><br/>
			<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
		</label>
	</div>
    <div class="cf"></div>
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
	    	<a href="#" rel="resume" class="aq-sortable-add-new button">Add New</a>
	    <p></p>
    </div>
	<div class="cf"></div>
	<div class="description">
		<label for="<?php echo $this->get_field_id('class') ?>">
			Class (Option) <code>Ex: employment or education</code><br/>
			<?php echo aq_field_input('class', $block_id, $class, $size = 'full') ?>
		</label>
	</div>
    <?php }
    
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
		    <div class="tab-desc description half">
			    <label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-title">
				    Tertiary education or Professional work (Option)<br/>
				    <input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][title]" value="<?php echo $item['title'] ?>" />
			    </label>
		    </div>
			<div class="tab-desc description half">
			    <label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-company">
				    Place of study or work (Option)<br/>
				    <input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-company" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][company]" value="<?php echo $item['company'] ?>" />
			    </label>
		    </div>
            <div class="tab-desc description half last">
		        <label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-icon">
		            Icon class name <code>Ex: icon-suitcase</code><a target="_blank" href="http://fontello.com/"> view more icon </a><br/>
		            <input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-icon" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][icon]" value="<?php echo $item['icon'] ?>" />
		        </label>
		    </div>
             <div class="cf"></div>
             <div class="tab-desc description">
			    <label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-year">
		            Year (Option) <code>Ex: 2013 - 2014</code><br/>
		            <input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-year" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][year]" value="<?php echo $item['year'] ?>" />
		        </label>
		    </div>
		    <div class="tab-desc description">
			    <label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content">
				    Content<br/>
				    <textarea id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][content]" rows="5"><?php echo $item['content'] ?></textarea>
			    </label>
		    </div>
		    
	    <p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
	    </div>
    </li>
    <?php
    }
    
    function block($instance){
        extract($instance);
    $title = (!empty($title) ? ' '.esc_attr($title) : ''); 
    $column = (!empty($column) ? ' '.esc_attr($column) : '');
    ?>
	
	<!--Employment and education-->
	<div class="<?php echo $class;?>">
		
		<h2 class="titleSmall"><?php echo htmlspecialchars_decode($title);?></h2>
		<?php 
            if(!empty($items)){
                foreach($items as $item){ ?>
		<!--Em-->
		<div class="em clearfix">
			<div class="dtIco">
				<span class="ico"><i class="<?php echo htmlspecialchars_decode($item['icon']);?>"></i></span>
				<span class="date"><?php echo htmlspecialchars_decode($item['year']);?></span>
			</div>
			
			<div class="det">
				<h3><?php echo htmlspecialchars_decode($item['title'])?> <span>– <?php echo htmlspecialchars_decode($item['company'])?></span></h3>
				<p><?php echo htmlspecialchars_decode($item['content'])?></p>
			</div>
		</div>
		<!--End em-->
		<?php
              }
         }
	?>
	</div>
	
	<?php
	}
    function add_resume_item() {
    $nonce = $_POST['security'];	
    if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
    
    $count = isset($_POST['count']) ? absint($_POST['count']) : false;
    $this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
    
    //default key/value for the testimonial
    $item = array(
	    'title' => 'New Title',               	            
		'icon'  => 'icon-suitcase',
		'year'=>'',
		'content' => '',
		'company' => ''
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
