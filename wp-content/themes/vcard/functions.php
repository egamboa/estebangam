<?php
global $theme_option;
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/sample/sample-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/sample/sample-config.php' );
}
//Custom fields:
require_once dirname( __FILE__ ) . '/framework/bfi_thumb-master/BFI_Thumb.php';
require_once dirname( __FILE__ ) . '/framework/Custom-Metaboxes/metabox-functions.php';
require_once dirname( __FILE__ ) . '/framework/post_type.php';
require_once dirname( __FILE__ ) . '/framework/wp_bootstrap_navwalker.php';
//Define Text Doimain
$textdomain = 'vcard';
$lang = get_template_directory_uri() . '/languages';
load_theme_textdomain($textdomain, $lang);
//Theme Set up:
function vcard_theme_setup() {
    /*
     * This theme uses a custom image size for featured images, displayed on
     * "standard" posts and pages.
     */
	add_theme_support( 'custom-header' ); 
	add_theme_support( 'custom-background' );
	
    add_theme_support( 'post-thumbnails' );
    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );
    // Switches default core markup for search form, comment form, and comments
    // to output valid HTML5.
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
    //Post formats
    add_theme_support( 'post-formats', array(
        'aside', 'image',  'vide', 'audio', 'quote', 'link', 'gallery'
    ) );
    // This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => 'Home Navigation Menu',
		'secondary' => 'Other Page  Navigation Menu',
	) );
    // This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
    add_shortcode('gallery', '__return_false');
}
add_action( 'after_setup_theme', 'vcard_theme_setup' );
if ( ! isset( $content_width ) ) $content_width = 900;

function vcard_theme_scripts_styles() {
	global $theme_option;
	$protocol = is_ssl() ? 'https' : 'http';
   
	wp_enqueue_style( 'font', get_template_directory_uri().'/css/font.css');
	wp_enqueue_style( 'fontello', get_template_directory_uri().'/css/fontello.css');
	wp_enqueue_style( 'base', get_template_directory_uri().'/css/base.css');
	wp_enqueue_style( 'skeleton', get_template_directory_uri().'/css/skeleton.css');
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '2014-05-15' );
	wp_enqueue_style( 'magnific', get_template_directory_uri().'/css/magnific-popup.css');
	wp_enqueue_style( 'flexslider', get_template_directory_uri().'/css/flexslider.css');
	
	wp_enqueue_style( 'color', get_template_directory_uri().'/framework/color.php');
	if($theme_option['rtl']==1){wp_enqueue_style( 'rtl', get_template_directory_uri().'/rtl.css');	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );
	wp_enqueue_script("jquery");
	//Javascript
	wp_enqueue_script("migrate", get_template_directory_uri()."/js/jquery-migrate-1.2.1.js",array(),false,true);
	wp_enqueue_script("flexslider", get_template_directory_uri()."/js/jquery.flexslider-min.js",array(),false,true);
	wp_enqueue_script("easing", get_template_directory_uri()."/js/jquery.easing.1.3.js",array(),false,true);
	wp_enqueue_script("smooth", get_template_directory_uri()."/js/jquery.scrollTo-min.js",array(),false,true);
	wp_enqueue_script("waypoints", get_template_directory_uri()."/js/waypoints.js",array(),false,true);
	wp_enqueue_script("quicksand", get_template_directory_uri()."/js/jquery.quicksand.js",array(),false,true);
	wp_enqueue_script("custom", get_template_directory_uri()."/js/modernizr.custom.js",array(),false,true);
	wp_enqueue_script("magnific", get_template_directory_uri()."/js/jquery.magnific-popup.js",array(),false,true);
    
    wp_enqueue_script("script", get_template_directory_uri()."/js/script.js",array(),false,true);
	
}
add_action( 'wp_enqueue_scripts', 'vcard_theme_scripts_styles' );

if(!function_exists('vcard_custom_frontend_style')){
	function vcard_custom_frontend_style(){
	global $theme_option;
	echo '<style type="text/css">'.$theme_option['custom-css'].'</style>';
}
}
add_action('wp_head', 'vcard_custom_frontend_style');

