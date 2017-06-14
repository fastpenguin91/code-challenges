<?php


class Code_Challenges_Loader {

    /**
     * The array of actions registered with WordPress.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
     */
    protected $actions;
    /**
     * The array of filters registered with WordPress.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
     */
    protected $filters;

    public function __construct() {
        //die('slow and painful __construct Code_Challenges_Loader');

        $this->actions = array();
        $this->filters = array();
    }

    public function add_action($hook, $component, $callback ){
        //die(var_dump($hook));
        //die('add_action in code_challenges_loader class');
        //$this->actions = $this->add($this->actions, $hook);
        $this->actions = $this->add($this->actions, $hook, $component, $callback );
    }

    private function add($hooks, $hook, $component, $callback ){

        $hooks[] = array(
            'hook'      => $hook,
            'component' => $component,
            'callback'  => $callback
            );

        //die(var_dump($component));
        return $hooks;
    }

    public function run(){
        //die( var_dump( $this->actions) );
        //die(var_dump($this->actions));
        foreach( $this->actions as $hook ) {
            //die('in foreach');
            add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
        }
    }
}

?>