<?php get_header(); ?>

<div class="archive-header">
    <h1 class="archive-title">Blog</h1>
    <p class="archive-description">Latest news and updates from Amnesia Skateboards</p>
</div>

<section class="blog-posts-container" style="max-width: 1000px; margin: 4rem auto; padding: 0 2rem;">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="blog-post-full" style="margin-bottom: 4rem; padding-bottom: 4rem; border-bottom: 1px solid #e5e5e5;">
                <header class="post-header">
                    <h2 class="post-title" style="font-size: 2.5rem; margin-bottom: 1rem;">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="post-meta" style="color: #999; margin-bottom: 2rem;">
                        Posted on <?php echo get_the_date(); ?>
                        <?php if (has_category()) : ?>
                            in <?php the_category(', '); ?>
                        <?php endif; ?>
                    </div>
                </header>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail" style="margin-bottom: 2rem;">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="post-content" style="font-size: 1.1rem; line-height: 1.8;">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No posts found.</p>
    <?php endif; ?>
</section>

<?php
// Pagination
the_posts_pagination(array(
    'mid_size' => 2,
    'prev_text' => '← Previous',
    'next_text' => 'Next →',
));
?>

<?php get_footer(); ?>
