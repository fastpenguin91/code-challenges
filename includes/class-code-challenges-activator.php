<?php

/*
* Don't know if the DB version needs to be global or not.
*/
global $cc_jsc_db_version;
$cc_jsc_db_version = '1.0';

class Code_Challenges_Activator {

    public function activate_plugin(){
        $this->create_database();
        $this->create_coding_pages();
    }

    private function create_coding_pages(){
        $codeChallenges = array(
            'post_title'  => 'code-challenges',
            'post_status' => 'publish',
            'post_type'   => 'page',
            'post_name'   => 'code-challenges'
        );

        $unsolvedChallenges = array(
            'post_title'  => 'Unsolved Challenges',
            'post_status' => 'publish',
            'post_type'   => 'page',
            'post_name'   => 'unsolved-challenges'
        );

        wp_insert_post( $codeChallenges );
        wp_insert_post( $unsolvedChallenges );
    }

    public function create_database() {
        global $wpdb;
        global $cc_jsc_db_version;

        $table_name = $wpdb->prefix . 'jsc_challenge_user';
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        challenge_id mediumint(9) NOT NULL,
        user_id mediumint(9) NOT NULL,
        PRIMARY KEY  (id)
      ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
        add_option( 'cc_jsc_db_version', $cc_jsc_db_version );
    }

}

?>