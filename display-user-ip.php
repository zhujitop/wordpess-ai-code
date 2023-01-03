<?php
/*
Plugin Name: Display User IP
Version: 1.0
Description: A simple plugin that displays the user's IP address.
Author: Your Name
*/

function display_user_ip() {
  $ip_address = $_SERVER['REMOTE_ADDR'];
  return $ip_address;
}

add_filter( 'the_content', 'display_user_ip' );

?>
