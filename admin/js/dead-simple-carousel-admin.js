(function($) {
  window.$ = $

  'use strict';

  function updateBindings() {
    $('.dscw .upload-button').unbind('click');
    $('.dscw .delete-button').unbind('click');
    $('.add-slide-button').unbind('click');

    $('.dscw .upload-button').click(function( event ){
      event.preventDefault();

      var $slide = $(this).parent().parent();

      var frame,
        addImageLink        = $slide.find('.upload-button'),
        deleteImageLink     = $slide.find('.delete-button'),
        imageContainer      = $slide.find('.thumbnail-image'),
        imageIdHiddenButton = $slide.find('.upload-id'),
        placeholder         = $slide.find('.placeholder');

      // If the media frame already exists, reopen it.
      if ( frame ) {
        frame.open();
        return;
      }
      
      // Create a new media frame
      frame = wp.media({
       title: 'Select or Upload Image',
       multiple: false
      });
      
      frame.on('select', function() {
        // Get media attachment details from the frame state
        var attachment = frame.state().get('selection').first().toJSON();

        // Send the attachment URL to our custom image input field.
        imageContainer.find('img').remove();
        imageContainer.append('<img src="'+attachment.url+'" alt="" style="max-width:100%;"/>');

        // Send the attachment id to our hidden input
        imageIdHiddenButton.val(attachment.url);

        // Force change event to auto-save widget in wordpress live view
        imageIdHiddenButton.change();

        placeholder.addClass('hidden');

        // Unhide the remove image link
        deleteImageLink.removeClass('hidden');
      });

      // Finally, open the modal on click
      frame.open();

      updateOrder();
    });
    
    $('.dscw .delete-button').click(function(event){
      event.preventDefault();

      var $slide = $(this).parent().parent();

      var frame,
        addImageLink        = $slide.find('.upload-button'),
        deleteImageLink     = $slide.find('.delete-button'),
        imageContainer      = $slide.find('.thumbnail-image'),
        imageIdHiddenButton = $slide.find('.upload-id'),
        placeholder         = $slide.find('.placeholder');

      // Clear out the preview image
      imageContainer.html('');

      // Un-hide the add image link
      addImageLink.removeClass('hidden');
      placeholder.removeClass('hidden');

      // Delete the image id from the hidden input
      imageIdHiddenButton.val('');

      var slidesCount = $slide.parent().parent().find('.slides-count').val();

      if ( slidesCount > 1 ) {
        // Decrement slide count
        slidesCount--;
        $('.slides-count').val(slidesCount);

        $slide.remove();
      }

      updateOrder();
    });

    $('.add-slide-button').click(function(event) {
      event.preventDefault();
      
      var slidesID = '.' + $(this).attr("id");
      var slidesCount = $('.slides-count').val();
      slidesCount++;
      $('.slides-count').val(slidesCount);

      // Get prop values
      var $slide = $('.dscw ' + slidesID + ' .slide:last');
      var name = $slide.find('input[type="hidden"]').prop('name');
      var id = $slide.find('input[type="hidden"]').prop('id');
      var number = parseInt(name.match(/image(\d+)/)[1]);

      name = name.replace(/image\d+\]/, 'image'+(number+1)+']');
      id = id.replace(/image\d+$/, 'image'+(number+1));

      var $clone = $slide.clone();

      // Clear changes      
      $clone.find('input[type="hidden"]').prop('name', name);
      $clone.find('input[type="hidden"]').prop('id', id);
      $clone.find('img').prop('src', '');
      $clone.find('.upload-button').removeClass('hidden');
      $clone.find('.placeholder').removeClass('hidden');
      $clone.find('.upload-id').val('');
      $clone.find('.thumbnail-image').html('');
      $clone.find('input[type="checkbox"]').replaceNumber(number, number+1).removeAttr('checked');
      $clone.find('input[name*="url"]').replaceNumber(number, number+1).val('');

      $slide.after( $clone );

      updateBindings();
    });
  }


  $.fn.replaceNumber = function (old_number, new_number) {
    var field = parseFieldName(this.attr('name'));
    field.name = field.name.replace(old_number, new_number); 
    this.attr('name', getFieldName(field));

    field = parseFieldID(this.attr('id'));
    field.name = field.name.replace(old_number, new_number); 
    this.attr('id', getFieldID(field));

    if(this.attr('type') == 'checkbox' && this.parent().prop('tagName') == 'LABEL') {
      this.parent().attr('for', getFieldID(field));
    }

    return this;
  }

  function updateOrder() {
    $('.dscw').each(function() {
      var slidesCount;

      $(this).find('.slide').each(function(index, el) {
        setSlideID($(this), index+1);
        slidesCount = index+1;
      });

      $(this).find('.slides-count').val(slidesCount);
    });
  }

  function getSlideID($slide) {
    var name = $slide.find('input[type="hidden"]').prop('name');
    var number = parseInt(name.match(/image(\d+)/)[1]);
    return number;
  }

  function setSlideID($slide, newID) {
    var $image = $slide.find('input[type="hidden"]');
    var image = parseFieldName($image.attr('name'));
    var oldID = parseInt(image.name.match(/(\d+)/)[1]);
  
    $image.replaceNumber(oldID, newID);
    $slide.find('input[type="checkbox"]').replaceNumber(oldID, newID);
    $slide.find('input[name*="url"]').replaceNumber(oldID, newID);
  }

  // https://developer.wordpress.org/reference/classes/wp_widget/get_field_name/
  function parseFieldName(name) {
    var matches = name.match(/widget-(\w+)\[(\w+)\]\[(\w+)\]/);

    return {
      widget: {
        name: matches[1],
        ID: matches[2]
      },
      name: matches[3]
    };
  }

  function getFieldName(field) {
    return 'widget-'+field.widget.name+'['+field.widget.ID+']['+field.name+']';
  }

  function parseFieldID(ID) {
    var matches = ID.match(/widget-(\w+)-(\w+)-(\w+)/);

    return {
      widget: {
        name: matches[1],
        ID: matches[2]
      },
      name: matches[3]
    };
  }

  function getFieldID(field) {
    return 'widget-'+field.widget.name+'-'+field.widget.ID+'-'+field.name;
  }

  $(function() {

    updateBindings();

    $('.slides').each(function(index, el) {
      Sortable.create(el, {
        draggable: '.slide',
        animation: 150,
        onSort: function () {
          updateOrder();
        }
      });
    });
    
  });

  $(document).on('widget-updated widget-added', function() {
    updateBindings();

    $('.slides').each(function(index, el) {
      Sortable.create(el, {
        draggable: '.slide',
        animation: 150,
        onSort: function () {
          updateOrder();
        }
      });
    });
  });

})( jQuery );
