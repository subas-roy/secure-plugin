<?php
$saved_data = get_option('secure_plugin_data');
// Display the saved data if it exists, using esc_html to escape the output for security. This prevents potential XSS attacks by ensuring that any HTML tags in the data are rendered as plain text rather than being executed as code.
if (!empty($saved_data)) {
  echo "<div>";
  echo 'Name:' . esc_html($saved_data['name']) . '<br>';
  echo 'Email:' . esc_html($saved_data['email']) . '<br>';
  echo 'Age:' . esc_html($saved_data['age']) . '<br>';
  echo 'Message:' . esc_html($saved_data['message']) . '<br>';
  echo "</div>";
}
?>


<form id="secure-plugin-form" method="post">
  <input type="text" name="name" placeholder="Your Name">
  <input type="email" name="email" placeholder="Your Email">
  <input type="number" name="age" placeholder="Your Age">
  <textarea name="message" placeholder="Write your message" rows="5" cols="30"></textarea>
  <input type="submit" name="secure_form_submit" value="Submit">
</form>