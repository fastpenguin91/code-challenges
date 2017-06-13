<?php

function jsc_plugin_css() {
    wp_register_style('jsc_code_challenges',
                      plugins_url() . '/codeChallengesWP/css/jsc_code_challenges.css');
    wp_enqueue_style( 'jsc_code_challenges',
                      dirname(__FILE__) . '/css/jsc_code_challenges.css',
                      '',
                      false );
}

add_action( 'wp_enqueue_scripts', 'jsc_plugin_css');


?>