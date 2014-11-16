<?php

if ( ! function_exists('top_list_get_item_rank')) {
  function top_list_get_item_rank(){

    global $post;
    return $post->item_order;

  }
}

function top_list_get_template_part( $slug, $name = '' ) {

  $template = '';
  // Look in yourtheme/slug-name.php and yourtheme/top-list/slug-name.php
  if ( $name ) {
    $template = locate_template( array( "{$slug}-{$name}.php", TOP_LIST_SLUG . "/{$slug}-{$name}.php" ) );
  }

  // If template file doesn't exist, look in yourtheme/slug.php and yourtheme/top-list/slug.php
  // if ( ! $template ) {
  //   $template = locate_template( array( "{$slug}.php", TOP_LIST_SLUG . "/{$slug}.php" ) );
  // }

  if ( ! $template) {
    // include from plugin
    $template = TOP_LIST_TEMPLATES_DIR .'/'. "{$slug}-{$name}.php";
  }


  // Allow 3rd party plugin filter template file from their plugin
  $template = apply_filters( 'top_list_get_template_part', $template, $slug, $name );

  if ( $template ) {
    load_template( $template, false );
  }

}

function top_list_locate_template( $template_name, $template_path = '', $default_path = '' ) {

  $template_path = TOP_LIST_BASENAME;

  // Look within passed path within the theme - this is priority
  $template = locate_template(
    array(
      trailingslashit( $template_path ) . $template_name,
      $template_name
    )
  );

  if ( ! $template) {
    // include from plugin
    $template = TOP_LIST_TEMPLATES_DIR .'/'. $template_name;
  }

  // Return what we found
  return apply_filters('top_list_locate_template', $template, $template_name, $template_path);

}
