<?php

class Code_Challenges_Public_DB {
    public function __construct(){
        //die('public db die');
    }

    function the_action_function(){
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
}


?>