<?php
/**
 * SSM Events
 *
 * @package   SSM_Events
 * @license   GPL-2.0+
 */

/**
 * Register post types and taxonomies.
 *
 * @package SSM_Events
 */
class SSM_Events_Registrations {

	public $post_type = 'event';

	public $taxonomies = array( 'event-category' );

	public function init() {
		// Add the SSM Events and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses SSM_Events_Registrations::register_post_type()
	 * @uses SSM_Events_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_taxonomy_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Events', 'ssm-events' ),
			'singular_name'      => __( 'Event', 'ssm-events' ),
			'add_new'            => __( 'Add Event', 'ssm-events' ),
			'add_new_item'       => __( 'Add Event', 'ssm-events' ),
			'edit_item'          => __( 'Edit Event', 'ssm-events' ),
			'new_item'           => __( 'New Event', 'ssm-events' ),
			'view_item'          => __( 'View Event', 'ssm-events' ),
			'search_items'       => __( 'Search Events', 'ssm-events' ),
			'not_found'          => __( 'No events found', 'ssm-events' ),
			'not_found_in_trash' => __( 'No events in the trash', 'ssm-events' ),
		);

		$supports = array(
			'title',
			'thumbnail',
			'page-attributes',
		);

		$args = array(
			'labels'          		=> $labels,
			'supports'        		=> $supports,
			'public'          		=> true,
			'capability_type' 		=> 'page',
			'publicly_queriable'	=> true,
			'show_ui' 						=> true,
			'show_in_nav_menus' 	=> true,
			'rewrite'         		=> array( 'slug' => 'event', ),
			'menu_position'   		=> 30,
			'menu_icon'       		=> 'dashicons-calendar-alt',
			'has_archive'					=> 'events',
			'exclude_from_search'	=> false,
			'hierarchical'	 			=> true
		);

		$args = apply_filters( 'SSM_Events_args', $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for Project Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Event Categories', 'ssm-events' ),
			'singular_name'              => __( 'Event Category', 'ssm-events' ),
			'menu_name'                  => __( 'Categories', 'ssm-events' ),
			'edit_item'                  => __( 'Edit Event Category', 'ssm-events' ),
			'update_item'                => __( 'Update Event Category', 'ssm-events' ),
			'add_new_item'               => __( 'Add New Event Category', 'ssm-events' ),
			'new_item_name'              => __( 'New Event Category Name', 'ssm-events' ),
			'parent_item'                => __( 'Parent Event Category', 'ssm-events' ),
			'parent_item_colon'          => __( 'Parent Event Category:', 'ssm-events' ),
			'all_items'                  => __( 'All Event Categories', 'ssm-events' ),
			'search_items'               => __( 'Search Event Categories', 'ssm-events' ),
			'popular_items'              => __( 'Popular Event Categories', 'ssm-events' ),
			'separate_items_with_commas' => __( 'Separate event categories with commas', 'ssm-events' ),
			'add_or_remove_items'        => __( 'Add or remove event categories', 'ssm-events' ),
			'choose_from_most_used'      => __( 'Choose from the most used event categories', 'ssm-events' ),
			'not_found'                  => __( 'No event categories found.', 'ssm-events' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => false,
			'show_ui'           => true,
			'show_tagcloud'     => false,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'event-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'SSM_Events_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
}