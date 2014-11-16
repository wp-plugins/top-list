<?php
class Top_List_Widgets {

  private $plugin_name;
  private $version;

  public function __construct( $plugin_name, $version ) {

    $this->plugin_name = $plugin_name;
    $this->version = $version;

  }

  public function register_widgets(){

    require plugin_dir_path( __FILE__ ) . '/widgets/class-top-list-category-widget.php';

    register_widget('Top_List_Category_Widget');

  }


}
