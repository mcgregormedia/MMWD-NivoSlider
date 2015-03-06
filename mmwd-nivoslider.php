<?php
/*
Plugin Name: MMWD NivoSlider
Plugin URI: http://www.mcgregormedia.co.uk/mmwd-nivoslider
Description: Adds a Slide custom post type and a shortcode to display the slider. To use the current image library as slides, you will need to use the <a target="_blank" href="https://wordpress.org/plugins/regenerate-thumbnails/">Regenerate Thumbnails</a> plugin to resize your images.
Version: 1.0.3
Author: McGregor Media Web Design
Author URI: http://www.mcgregormedia.co.uk/
License: GPL2

MMWD NivoSlider is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

MMWD NivoSlider is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with MMWD NivoSlider. If not, see http://www.gnu.org/licenses/gpl.html.
*/


// If you've come directly here, scram.
if ( ! defined( 'ABSPATH' ) ) exit;





/**
 * backend
**/

// Run activation functions
function mmwd_nivoslider_activation_functions() {	
	if ( !is_plugin_active( 'mobble/mobble.php' ) ){ // Check if Mobble is installed
		deactivate_plugins( basename( __FILE__ ) );
		wp_die( '<p>MMWD NivoSlider requires the plugin Mobble. Please install and activate <a target="_blank" href="https://wordpress.org/plugins/mobble/">Mobble</a> as soon as possible.</p>' );
	}	
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'mmwd_nivoslider_activation_functions' );


// Load constants
if ( ! defined( 'MMWD_NS_BASE_FILE' ) )
    define( 'MMWD_NS_BASE_FILE', __FILE__ );
if ( ! defined( 'MMWD_NS_BASE_DIR' ) )
    define( 'MMWD_NS_BASE_DIR', dirname( MMWD_NS_BASE_FILE ) );
