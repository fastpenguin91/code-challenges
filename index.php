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

/*class Code_Challenges_Startup {

    /*public function bootstrap() {
        register_activation_hook( __FILE__, array( $this, 'activate' ) );
    }*/

    function activate_code_challenges() {
        
        require_once( plugin_dir_path( __FILE__ ) . '/includes/class-code-challenges-activator.php' );
        $code_challenges_activator = new Code_Challenges_Activator();
        $code_challenges_activator->activate_plugin();
        //Code_Challenges_Activator::activate_plugin();
        //flush_rewrite_rules();
        //die('die in activate function!');
    }

//}

register_activation_hook( __FILE__, 'activate_code_challenges' );


/* 
* core plugin class 
 */
//require plugin_dir_path( __FILE__ ) . 'includes/class-code-challenges.php';

/*function run_code_challenges() {
    $plugin = new Code_Challenges();
    $plugin->run();
}
run_code_challenges();*/

//$code_challenges_startup = new Code_Challenges_Startup();
//$code_challenges_startup->bootstrap();
