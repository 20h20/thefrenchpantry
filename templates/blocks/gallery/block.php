<?php
    if( function_exists('acf_register_block_type') ):
        acf_register_block_type(array(
            'name' => 'gallery',
            'title' => 'Galerie',
            'description' => '',
            'category' => 'galerie',
            'keywords' => array(
            ),
            'post_types' => array(
            ),
            'mode' => 'auto',
            'align' => '',
            'align_content' => NULL,
            'render_callback' => 'cbo_render_gallery_block',
            'icon' => 'format-gallery',
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
    function cbo_render_gallery_block( $block, $content = '', $is_preview = false, $post_id = 0 ) {

        if ( ! empty( $block['data']['is_example'] ) ) {
            echo '<img src="' . esc_url( get_template_directory_uri() . '/library/img/previews/gallery.jpg' ) . '" alt="" style="display:block;width:100%;height:auto;">';
            return;
        }

        include get_template_directory() . '/templates/blocks/gallery/template.php';
    }
