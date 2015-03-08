<?php

/**
* Clase que contiene las configuraciones de las columnas adicionales del plugin
*/
class WPSimpleExitpopupColumns
{
    
    function __construct()
    {
        add_filter('manage_edit-simple-exitpopup_columns',array($this,'add_colums'));
        add_filter('manage_edit-simple-exitpopup_sortable_columns',array($this,'add_colums'));
        add_action('manage_simple-exitpopup_posts_custom_column',array($this,'render_colums'),10,2);
        add_action('admin_enqueue_scripts', array($this,'include_admin_js_css'));
    }

    final public function add_colums($columns)
    {
        unset($columns['parent']);
        unset($columns['comments']);

        return array(
            'title' => $columns['title'],
            'active' => __('Activo',BOXERPOPPUP_PLUGIN_SLUG),
            'only_home' => __('Solo en Home',BOXERPOPPUP_PLUGIN_SLUG),
            'date' => $columns['date']
        );
    }

    final function render_colums($column,$post_id)
    {
        $wpsepp_post_meta = get_post_meta($post_id,'wpsepp_post_meta',true);

        switch ($column)
        {
            case 'active':case 'only_home':
                echo $this->get_active_html($wpsepp_post_meta[$column]);
                break;
        }
    }

    final public function include_admin_js_css($hook)
    {
        if($hook=='edit.php'&&$_GET['post_type']=='simple-exitpopup')
        {
            wp_enqueue_style('wpsepp-colums',BOXERPOPPUP_ROOT_URL.'/css/wpsepp-colums.css',false,'1.0.0');
        }
    }

    private function get_active_html($active)
    {
        return sprintf('<span class="dashicons dashicons-yes %s"></span>',$active==1?'active':'');
    }  
}
new WPSimpleExitpopupColumns();
?>