<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article class="post-container">
        <header class="post-header">
            <h1 class="post-title"><?php the_title(); ?></h1>
            <div class="post-meta">
                Posted on <?php echo get_the_date(); ?> 
                <?php if (has_category()) : ?>
                    in <?php the_category(', '); ?>
                <?php endif; ?>
            </div>
        </header>
        
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php endif; ?>
        
        <div class="post-content">
            <?php the_content(); ?>
        </div>
        
        <?php
        // Post navigation
        the_post_navigation(array(
            'prev_text' => '← %title',
            'next_text' => '%title →',
        ));
        ?>
    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
