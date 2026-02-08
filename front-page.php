<?php get_header(); ?>

<?php
$hero_image = get_theme_mod('hero_background_image', '');
$hero_title = get_theme_mod('hero_title', 'Amnesia Skateboards');
$hero_subtitle = get_theme_mod('hero_subtitle', 'Australian skateboard company pushing the boundaries of street skating');
$hero_overlay = get_theme_mod('hero_overlay', true);
$overlay_opacity = get_theme_mod('hero_overlay_opacity', 40);
?>

<!-- Hero Container -->
<div class="hero-container">
    <!-- Hero Section -->
    <section class="hero-section" <?php if ($hero_image) : ?>style="background-image: url('<?php echo esc_url($hero_image); ?>');"<?php endif; ?>>
        <?php if ($hero_overlay && $hero_image) : ?>
            <div class="hero-overlay" style="opacity: <?php echo ($overlay_opacity / 100); ?>;"></div>
        <?php endif; ?>
        
        <div class="hero-content">
            <h1><?php echo esc_html($hero_title); ?></h1>
            <p><?php echo esc_html($hero_subtitle); ?></p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo esc_url(home_url('/shop')); ?>" class="btn">Shop Now</a>
                <a href="<?php echo esc_url(home_url('/team')); ?>" class="btn btn-outline">Meet The Team</a>
            </div>
        </div>
    </section>
</div><!-- .hero-container -->

<!-- Latest Content Grid -->
<section class="content-grid">
    <?php
    $latest_posts = new WP_Query(array(
        'post_type' => array('post', 'video'),
        'posts_per_page' => 6,
        'orderby' => 'date',
        'order' => 'DESC'
    ));
    
    if ($latest_posts->have_posts()) :
        while ($latest_posts->have_posts()) : $latest_posts->the_post();
    ?>
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
                    <?php echo get_post_type() === 'video' ? '🎥 Video' : '📝 Blog Post'; ?> • 
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
    <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</section>

<!-- Featured Video -->
<?php
$featured_video = new WP_Query(array(
    'post_type' => 'video',
    'posts_per_page' => 1,
    'meta_key' => '_video_url',
    'orderby' => 'date',
    'order' => 'DESC'
));

if ($featured_video->have_posts()) :
    while ($featured_video->have_posts()) : $featured_video->the_post();
        $video_url = get_post_meta(get_the_ID(), '_video_url', true);
        if ($video_url) :
?>
<section class="featured-video-section">
    <div class="featured-video-content">
        <h2>Latest Video: <?php the_title(); ?></h2>
        <div class="video-wrapper">
            <?php echo amnesia_get_video_embed($video_url); ?>
        </div>
    </div>
</section>
<?php
        endif;
    endwhile;
    wp_reset_postdata();
endif;
?>

<!-- Team Section -->
<?php
$team_members = new WP_Query(array(
    'post_type' => 'team',
    'posts_per_page' => 4,
    'orderby' => 'menu_order',
    'order' => 'ASC'
));

if ($team_members->have_posts()) :
?>
<section class="team-section">
    <h2>The Team</h2>
    <div class="team-grid">
        <?php while ($team_members->have_posts()) : $team_members->the_post(); ?>
            <div class="team-member">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="team-member-image">
                        <?php the_post_thumbnail('medium'); ?>
                    </div>
                <?php endif; ?>
                <h3 class="team-member-name"><?php the_title(); ?></h3>
                <p class="team-member-role"><?php echo wp_trim_words(get_the_excerpt(), 5); ?></p>
            </div>
        <?php endwhile; ?>
    </div>
    <div style="text-align: center; margin-top: 3rem;">
        <a href="<?php echo esc_url(home_url('/team')); ?>" class="btn">View Full Team</a>
    </div>
</section>
<?php
    wp_reset_postdata();
endif;
?>

<!-- Newsletter Signup -->
<section class="newsletter-section">
    <div class="newsletter-content">
        <h2>Email Sign Up</h2>
        <p>Sign up for exclusive offers, original stories, events and more.</p>
        <form class="newsletter-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="newsletter_signup">
            <input type="email" name="email" placeholder="Your email address" required>
            <button type="submit">Subscribe</button>
        </form>
    </div>
</section>

<?php get_footer(); ?>
