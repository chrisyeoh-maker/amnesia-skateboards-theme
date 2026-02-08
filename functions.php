<?php
/**
 * Amnesia Skateboards Theme Functions
 */

// Theme Setup
function amnesia_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('automatic-feed-links');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'amnesia'),
        'footer' => __('Footer Menu', 'amnesia'),
    ));
    
    // WooCommerce support
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // Set content width
    if (!isset($content_width)) {
        $content_width = 1200;
    }
}
add_action('after_setup_theme', 'amnesia_theme_setup');

// Enqueue Styles and Scripts
function amnesia_enqueue_scripts() {
    wp_enqueue_style('amnesia-style', get_stylesheet_uri(), array(), '1.0');
    wp_enqueue_script('amnesia-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'amnesia_enqueue_scripts');

// Register Widget Areas
function amnesia_widgets_init() {
    register_sidebar(array(
        'name' => __('Footer Column 1', 'amnesia'),
        'id' => 'footer-1',
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer Column 2', 'amnesia'),
        'id' => 'footer-2',
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer Column 3', 'amnesia'),
        'id' => 'footer-3',
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'amnesia_widgets_init');

// Custom Post Type: Team Members
function amnesia_register_team_cpt() {
    $labels = array(
        'name' => 'Team Members',
        'singular_name' => 'Team Member',
        'add_new' => 'Add New Team Member',
        'add_new_item' => 'Add New Team Member',
        'edit_item' => 'Edit Team Member',
        'new_item' => 'New Team Member',
        'view_item' => 'View Team Member',
        'all_items' => 'All Team Members',
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-groups',
        'rewrite' => array('slug' => 'team'),
        'show_in_rest' => true,
    );
    
    register_post_type('team', $args);
}
add_action('init', 'amnesia_register_team_cpt');

// Custom Post Type: Videos
function amnesia_register_video_cpt() {
    $labels = array(
        'name' => 'Videos',
        'singular_name' => 'Video',
        'add_new' => 'Add New Video',
        'add_new_item' => 'Add New Video',
        'edit_item' => 'Edit Video',
        'new_item' => 'New Video',
        'view_item' => 'View Video',
        'all_items' => 'All Videos',
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-video-alt3',
        'rewrite' => array('slug' => 'videos'),
        'show_in_rest' => true,
    );
    
    register_post_type('video', $args);
}
add_action('init', 'amnesia_register_video_cpt');

// Add custom meta box for video URL
function amnesia_add_video_meta_boxes() {
    add_meta_box(
        'video_url',
        'Video URL (YouTube/Vimeo)',
        'amnesia_video_url_callback',
        'video',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'amnesia_add_video_meta_boxes');

function amnesia_video_url_callback($post) {
    wp_nonce_field('amnesia_save_video_url', 'amnesia_video_url_nonce');
    $value = get_post_meta($post->ID, '_video_url', true);
    echo '<input type="text" name="video_url" value="' . esc_attr($value) . '" style="width:100%;" placeholder="https://www.youtube.com/watch?v=..." />';
}

function amnesia_save_video_url($post_id) {
    if (!isset($_POST['amnesia_video_url_nonce'])) return;
    if (!wp_verify_nonce($_POST['amnesia_video_url_nonce'], 'amnesia_save_video_url')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    
    if (isset($_POST['video_url'])) {
        update_post_meta($post_id, '_video_url', sanitize_text_field($_POST['video_url']));
    }
}
add_action('save_post', 'amnesia_save_video_url');

// Excerpt Length
function amnesia_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'amnesia_excerpt_length');

// WooCommerce: Change number of products per row
function amnesia_loop_columns() {
    return 4;
}
add_filter('loop_shop_columns', 'amnesia_loop_columns');

// Convert video URLs to embed format
function amnesia_get_video_embed($url) {
    if (empty($url)) return '';
    
    // YouTube
    if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/', $url, $matches);
        if (!empty($matches[1])) {
            return '<iframe src="https://www.youtube.com/embed/' . esc_attr($matches[1]) . '" frameborder="0" allowfullscreen></iframe>';
        }
    }
    
    // Vimeo
    if (strpos($url, 'vimeo.com') !== false) {
        preg_match('/vimeo\.com\/(\d+)/', $url, $matches);
        if (!empty($matches[1])) {
            return '<iframe src="https://player.vimeo.com/video/' . esc_attr($matches[1]) . '" frameborder="0" allowfullscreen></iframe>';
        }
    }
    
    return '';
}
?>

/**
 * Theme Customizer - Hero Image Upload
 */
function amnesia_customize_register($wp_customize) {
    
    // Add Homepage Settings Section
    $wp_customize->add_section('amnesia_homepage_settings', array(
        'title'    => __('Homepage Settings', 'amnesia'),
        'priority' => 30,
    ));
    
    // Hero Background Image
    $wp_customize->add_setting('hero_background_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_background_image', array(
        'label'    => __('Hero Background Image', 'amnesia'),
        'section'  => 'amnesia_homepage_settings',
        'settings' => 'hero_background_image',
        'description' => __('Recommended size: 1920x800px. Best with action skate shots or team photos.', 'amnesia'),
    )));
    
    // Hero Title
    $wp_customize->add_setting('hero_title', array(
        'default'           => 'Amnesia Skateboards',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label'    => __('Hero Title', 'amnesia'),
        'section'  => 'amnesia_homepage_settings',
        'type'     => 'text',
    ));
    
    // Hero Subtitle
    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => 'Australian skateboard company pushing the boundaries of street skating',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label'    => __('Hero Subtitle', 'amnesia'),
        'section'  => 'amnesia_homepage_settings',
        'type'     => 'text',
    ));
    
    // Enable/Disable Overlay
    $wp_customize->add_setting('hero_overlay', array(
        'default'           => true,
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('hero_overlay', array(
        'label'    => __('Enable Dark Overlay (better text readability)', 'amnesia'),
        'section'  => 'amnesia_homepage_settings',
        'type'     => 'checkbox',
    ));
    
    // Overlay Opacity
    $wp_customize->add_setting('hero_overlay_opacity', array(
        'default'           => '40',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('hero_overlay_opacity', array(
        'label'       => __('Overlay Darkness (%)', 'amnesia'),
        'section'     => 'amnesia_homepage_settings',
        'type'        => 'number',
        'description' => __('0 = transparent, 100 = fully dark. Recommended: 30-50%', 'amnesia'),
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 5,
        ),
    ));
}
add_action('customize_register', 'amnesia_customize_register');
