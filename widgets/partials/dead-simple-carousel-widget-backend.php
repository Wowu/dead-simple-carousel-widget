<div class="dscw">
  <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>">
      <?php _e( 'Title:', 'dead-simple-carousel'); ?>
    </label>

    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
  </p>

  <p>
    <label for="<?php echo $this->get_field_id( 'slide_time' ); ?>">
      <?php _e( 'Slide duration: (ms)', 'dead-simple-carousel'); ?>
    </label>

    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'slide_time' ); ?>" name="<?php echo $this->get_field_name( 'slide_time' ); ?>" value="<?php echo esc_attr( $slide_time ); ?>" />
  </p>

  <input class="slides-count" type="hidden" name="<?php echo $this->get_field_name( 'slides_count' ); ?>" id="<?php echo $this->get_field_id( 'slides_count' ); ?>" value="<?php echo $slides_count; ?>">
  
  <div class="slides <?php echo $this->id; ?>">
    <?php for ( $i = 1; $i <= $slides_count; $i++ ) : ?>
      <?php
        $image[$i] = isset( $instance['image'.$i] ) ? $instance['image'.$i] : '';
        $url[$i] = isset( $instance['url'.$i] ) ? $instance['url'.$i] : '';
      ?>

      <div class="slide slide-<?php echo $i; ?> cf">

        <?php if ( $image[$i] ) : ?>
          <div class="thumbnail thumbnail-image">
            <img src="<?php echo $image[$i]; ?>" style="max-width: 100%"/>
          </div>

          <div class="placeholder hidden">
            <?php _e( 'No image selected', 'dead-simple-carousel' ); ?>
          </div>
        <?php else: ?>
          <div class="thumbnail thumbnail-image"></div>

          <div class="placeholder">
            <?php _e( 'No image selected', 'dead-simple-carousel' ); ?>
          </div>
        <?php endif; ?>

        <div class="url-box">
          <p>
            <label for="<?php echo $this->get_field_id( 'url'.$i ); ?>">
              <?php _e( 'Image hyperlink:', 'dead-simple-carousel'); ?>
            </label>

            <input type="text" class="widefat" placeholder="http(s)://" id="<?php echo $this->get_field_id( 'url'.$i ); ?>" name="<?php echo $this->get_field_name( 'url'.$i ); ?>" value="<?php echo esc_attr( $url[$i] ); ?>" />
          </p>

          <p>
            <label for="<?php echo $this->get_field_id( 'new_tab'.$i ); ?>">
              <input type="checkbox" id="<?php echo $this->get_field_id( 'new_tab'.$i ); ?>" name="<?php echo $this->get_field_name( 'new_tab'.$i ); ?>" <?php checked( $instance['new_tab'.$i], 'on' ); ?> />

              <?php _e( 'Open link in new tab?', 'dead-simple-carousel' ); ?>
            </label>
          </p>
        </div>

        
        <div class="actions cf">
            <button type="button" class="button delete-button alignleft"><?php _e('Remove', 'dead-simple-carousel'); ?></button>
            <button type="button" class="button upload-button alignright"><?php _e('Select Image', 'dead-simple-carousel'); ?></button>
            
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