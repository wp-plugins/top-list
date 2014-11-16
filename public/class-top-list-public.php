<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.nilambar.net
 * @since      1.0.0
 *
 * @package    Top_List
 * @subpackage Top_List/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Top_List
 * @subpackage Top_List/public
 * @author     Nilambar Sharma <nilambar@outlook.com>
 */
class Top_List_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $plugin_name       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Top_List_Public_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Top_List_Public_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/top-list-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Top_List_Public_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Top_List_Public_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/top-list-public.js', array( 'jquery' ), $this->version, false );

	}

	public function custom_post_types(){

		// Register List Post Type
		$labels = array(
			'name'               => _x( 'Lists', 'post type general name', 'top-list' ),
			'singular_name'      => _x( 'List', 'post type singular name', 'top-list' ),
			'menu_name'          => _x( 'Top List', 'admin menu', 'top-list' ),
			'name_admin_bar'     => _x( 'List', 'add new on admin bar', 'top-list' ),
			'add_new'            => _x( 'Add New', TOP_LIST_POST_TYPE_LIST, 'top-list' ),
			'add_new_item'       => __( 'Add New List', 'top-list' ),
			'new_item'           => __( 'New List', 'top-list' ),
			'edit_item'          => __( 'Edit List', 'top-list' ),
			'view_item'          => __( 'View List', 'top-list' ),
			'all_items'          => __( 'All Lists', 'top-list' ),
			'search_items'       => __( 'Search Lists', 'top-list' ),
			'parent_item_colon'  => __( 'Parent Lists:', 'top-list' ),
			'not_found'          => __( 'No lists found.', 'top-list' ),
			'not_found_in_trash' => __( 'No lists found in Trash.', 'top-list' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'list' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_icon'          => 'dashicons-editor-justify',
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		);

		register_post_type( TOP_LIST_POST_TYPE_LIST, $args );

		// Register List Item Post Type

		$args = array(
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => false,
			'show_in_menu'       => false,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'comments' )
		);

		register_post_type( TOP_LIST_POST_TYPE_LIST_ITEM, $args );

		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Categories', 'taxonomy general name', 'top-list'  ),
			'singular_name'     => _x( 'Category', 'taxonomy singular name', 'top-list'  ),
			'search_items'      => __( 'Search Categories', 'top-list'  ),
			'all_items'         => __( 'All Categories', 'top-list'  ),
			'parent_item'       => __( 'Parent Category', 'top-list'  ),
			'parent_item_colon' => __( 'Parent Category:', 'top-list'  ),
			'edit_item'         => __( 'Edit Category', 'top-list'  ),
			'update_item'       => __( 'Update Category', 'top-list'  ),
			'add_new_item'      => __( 'Add New Category', 'top-list'  ),
			'new_item_name'     => __( 'New Category Name', 'top-list'  ),
			'menu_name'         => __( 'Categories', 'top-list'  ),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'list-category' ),
		);
		register_taxonomy( TOP_LIST_TAX_TYPE_LIST_CATEGORY, array( TOP_LIST_POST_TYPE_LIST ), $args );

		// Add new taxonomy, NOT hierarchical (like tags)
		$labels = array(
			'name'                       => _x( 'Tags', 'taxonomy general name' ),
			'singular_name'              => _x( 'Tag', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Tags' ),
			'popular_items'              => __( 'Popular Tags' ),
			'all_items'                  => __( 'All Tags' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Tag' ),
			'update_item'                => __( 'Update Tag' ),
			'add_new_item'               => __( 'Add New Tag' ),
			'new_item_name'              => __( 'New Tag Name' ),
			'separate_items_with_commas' => __( 'Separate tags with commas' ),
			'add_or_remove_items'        => __( 'Add or remove tags' ),
			'choose_from_most_used'      => __( 'Choose from the most used tags' ),
			'not_found'                  => __( 'No tags found.' ),
			'menu_name'                  => __( 'Tags' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'list-tag' ),
		);

		register_taxonomy( TOP_LIST_TAX_TYPE_LIST_TAG, TOP_LIST_POST_TYPE_LIST, $args );

	}

	public function before_lists(){
		echo '<div class="top-list-wrap">';
	}
	public function after_lists(){
		echo '</div><!-- .top-list-wrap -->';
	}


	public function display_lists(){

		global $post;
		if ( TOP_LIST_POST_TYPE_LIST != $post->post_type ) {
			return;
		}
		$list_id = get_the_ID();
		$custom_query_args = array(
			'post_type'      => TOP_LIST_POST_TYPE_LIST_ITEM,
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'meta_query' => array(
					array(
						'key'     => '_parent_list_id',
						'value'   => $list_id,
						'compare' => '=',
					),
				),
	  );
		$custom_query = new WP_Query($custom_query_args);

		if ( $custom_query->have_posts() ) {

			$template = top_list_locate_template('single-list-item.php');

			while ( $custom_query->have_posts() ) {
				$custom_query->the_post();
				global $post;
				$post->item_order = $post->menu_order;
				if ($template) {
					load_template( $template, false );
				}
			}

		}
		wp_reset_postdata();
		return;

	}


	public function get_items_of_list($id){

		$output = array();

		if ( intval($id) < 1 ) {
			return $output;
		}

		$custom_query_args = array(
			'post_type'      => TOP_LIST_POST_TYPE_LIST_ITEM,
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'meta_query' => array(
					array(
						'key'     => '_parent_list_id',
						'value'   => $id,
						'compare' => '=',
					),
				),
	  );
		$all_posts = get_posts($custom_query_args);

		if (!empty($all_posts)) {
			foreach ($all_posts as $key => $p) {

				$output[$key]['post'] = $p;
				$output[$key]['meta']['thumbnail_info'] = array();
				$output[$key]['meta']['item_number'] = ($key+1);
				$thumb_id = get_post_meta($p->ID,'_thumbnail_id',true);
				if (!empty($thumb_id)) {
					$thumb_info = wp_get_attachment_image_src($thumb_id,'large');
					if (!empty($thumb_info)) {
						$output[$key]['meta']['thumbnail_info'] = $thumb_info;
					}
				}

			}
		}

		return $output;

	}

	public function template_include( $template ){

		if (is_singular( TOP_LIST_POST_TYPE_LIST )) {
			$template = top_list_locate_template('single-list.php');
		}

		return $template;

	}

	public function output_content_wrapper(){

		$template = get_option( 'template' );

		switch( $template ) {
			case 'twentyeleven' :
				echo '<div id="primary"><div id="content" role="main">';
				break;
			case 'twentytwelve' :
				echo '<div id="primary" class="site-content"><div id="content" role="main">';
				break;
			case 'twentythirteen' :
				echo '<div id="primary" class="site-content"><div id="content" role="main" class="entry-content twentythirteen">';
				break;
			case 'twentyfourteen' :
				echo '<div id="primary" class="content-area"><div id="content" role="main" class="site-content twentyfourteen"><div class="tfwc">';
				break;
			default :
				echo '<div id="container"><div id="content" role="main">';
				break;
		}
	}
	public function output_content_wrapper_end(){

		$template = get_option( 'template' );

		switch( $template ) {
			case 'twentyeleven' :
				echo '</div></div>';
				break;
			case 'twentytwelve' :
				echo '</div></div>';
				break;
			case 'twentythirteen' :
				echo '</div></div>';
				break;
			case 'twentyfourteen' :
				echo '</div></div></div>';
				get_sidebar( 'content' );
				break;
			default :
				echo '</div></div>';
				break;
		}


	}

	public function sidebar(){

		get_sidebar('lists');

	}

	public function add_list_meta(){
		global $post;

		echo '<div class="tl-single-meta-wrap">';

		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
		echo sprintf(__('Posted on','top-list').' '.'<span class="posted-on">%s</span>',
			sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
						esc_url( get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')) ),
						$time_string
					)
			);

		echo sprintf( '<span class="author vcard"> by <a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);

		$before = '<span class="tl-meta-block">';
		$sep = ', ';
		$after = '</span><!-- .tl-meta-block -->';
		echo get_the_term_list(
			$post->ID,
			TOP_LIST_TAX_TYPE_LIST_CATEGORY,
			$before.'<span class="tl-meta-label">'.__('Category','top-list').': </span><span class="tl-meta-value">',
			$sep,
			'</span>' . $after
    );
		echo get_the_term_list(
			$post->ID,
			TOP_LIST_TAX_TYPE_LIST_TAG,
			$before.'<span class="tl-meta-label">'.__('Tag','top-list').': </span><span class="tl-meta-value">',
			$sep,
			'</span>' . $after
    );

		echo '</div><!-- .tl-single-meta-wrap -->';

	}



}
