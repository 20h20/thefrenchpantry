<?php
    $title	= get_field('herovideo_title');
	$content	= get_field('herovideo_content');
	$video	= get_field('herovideo_video');
    $height	= get_field('herovideo_height');
?>

<section class="cbo-herovideo <?php echo ($height === 'adaptativeheight') ? 'herovideo--adaptativeheight' : ''; ?>">
    <div class="herovideo-picture cbo-picture-cover">
        <video autoplay="" muted="" playsinline="" loop="" src="<?php echo esc_url($video['url']); ?>">
            <source loading="lazy" type="video/mp4" src="<?php echo esc_url($video['url']); ?>" itemprop="contentUrl">
        </video>
    </div>

    <div class="herovideo-inner cbo-container container--nomargin container--padding">
        <div class="herovideo-content">
            <?php if($title): ?>
                <div class="content-title cbo-title-1 slide-up" itemprop="headline">
                    <?php echo wp_kses_post($title); ?>
                </div>
            <?php endif; ?>

            <?php if($content): ?>
                <div class="content-chapo cbo-chapo slide-up">
                    <?php echo wp_kses_post($content); ?>
                </div>
            <?php endif; ?>

            <?php get_template_part('templates/parts/button/template', null, array()); ?>
        </div>
    </div>
</section>