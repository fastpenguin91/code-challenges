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
        //die('scripts enqueue');
        wp_enqueue_script( 'code-challenges-ajax-handle', plugin_dir_url( __FILE__ ) . 'js/solve_challenge_ajax.js', array( 'jquery' ) );
        wp_localize_script( 'code-challenges-ajax-handle', 'solve_challenge_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    }

    public function jsc_get_custom_post_type_template($single_template) {
        global $post;

        if ($post->post_type == 'code_challenge') {
            $single_template = dirname( __FILE__ ) . '/single-code_challenge.php';
        }
        return $single_template;
    }

    public function portfolio_page_template( $template ) {
        if ( is_page( 'code-challenges' )  ) {
            $new_template = dirname( __FILE__ ) . '/archive-challenge.php';
            if ( '' != $new_template ) {
                return $new_template ;
            }
        }

        return $template;
    }

    public function create_post_type_jsc() {
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

    public function unsolved_challenges_template( $template ) {
        if ( is_page( 'unsolved-challenges' )  ) {
            $new_template = dirname( __FILE__ ) . '/unsolved-challenges.php';
            if ( '' != $new_template ) {
                return $new_template ;
            }
        }
        return $template;
    }


}

?>