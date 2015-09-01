<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';
	
    $meta_boxes[] = array(
        'id'         => 'page_setting',
        'title'      => 'Page Setting',
        'pages'      => array('page'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            array(
                'name' => 'Page Sub Title',
                'desc' => 'Set Page Sub Title',
                'id'   => $prefix . 'page_sub_title',
                'type'    => 'text',
            ),           
        )
    );
	// Add other metaboxes as needed
	
	$meta_boxes[] = array(
        'id'         => 'post_setting',
        'title'      => 'Post Setting',
        'pages'      => array('post'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(              
			array(
                'name' => 'Selected Left Right Media',
                'desc' => 'Media Left or Right Content',
                'id'   => $prefix . 'media_post',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Media Left', 'value' => 'media_left', ),
                    array( 'name' => 'Media Right', 'value' => 'media_right', ),
                    )
            ),  
            array(
				'name' => __( 'Link Audio', 'cmb' ),
				'desc' => __( 'Add link Audio Soundcloud. Ex: https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/139083759', 'cmb' ),
				'id'   => $prefix . 'link_audio',
				'type' => 'text'
			),
			array(
				'name' => __( 'Link Video', 'cmb' ),
				'desc' => __( 'Add link Video Youtube, Vimeo. Ex: http://www.youtube.com/embed/eP2VWNtU5rw or http://player.vimeo.com/video/20249835', 'cmb' ),
				'id'   => $prefix . 'link_video',
				'type' => 'text'
			),            
        )
    );
	// Add other metaboxes as needed
	
	$meta_boxes[] = array(
        'id'         => 'portfolio_setting',
        'title'      => 'Portfolio Setting',
        'pages'      => array('portfolio'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(              			
			array(
                'name' => 'Launch Project',
                'desc' => 'Link Out Project',
                'id'   => $prefix . 'portfolio_project',
                'type'    => 'text',
            ),   
			/*array(
                'name' => 'Information',
                'desc' => 'Description Information',
                'id'   => $prefix . 'information',
                'type'    => 'textarea',
            ),   */ 
			array(
                'name' => 'Link Audio',
                'desc' => 'Add link Audio Soundcloud. Ex: https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/139083759',
                'id'   => $prefix . 'portfolio_audio',
                'type'    => 'text',
            ),
			array(
                'name' => 'Link video',
                'desc' => 'Link youtube, link vimeo, Example: http://www.youtube.com/embed/0ecv0bT9DEo',
                'id'   => $prefix . 'portfolio_video',
                'type'    => 'text',
            ), 
			array(
                'name' => 'Link facebook',
                'desc' => 'http://facebook.com/user',
                'id'   => $prefix . 'portfolio_facebook',
                'type'    => 'text',
            ),   
			array(
                'name' => 'Link linkedin',
                'desc' => 'http://linkedin.com/user',
                'id'   => $prefix . 'portfolio_linkedin',
                'type'    => 'text',
            ),   
			array(
                'name' => 'Link instagram',
                'desc' => 'http://instagram.com/user',
                'id'   => $prefix . 'portfolio_instagram',
                'type'    => 'text',
            ),   
        )
    );
	// Add other metaboxes as needed
	
	$meta_boxes[] = array(
		'id'         => 'seo_fields',
		'title'      => 'WordPress SEO by VergaTheme',
		'pages'      => array( 'page', 'post','portfolio'), // Post type
		'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
		//'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields' => array(
			array(
                'name' => 'Focus Keyword:',
                'desc' => 'SEO keywords (optional)',
                'id'   => $prefix . 'seo_keywords',
                'type' => 'text',
            ),
			array(
				'name' => 'SEO Title:',
				'desc' => 'Title display in search engines is limited to 70 chars.',
				'id'   => $prefix . 'seo_title',
				'type' => 'text',
			),
            array(
                'name' => 'Meta Description:',
                'desc' => 'The meta description will be limited to 156 chars.',
                'id'   => $prefix . 'seo_description',
                'type' => 'textarea',
            ),
		)
	);
	// Add other metaboxes as needed
	
	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}
