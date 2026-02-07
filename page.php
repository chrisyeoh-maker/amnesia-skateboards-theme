<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article class="page-container">
        <header class="page-header">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </header>
        
        <?php if (has_post_thumbnail()) : ?>
            <div class="page-thumbnail">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php endif; ?>
        
        <div class="page-content">
            <?php the_content(); ?>
        </div>
    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
