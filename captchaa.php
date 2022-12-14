<?php
/*
 * Plugin Name: Simple CAPTCHA
 * Plugin URI: https://example.com/simple-captcha
 * Description: A simple CAPTCHA plugin for WordPress.
 * Version: 1.0
 * Author: John Doe
 * Author URI: https://example.com
 */

function simple_captcha_display() {
  // Generate a random code for the CAPTCHA
  $code = rand(10000, 99999);

  // Store the code in a session variable
  session_start();
  $_SESSION['captcha_code'] = $code;

  // Display the CAPTCHA code as an image
  $img = imagecreate(60, 20);
  $bg = imagecolorallocate($img, 255, 255, 255);
  $textcolor = imagecolorallocate($img, 0, 0, 0);
  imagestring($img, 5, 5, 2, $code, $textcolor);
  header("Content-type: image/png");
  imagepng($img);
  imagedestroy($img);
}

// Add a shortcode for displaying the CAPTCHA
add_shortcode('simple_captcha', 'simple_captcha_display');
