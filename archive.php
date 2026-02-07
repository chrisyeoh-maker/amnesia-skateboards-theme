<?php get_header(); ?>

<div class="archive-header">
    <h1 class="archive-title"><?php the_archive_title(); ?></h1>
    <?php if (get_the_archive_description()) : ?>
        <div class="archive-description">
            <?php echo get_the_archive_description(); ?>
        </div>
    <?php endif; ?>
</div>

<section class="content-grid">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="content-card">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="content-card-image">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('large'); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
                <div class="content-card-body">
                    <div class="content-card-meta">
                        <?php echo get_the_date(); ?>
                    </div>
                    <h3 class="content-card-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <p class="content-card-excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                    </p>
                    <a href="<?php the_permalink(); ?>" class="btn">Read More</a>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No content found.</p>
    <?php endif; ?>
</section>

<?php
the_posts_pagination(array(
    'mid_size' => 2,
    'prev_text' => '← Previous',
    'next_text' => 'Next →',
));
?>

<?php get_footer(); ?>
