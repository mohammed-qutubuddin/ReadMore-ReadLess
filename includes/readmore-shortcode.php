<?php
function my_readmore_shortcode($atts, $content = null) {
    static $count = 0;
    $count++;
    $wrapper_id = 'readmore-wrap-' . $count;
    $bg_color   = get_option('readmore_button_color', '#337ab7');
    $font_color = get_option('readmore_button_font_color', '#ffffff');
    $more       = get_option('readmore_more_text', 'Read More');
    $less       = get_option('readmore_less_text', 'Read Less');
    $fontsize   = get_option('readmore_font_size', 16);


    ob_start();
    ?>
    <div id="<?php echo esc_attr($wrapper_id); ?>" class="rmsc-readmore-wrap">
        <div class="rmsc-readmore-content">
            <?php echo do_shortcode($content); ?>
        </div>
        <button
            class="rmsc-readmore-btn"
            style="background:<?php echo esc_attr($bg_color); ?>;
                   color:<?php echo esc_attr($font_color); ?>;
                   font-size:<?php echo intval($fontsize); ?>px;"
            type="button"
            onclick="rmsc_toggle_content('<?php echo esc_js($wrapper_id); ?>')"
            data-more="<?php echo esc_attr($more); ?>"
            data-less="<?php echo esc_attr($less); ?>"
        ><?php echo esc_html($more); ?></button>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('readmore', 'my_readmore_shortcode');

// Enqueue scripts and styles
function my_readmore_scripts() {
    $dir = plugin_dir_url(dirname(__FILE__));
    wp_enqueue_script('rmsc-readmore', $dir . 'assets/js/readmore.js', [], '1.0.0', true);
    wp_enqueue_style('rmsc-readmore', $dir . 'assets/css/readmore.css', [], '1.0.0');
}
add_action('wp_enqueue_scripts', 'my_readmore_scripts');
