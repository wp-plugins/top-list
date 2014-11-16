<div class="top-list-item-wrap">
  <div class="item-heading">
    <div class="item-heading-left">
      <span class="item-number"><?php echo top_list_get_item_rank(); ?></span>
    </div><!-- .item-heading-left -->
    <div class="item-heading-right">
      <div class="item-title">
        <?php the_title(); ?>
      </div>
    </div><!-- .item-heading-right -->
  </div>
  <div class="item-description">
    <?php if ( has_post_thumbnail()) : ?>
      <div class="list-thumbnail-wrapper">
        <?php the_post_thumbnail(); ?>
      </div>
    <?php endif; ?>
    <?php the_content(); ?>
  </div><!-- .item-description -->

</div><!-- .top-list-item-wrap -->
