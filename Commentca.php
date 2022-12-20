<?php
/*
Plugin Name: Comment Captcha
Description: A simple plugin to add a captcha to the comment form
Version: 1.0
Author: Your Name
*/

function comment_captcha_scripts() {
    wp_enqueue_script( 'comment-captcha', plugins_url( 'comment-captcha.js', __FILE__ ), array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'comment_captcha_scripts' );

function comment_captcha_form( $defaults ) {
    $defaults['fields']['captcha'] = '<p class="comment-form-captcha"><label for="captcha">Captcha</label> <input id="captcha" name="captcha" type="text" size="30" required></p>';
    return $defaults;
}
add_filter( 'comment_form_defaults', 'comment_captcha_form' );

function comment_captcha_verify( $approved ) {
    if ( ! isset( $_POST['captcha'] ) || empty( $_POST['captcha'] ) ) {
        return 'spam';
    }

    // Verify the captcha here, for example by comparing it to a stored value
    $captcha = $_POST['captcha'];
    if ( $captcha !== '12345' ) {
        return 'spam';
    }

    return $approved;
}
add_filter( 'pre_comment_approved', 'comment_captcha_verify' );
