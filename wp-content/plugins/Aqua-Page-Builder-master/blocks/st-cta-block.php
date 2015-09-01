<?php
/** Slogan block **/
class ST_CTA_Block extends AQ_Block {

	//set and create block
	function __construct() {
		$block_options = array(
		'name' => '<i class="fa fa-pagelines"></i> Call To Action',
		'size' => 'col-md-12',
	);

		//create the block
		parent::__construct('st_cta_block', $block_options);
	}

	function form($instance) {
	
		$defaults = array(
			'title' => '',
			'headline' => ''				
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
	?>
		<div class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title (optional)
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</div>
		
		<div class="description">
			<label for="<?php echo $this->get_field_id('headline') ?>">
				Decription (optional)
				<?php echo aq_field_textarea('headline', $block_id, $headline, $size = 'full') ?>
			</label>
		</div>
	<?php
	
	}
	
	function block($instance) {
	extract($instance);
	
	?>
	
	<div class="intro">
		<h1 class="titleBig"><?php echo htmlspecialchars_decode($title);?></h1>
		<?php echo wpautop(do_shortcode(htmlspecialchars_decode($headline)));?>
	</div>
	<?php	
	}

}