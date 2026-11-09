<?php
    if( function_exists('acf_register_block_type') ):
        acf_register_block_type(array(
            'name' => 'form',
            'title' => 'Formulaire',
            'description' => '',
            'category' => 'text',
            'keywords' => array(
            ),
            'post_types' => array(
            ),
            'mode' => 'auto',
            'align' => '',
            'align_content' => NULL,
            'render_callback' => 'cbo_render_form_block',
            'icon' => 'forms',
            'supports' => array(
                'align' => false,
                'mode' => false,
                'multiple' => true,
                'jsx' => false,
                'align_content' => false,
                'anchor' => true,
            ),
            'example' => [
                'attributes' => [
                    'mode' => 'preview',
                    'data' => ['is_example' => true],
                ]
            ]
        ));
    endif;

    /**
     * Contact Form 7 : ne pas charger son JS sur toutes les pages.
     * Il est chargé par le template du bloc, uniquement quand un formulaire est affiché.
     */
    add_filter( 'wpcf7_load_js', '__return_false' );

    /**
     * Rendu du bloc.
     */
    function cbo_render_form_block( $block, $content = '', $is_preview = false, $post_id = 0 ) {

        if ( ! empty( $block['data']['is_example'] ) ) {
            echo '<img src="' . esc_url( get_template_directory_uri() . '/library/img/previews/form.jpg' ) . '" alt="" style="display:block;width:100%;height:auto;">';
            return;
        }

        include get_template_directory() . '/templates/blocks/form/template.php';
    }
