<?php
/** A simple text block **/
class ST_Download_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => '<i class="fa fa-download"></i> Download',
			'size' => 'col-md-6',
		);
		
		//create the block
		parent::__construct('st_download_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'link' => ''		
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		?>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title (optional)
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('link') ?>">
				Link Download (optional)
				<?php echo aq_field_input('link', $block_id, $link, $size = 'full') ?>
			</label>
		</p>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
	?>
		
	<div class="getCv">
		<a href="<?php echo esc_url($link); ?>"><i class="icon-down-circled"></i>
		<h3><?php echo strip_tags($title); ?></h3>
		</a>
	</div>
	
	<?php 	
	}
	
}
