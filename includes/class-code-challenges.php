<?php

class Code_Challenges {

    /**
         * The loader that's responsible for maintaining and registering all hooks that power
         * the plugin.
         *
         * @since    1.0.0
         * @access   protected
         * @var      Plugin_Name_Loader    $loader    Maintains and registers all hooks for the plugin.
    */
    protected $loader;
    protected $plugin_name;
    protected $version;

    public function __construct() {

        $this->plugin_name = 'code-challenges';
        $this->version = '1.0.0';

        $this->load_dependencies();
        $this->define_public_hooks();
    }

    private function load_dependencies(){
        //die('load dependencies in Code_Challenges Class!');

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-code-challenges-loader.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
        */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-code-challenges-public.php';

        $this->loader = new Code_Challenges_Loader();
    }

    private function define_public_hooks(){

        $code_challenges_public = new Code_Challenges_Public( $this->get_plugin_name(), $this->get_version() );

        //wp_enqueue_script( 'my-ajax-handle', plugin_dir_url( __FILE__ ) . '../ajax.js', array( 'jquery' ) );
        //wp_localize_script( 'my-ajax-handle', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
        
        $this->loader->add_action('wp_enqueue_scripts', $code_challenges_public, 'enqueue_scripts' );
        $this->loader->add_filter('single_template', $code_challenges_public, 'jsc_get_custom_post_type_template' );
        $this->loader->add_filter('template_include', $code_challenges_public, 'portfolio_page_template' );
        $this->loader->add_filter('template_include', $code_challenges_public, 'unsolved_challenges_template' );
        $this->loader->add_action('wp_ajax_the_ajax_hook', $code_challenges_public, 'the_action_function' );
        $this->loader->add_action('wp_ajax_reset_challenge', $code_challenges_public, 'the_reset_challenge_function' );


    }
    

    public function get_plugin_name() {
        return $this->plugin_name;
    }

    public function get_version(){
        return $this->version;
    }

    public function run(){
        $this->loader->run();
    }
}


?>