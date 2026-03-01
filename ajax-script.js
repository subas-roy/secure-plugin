jQuery(document).ready(function($) {
  
  $('#secure-plugin-form').on('submit', function(e) {
    e.preventDefault();
    
    $.ajax({
      url: siteInfo.ajaxUrl,
      type: 'POST',
      data: {
        action: 'secure_plugin_ajax',
        nonce: siteInfo.nonce,
        form_data: $(this).serialize()
      },
      success: function(response) {
        console.log(response);
      }
    });
  });

});