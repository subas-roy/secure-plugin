jQuery(document).ready(function ($) {

  // console.log(siteInfo); // Log the siteInfo object to verify that it contains the expected data

  $("#secure-plugin-form").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      type: "POST",
      url: siteInfo.ajaxUrl,
      data: {
        action: "secure_plugin_ajax",
        nonce: siteInfo.nonce,
        form_data: $(this).serialize(),
      },
      success: function (response) {
        $("#secure-plugin-form").trigger('reset'); // Reset the form after successful submission
        // console.log(response); // Log the response from the server to verify that the AJAX request was successful
      },
    });
    
  });

});