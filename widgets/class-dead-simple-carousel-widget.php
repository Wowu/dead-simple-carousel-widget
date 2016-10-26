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
      $title = apply_filters( 'widget_title', $instance['title'] );
      // before and after widget arguments are defined by themes
      echo $args['before_widget'];
      if ( ! empty( $title ) )
      echo $args['before_title'] . $title . $args['after_title'];

      $slides_count = $instance['slides_count'];

      ?>

        <div class="dscw" data-speed="2000">
          
          <div class="dscw__slides">
            <?php for ( $i = 1; $i <= $slides_count; $i++ ) : ?>
                <img class="dscw__slides__image" src="<?php echo $instance['image'.$i]; ?>" />
            <?php endfor; ?>
          </div>

        </div>

      <?php

      echo $args['after_widget'];
    }

    // Widget Backend
    public function form( $instance ) {
      $title         = isset( $instance['title'] ) ? $instance['title'] : __( 'New title', 'dead-simple-carousel' );
      $slides_count  = isset( $instance['slides_count'] ) ? $instance['slides_count'] : 1;

      ?>
        <?php // dsc - Dead Simple Carousel Widget ?>
        <div class="dscw">
          <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input 
              type="text" 
              class="widefat" 
              id="<?php echo $this->get_field_id( 'title' ); ?>" 
              name="<?php echo $this->get_field_name( 'title' ); ?>" 
              value="<?php echo esc_attr( $title ); ?>" 
              />

            <input class="slides-count" type="hidden" name="<?php echo $this->get_field_name( 'slides_count' ); ?>" id="<?php echo $this->get_field_id( 'slides_count' ); ?>" value="<?php echo $slides_count; ?>">
          </p>
          
          <div class="slides <?php echo $this->id; ?>">
            <?php for ( $i = 1; $i <= $slides_count; $i++ ) : ?>
              <?php 
                $image[$i] = isset( $instance['image'.$i] ) ? $instance['image'.$i] : '';
              ?>
              <div class="slide slide-<?php echo $i; ?> cf">

                <?php if ( $image[$i] ) : ?>
                  <div class="thumbnail thumbnail-image">
                    <img src="<?php echo $image[$i]; ?>" style="max-width: 100%"/>
                  </div>

                  <div class="placeholder hidden">
                    <?php _e( 'No image selected' ); ?>
                  </div>
                <?php else: ?>
                  <div class="thumbnail thumbnail-image"></div>

                  <div class="placeholder">
                    <?php _e( 'No image selected' ); ?>
                  </div>
                <?php endif; ?>
                
                <div class="actions cf">
                    <button type="button" class="button delete-button alignleft"><?php _e('Remove', 'viral'); ?></button>
                    <button type="button" class="button upload-button alignright"><?php _e('Select Image', 'viral'); ?></button>
                    
                    <input name="<?php echo $this->get_field_name( 'image'.$i ); ?>" id="<?php echo $this->get_field_id( 'image'.$i ); ?>" class="upload-id" type="hidden" value="<?php echo esc_url($image[$i]) ?>"/>
                </div>
              </div>
            <?php endfor; ?>
          </div>
          <p>
            <button id="<?php echo $this->id; ?>" class="add-slide-button button widefat ">
              <i class="fa fa-plus"></i>
            </button>
          </p>
        </div>
      <?php
    }

    public function update( $new_instance, $old_instance ) {
      $instance = array();
      $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
      $instance['slides_count'] = ( ! empty( $new_instance['slides_count'] ) ) ? strip_tags( $new_instance['slides_count'] ) : '';

      for ( $i = 1; $i <= $instance['slides_count']; $i++ ) {
        $instance['image'.$i] = ( ! empty( $new_instance['image'.$i] ) ) ? strip_tags( $new_instance['image'.$i] ) : '';
      }

      return $instance;
    }

  } // Class wpb_widget ends here

  // Register and load the widget
  function wpb_load_widget() {
    register_widget( 'dead_simple_carousel_widget' );
  }

  add_action( 'widgets_init', 'wpb_load_widget' );
