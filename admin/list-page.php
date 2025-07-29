<?php
if (!defined('ABSPATH')) exit;

function cab_render_list_page() {
    $accordions = get_option('cab_accordions', []);
    ?>
    <div class="wrap">
        <h1>Custom Accordions</h1>
        <a href="<?php echo admin_url('admin.php?page=cab_accordion_edit'); ?>" class="button button-primary">+ Add New Accordion</a>
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>Accordion ID</th>
                    <th>Shortcode</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($accordions)) : ?>
                    <?php foreach ($accordions as $id => $items): ?>
                        <tr>
                            <td><strong><?php echo esc_html($id); ?></strong></td>
                            <td><code>[custom_accordion id="<?php echo esc_attr($id); ?>"]</code></td>
                            <td>
                                <a href="<?php echo admin_url('admin.php?page=cab_accordion_edit&edit=' . urlencode($id)); ?>" class="button">Edit</a>
                                <a href="<?php echo wp_nonce_url(admin_url('admin.php?page=cab_accordion_list&delete=' . urlencode($id)), 'cab_delete_' . $id); ?>" class="button delete-button" onclick="return confirm('Delete this accordion?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="3">No accordions found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php

    // Handle delete action
    if (isset($_GET['delete']) && check_admin_referer('cab_delete_' . $_GET['delete'])) {
        $accordions = get_option('cab_accordions', []);
        unset($accordions[sanitize_title($_GET['delete'])]);
        update_option('cab_accordions', $accordions);

        wp_safe_redirect(admin_url('admin.php?page=cab_accordion_list'));
        exit;
    }
}
