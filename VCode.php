<?php
/*
 * Plugin Name: User Verification Code
 * Plugin URI: https://example.com/plugins/user-verification-code
 * Description: A plugin that adds a verification code field to the WordPress login form.
 * Version: 1.0
 * Author: John Doe
 * Author URI: https://example.com
 * License: GPLv2 or later
 */

// prevent direct access to this file
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add a verification code field to the login form.
 */
function uvc_add_verification_code_field() {
    $code = uvc_generate_verification_code();
    ?>
    <p>
        <label for="uvc_verification_code">Verification Code:</label>
        <br />
        <input type="text" name="uvc_verification_code" id="uvc_verification_code" class="input" value="" size="20" />
        <input type="hidden" name="uvc_verification_code_hidden" id="uvc_verification_code_hidden" value="<?php echo esc_attr( $code ); ?>" />
    </p>
    <?php
}
add_action( 'login_form', 'uvc_add_verification_code_field' );

/**
 * Generate a random verification code.
 *
 * @return string
 */
function uvc_generate_verification_code() {
    return substr( md5( uniqid( mt_rand(), true ) ), 0, 5 );
}

/**
 * Validate the verification code.
 *
 * @param WP_Error $errors
 * @return WP_Error
 */
function uvc_validate_verification_code( $errors ) {
    if ( isset( $_POST['uvc_verification_code'] ) && isset( $_POST['uvc_verification_code_hidden'] ) ) {
        $code = $_POST['uvc_verification_code'];
        $hidden_code = $_POST['uvc_verification_code_hidden'];
        if ( $code !== $hidden_code ) {
            $errors->add( 'invalid_verification_code', 'Invalid verification code' );
        }
    }
    return $errors;
}
add_filter( 'wp_login_errors', 'uvc_validate_verification_code' );
