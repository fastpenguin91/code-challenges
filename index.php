<?php

/**
 * @package codeChallenges
 * @version 1.6
 */
/*
   Plugin Name: Code Challenges
   Plugin URI:
   Description: 
   Author: John
   Version: 1.0
   Author URI: 
*/

// If this file is called directly, abort.
if ( ! defined('WPINC' ) ) {
    die('dead!');
}

add_action( 'init', 'create_post_type_jsc' );


wp_enqueue_script( 'my-ajax-handle', plugin_dir_url( __FILE__ ) . '/ajax.js', array( 'jquery' ) );
add_action( 'wp_ajax_the_ajax_hook', 'the_action_function' );
add_action( 'wp_ajax_reset_challenge', 'the_reset_challenge_function');
wp_localize_script( 'my-ajax-handle', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );


//db function
function the_action_function(){
    //die('the_action_function');
    global $wpdb;
    $user = wp_get_current_user();
    $challenge_id = (int) $_POST['challenge_id'];
    $wpdb->insert(
        $wpdb->prefix . 'jsc_challenge_user',
        array(
            'user_id' => $user->ID,
            'challenge_id' => $challenge_id
        )
    );
    
    die();
}



//db function
function the_reset_challenge_function(){
    //die('reset challenge function');
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




function create_post_type_jsc() {
    //die("create post type");
    register_post_type( 'code_challenge',
        array(
            'labels' => array(
                'name' => __( 'Challenges' ),
                'singular_name' => __( 'Challenge' )
            ),
            'public' => true,
            'has_archive' => true,
        )
    );
}


function activate_code_challenges() {
    
    require_once( plugin_dir_path( __FILE__ ) . '/includes/class-code-challenges-activator.php' );
    $code_challenges_activator = new Code_Challenges_Activator();
    $code_challenges_activator->activate_plugin();
    //flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'activate_code_challenges' );

require plugin_dir_path( __FILE__ ) . 'includes/class-code-challenges.php';

function run_code_challenges(){
  $code_challenges = new Code_Challenges();
  $code_challenges->run();
}

run_code_challenges();