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

        $this->actions = array();
        $this->filters = array();
    }

    public function add_action($hook, $component, $callback ){
        $this->actions = $this->add($this->actions, $hook, $component, $callback );
    }

    public function add_filter($hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
        //die('add_filter func');
        $this->filters = $this->add($this->filters, $hook, $component, $callback, $priority, $accepted_args );
    }

    private function add($hooks, $hook, $component, $callback ){

        $hooks[] = array(
            'hook'      => $hook,
            'component' => $component,
            'callback'  => $callback
            );

        return $hooks;
    }

    public function run(){
        //die(var_dump($this->filters));
        foreach( $this->filters as $hook ) {
            add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
        }


        foreach( $this->actions as $hook ) {
            add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
        }

    }
}

?>