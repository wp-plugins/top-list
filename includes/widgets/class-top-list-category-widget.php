<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Top_List_Category_Widget extends WP_Widget{

  public function __construct() {
    $widget_ops = array( 'classname' => 'widget_top_list_categories', 'description' => __( "A list or dropdown of Top List categories." ) );
    parent::__construct('top_list_categories', __('[Top List] Categories'), $widget_ops);
  }

    public function widget( $args, $instance ) {

      $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base );

      $c = ! empty( $instance['count'] ) ? '1' : '0';
      $h = ! empty( $instance['hierarchical'] ) ? '1' : '0';

      echo $args['before_widget'];
      if ( $title ) {
        echo $args['before_title'] . $title . $args['after_title'];
      }

      $cat_args = array(
        'orderby'      => 'name',
        'show_count'   => $c,
        'hierarchical' => $h,
        'taxonomy'     => TOP_LIST_TAX_TYPE_LIST_CATEGORY,
      );

  ?>
      <ul>
  <?php
      $cat_args['title_li'] = '';

      wp_list_categories( apply_filters( 'widget_top_list_categories_args', $cat_args ) );
  ?>
      </ul>
  <?php

      echo $args['after_widget'];
    }

    public function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['count'] = !empty($new_instance['count']) ? 1 : 0;
      $instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;

      return $instance;
    }

    public function form( $instance ) {
      //Defaults
      $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
      $title = esc_attr( $instance['title'] );
      $count = isset($instance['count']) ? (bool) $instance['count'] :false;
      $hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
  ?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

      <p>
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
      <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts' ); ?></label><br />

      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked( $hierarchical ); ?> />
      <label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy' ); ?></label></p>
  <?php
    }

}