if(!function_exists('vcard_custom_frontend_scripts')){
	function vcard_custom_frontend_scripts(){
	global $theme_option;
	echo $theme_option['google_id'];
}
}
add_action('wp_footer', 'vcard_custom_frontend_scripts');
//Custom Excerpt Function
function vcard_do_shortcode($content) {
    global $shortcode_tags;
    if (empty($shortcode_tags) || !is_array($shortcode_tags))
        return $content;
    $pattern = get_shortcode_regex();
    return preg_replace_callback( "/$pattern/s", 'do_shortcode_tag', $content );
}
// Widget Sidebar
function vcard_widgets_init() {
	register_sidebar( array(
        'name'          => __( 'Primary Sidebar', 'vcard' ),
        'id'            => 'sidebar-1',        
		'description'   => __( 'Appears in the sidebar section of the site.', 'vcard' ),        
		'before_widget' => '<div id="%1$s" class="widget %2$s">',        
		'after_widget'  => '</div>',        
		'before_title'  => '<h2>',        
		'after_title'   => '</h2>'
    ) );
}
add_action( 'widgets_init', 'vcard_widgets_init' );
function add_class_previous($format){
  $format = str_replace('href=', 'class="icon-left-open-big" href=', $format);
  return $format;
}
function add_class_next($format){
  $format = str_replace('href=', 'class="icon-right-open-big" href=', $format);
  return $format;
}
add_filter('next_post_link', 'add_class_next');
add_filter('previous_post_link', 'add_class_previous');
//function tag widgets
function vcard_tag_cloud_widget($args) {
	$args['number'] = 0; //adding a 0 will display all tags
	$args['largest'] = 18; //largest tag
	$args['smallest'] = 11; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	$args['format'] = 'list'; //ul with a class of wp-tag-cloud
	$args['exclude'] = array(20, 80, 92); //exclude tags by ID
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'vcard_tag_cloud_widget' );
function vcard_excerpt() {
  global $theme_option;
  if(isset($theme_option['blog_excerpt'])){
    $limit = $theme_option['blog_excerpt'];
  }else{
    $limit = 30;
  }
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}
//pagination
function vcard_pagination($prev = '<i class="icon-left-open-mini"></i>', $next = '<i class="icon-right-open-mini"></i>', $pages='') {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    if($pages==''){
        global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
    }
    $pagination = array(
		'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
		'format' 		=> '',
		'current' 		=> max( 1, get_query_var('paged') ),
		'total' 		=> $pages,
		'prev_text' => __($prev,'vcard'),
        'next_text' => __($next,'vcard'),		'type'			=> 'list',
		'end_size'		=> 3,
		'mid_size'		=> 3
);
    $return =  paginate_links( $pagination );
	echo str_replace( "<ul class='page-numbers'>", '<ul>', $return );
}
//Get thumbnail url
function vcard_thumbnail_url($size){
    global $post;
    //$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()),$size );
    if($size==''){
        $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
         return $url;
    }else{
        $url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $size);
         return $url[0];
    }
}
function vcard_post_nav() {
    global $post;
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );
    if ( ! $next && ! $previous )
        return;
    ?>
	<ul class="pager clearfix">
	  <li class="previous">
		<?php previous_post_link( '%link', _x( ' &larr; Older Item', 'Previous post link', 'nevermind' ) ); ?>
	  </li>
	  <li class="next">
		<?php next_post_link( '%link', _x( 'Newer Item &rarr;', 'Next post link', 'nevermind' ) ); ?>
	  </li>
	</ul>   
<?php
}
function vcard_search_form( $form ) {
    $form = '
		<form role="search" method="get" id="searchform" class="searchForm" action="' . home_url( '/' ) . '" >
			<input type="text" size="16" placeholder="Search" value="' . get_search_query() . '" name="s" id="s" />
			<input type="submit" class="submitSearch" value="Ok">
		</form>
	';
    return $form;
}
add_filter( 'get_search_form', 'vcard_search_form' );
//Custom comment List:

// Comment Form
function vcard_theme_comment($comment, $args, $depth) {
    //echo 's';
   $GLOBALS['comment'] = $comment; ?>
    <li id="li-comment-<?php comment_ID() ?>">
		<div class="comment"> 
			<div class="img">
			   <?php echo get_avatar($comment,$size='50',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=70' ); ?>
			</div>  
			<div class="commentContent">
				<div class="commentsInfo">
					<div class="author"><a href="#"><?php printf(__('%s','vcard'), get_comment_author_link()) ?></a></div>
					<div class="date"><a href="#"><?php $d = "F j, Y \A\T h a"; printf(get_comment_date($d)) ?></a></div>
				</div>
				<?php if ($comment->comment_approved == '0') : ?>
					 <em><?php _e('Your comment is awaiting moderation.','vcard') ?></em>
					 <br />
				<?php endif; ?>
				<p class="expert"><?php comment_text() ?></p>
			</div>
			<div class="reply-btn">
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>				
			</div> 
		</div>
	</li>
<?php
}

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/framework/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'vcard_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
 
 
function vcard_theme_register_required_plugins() {
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
             // This is an example of how to include a plugin from a private repo in your theme.
        array(
            'name'               => 'Verga Theme Page Builder', // The plugin name.
            'slug'               => 'Aqua-Page-Builder-master', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/framework/plugins/Aqua-Page-Builder-master.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),		
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => true,
        ),
    );
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'tgmpa' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
    tgmpa( $plugins, $config );
}
?>