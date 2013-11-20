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
		'id'         => 'page_metabox',
		'title'      => 'Page Settings',
		'pages'      => array( 'Page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Hide page title ',
				'desc' => '',
				'id' => $prefix . 'hide_title',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Display text below title',
				'desc' => 'This text will display below title of the page',
				'id' => $prefix . 'below_title',
				'type' => 'wysiwyg',
				'options' => array(	'textarea_rows' => 5, ),
				)		
			
		)
	);

	$meta_boxes[] = array(
		'id'         => 'post_metabox',
		'title'      => 'Post Settings',
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
				array(
				'name' => 'Select Video Provider',
				'id' => $prefix . 'post_video_select',
				'type' => 'select',				
				'options' => array(
								array( 'name' => 'Youtube', 'value' => 'Youtube', ),
								array( 'name' => 'Vimeo', 'value' => 'Vimeo', ),
									),								
				),
				 array(
				'name' => 'Video ID',
				'desc' => 'Enter your Video Id here (Ex: for http://vimeo.com/51430433 video id is 51430433)',
				'id' => $prefix . 'post_video_id',
				'type' => 'text',
				'std' => ''
				)				
			
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