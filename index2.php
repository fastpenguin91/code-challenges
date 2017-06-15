<?php
/**
 * @package codeChallenges
 * @version 1.6
 */







apply_filters( 'template_include', $template );




// enqueue and localise scripts
wp_enqueue_script( 'my-ajax-handle', plugin_dir_url( __FILE__ ) . 'ajax.js', array( 'jquery' ) );
wp_localize_script( 'my-ajax-handle', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
// THE AJAX ADD ACTIONS
add_action( 'wp_ajax_the_ajax_hook', 'the_action_function' );
add_action( 'wp_ajax_reset_challenge', 'the_reset_challenge_function');


//db function
function the_reset_challenge_function(){
    global $wpdb;

    $user = wp_get_current_user();
    $challenge_id = (int) $_POST['challenge_id'];
    $wpdb->delete(
        $wpdb->prefix . 'jsc_challenge_user',
        array(
            'user_id' => $user->ID,
            'challenge_id' => $challenge_id
        )
    );
    die();
}


