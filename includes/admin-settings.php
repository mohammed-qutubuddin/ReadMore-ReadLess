<?php
// Settings Page Register and Render
add_action('admin_menu', function() {
    add_options_page(
        'Read More Settings',
        'Read More',
        'manage_options',
        'readmore-settings',
        'my_readmore_settings_page'
    );
});

// Settings Register
add_action('admin_init', function() {
    register_setting('readmore_settings_group', 'readmore_button_color', [
    'sanitize_callback' => 'sanitize_hex_color',
    ]);
    register_setting('readmore_settings_group', 'readmore_button_font_color', [
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    register_setting('readmore_settings_group', 'readmore_more_text', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    register_setting('readmore_settings_group', 'readmore_less_text', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    register_setting('readmore_settings_group', 'readmore_font_size', [
        'sanitize_callback' => 'absint',
    ]);

    });

function my_readmore_settings_page() {
    ?>
    <div class="wrap">
        <h2>Read More Button Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('readmore_settings_group'); ?>
            <table class="form-table">
                <tr>
                    <th>Button Background Color</th>
                    <td>
                        <input type="text" name="readmore_button_color" class="my-color-field"
                            value="<?php echo esc_attr(get_option('readmore_button_color', '#337ab7')); ?>" data-default-color="#337ab7">
                    </td>
                </tr>
                <tr>
                    <th>Button Font Color</th>
                    <td>
                        <input type="text" name="readmore_button_font_color" class="my-color-field"
                            value="<?php echo esc_attr(get_option('readmore_button_font_color', '#ffffff')); ?>" data-default-color="#ffffff">
                    </td>
                </tr>
                <tr>
                    <th>Read More Text</th>
                    <td>
                        <input type="text" name="readmore_more_text"
                            value="<?php echo esc_attr(get_option('readmore_more_text', 'Read More')); ?>">
                    </td>
                </tr>
                <tr>
                    <th>Read Less Text</th>
                    <td>
                        <input type="text" name="readmore_less_text"
                            value="<?php echo esc_attr(get_option('readmore_less_text', 'Read Less')); ?>">
                    </td>
                </tr>
                <tr>
                    <th>Button Font Size (px)</th>
                    <td>
                        <input type="number" min="10" max="48" name="readmore_font_size"
                            value="<?php echo esc_attr(get_option('readmore_font_size', 16)); ?>"> px
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <script>
        (function($){
            $(function(){
                if ($.fn.wpColorPicker) {
                    $('.my-color-field').wpColorPicker();
                }
            });
        })(jQuery);
    </script>
    <?php
}

// Enqueue color picker
add_action('admin_enqueue_scripts', function($hook) {
    if ( $hook === 'settings_page_readmore-settings' ) {
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
    }
});
