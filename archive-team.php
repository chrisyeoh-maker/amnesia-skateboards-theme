<?php get_header(); ?>

<div class="archive-header">
    <h1 class="archive-title">The Team</h1>
    <p class="archive-description">Meet the riders behind Amnesia Skateboards</p>
</div>

<section class="team-section">
    <div class="team-grid">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="team-member">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="team-member-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <h3 class="team-member-name">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <p class="team-member-role">
                        <?php echo wp_trim_words(get_the_excerpt(), 5); ?>
                    </p>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p>No team members found.</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
