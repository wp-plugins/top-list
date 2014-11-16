<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://www.nilambar.net
 * @since      1.0.0
 *
 * @package    Top_List
 * @subpackage Top_List/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Top_List
 * @subpackage Top_List/admin
 * @author     Nilambar Sharma <nilambar@outlook.com>
 */
class Top_List_Admin {

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
	 * @var      string    $plugin_name       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Top_List_Admin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Top_List_Admin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/top-list-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'jqueryui-style', '//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Top_List_Admin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Top_List_Admin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script('jquery-ui-sortable');

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/top-list-admin.js', array( 'jquery','quicktags', 'jquery-ui-core' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . '-ajax', plugin_dir_url( __FILE__ ) . 'js/top-list-admin-ajax.js', array( 'jquery','quicktags', 'jquery-ui-core' ), $this->version, false );

	}

	public function top_list_add_list_meta_box(){

		$screens = array( TOP_LIST_POST_TYPE_LIST );

		foreach ( $screens as $screen ) {

			add_meta_box(
				'top_list_content_id',
				__( 'List Content', 'top-list' ),
				array($this,'top_list_content_meta_box_callback'),
				$screen
			);
		}

	}

	public function top_list_content_meta_box_callback( $post ){

		$list_items_ids = get_post_meta( $post->ID, '_list_items', true );
		// nspre($list_items_ids,'list_items_ids',false,false);
		$item_count_total = 0;
		if (!empty($list_items_ids)){
			$item_count_total = count($list_items_ids);
		}

		?>
		<div id="main-tl-list-wrap" data-item_count_total="<?php echo $item_count_total; ?>">
			 <p><input type="button" value="Add New" class="button button-primary btn-add-tl-list-item" /></p>
				<?php wp_nonce_field( plugin_basename( __FILE__ ), 'top_list_content_nonce' ); ?>
				<input type="hidden" name="parent_list_id" id="parent_list_id" value="<?php echo esc_attr($post->ID); ?>" />
				<hr />

		<?php if (!empty($list_items_ids)): ?>

			<?php $icount = 1; ?>
			<?php foreach ($list_items_ids as $key => $item): ?>
				<?php
					$item_post = get_post($item);
				 ?>

				 <div class="list-item-wrap list-item-wrap-<?php echo esc_attr($item_post->ID); ?>">

				 <div class="tl-item-mav-bar">
					 <div class="tl-nav-bar-left">
					 	<span class="tl-item-reference"><?php echo $icount; ?></span>
					 </div><!-- .tl-nav-bar-left -->
					 <div class="tl-nav-bar-right">
					 	<button class="btn-remove-tl-list-item" data-item_id="<?php echo esc_attr($item_post->ID); ?>"><span class="dashicons dashicons-no-alt"></span></button>
					 </div><!-- .tl-nav-bar-right -->

				 </div><!-- .tl-item-mav-bar -->


					 <input type="hidden" name="list_item_id[]" value="<?php echo esc_attr($item_post->ID); ?>" />
						<div class="tl-form-row">
							<label for=""><strong><?php _e( 'Title', 'top-list' ); ?></strong></label>
							<input type="text" name="list_title[]" value="<?php echo esc_attr($item_post->post_title); ?>" placeholder="<?php _e( 'Enter Title', 'top-list' ); ?>" class="txt-tl-title regular-text code" />
						</div>

						<?php

							$thumbnail_url = '';
							$thumbnail_id = get_post_meta($item_post->ID,'_thumbnail_id',true);
							if ($thumbnail_id) {
								$thumbnail_url = wp_get_attachment_thumb_url( $thumbnail_id );
							}

						?>
						<div class="tl-form-row">


							<label for=""><strong><?php _e( 'Image', 'top-list' ); ?></strong></label>
							<input type="hidden" name="list_image[]" value="<?php echo esc_attr( $thumbnail_id ); ?>"  class="txt-tl-image regular-text code" />
							<input type="button" class="tl-select-img button button-primary" value="<?php _e( 'Upload', 'top-list' ); ?>" data-uploader_button_text="Select" data-uploader_title="Select Image" />
							<?php
								$style_text="display:none;";
								if ( !empty($thumbnail_url)) {
									$style_text = '';
								}
							 ?>
							<div class="image-preview-wrap" style="<?php echo $style_text; ?>" >
								<img class="img-preview" alt="<?php _e( 'Preview', 'top-list' ); ?>" src="<?php echo $thumbnail_url; ?>" />
								<a href="#" class="btn-tl-remove-image-upload">
									<span class="dashicons dashicons-no"></span>
								</a>
							</div>

						</div>

						<div class="tl-form-row">
							<label for=""><strong><?php _e( 'Description', 'top-list' ); ?></strong></label>
						  <textarea name="list_description[]" id="<?php echo '_list_description_'.$item_post->ID; ?>" cols="30" rows="6" style="width:100%;" class="tl-textarea"  placeholder="<?php _e( 'Enter Description', 'top-list' ); ?>" ><?php echo $item_post->post_content; ?></textarea>
						</div>

				 </div><!-- .list-item-wrap -->
				 <?php $icount++; ?>
			<?php endforeach ?>


		<?php endif ?>

		</div><!-- #main-tl-list-wrap -->

	  <?php

	}

	public function top_list_save_post( $post_id ){

		if ( TOP_LIST_POST_TYPE_LIST != get_post_type($post_id) ) {
			return $post_id;
		}

		// Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // if our nonce isn't there, or we can't verify it, bail
    if ( !isset( $_POST['top_list_content_nonce'] ) || !wp_verify_nonce( $_POST['top_list_content_nonce'], plugin_basename( __FILE__ ) ) )
        return $post_id;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' , $post_id ) )
    	return $post_id;

    $list_item_ids = array();
		$list_title_array = $_POST['list_title'];

		// Update item posts
		foreach ($list_title_array as $key => $title) {
			if (empty($title)) {
				continue;
			}
			$my_post = array(
				'post_title'   => sanitize_text_field($title),
				'post_content' => $_POST['list_description'][$key],
				'post_type'    => TOP_LIST_POST_TYPE_LIST_ITEM,
				'post_status'  => 'publish',
				);
			$cur_id = '';
			if (isset($_POST['list_item_id'][$key])) {
				$cur_id = $_POST['list_item_id'][$key];
			}
			if ( is_string( get_post_status( $cur_id ) ) ) {
				// Post exist
				$my_post['ID'] = $cur_id;
				$temp_id = wp_insert_post($my_post);
				$list_item_ids[] = $temp_id;
			}
			else{
				// new post
				$temp_id = wp_insert_post($my_post);
				$list_item_ids[] = $temp_id;
			}

			// Update featured image
			if (isset($_POST['list_image'][$key]) && intval($_POST['list_image'][$key]) > 0 ) {
				update_post_meta($temp_id,'_thumbnail_id',intval($_POST['list_image'][$key]));
			}
			else{
				delete_post_meta($temp_id,'_thumbnail_id');
			}

		}
		// Update list_items
		update_post_meta( $post_id, '_list_items', $list_item_ids );

		// Update parent meta for each list item
		if (!empty($list_item_ids)) {
			foreach ($list_item_ids as $key => $item) {
				update_post_meta( $item, '_parent_list_id', $post_id );
			}
		}

		// Updating menu order of list item
		if (!empty($list_item_ids)) {
			global $wpdb;
			$sql = 'UPDATE '.$wpdb->posts.' SET menu_order = CASE ID ';
			$cnt = 1;
			foreach ($list_item_ids as $key => $item) {
			    $sql .= sprintf("WHEN %d THEN %d ", $item, $cnt);
			    $cnt++;
			}
			$sql .= ' END WHERE ID IN ('.implode(',',$list_item_ids).')';
			$wpdb->query($sql);
		}



	}


	public function top_list_admin_print_footer_scripts(){

		$screen= get_current_screen();
		if ( TOP_LIST_POST_TYPE_LIST != $screen->id) {
		  return;
		}

		?><script type="text/javascript">/* <![CDATA[ */
    jQuery(function($)
    {
        $('textarea.tl-textarea').each(function(e) {
            settings = {
                id : $(this).attr('id')
            }
            quicktags(settings);
         });

	  });
/* ]]> */</script>
		<?php

	}

	public function ajax_cb_top_list_ajax_remove_list_item(){

		$output = array();
		$output['success'] = 0;
		// TEST
		// wp_send_json( $output );
		// TEST
		$id        = intval($_POST['id']);
		$parent_id = intval($_POST['parent_id']);
		$post_obj = get_post($id);
		if ( $id < 1 || empty($post_obj)) {
			$output['message'] =__('Invalid ID','top-list');
			return $output;
		}
		if ( TOP_LIST_POST_TYPE_LIST_ITEM != $post_obj->post_type) {
			$output['message'] = __('Error','top-list');
			return $output;
		}

		if( wp_delete_post( $post_obj->ID, true ) ){

			$output['success'] = 1;
			$output['message'] = __('Removed Successfully','top-list');

			// Remove in parent ID's meta
			if ($parent_id) {
				$list_item_ids = get_post_meta( $parent_id, '_list_items', true );
				$list_item_ids = array_diff( $list_item_ids, array( $id ) );
				update_post_meta( $parent_id, '_list_items', $list_item_ids );
			}

		}

		wp_send_json( $output );

	}

}
