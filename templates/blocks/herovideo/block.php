<?php
    if( function_exists('acf_register_block_type') ):
        acf_register_block_type(array(
            'name' => 'herovideo',
            'title' => 'Hero avec vidéo',
            'description' => '',
            'category' => 'hero',
            'keywords' => array(
            ),
            'post_types' => array(
            ),
            'mode' => 'auto',
            'align' => '',
            'align_content' => NULL,
            'render_callback' => 'cbo_render_herovideo_block',
            'icon' => 'superhero',
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
    function cbo_render_herovideo_block( $block, $content = '', $is_preview = false, $post_id = 0 ) {

        if ( ! empty( $block['data']['is_example'] ) ) {
            $preview = '/library/img/previews/herovideo.jpg';

            if ( file_exists( get_template_directory() . $preview ) ) {
                echo '<img src="' . esc_url( get_template_directory_uri() . $preview ) . '" alt="" style="display:block;width:100%;height:auto;">';
            } else {
                echo '<p style="padding:20px;text-align:center;">Hero avec vidéo</p>';
            }
            return;
        }

        include get_template_directory() . '/templates/blocks/herovideo/template.php';
    }
