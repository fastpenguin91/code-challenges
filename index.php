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

//add_action( 'init', 'create_post_type_jsc' );


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