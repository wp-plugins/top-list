var file_frame;

(function( $ ) {
	'use strict';


	 $(function() {

	 	// Sortable
	 	$( "#main-tl-list-wrap" ).sortable();

	 	// Remove button handler
	 	$(document).on('click','button.btn-remove-tl-list-item', function(e){

	 		e.preventDefault();
	 		// Confirmation
	 		var confirmation = confirm("Are you sure?");
	 		if( ! confirmation ){
	 			return false;
	 		}

	 		var $this = $(this);
	 		var $wrap = $this.parent().parent().parent('.list-item-wrap');
	 		var item_id = $this.data('item_id');
	 		$wrap.fadeOut('slow',function(){
        $wrap.remove();
      });

	 		if( '' !== item_id ){
	 			// old item; remove from database also
	 			var dataObj = new Object();
	 			dataObj.action = "top_list_ajax_remove_list_item";
	 			dataObj.id = item_id;
	 			dataObj.parent_id = jQuery('#parent_list_id').val();
	 			$.ajax({
	 				url: ajaxurl,
	 				type: 'POST',
	 				data: dataObj

 				});

	 		}

	 	})

	 	// Add Handler
	 	$('input.btn-add-tl-list-item').on('click', function(e){
	 		e.preventDefault();
	 		var $item = $('<div></div>');
	 		$item.addClass('list-item-wrap');

	 		// Nav Bar
	 		var $nav_bar = $('<div></div>');
	 		$nav_bar.addClass('tl-item-mav-bar');
	 		$nav_bar.append('<div class="tl-nav-bar-left"></div>');
	 		$nav_bar.append('<div class="tl-nav-bar-right"><button class="btn-remove-tl-list-item" data-item_id=""><span class="dashicons dashicons-no-alt"></span></button></div>');
	 		$item.append($nav_bar);

	 		// Title
	 		var $title = $('<div></div>');
	 		$title.addClass('tl-form-row');
	 		$title.append('<label><strong>Title</strong></label>');
	 		$title.append('<input type="text" class="txt-tl-title regular-text code" placeholder="Enter Title" name="list_title[]" />');
	 		$item.append($title);

	 		// Image
	 		var $image = $('<div></div>');
	 		$image.addClass('tl-form-row');
	 		$image.append('<label for=""><strong>Image</strong></label>');
	 		$image.append('<input type="hidden" name="list_image[]" value=""  class="txt-tl-image regular-text code" />');
	 		$image.append('<input type="button" class="tl-select-img button button-primary" value="Upload" data-uploader_button_text="Select" data-uploader_title="Select Image" />');
	 		$image.append('<div class="image-preview-wrap" style="display:none;" ><img class="img-preview" /><a href="#" class="btn-tl-remove-image-upload"><span class="dashicons dashicons-no"></span></a></div>');
	 		$item.append($image);

	 		// Description
	 		var $description = $('<div></div>');
	 		$description.addClass('tl-form-row')
	 		$description.append('<label><strong>Description</strong></label>');
	 		var temp_id = '_list_description_';
	 		var rand_number = Math.round(Math.random()*1000) + 1;
	 		temp_id += rand_number + 'a';

	 		$description.append('<textarea name="list_description[]" class="tl-textarea" placeholder="Enter Description" cols="30" rows="6" style="width:100%;" id="'+temp_id+'" />');
	 		$item.append($description);

	 		$item.appendTo('#main-tl-list-wrap');
	 		$('.txt-tl-title').focus();

	 		var settings = {
	 		    id : temp_id
	 		}
	 		quicktags(settings);
	 		QTags._buttonsInit();
	 	});

			// Uploads

			jQuery(document).on('click', 'input.tl-select-img', function( event ){

			  var $this = $(this);

			  event.preventDefault();

			  // If the media frame already exists, reopen it.
			  // if ( file_frame ) {
			  //   file_frame.open();
			  //   return;
			  // }

			  // Create the media frame.
			  file_frame = wp.media.frames.file_frame = wp.media({
			    title: jQuery( this ).data( 'uploader_title' ),
			    button: {
			      text: jQuery( this ).data( 'uploader_button_text' ),
			    },
			    multiple: false  // Set to true to allow multiple files to be selected
			  });



			  // When an image is selected, run a callback.
			  file_frame.on( 'select', function() {
			    // We set multiple to false so only get one image from the uploader
			    var attachment = file_frame.state().get('selection').first().toJSON();
			    var image_field = $this.siblings('.txt-tl-image');
			    var imgurl = attachment.url;
			    image_field.val(attachment.id);
			    var image_preview_wrap = $this.siblings('.image-preview-wrap');
			    image_preview_wrap.show();
			    image_preview_wrap.find('.img-preview').attr('src',attachment.url);

			  });

			  // Finally, open the modal
			  file_frame.open();
			});


			// Remo upload button handler
			$(document).on('click', 'a.btn-tl-remove-image-upload', function(evt){
			  evt.preventDefault();
			  var $this = $(this);

			  var image_field_temp = $this.parent().parent().parent().find('input.txt-tl-image');
			  var image_preview_wrap = $this.parent().parent().parent().find('.image-preview-wrap');
			  var cur_image_value = image_field_temp.val();

			  image_field_temp.val('');
			  image_preview_wrap.fadeOut('slow',function(){
				  image_preview_wrap.hide();
				  image_preview_wrap.find('.img-preview').attr('src','');
			  });
			  return;
			});



		// do not touch below

 	 });


})( jQuery );
