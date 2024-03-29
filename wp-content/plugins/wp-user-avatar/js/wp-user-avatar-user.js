jQuery(function($) {
  // Add enctype to form with JavaScript as backup
  $('#your-profile').attr('enctype', 'multipart/form-data');
  // Store WP User Avatar ID
  var wpuaID = $('#wp-user-avatar').val();
  // Store WP User Avatar src
  var wpuaSrc = $('#wpua-preview').find('img').attr('src');
  // Remove WP User Avatar
  $('body').on('click', '#wpua-remove', function(e) {
    e.preventDefault();
    $('#wpua-original').remove();
    $('#wpua-remove-button, #wpua-thumbnail').hide();
    $('#wpua-preview').find('img:first').hide();
    $('#wpua-preview').prepend('<img id="wpua-original" />');
    $('#wpua-original').attr('src', wpua_custom.avatar_thumb);
    $('#wp-user-avatar').val("");
    $('#wpua-original, #wpua-undo-button').show();
    $('#wp_user_avatar_radio').trigger('click');
  });
  // Undo WP User Avatar
  $('body').on('click', '#wpua-undo', function(e) {
    e.preventDefault();
    $('#wpua-original').remove();
    $('#wpua-images').removeAttr('style');
    $('#wpua-undo-button').hide();
    $('#wpua-remove-button, #wpua-thumbnail').show();
    $('#wpua-preview').find('img:first').attr('src', wpuaSrc).show();
    $('#wp-user-avatar').val(wpuaID);
    $('#wp_user_avatar_radio').trigger('click');
  });
});
