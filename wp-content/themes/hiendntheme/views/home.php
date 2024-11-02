<?php get_template_part('templates/header'); ?>

<div class="content">
    <h1>Latest Posts</h1>
    <?php if ($posts_controller->have_posts()): while ($posts_controller->have_posts()): $posts_controller->the_post(); ?>
        <h2><?php the_title(); ?></h2>
        <p><?php the_excerpt(); ?></p>
    <?php endwhile; endif; wp_reset_postdata(); ?>

</div>

<?php get_template_part('templates/footer'); ?>