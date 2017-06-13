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

function activate_code_challenges() {
    
    require_once( plugin_dir_path( __FILE__ ) . '/includes/class-code-challenges-activator.php' );
    $code_challenges_activator = new Code_Challenges_Activator();
    $code_challenges_activator->activate_plugin();
    //flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'activate_code_challenges' );



