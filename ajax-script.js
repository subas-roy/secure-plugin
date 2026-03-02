jQuery(document).ready(function ($) {

  console.log("Loaded");

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
        console.log(response);
      },
    });
    
  });

});