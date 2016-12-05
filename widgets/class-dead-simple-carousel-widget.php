<?php
  class dead_simple_carousel_widget extends WP_Widget {

    function __construct() {
      parent::__construct(
        // Base ID of your widget
        'dead_simple_carousel',

        // Widget name will appear in UI
        __('Dead Simple Carousel Widget', 'dead-simple-carousel'),

        // Widget description
        array( 'description' => __( 'Simple widget for displaying images', 'dead-simple-carousel' ), )
      );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
      $title = isset( $instance['title'] ) ? $instance['title'] : ''; 
      $title = apply_filters( 'widget_title', $title );
      // before and after widget arguments are defined by themes
      echo $args['before_widget'];
      if ( ! empty( $title ) )
      echo $args['before_title'] . $title . $args['after_title'];

      $slides_count = isset( $instance['slides_count'] ) ? $instance['slides_count'] : 0;

      $data['instance'] = $instance;
      $data['slides_count'] = $slides_count;

      Timber::render('partials/dead-simple-carousel-widget-frontend.twig', $data);

      echo $args['after_widget'];
    }

    // Widget Backend
    public function form( $instance ) {
      $title         = isset( $instance['title'] ) ? $instance['title'] : __( 'New title', 'dead-simple-carousel' );
      $slides_count  = isset( $instance['slides_count'] ) ? $instance['slides_count'] : 1;
      $slide_time  = isset( $instance['slide_time'] ) ? $instance['slide_time'] : 3000;

      $data = array(
        'id' => $this->id,

        'title' => array(
          'text' => $title,
          'id' => $this->get_field_id( 'title' ),
          'name' => $this->get_field_name( 'title' ),
        ),
      
        'slides_count' => array(
          'count' => $slides_count,
          'id' => $this->get_field_id( 'slides_count' ),
          'name' => $this->get_field_name( 'slides_count' ),
        ),

        'slide_time' => array(
          'time' => $slide_time,
          'id' => $this->get_field_id( 'slide_time' ),
          'name' => $this->get_field_name( 'slide_time' ),
        ),

        'image' => array(),
      );

      for ( $i = 1; $i <= $slides_count; $i++ ) {
        $image = array(
          'name' => $this->get_field_name( 'image'.$i ),
          'id' => $this->get_field_id( 'image'.$i ),
          'src' => isset( $instance['image'.$i] ) ? $instance['image'.$i] : null,
          'url' => array(
            'url' => isset( $instance['url'.$i] ) ? $instance['url'.$i] : '',
            'id' => $this->get_field_id( 'url'.$i ),
            'name' => $this->get_field_name( 'url'.$i ),
          ),
          'new_tab' => array(
            'id' => $this->get_field_id( 'new_tab'.$i ),
            'name' => $this->get_field_name( 'new_tab'.$i ),
            'checked' => isset( $instance['new_tab'.$i] ) ? 'checked="checked"' : '',
          )
        );

        $data['image'][$i] = $image;
      }

      Timber::render( 'partials/dead-simple-carousel-widget-backend.twig', $data);

      // DEBUG
      // echo '<pre>';
      // var_dump($instance);
      // var_dump($data);
      // echo '</pre>';
    }

    public function update( $new_instance, $old_instance ) {
      $instance = array();
      $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
      $instance['slides_count'] = ( ! empty( $new_instance['slides_count'] ) ) ? strip_tags( $new_instance['slides_count'] ) : '';
      $instance['slide_time'] = ( ! empty( $new_instance['slide_time'] ) ) ? strip_tags( $new_instance['slide_time'] ) : '';

      for ( $i = 1; $i <= $instance['slides_count']; $i++ ) {
        $instance['image'.$i] = ( ! empty( $new_instance['image'.$i] ) ) ? strip_tags( $new_instance['image'.$i] ) : '';
        $instance['url'.$i] = ( ! empty( $new_instance['url'.$i] ) ) ? strip_tags( $new_instance['url'.$i] ) : '';
        $instance['new_tab'.$i] = $new_instance['new_tab'.$i];
      }

      return $instance;
    }

  } // Class wpb_widget ends here

  // Register and load the widget
  function wpb_load_widget() {
    register_widget( 'dead_simple_carousel_widget' );
  }

  add_action( 'widgets_init', 'wpb_load_widget' );
