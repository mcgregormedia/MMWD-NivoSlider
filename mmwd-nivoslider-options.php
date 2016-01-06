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
		'MMWD NivoSlider Settings', 
		'MMWD NivoSlider Settings',
		'manage_options',
		'mmwd_nivoslider_options',
		'mmwd_nivoslider_plugin_options_show_page'
	);
}

// display the admin options page
function mmwd_nivoslider_plugin_options_show_page() {
?>
	<div>
		<h2>MMWD NivoSlider Settings</h2>
		<p><em>Note: To use the current image library as slides, you will need to use the <a target="_blank" href="https://wordpress.org/plugins/regenerate-thumbnails/">Regenerate Thumbnails</a> plugin to resize your images.</em></p>
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
		'mmwd_nivoslider_content_text_colour',
		'Content text colour',
		'mmwd_nivoslider_text_options_setting_content_text_colour',
		'mmwd_nivoslider_plugin_options',
		'mmwd_nivoslider_text_options'
	);
	add_settings_field(
		'mmwd_nivoslider_background_colour',
		'Text background colour',
		'mmwd_nivoslider_text_options_setting_background_colour',
		'mmwd_nivoslider_plugin_options',
		'mmwd_nivoslider_text_options'
	);
	add_settings_field(
		'mmwd_nivoslider_background_opacity',
		'Text background opacity',
		'mmwd_nivoslider_text_options_setting_background_opacity',
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
		'Slider transition speed',
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
	$mmwd_nivoslider_title_text_colour = ( $options['mmwd_nivoslider_title_text_colour'] ) ? esc_html( $options['mmwd_nivoslider_title_text_colour'] ) : "";
	echo "<input id='mmwd_nivoslider_title_text_colour' class='wide mmwd-color-picker' name='mmwd_nivoslider_plugin_options[mmwd_nivoslider_title_text_colour]' type='text' value='" . $mmwd_nivoslider_title_text_colour . "'> <em>Title font can be changed in your theme's CSS</em>";
}
function mmwd_nivoslider_text_options_setting_content_text_colour() {
	$options = get_option('mmwd_nivoslider_plugin_options');
	$mmwd_nivoslider_content_text_colour = ( $options['mmwd_nivoslider_content_text_colour'] ) ? esc_html( $options['mmwd_nivoslider_content_text_colour'] ) : "";
	echo "<input id='mmwd_nivoslider_content_text_colour' class='wide mmwd-color-picker' name='mmwd_nivoslider_plugin_options[mmwd_nivoslider_content_text_colour]' type='text' value='" . $mmwd_nivoslider_content_text_colour . "'> <em>Content font can be changed in your theme's CSS</em>";
}
function mmwd_nivoslider_text_options_setting_background_colour() {
	$options = get_option('mmwd_nivoslider_plugin_options');
	$mmwd_nivoslider_background_colour = ( $options['mmwd_nivoslider_background_colour'] ) ? esc_html( $options['mmwd_nivoslider_background_colour'] ) : "";
	echo "<input id='mmwd_nivoslider_background_colour' class='wide mmwd-color-picker' name='mmwd_nivoslider_plugin_options[mmwd_nivoslider_background_colour]' type='text' value='" . $mmwd_nivoslider_background_colour . "'>";
}
function mmwd_nivoslider_text_options_setting_background_opacity() {
	$options = get_option('mmwd_nivoslider_plugin_options');
	$mmwd_nivoslider_background_opacity = ( $options['mmwd_nivoslider_background_opacity'] ) ? esc_html( $options['mmwd_nivoslider_background_opacity'] ) : "";
	echo "<input id='mmwd_nivoslider_background_opacity' class='wide' name='mmwd_nivoslider_plugin_options[mmwd_nivoslider_background_opacity]' type='text' value='" . $mmwd_nivoslider_background_opacity . "'> <em>Enter decimal value between 0 and 1 - for example, 0.5 = 50%</em>";
}


