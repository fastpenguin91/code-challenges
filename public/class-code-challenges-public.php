<?php


class Code_Challenges_Public {

    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        
    }

    public function enqueue_styles() {
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/code-challenges-public.css', array(), $this->version, 'all' );
    }

    public function enqueue_scripts() {
        wp_enqueue_script( 'my-ajax-handle', plugin_dir_url( __FILE__ ) . '../ajax.js', array( 'jquery' ) );
        wp_localize_script( 'my-ajax-handle', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
        
        //die('enqueing scripts!');
        //wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../ajax.js', array('jquery'), $this->version, false );
    }

    public function jsc_get_custom_post_type_template($single_template) { // Do filters next!
        global $post;
        //die('in jsc_get_custom_post_type_template');
        if ($post->post_type == 'code_challenge') {
            $single_template = dirname( __FILE__ ) . '/single-code_challenge.php';
        }
        return $single_template;
    }

    public function portfolio_page_template( $template ) {
        //die('portfolio_page_template');
        if ( is_page( 'code-challenges' )  ) {
            $new_template = dirname( __FILE__ ) . '/archive-challenge.php';
            if ( '' != $new_template ) {
                return $new_template ;
            }
        }

        return $template;
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

    function unsolved_challenges_template( $template ) {
        //die('unsolved_challenges_template');
        if ( is_page( 'unsolved-challenges' )  ) {
            $new_template = dirname( __FILE__ ) . '/unsolved-challenges.php';
            if ( '' != $new_template ) {
                return $new_template ;
            }
        }
        return $template;
    }

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

    


}

?>