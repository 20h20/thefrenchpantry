<?php
    if( function_exists('acf_register_block_type') ):
        acf_register_block_type(array(
            'name' => 'picturefull',
            'title' => 'Image plein écran',
            'description' => '',
            'category' => 'text',
            'keywords' => array(
            ),
            'post_types' => array(
            ),
            'mode' => 'auto',
            'align' => '',
            'align_content' => NULL,
            'render_callback' => 'cbo_render_picturefull_block',
            'icon' => 'format-image',
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
     * Rendu du bloc.
     */
    function cbo_render_picturefull_block( $block, $content = '', $is_preview = false, $post_id = 0 ) {

        if ( ! empty( $block['data']['is_example'] ) ) {
            echo '<img src="' . esc_url( get_template_directory_uri() . '/library/img/previews/picturefull.jpg' ) . '" alt="" style="display:block;width:100%;height:auto;">';
            return;
        }

        include get_template_directory() . '/templates/blocks/picturefull/template.php';
    }
