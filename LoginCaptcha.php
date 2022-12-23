<?php
/*
 Plugin Name: Login Captcha
 Plugin URI: https://example.com/login-captcha
 Description: A plugin that adds a login captcha to the login form.
 Version: 1.0
 Author: Your Name
 Author URI: https://example.com
 License: GPL2
*/

// Add captcha to login form
function login_captcha_form() {
    echo '<p>';
    echo '<label for="login_captcha">Captcha:</label><br />';
    echo '<input type="text" name="login_captcha" id="login_captcha" class="input" value="" size="20" />';
    echo '</p>';
}
add_action( 'login_form', 'login_captcha_form' );

// Validate captcha on login form submission
function login_captcha_validate($user, $password) {
    if (isset($_POST['login_captcha'])) {
        $captcha = sanitize_text_field($_POST['login_captcha']);
    }
    if (empty($captcha)) {
        return new WP_Error('empty_captcha', __('<strong>ERROR</strong>: You must enter a captcha value.'));
    }
    if ($captcha != '12345') { // Change this value to your desired captcha value
        return new WP_Error('invalid_captcha', __('<strong>ERROR</strong>: The captcha value you entered is incorrect.'));
    }
    return $user;
}
add_filter('wp_authenticate_user', 'login_captcha_validate', 10, 2);