if ( ! defined( 'MMWD_NS_PLUGIN_URL' ) )
    define( 'MMWD_NS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );


//Add additional generated image sizes
add_theme_support( 'post-thumbnails' );	
add_image_size( 'slide-desktop', 1280, 300, true ); //(cropped)
add_image_size( 'slide-tablet', 1024, 250, true ); //(cropped)
add_image_size( 'slide-mobile', 480, 200, true ); //(cropped)


// Enqueue scripts
function mmwd_nivoslider_scripts() {	
	wp_enqueue_style( 'nivo-library-css', MMWD_NS_PLUGIN_URL . 'nivo-slider/nivo-slider.css', array(), '' );
	wp_enqueue_style( 'nivo-default-theme-css', MMWD_NS_PLUGIN_URL . 'nivo-slider/themes/default/default.css', array(), '' );
	wp_enqueue_script( 'nivo-library', MMWD_NS_PLUGIN_URL . 'nivo-slider/jquery.nivo.slider.pack.js', array( 'jquery' ), '3.2', true );	
}
add_action( 'wp_enqueue_scripts', 'mmwd_nivoslider_scripts' );

// Register Slides custom post type
if ( ! function_exists( 'register_slide_cpt' ) ) {
	function register_slide_cpt() {

		$labels = array(
			'name'                => __( 'Slides', 'Post Type General Name', 'mmwd-nivoslider' ),
			'singular_name'       => __( 'Slide', 'Post Type Singular Name', 'mmwd-nivoslider' ),
			'menu_name'           => __( 'Slideshow', 'mmwd-nivoslider' ),
			'parent_item_colon'   => __( 'Parent Slide:', 'mmwd-nivoslider' ),
			'all_items'           => __( 'All Slides', 'mmwd-nivoslider' ),
			'view_item'           => __( 'View Slide', 'mmwd-nivoslider' ),
			'add_new_item'        => __( 'Add New Slide', 'mmwd-nivoslider' ),
			'add_new'             => __( 'Add Slide', 'mmwd-nivoslider' ),
			'edit_item'           => __( 'Edit Slide', 'mmwd-nivoslider' ),
			'update_item'         => __( 'Update Slide', 'mmwd-nivoslider' ),
			'search_items'        => __( 'Search Slides', 'mmwd-nivoslider' ),
			'not_found'           => __( 'No slides found', 'mmwd-nivoslider' ),
			'not_found_in_trash'  => __( 'No slides found in Trash', 'mmwd-nivoslider' ),
		);
		$rewrite = array(
			'slug'                => 'slides',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);
		$args = array(
			'label'               	=> __( 'slide', 'mmwd-nivoslider' ),
			'description'         	=> __( 'Slides info', 'mmwd-nivoslider' ),
			'labels'              	=> $labels,
			'supports'            	=> array( 'title', 'editor', 'thumbnail', 'page-attributes', ),
			'taxonomies'          	=> array( '' ),
			'hierarchical'        	=> false,
			'public'              	=> true,
			'show_ui'             	=> true,
			'show_in_menu'        	=> true,
			'show_in_nav_menus'   	=> true,
			'show_in_admin_bar'   	=> true,
			'menu_position'       	=> 24,
			'menu_icon'           	=> 'dashicons-images-alt',
			'can_export'          	=> true,
			'has_archive'         	=> true,
			'exclude_from_search' 	=> false,
			'publicly_queryable'  	=> true,
			'rewrite'             	=> $rewrite,
			'capability_type'     	=> 'post'
		);
		register_post_type( 'slide', $args );

	}
	add_action( 'init', 'register_slide_cpt', 0 );	
}


// Change CPT admin text
function mmwd_nivoslider_change_admin_cpt_text_filter( $translated_text, $untranslated_text, $domain ) {
	if ( 'slide' == get_post_type() ){
		//make the changes to the text
		switch( $untranslated_text ) {
			case 'Enter title here':
			$translated_text = __( 'Slide title text','mmwd-nivoslider' );
			break;        
		}
	}
	return $translated_text;
}
add_filter('gettext', 'mmwd_nivoslider_change_admin_cpt_text_filter', 20, 3);


// Remove Add Media button
function mmwd_nivoslider_remove_media_controls() {
	if ( 'slide' == get_post_type() ){
		remove_action( 'media_buttons', 'media_buttons' );
	}
}
add_action('admin_head','mmwd_nivoslider_remove_media_controls');


// Customise the Featured Image metabox
function mmwd_nivoslider_remove_slide_featured_image_metabox() {	
    if ( 'slide' == get_post_type() ){
		remove_meta_box( 'postimagediv', 'slide', 'side' );
	}
}
function mmwd_nivoslider_custom_slide_featured_image_metabox( $post ) {
	if ( 'slide' == get_post_type() ){
		$thumbnail_id = get_post_meta( $post->ID, '_thumbnail_id', true );	
		echo "Minimum width: 1280px<br>Minimum height: 300px";
		echo _wp_post_thumbnail_html( $thumbnail_id, $post->ID );
	}
}
function mmwd_nivoslider_add_slide_featured_image_metabox() {	
	if ( 'slide' == get_post_type() ){
		add_meta_box( 'postimagediv', __( 'Slide Image', 'mmwd-nivoslider' ), 'mmwd_nivoslider_custom_slide_featured_image_metabox', 'slide', 'side', 'default' );	
	}
}
add_action( 'admin_head', 'mmwd_nivoslider_remove_slide_featured_image_metabox' );
add_action( 'admin_head', 'mmwd_nivoslider_add_slide_featured_image_metabox' );


// add columns
function mmwd_nivoslider_slide_posts_columns( $slide_columns ) {	
    $new_columns['cb']  			= '<input type="checkbox">';
	$new_columns['post_thumbnail']  = 'Image';
	$new_columns['menu_order']  	= 'Order';
	$new_columns['title']  			= 'Title';
	$new_columns['post_content']  	= 'Content';	
    $new_columns['date'] 			= 'Added';
	$new_columns['author'] 			= 'Added by';
    return $new_columns;	
}
add_filter('manage_edit-slide_columns', 'mmwd_nivoslider_slide_posts_columns');


// populate columns
function mmwd_nivoslider_slide_posts_columns_content( $column_name, $post_id ) {	
	global $post;
	if ($column_name == 'menu_order') {
		$menu_order = $post->menu_order;
		echo $menu_order;
    }
	if ($column_name == 'post_content') {
		$content = $post->post_content;
		echo $content;
    }
	if ($column_name == 'post_thumbnail') {
		$thumb = the_post_thumbnail( array( 100,100 ) );
		echo $thumb;
    }
}
add_action( 'manage_slide_posts_custom_column', 'mmwd_nivoslider_slide_posts_columns_content', 10, 2 );


// order by menu_order
function mmwd_nivoslider_set_slide_cpt_admin_order( $wp_query ) {	
  if (is_admin()) {
    // Get the post type from the query
    $post_type = $wp_query->query['post_type'];
    // if it's one of our custom ones
    if ( 'slide' == $post_type ) {
      $wp_query->set( 'orderby', 'menu_order' );
      $wp_query->set( 'order', 'ASC' );
    }
  } 
}
add_filter('pre_get_posts', 'mmwd_nivoslider_set_slide_cpt_admin_order');

// include options
require_once( 'mmwd-nivoslider-options.php' );

// Add settings link on plugin page
function mmwd_nivoslider_plugin_page_settings_link( $links ) { 
  $settings_link = '<a href="options-general.php?page=mmwd_nivoslider_options.php">Settings</a>'; 
  array_unshift( $links, $settings_link ); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter('plugin_action_links_' . $plugin, 'mmwd_nivoslider_plugin_page_settings_link' );






/**
 * Frontend
**/

// Add shortcode
function mmwd_nivoslider_show_nivoslider() {
	$args = array (
		'post_type'              => 'slide',
		'posts_per_page'         => '-1',
		'posts_per_archive_page' => '-1',
		'order'                  => 'ASC',
		'orderby'                => 'menu_order',
	);
	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		
		$options = get_option('mmwd_nivoslider_plugin_options');
		?>

		<div class="slider-wrapper theme-default">

			<div id="slider" class="nivoSlider">

				<?php
				while ( $query->have_posts() ) {
					$query->the_post();
					global $post;
					if( is_mobile() ){
						$slider_img_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slide-mobile', false, '' );
					}
					elseif( is_tablet() ){
						$slider_img_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slide-tablet', false, '' );
					}
					else{
						$slider_img_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slide-desktop', false, '' );
					}
					?>

					<img src="<?php echo $slider_img_src[0] ?>" width="<?php echo $slider_img_src[1] ?>" height="<?php echo $slider_img_src[2] ?>" alt="<?php the_title_attribute(); ?>" title="#htmlcaption-<?php the_ID();?>">
				<?php } ?>

			</div>

		
		
			
		<?php
		while ( $query->have_posts() ) {
			$query->the_post();			
			?>

			<div id="htmlcaption-<?php the_ID(); ?>" class="nivo-html-caption">

				<div class="nivo-html-caption-content">
				
					<h3 style="width:100%;color:<?php echo esc_html( $options['mmwd_nivoslider_title_text_colour'] ); ?>;"><?php the_title(); ?></h3>

					<span style="color:<?php echo esc_html( $options['mmwd_nivoslider_content_text_colour'] ); ?>;"><?php the_content(); ?></span>
				
				</div>

			</div>

			<?php		
		}		
		?>
		
		
		
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('#slider').nivoSlider({
					effect: '<?php echo esc_html( $options['mmwd_nivoslider_slider_effect'] ); ?>',
					animSpeed: <?php echo esc_html( $options['mmwd_nivoslider_slider_animation_speed'] ); ?>, // Slide transition speed
					pauseTime: <?php echo esc_html( $options['mmwd_nivoslider_slider_pause_time'] ); ?>, // How long each slide will show
					pauseOnHover: <?php echo esc_html( $options['mmwd_nivoslider_slider_pause_on_hover'] ); ?>, // Stop animation while hovering
				});
				jQuery('.nivo-caption').css('background-color', '<?php echo esc_html( $options['mmwd_nivoslider_background_colour'] ); ?>');
				/* jQuery('.nivo-controlNav').addClass('theme-default'); */
			});
		</script>
		
		</div>

		<?php
	}	
}
add_shortcode( 'mmwd-nivoslider', 'mmwd_nivoslider_show_nivoslider' );