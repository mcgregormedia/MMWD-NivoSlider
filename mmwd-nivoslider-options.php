<?php
/**
 * Options page
 *
 * @package MMWD NivoSlider
 *
 * Since v1.0.1
 */
 
// add the admin options page
add_action('admin_menu', 'mmwd_nivoslider_plugin_options_page');
function mmwd_nivoslider_plugin_options_page() {
	add_options_page(
		'MMWD NivoSlider Options', 
		'MMWD NivoSlider Options',
		'manage_options',
		'mmwd_nivoslider_options',
		'mmwd_nivoslider_plugin_options_show_page'
	);
}

// display the admin options page
function mmwd_nivoslider_plugin_options_show_page() {
?>
	<div>
		<h2>MMWD NivoSlider Options</h2>
		<form action="options.php" method="post">
		<?php settings_fields('mmwd_nivoslider_admin_plugin_options'); ?>
		<?php do_settings_sections('mmwd_nivoslider_plugin_options'); ?>
		 
		<input name="Submit" class="button-primary" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
		</form>
	</div>
 
<?php
}

// add the admin settings and such
add_action('admin_init', 'mmwd_nivoslider_admin_plugin_options_init');
function mmwd_nivoslider_admin_plugin_options_init(){

	register_setting(
		'mmwd_nivoslider_admin_plugin_options',
		'mmwd_nivoslider_plugin_options',
		'mmwd_nivoslider_admin_plugin_options_validate'
	);
	
	// Text options
	add_settings_section(
		'mmwd_nivoslider_text_options',
		'Text Options',
		'mmwd_nivoslider_text_options_section_text',
		'mmwd_nivoslider_plugin_options'
	);
	add_settings_field(
		'mmwd_nivoslider_title_text_colour',
		'Title text colour',
		'mmwd_nivoslider_text_options_setting_title_text_colour',
		'mmwd_nivoslider_plugin_options',
		'mmwd_nivoslider_text_options'
	);
	add_settings_field(
		'mmwd_nivoslider_title_text_background_colour',
		'Title text background colour',
		'mmwd_nivoslider_text_options_setting_title_text_background_colour',
		'mmwd_nivoslider_plugin_options',
		'mmwd_nivoslider_text_options'
	);
	add_settings_field(
		'mmwd_nivoslider_content_text_colour',
		'Content text colour',
		'mmwd_nivoslider_text_options_setting_content_text_colour',
		'mmwd_nivoslider_plugin_options',
		'mmwd_nivoslider_text_options'
	);
	add_settings_field(
		'mmwd_nivoslider_content_text_background_colour',
		'Content text background colour',
		'mmwd_nivoslider_text_options_setting_content_text_background_colour',
		'mmwd_nivoslider_plugin_options',
		'mmwd_nivoslider_text_options'
	);
	
	
	// Slider options
	add_settings_section(
		'mmwd_nivoslider_slider_options',
		'Slider Options',
		'mmwd_nivoslider_slider_options_section_text',
		'mmwd_nivoslider_plugin_options'
	);	
	add_settings_field(
		'mmwd_nivoslider_slider_effect',
		'Slider transition effect',
		'mmwd_nivoslider_slider_options_setting_slider_effect',
		'mmwd_nivoslider_plugin_options',
		'mmwd_nivoslider_slider_options'
	);
	add_settings_field(
		'mmwd_nivoslider_slider_animation_speed',
		'Slider animation speed',
		'mmwd_nivoslider_slider_options_setting_slider_animation_speed',
		'mmwd_nivoslider_plugin_options',
		'mmwd_nivoslider_slider_options'
	);
	add_settings_field(
		'mmwd_nivoslider_slider_pause_time',
		'Slider pause time',
		'mmwd_nivoslider_slider_options_setting_slider_pause_time',
		'mmwd_nivoslider_plugin_options',
		'mmwd_nivoslider_slider_options'
	);
	add_settings_field(
		'mmwd_nivoslider_slider_pause_on_hover',
		'Slider pause on hover',
		'mmwd_nivoslider_slider_options_setting_slider_pause_on_hover',
		'mmwd_nivoslider_plugin_options',
		'mmwd_nivoslider_slider_options'
	);
	
}

// Section text
function mmwd_nivoslider_text_options_section_text() {
	echo '<p>Change how the text is displayed on the slider.</p>';
}
function mmwd_nivoslider_slider_options_section_text() {
	echo '<p>Change how the slider behaves on the frontend.</p>';
}

