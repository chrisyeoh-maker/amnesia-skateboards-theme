<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="header-container">
        <div class="site-logo">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php bloginfo('name'); ?>
                </a>
            <?php endif; ?>
        </div>
        
        <button class="mobile-menu-toggle" aria-label="Toggle Menu">☰</button>
        
        <nav class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'fallback_cb' => 'amnesia_default_menu',
            ));
            ?>
        </nav>
        
        <div class="header-icons">
            <?php if (class_exists('WooCommerce')) : ?>
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" aria-label="Cart">
                    🛒 <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                </a>
                <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" aria-label="Account">👤</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<?php
function amnesia_default_menu() {
    echo '<ul>';
    echo '<li><a href="' . esc_url(home_url('/')) . '">HOME</a></li>';
    echo '<li><a href="' . esc_url(home_url('/shop')) . '">SHOP</a></li>';
    echo '<li><a href="' . esc_url(home_url('/blog')) . '">BLOG</a></li>';
    echo '<li><a href="' . esc_url(home_url('/team')) . '">TEAM</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact')) . '">CONTACT</a></li>';
    echo '</ul>';
}
?>
