<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'lists' ); ?>


<?php
  /**
   * top_list_before_main_content hook
   *
   * @hooked top_list_output_content_wrapper - 10 (outputs opening divs for the content)
   */
  do_action( 'top_list_before_main_content' );
?>

  <?php while ( have_posts() ) : the_post(); ?>

    <?php top_list_get_template_part( 'content', 'single-list' ); ?>

    <?php comments_template( '', true ); ?>

  <?php endwhile; // end of the loop. ?>

  <?php
    /**
     * top_list_after_main_content hook
     *
     * @hooked top_list_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action( 'top_list_after_main_content' );
  ?>

  <?php
   do_action( 'top_list_sidebar' );
   ?>


<?php get_footer( 'lists' ); ?>
