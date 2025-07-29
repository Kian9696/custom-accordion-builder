<?php
if (!defined('ABSPATH'))
    exit;

function cab_render_style_settings_page()
{
    $options = get_option('cab_style_options', [
        'background_color' => '#ffffff',
        'font_size' => '16px',
        'border_color' => '#cccccc',
        'border_width' => '1px'
    ]);
    ?>
    <div class="wrap">
        <h1>تنظیمات استایل آکاردئون</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('cab_style_group');
            do_settings_sections('cab_accordion_styles');
            ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="background_color">رنگ پس‌زمینه</label></th>
                    <td><input type="color" id="background_color" name="cab_style_options[background_color]"
                            value="<?php echo esc_attr($options['background_color']); ?>"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="font_size">سایز فونت</label></th>
                    <td><input type="text" id="font_size" name="cab_style_options[font_size]"
                            value="<?php echo esc_attr($options['font_size']); ?>"> (مثلاً 16px)</td>
                </tr>
                <tr>
                    <th scope="row"><label for="border_color">رنگ بوردر</label></th>
                    <td><input type="color" id="border_color" name="cab_style_options[border_color]"
                            value="<?php echo esc_attr($options['border_color']); ?>"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="border_width">عرض بوردر</label></th>
                    <td><input type="text" id="border_width" name="cab_style_options[border_width]"
                            value="<?php echo esc_attr($options['border_width']); ?>"> (مثلاً 1px)</td>
                </tr>
                <tr>
                    <th scope="row"><label for="header_padding">پدینگ عنوان (header)</label></th>
                    <td><input type="text" id="header_padding" name="cab_style_options[header_padding]"
                            value="<?php echo esc_attr($options['header_padding'] ?? '1em'); ?>"> (مثلاً 1em یا 10px)</td>
                </tr>
                <tr>
                    <th scope="row"><label for="panel_background">رنگ پس‌زمینه پنل</label></th>
                    <td><input type="color" id="panel_background" name="cab_style_options[panel_background]"
                            value="<?php echo esc_attr($options['panel_background'] ?? '#ffffff'); ?>"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="content_padding">پدینگ محتوای آکاردئون</label></th>
                    <td><input type="text" id="content_padding" name="cab_style_options[content_padding]"
                            value="<?php echo esc_attr($options['content_padding'] ?? '1em'); ?>"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="content_font_size">سایز فونت محتوا</label></th>
                    <td><input type="text" id="content_font_size" name="cab_style_options[content_font_size]"
                            value="<?php echo esc_attr($options['content_font_size'] ?? '1rem'); ?>"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="content_border_width">عرض بوردر محتوا</label></th>
                    <td><input type="text" id="content_border_width" name="cab_style_options[content_border_width]"
                            value="<?php echo esc_attr($options['content_border_width'] ?? '1px'); ?>"></td>
                </tr>

            </table>
            <?php submit_button('ذخیره تنظیمات'); ?>
        </form>
    </div>
    <?php
}

function cab_register_style_settings()
{
    register_setting('cab_style_group', 'cab_style_options');
}
add_action('admin_init', 'cab_register_style_settings');
