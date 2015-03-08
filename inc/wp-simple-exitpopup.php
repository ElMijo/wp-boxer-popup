<?php

/**
* Clase que contiene la estructura base del plugin
*/
class WPSimpleExitpopup
{
    /**
     * Nombre del Post Type
     * @var string
     */
    private $postType = "simple-exitpopup";
    
    function __construct()
    {
        add_action('init', array($this,'exit_pop_up_type'));
        add_action('add_meta_boxes',array($this,'exit_pop_up_metabox'));
        add_action('save_post',array( $this,'save_post'));
    }


    /**
     * Metodo que permite registrar el Post Type
     * @return void
     */
    final public function exit_pop_up_type()
    {
        $labels = array(
            'name' => __('Exit Popup',BOXERPOPPUP_PLUGIN_SLUG),
            'singular_name' => __('Exit Popup',BOXERPOPPUP_PLUGIN_SLUG),
            'add_new' => __('Agregar Exit Popup',BOXERPOPPUP_PLUGIN_SLUG),
            'add_new_item' => __("Agregar Exit Popup",BOXERPOPPUP_PLUGIN_SLUG),
            'edit_item' => __("Editar Exit Popup",BOXERPOPPUP_PLUGIN_SLUG),
            'new_item' => __("Nuevo Exit Popup",BOXERPOPPUP_PLUGIN_SLUG),
            'view_item' => __("Ver Exit Popup",BOXERPOPPUP_PLUGIN_SLUG),
            'search_items' => __("Buscar Exit Popup",BOXERPOPPUP_PLUGIN_SLUG),
            'not_found' => __('No se encontro Exit Popup',BOXERPOPPUP_PLUGIN_SLUG),
            'not_found_in_trash' => __('No hay Exit Popup',BOXERPOPPUP_PLUGIN_SLUG),
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
            'supports' => array('title', 'editor','thumbnail'),
            'menu_icon'=> 'dashicons-feedback',
        );
        
        register_post_type($this->postType, $args);
    }

    /**
     * Metodo que permite registrar el meta box de configuración del post type
     * @return void
     */
    final public function exit_pop_up_metabox()
    {
        add_meta_box(
            'wpbpp_meta',
            __('Configuración Exit Popup',BOXERPOPPUP_PLUGIN_SLUG),
            array($this,'exit_pop_up_metabox_view'),
            $this->postType,
            'side'
        );
    }

    /**
     * Metodo que permite imprimir la vista del meta box
     * @param  [type] $post [description]
     * @return [type]       [description]
     */
    final public function exit_pop_up_metabox_view($post)
    {
        wp_nonce_field( 'wpsepp_inner_meta_box', 'wpsepp_inner_meta_box_nonce' );

        $wpsepp_post_meta = get_post_meta($post->ID, 'wpsepp_post_meta',true);

        $active = !!isset($wpsepp_post_meta['active'])?$wpsepp_post_meta['active']:1;
        $only_home = !!isset($wpsepp_post_meta['only_home'])?$wpsepp_post_meta['only_home']:1;

        include_once BOXERPOPPUP_ROOT_PATH.'/view/settingspost.phtml';
    }

    final public function save_post($post_id) {
    
        if(!$this->validate_save_post()||!current_user_can('edit_post',$post_id)||!!(defined('DOING_AUTOSAVE' )&&DOING_AUTOSAVE))
        {
            return $post_id;
        }

        $wpsepp_data = $this->validate_save_post_data();

        update_post_meta($post_id, 'wpsepp_post_meta',$wpsepp_data);
    }

    private function validate_save_post()
    {
        return !!(isset($_POST['post_type'])&&$_POST['post_type']=='simple-exitpopup')&&
                !!isset($_POST['wpsepp_inner_meta_box_nonce'])&&
                !!wp_verify_nonce($_POST['wpsepp_inner_meta_box_nonce'], 'wpsepp_inner_meta_box' )
        ;
    }

    private function validate_save_post_data()
    {
        return array(
            'active' => isset($_POST['wpsepp']['active'])?1:2,
            'only_home' => isset($_POST['wpsepp']['only_home'])?1:2
        );
    }
}
$WPBPP = new WPSimpleExitpopup();

?>