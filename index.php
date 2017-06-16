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

register_activation_hook( __FILE__, 'activate_code_challenges' );

require plugin_dir_path( __FILE__ ) . 'includes/class-code-challenges.php';

/*
* class-code-challenges activator creates the database and the necessary pages for plugin to work
*/
function activate_code_challenges() {
    require_once( plugin_dir_path( __FILE__ ) . '/includes/class-code-challenges-activator.php' );
    $code_challenges_activator = new Code_Challenges_Activator();
    $code_challenges_activator->activate_plugin();
}

/* 
* The main plugin file is the /includes/class-code-challenges
*/
function run_code_challenges(){
  $code_challenges = new Code_Challenges();
  $code_challenges->run();
}

run_code_challenges();