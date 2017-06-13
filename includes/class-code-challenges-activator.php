<?php


global $jal_db_version;
$jal_db_version = '1.0';

class Code_Challenges_Activator {

    public function activate_plugin(){
        //die('in activate_plugin');
        $this->create_database();
        $this->create_coding_pages();
        //register_activation_hook( __FILE__, array( $this, 'jal_install_data' ) );
        add_action( 'init', array( $this, 'create_post_type' ) );
    }

    private function create_coding_pages(){
        //die('create coding pages');
        $codeChallenges = array(
            'post_title'  => 'code-challenges',
            'post_status' => 'publish',
            'post_type'   => 'page',
            'post_name'   => 'code-challenges'
        );

        wp_insert_post( $codeChallenges );

        $unsolvedChallenges = array(
            'post_title'  => 'Unsolved Challenges',
            'post_status' => 'publish',
            'post_type'   => 'page',
            'post_name'   => 'unsolved-challenges'
        );

        wp_insert_post( $unsolvedChallenges );


    }



    public function create_database() {
      //die ('in jal_install');
        global $wpdb;
        global $jal_db_version;

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
        add_option( 'jal_db_version', $jal_db_version );
    }

    private function create_post_type() {
        die("create post type");
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

    /*function jal_install_data() {
      //die( 'in jall_install_data');
        global $wpdb;
        
        $welcome_challenge_id = 4;
        $welcome_user_id      = 2;
        $table_name = $wpdb->prefix . 'jsc_challenge_user';
        $wpdb->insert( 
            $table_name, 
            array(
                'challenge_user' => '4_2',
                'challenge_id' => $welcome_challenge_id,
                'user_id' => $welcome_user_id, 
            ) 
        );
    }*/
}










?>