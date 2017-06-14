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
        //die('construct func');

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
        //die('define public hooks');

        $code_challenges_public = new Code_Challenges_Public( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action('wp_enqueue_scripts', $code_challenges_public, 'enqueue_styles' ); 
        //die('in define_public_hooks');
        //add_action()
    }

    public function get_plugin_name() {
        //die('plugin name get...');
        //die(var_dump($this->plugin_name));
        return $this->plugin_name;
    }

    public function get_version(){
        //die('version func');
        return $this->version;
    }

    public function run(){
        //die('run. Da nanananana');
        $this->loader->run();
    }
}


?>