<?php

/**
* Clase que contiene la estructura base del plugin
*/
class WPSimpleExitpopupFrontEnd
{
    function __construct()
    {
        add_action('wp_footer', array($this,'include_popup'));
        add_action('wp_enqueue_scripts',array($this,'include_js_css'));

    }
    
    final public function include_popup()
    {
        include_once BOXERPOPPUP_ROOT_PATH.'/view/wpspp-frontend.phtml';
    }

    final public function include_js_css()
    {
        wp_enqueue_style('wpsepp-frontend',BOXERPOPPUP_ROOT_URL.'/css/wpsepp-frontend.css',false,'1.0.0');
    }

    /**
     * Metodo que permite imprimir la vista del meta box
     * @param  [type] $post [description]
     * @return [type]       [description]
     */
/*    final public function exit_pop_up_metabox_view($post)
    {
        wp_nonce_field( 'wpsepp_inner_meta_box', 'wpsepp_inner_meta_box_nonce' );

        $wpsepp_post_meta = get_post_meta($post->ID, 'wpsepp_post_meta',true);

        $active = !!isset($wpsepp_post_meta['active'])?$wpsepp_post_meta['active']:1;
        $only_home = !!isset($wpsepp_post_meta['only_home'])?$wpsepp_post_meta['only_home']:1;

        include_once BOXERPOPPUP_ROOT_PATH.'/view/settingspost.phtml';
    }*/

/*    final public function save_post($post_id) {
    
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
    }*/
}
$WPBPP = new WPSimpleExitpopupFrontEnd();

?>