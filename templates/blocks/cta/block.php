<?php
    if( function_exists('acf_register_block_type') ):
        acf_register_block_type(array(
            'name' => 'cta',
            'title' => 'Call to action',
            'description' => 'Mise en avant d\'un titre et d\'un bouton',
            'category' => 'text',
            'keywords' => array(
            ),
            'post_types' => array(
            ),
            'mode' => 'auto',
            'align' => '',
            'align_content' => NULL,
            'render_callback' => 'cbo_render_cta_block',
            'icon' => 'button',
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
     * Brevo (plugin "mailin") charge son JS, son CSS et jQuery dans le <head> de toutes les pages.
     * On ne les garde que sur les pages qui contiennent ce bloc (seul endroit où le formulaire est affiché).
     * Priorité 1000 : après l'ajout des fichiers par le plugin (priorité 999).
     */
    function cbo_brevo_assets_only_with_cta() {
        if ( is_singular() && has_block( 'acf/cta', get_queried_object_id() ) ) {
            return;
        }
        wp_dequeue_script( 'sib-front-js' );
        wp_dequeue_style( 'sib-front-css' );
    }
    add_action( 'wp_enqueue_scripts', 'cbo_brevo_assets_only_with_cta', 1000 );

    /**
     * Rendu du bloc.
     */
    function cbo_render_cta_block( $block, $content = '', $is_preview = false, $post_id = 0 ) {

        if ( ! empty( $block['data']['is_example'] ) ) {
            echo '<img src="' . esc_url( get_template_directory_uri() . '/library/img/previews/cta.jpg' ) . '" alt="" style="display:block;width:100%;height:auto;">';
            return;
        }

        include get_template_directory() . '/templates/blocks/cta/template.php';
    }
