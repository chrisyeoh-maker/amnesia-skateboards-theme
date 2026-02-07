<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article class="post-container">
        <header class="post-header">
            <h1 class="post-title"><?php the_title(); ?></h1>
            <div class="post-meta">
                Posted on <?php echo get_the_date(); ?>
            </div>
        </header>
        
        <?php 
        $video_url = get_post_meta(get_the_ID(), '_video_url', true);
        if ($video_url) : 
        ?>
            <div class="video-wrapper" style="margin-bottom: 3rem;">
                <?php echo amnesia_get_video_embed($video_url); ?>
            </div>
        <?php elseif (has_post_thumbnail()) : ?>
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
