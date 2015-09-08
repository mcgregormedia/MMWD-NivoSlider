<?php
/**
 * Contextual help for slides Custom Post Type
 *
 * @package MMWD NivoSlider
**/
function rx_cpt_slides_help_tab() {
	$screen = get_current_screen();
	// Return early if we're not on the slides post type.
	if ( 'slide' != $screen->post_type )
	return;

	// Add the help tab.
	$screen->add_help_tab(
		array(
			'id'      => 'slides_cpt_help_overview',
			'title'   => 'Overview',
			'content' => '<h3>Overview</h3><p>Create or edit a slide.</p>',
		)
	);
	$screen->add_help_tab(
		array(
			'id'      => 'slides_cpt_help_list',
			'title'   => 'List of slides',
			'content' => '<h3>List of slides</h3><p>Display a list of slides and select slides to edit.</p>
			<ol>
				<li>The list screen displays the slide image, whether the slide is active, its order in the slideshow and its title, .</li>
				<li>The list is sorted into the order that slides will display on the frontend.</li>
				<li>Click/tap Add Slide to enter a new slide\'s listing.</li>
				<li>Click/tap on a slide\'s title to edit that slide\'s listing.</li>
			</ol>',
		)
	);
	$screen->add_help_tab(
		array(
			'id'      => 'slides_cpt_help_add_edit_slides',
			'title'   => 'Add/edit a slide',
			'content' => '<h3>Add/edit a slide</h3>
			<ol>
				<li>Add/edit the title (slide\'s name), text content and slide\'s image.</li>
				<li>Featured image shoud be a minimum width of 1200px and a minimum height of 300px.</li>
				<li>In the Attributes box, enter the order in which to display the slide in the slideshow.</li>
				<li>Tick the \'Currently active\' box. A slide will not display on the site if this box is not ticked.</li>
				<li>Add an optional link and button text. If a link and button text are specified, a clickable button will display in the slide. The slide title will also be clickable for smaller screen users.</li>
				<li>Don\'t forget to click/tap Publish or Update.</li>	
			</ol>',
		)
	);
	$screen->add_help_tab(
		array(
			'id'      => 'slides_cpt_help_display',
			'title'   => 'Display the slideshow',
			'content' => '<h3>Display the slideshow</h3><p>Display the slideshow by using the shortcode [mmwd-nivoslider] in your page/post content or in a text widget if supported by your theme.</p>',
		)
	);
}

add_action('admin_head', 'rx_cpt_slides_help_tab');