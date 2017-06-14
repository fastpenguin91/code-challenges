<?php


class Code_Challenges_Public {

    public function __construct( $plugin_name, $version ) {
        //die('in code-challenges-public');

        $this->plugin_name = $plugin_name;
        //die('hello' . var_dump($this->plugin_name));
        $this->version = $version;
        //die(var_dump($this->version));
        
    }

    public function enqueue_styles() {
        //die('in enqueue_styles');
        //die(var_dump(plugin_dir_url( __FILE__ ) ) );
        //die(var_dump(plugins_url()));
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/code-challenges-public.css', array(), $this->version, 'all' );
        //wp_enqueue_style( $this->plugin_name, plugins_url() . 'css/code-challenges-public.css', array(), null );
    }



}

?>