// Slider options
function mmwd_nivoslider_slider_options_setting_slider_effect() {
	$options = get_option('mmwd_nivoslider_plugin_options');	
	?>
	<select id='mmwd_nivoslider_slider_effect' class='wide' name='mmwd_nivoslider_plugin_options[mmwd_nivoslider_slider_effect]'>
		<option value='sliceDown'>Slice down</option>	
		<option value='sliceDownLeft'>Slice down left</option>	
		<option value='sliceUp'>Slice up</option>	
		<option value='sliceUpLeft'>Slice up left</option>	
		<option value='sliceUpDown'>Slice up down</option>	
		<option value='sliceUpDownLeft'>Slice up down left</option>	
		<option value='fold'>Fold</option>	
		<option value='fade'>Fade</option>	
		<option value='random'>Random</option>	
		<option value='slideInRight'>Slide in right</option>	
		<option value='slideInLeft'>Slide in left</option>	
		<option value='boxRandom'>Box random</option>	
		<option value='boxRain'>Box rain</option>	
		<option value='boxRainReverse'>Box rain reverse</option>	
		<option value='boxRainGrow'>Box rain grow</option>	
		<option value='boxRainGrowReverse'>Box rain grow reverse</option>	
	</select>
	<script>
	jQuery(document).ready(function() {
		jQuery('#mmwd_nivoslider_slider_effect option[value="<?php echo $options['mmwd_nivoslider_slider_effect']; ?>"]').prop('selected','selected');
	});
	</script>
	<?php
}
function mmwd_nivoslider_slider_options_setting_slider_animation_speed() {
	$options = get_option('mmwd_nivoslider_plugin_options');
	echo "<input id='mmwd_nivoslider_slider_animation_speed' class='wide' name='mmwd_nivoslider_plugin_options[mmwd_nivoslider_slider_animation_speed]' type='text' value='{$options['mmwd_nivoslider_slider_animation_speed']}'> <em>The length of time (in milliseconds) that the slider takes to move from one slide to the next</em>";
}
function mmwd_nivoslider_slider_options_setting_slider_pause_time() {
	$options = get_option('mmwd_nivoslider_plugin_options');
	echo "<input id='mmwd_nivoslider_slider_pause_time' class='wide' name='mmwd_nivoslider_plugin_options[mmwd_nivoslider_slider_pause_time]' type='text' value='{$options['mmwd_nivoslider_slider_pause_time']}'> <em>The length of time (in milliseconds) that the slider shows a single slide for</em>";
}
function mmwd_nivoslider_slider_options_setting_slider_pause_on_hover() {
	$options = get_option('mmwd_nivoslider_plugin_options');
	?>
	<select id='mmwd_nivoslider_slider_pause_on_hover' class='wide' name='mmwd_nivoslider_plugin_options[mmwd_nivoslider_slider_pause_on_hover]'>
		<option value='true'>Pause on hover</option>	
		<option value='false'>Don't pause on hover</option>
	</select> <em>Do you want the slider to remain on the same slide when the user hovers their mouse over the slider?</em>
	<script>
	jQuery(document).ready(function() {
		jQuery('#mmwd_nivoslider_slider_pause_on_hover option[value="<?php echo $options['mmwd_nivoslider_slider_pause_on_hover']; ?>"]').prop('selected','selected');
	});
	</script>
	<?php
}

// Validate our options
function mmwd_nivoslider_admin_plugin_options_validate( $input ) {
	// Text options
	$newinput['mmwd_nivoslider_title_text_colour'] = sanitize_text_field( $input['mmwd_nivoslider_title_text_colour'] );
	$newinput['mmwd_nivoslider_content_text_colour'] = sanitize_text_field( $input['mmwd_nivoslider_content_text_colour'] );
	$newinput['mmwd_nivoslider_background_colour'] = sanitize_text_field( $input['mmwd_nivoslider_background_colour'] );
	$newinput['mmwd_nivoslider_background_opacity'] = sanitize_text_field( $input['mmwd_nivoslider_background_opacity'] );
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