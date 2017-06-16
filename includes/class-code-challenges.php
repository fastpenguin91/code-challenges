<?php




/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */
class Code_Challenges {

    /**
         * The loader that's responsible for maintaining and registering all hooks that power
         * the plugin.
         *
         * @since    1.0.0
         * @access   protected
         * @var      Plugin_Name_Loader    $loader    Maintains and registers all hooks for the plugin.
         * $loader is a class. the class-code-challenges-loader.php file
    */
    protected $loader;

    /**
         * The unique identifier of this plugin.
         *
         * @since    1.0.0
         * @access   protected
         * @var      string    $plugin_name    The string used to uniquely identify this plugin.
         * Too nooby to know why this is important. Lol.
    */
    protected $plugin_name;
    

    /**
         * The current version of the plugin.
         *
         * @since    1.0.0
         * @access   protected
         * @var      string    $version    The current version of the plugin.
    */
    protected $version;


    /**
         * Define the core functionality of the plugin.
         *
         * Set the plugin name and the plugin version that can be used throughout the plugin.
         * Load the dependencies, define the locale, and set the hooks for the admin area and
         * the public-facing side of the site.
         *
         * @since    1.0.0
    */
    public function __construct() {

        $this->plugin_name = 'code-challenges';
        $this->version = '1.0.0';

        $this->load_dependencies();
        $this->define_public_hooks();
    }


    /**
         * Load the required dependencies for this plugin.
         *
         * Include the following files that make up the plugin:
         *
         * - Plugin_Name_Loader. Orchestrates the hooks of the plugin.
         * - Plugin_Name_i18n. Defines internationalization functionality.
         * - Plugin_Name_Admin. Defines all hooks for the admin area.
         * - Plugin_Name_Public. Defines all hooks for the public side of the site.
         *
         * Create an instance of the loader which will be used to register the hooks
         * with WordPress.
         *
         * @since    1.0.0
         * @access   private
    */
    private function load_dependencies(){

        /**
            * The class responsible for orchestrating the actions and filters of the
            * core plugin.
        */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-code-challenges-loader.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
        */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-code-challenges-public.php';

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-code-challenges-public-db.php';

        $this->loader = new Code_Challenges_Loader();
    }

    /**
         * Register all of the hooks related to the public-facing functionality
         * of the plugin.
         *
         * @since    1.0.0
         * @access   private
    */
    private function define_public_hooks(){

        $code_challenges_public = new Code_Challenges_Public( $this->get_plugin_name(), $this->get_version() );

        $code_challenges_public_db = new Code_Challenges_Public_DB();
        
        $this->loader->add_action('init', $code_challenges_public, 'create_post_type_jsc' );
        
        $this->loader->add_action('wp_enqueue_scripts', $code_challenges_public, 'enqueue_scripts' );
        $this->loader->add_action('wp_enqueue_scripts', $code_challenges_public, 'enqueue_styles' );
        
        $this->loader->add_filter('single_template', $code_challenges_public, 'jsc_get_custom_post_type_template' );
        $this->loader->add_filter('template_include', $code_challenges_public, 'portfolio_page_template' );
        $this->loader->add_filter('template_include', $code_challenges_public, 'unsolved_challenges_template' );
        
        $this->loader->add_action('wp_ajax_solve_challenge_ajax_hook', $code_challenges_public_db, 'solve_challenge_function' );
        $this->loader->add_action('wp_ajax_reset_challenge_ajax_hook', $code_challenges_public_db, 'reset_challenge_function' );
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