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


function post_poop_add_poop() {
  $poop = get_post_meta( $_REQUEST['post_id'], 'post_poop', true );
  $poop++;
  update_post_meta( $_REQUEST['post_id'], 'post_poop', $poop );
  if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
    echo $poop;
    die();
  }
  else {
    wp_redirect( get_permalink( $_REQUEST['post_id'] ) );
    exit();
  }
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





add_action( 'wp_enqueue_scripts', 'ajax_test_enqueue_scripts2' );
function ajax_test_enqueue_scripts2() {
  if( is_single() ) {
    wp_enqueue_style( 'poop', plugins_url( '/poop.css', __FILE__ ) );
  }

  wp_enqueue_script( 'poop', plugins_url( '/poop.js', __FILE__ ), array('jquery'), '1.0', true );

  wp_localize_script( 'poop', 'postpoop', array(
    'ajax_url' => admin_url( 'admin-ajax.php' )
  ));

}

add_filter( 'the_content', 'post_poop_display', 99 );
function post_poop_display( $content ) {
  $poop_text = '';

  if ( is_single() ) {
    
    $poop = get_post_meta( get_the_ID(), 'post_poop', true );
    $poop = ( empty( $poop ) ) ? 0 : $poop;

    $poop_text = '<p class="poop-received"><a class="poop-button" href="' . admin_url( 'admin-ajax.php?action=post_poop_add_poop&post_id=' . get_the_ID() ) . '" data-id="' . get_the_ID() . '">give poop</a><span id="poop-count">' . $poop . '</span></p>'; 
  
  }

  return $content . $poop_text;

}

add_action( 'wp_ajax_nopriv_post_poop_add_poop', 'post_poop_add_poop' );
add_action( 'wp_ajax_post_poop_add_poop', 'post_poop_add_poop' );
























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