<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-column">
            <h3>Links</h3>
            <ul>
                <li><a href="<?php echo esc_url(home_url('/about')); ?>">About</a></li>
                <li><a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a></li>
                <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact Us</a></li>
            </ul>
        </div>
        
        <div class="footer-column">
            <h3>Social</h3>
            <div class="social-links">
                <a href="https://www.instagram.com/amnesiaskateboards/" target="_blank" rel="noopener" aria-label="Instagram">📷</a>
                <a href="https://www.facebook.com/amnesiaskateboards" target="_blank" rel="noopener" aria-label="Facebook">📘</a>
                <a href="https://www.tiktok.com/@amnesiaskateboards" target="_blank" rel="noopener" aria-label="TikTok">🎵</a>
                <a href="https://www.youtube.com/@AmnesiaskateboardsAu" target="_blank" rel="noopener" aria-label="YouTube">📹</a>
                <a href="https://vimeo.com/amnesiaskateboards" target="_blank" rel="noopener" aria-label="Vimeo">🎬</a>
            </div>
        </div>
        
        <div class="footer-column">
            <h3>Legal</h3>
            <ul>
                <li><a href="<?php echo esc_url(home_url('/terms-of-service')); ?>">Terms of Service</a></li>
                <li><a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">Privacy Policy</a></li>
                <li><a href="<?php echo esc_url(home_url('/shipping-policy')); ?>">Shipping Policy</a></li>
                <li><a href="<?php echo esc_url(home_url('/refund-policy')); ?>">Refund Policy</a></li>
            </ul>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
