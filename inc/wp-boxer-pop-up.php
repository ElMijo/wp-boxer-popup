<?php

/**
* Clase que contiene la estructura base del plugin
*/
class WPBoxerPopUp
{
    /**
     * Nombre del Post Type
     * @var string
     */
    private $postType = "boxer-pop-up";
    
    function __construct(argument)
    {
        add_action( 'init', array( $this, 'wp_boxer_pop_up_type' ) );
    }

    /**
     * Metodo que permite registrar el Post Type
     * @return void
     */
    final public function wp_boxer_pop_up_type()
    {
        $labels = array(
            'name' => __('Boxer Pop-up',BOXERPOPPUP_PLUGIN_SLUG),
            'singular_name' => __('Boxer Pop-up',BOXERPOPPUP_PLUGIN_SLUG),
            'add_new' => __('Agregar Boxer Pop-up',BOXERPOPPUP_PLUGIN_SLUG),
            'add_new_item' => __("Agregar Boxer Pop-up",BOXERPOPPUP_PLUGIN_SLUG),
            'edit_item' => __("Editar Boxer Pop-up",BOXERPOPPUP_PLUGIN_SLUG),
            'new_item' => __("Nuevo Boxer Pop-up",BOXERPOPPUP_PLUGIN_SLUG),
            'view_item' => __("Ver Boxer Pop-up",BOXERPOPPUP_PLUGIN_SLUG),
            'search_items' => __("Buscar Boxer Pop-up",BOXERPOPPUP_PLUGIN_SLUG),
            'not_found' => __('no se encontro Boxer Pop-up',BOXERPOPPUP_PLUGIN_SLUG),
            'not_found_in_trash' => __('No hay Boxer Pop-up',BOXERPOPPUP_PLUGIN_SLUG),
            'parent_item_colon' => ''
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_nav_menus' => false,
            'query_var' => true,
            'rewrite' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'capability_type' => 'post',
            'supports' => array('title', 'editor'),
            'menu_icon'=> plugins_url('img/icon.png',__FILE__),
        );
        
        register_post_type($this->postType, $args);
    }
}

?>