// Add form fields
// Text options
function mmwd_nivoslider_text_options_setting_title_text_colour() {
	$options = get_option('mmwd_nivoslider_plugin_options');
	echo "<input id='mmwd_nivoslider_title_text_colour' class='wide mmwd-color-picker' name='mmwd_nivoslider_plugin_options[mmwd_nivoslider_title_text_colour]' type='text' value='{$options['mmwd_nivoslider_title_text_colour']}'>";
}
function mmwd_nivoslider_text_options_setting_title_text_background_colour() {
	$options = get_option('mmwd_nivoslider_plugin_options');
	echo "<input id='mmwd_nivoslider_title_text_background_colour' class='wide mmwd-color-picker' name='mmwd_nivoslider_plugin_options[mmwd_nivoslider_title_text_background_colour]' type='tel' value='{$options['mmwd_nivoslider_title_text_background_colour']}'>";
}
function mmwd_nivoslider_text_options_setting_content_text_colour() {
	$options = get_option('mmwd_nivoslider_plugin_options');
	echo "<input id='mmwd_nivoslider_content_text_colour' class='wide mmwd-color-picker' name='mmwd_nivoslider_plugin_options[mmwd_nivoslider_content_text_colour]' type='tel' value='{$options['mmwd_nivoslider_content_text_colour']}'>";
}
function mmwd_nivoslider_text_options_setting_content_text_background_colour() {
	$options = get_option('mmwd_nivoslider_plugin_options');
	echo "<input id='mmwd_nivoslider_content_text_background_colour' class='wide mmwd-color-picker' name='mmwd_nivoslider_plugin_options[mmwd_nivoslider_content_text_background_colour]' value='{$options['mmwd_nivoslider_content_text_background_colour']}'>";
}


// Slider options
function mmwd_nivoslider_slider_options_setting_slider_effect() {
	$options = get_option('mmwd_nivoslider_plugin_options');
	echo "<input id='mmwd_nivoslider_slider_effect' class='wide' name='mmwd_nivoslider_plugin_options[mmwd_nivoslider_slider_effect]' type='text' value='{$options['mmwd_nivoslider_slider_effect']}'>";
}
function mmwd_nivoslider_slider_options_setting_slider_animation_speed() {
	$options = get_option('mmwd_nivoslider_plugin_options');
	echo "<input id='mmwd_nivoslider_slider_animation_speed' class='wide' name='mmwd_nivoslider_plugin_options[mmwd_nivoslider_slider_animation_speed]' type='text' value='{$options['mmwd_nivoslider_slider_animation_speed']}'> <em>milliseconds</em>";
}
function mmwd_nivoslider_slider_options_setting_slider_pause_time() {
	$options = get_option('mmwd_nivoslider_plugin_options');
	echo "<input id='mmwd_nivoslider_slider_pause_time' class='wide' name='mmwd_nivoslider_plugin_options[mmwd_nivoslider_slider_pause_time]' type='text' value='{$options['mmwd_nivoslider_slider_pause_time']}'> <em>milliseconds</em>";
}
function mmwd_nivoslider_slider_options_setting_slider_pause_on_hover() {
	$options = get_option('mmwd_nivoslider_plugin_options');
	echo "<input id='mmwd_nivoslider_slider_pause_on_hover' class='wide' name='mmwd_nivoslider_plugin_options[mmwd_nivoslider_slider_pause_on_hover]' type='text' value='{$options['mmwd_nivoslider_slider_pause_on_hover']}'> <em>true or false</em>";
}

// Validate our options
function mmwd_nivoslider_admin_plugin_options_validate($input) {
	// Text options
	$newinput['mmwd_nivoslider_title_text_colour'] = sanitize_text_field( $input['mmwd_nivoslider_title_text_colour'] );
	$newinput['mmwd_nivoslider_title_text_background_colour'] = sanitize_text_field( $input['mmwd_nivoslider_title_text_background_colour'] );
	$newinput['mmwd_nivoslider_content_text_colour'] = sanitize_text_field( $input['mmwd_nivoslider_content_text_colour'] );
	$newinput['mmwd_nivoslider_content_text_background_colour'] = sanitize_text_field( $input['mmwd_nivoslider_content_text_background_colour'] );
	// Slider options
	$newinput['mmwd_nivoslider_slider_effect'] = sanitize_text_field( $input['mmwd_nivoslider_slider_effect'] );
	$newinput['mmwd_nivoslider_slider_animation_speed'] = sanitize_text_field( $input['mmwd_nivoslider_slider_animation_speed'] );
	$newinput['mmwd_nivoslider_slider_pause_time'] = sanitize_text_field( $input['mmwd_nivoslider_slider_pause_time'] );
	$newinput['mmwd_nivoslider_slider_pause_on_hover'] = sanitize_text_field( $input['mmwd_nivoslider_slider_pause_on_hover'] );
	return $newinput;
}

// Add WordPress colour picker scripts
function mmwd_nivoslider_add_color_picker( $hook ) {
    if( is_admin() ) {   
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'mmwd-nivoslider-add-color-picker-js', plugins_url( 'mmwd-nivoslider-add-color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
    }
}
add_action( 'admin_enqueue_scripts', 'mmwd_nivoslider_add_color_picker' );