<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
  /**
   * top_list_before_single_list hook
   *
   */
   do_action( 'top_list_before_single_list' );

   if ( post_password_required() ) {
    echo get_the_password_form();
    return;
   }
?>

<div id="list-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

  <?php
    do_action( 'top_list_single_after_header' );
   ?>
  </header><!-- .entry-header -->

  <div class="entry-content">

    <?php if ( has_post_thumbnail()) : ?>
      <div class="list-post-thumbnail-wrapper">
        <?php the_post_thumbnail(); ?>
      </div>
    <?php endif; ?>

  <?php the_content(); ?>

  <?php do_action('top_list_before_lists'); ?>
  <?php do_action('top_list_display_lists'); ?>
  <?php do_action('top_list_after_lists'); ?>

  </div><!-- .entry-content -->


</div><!-- #list-<?php the_ID(); ?> -->


<?php do_action( 'top_list_after_single_list' ); ?>
