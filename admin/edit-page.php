<?php
if (!defined('ABSPATH')) exit;

function cab_render_edit_page() {
    $accordions = get_option('cab_accordions', []);
    $editing_id = isset($_GET['edit']) ? sanitize_title($_GET['edit']) : '';
    $editing_data = $editing_id && isset($accordions[$editing_id]) ? $accordions[$editing_id] : [];

    ?>
    <div class="wrap">
        <h1><?php echo $editing_id ? 'Edit Accordion' : 'Add New Accordion'; ?></h1>
        <form method="post">
            <?php wp_nonce_field('cab_save_accordion', 'cab_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th><label for="cab_accordion_id">Accordion ID</label></th>
                    <td>
                        <input type="text" name="cab_accordion_id" id="cab_accordion_id"
                               value="<?php echo esc_attr($editing_id); ?>" <?php if ($editing_id) echo 'readonly'; ?> required />
                        <p class="description">Used in shortcode: <code>[custom_accordion id="your-id"]</code></p>
                    </td>
                </tr>
                <tr>
                    <th>Accordion Items</th>
                    <td>
                        <div id="cab-items">
                            <?php if (!empty($editing_data)) :
                                foreach ($editing_data as $index => $item): ?>
                                    <div class="cab-item">
                                        <input type="text" name="cab_items[<?php echo $index; ?>][title]"
                                               value="<?php echo esc_attr($item['title']); ?>" placeholder="Title" required />
                                        <textarea name="cab_items[<?php echo $index; ?>][content]"
                                                  placeholder="Content" required><?php echo esc_textarea($item['content']); ?></textarea>
                                        <button type="button" class="button cab-remove-item">Remove</button>
                                    </div>
                                <?php endforeach;
                            else: ?>
                                <div class="cab-item">
                                    <input type="text" name="cab_items[0][title]" placeholder="Title" required />
                                    <textarea name="cab_items[0][content]" placeholder="Content" required></textarea>
                                    <button type="button" class="button cab-remove-item">Remove</button>
                                </div>
                            <?php endif; ?>
                        </div>
                        <button type="button" class="button" id="cab-add-item">+ Add Item</button>
                    </td>
                </tr>
            </table>
            <p><input type="submit" name="cab_save" class="button button-primary" value="Save Accordion" /></p>
        </form>
        <p><a href="<?php echo admin_url('admin.php?page=cab_accordion_list'); ?>">← Back to list</a></p>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('cab-items');
        const addBtn = document.getElementById('cab-add-item');

        let index = container.querySelectorAll('.cab-item').length;

        addBtn.addEventListener('click', () => {
            const item = document.createElement('div');
            item.classList.add('cab-item');

            item.innerHTML = `
                <input type="text" name="cab_items[${index}][title]" placeholder="Title" required />
                <textarea name="cab_items[${index}][content]" placeholder="Content" required></textarea>
                <button type="button" class="button cab-remove-item">Remove</button>
            `;

            container.appendChild(item);
            index++;

            attachRemoveHandlers();
        });

        function attachRemoveHandlers() {
            container.querySelectorAll('.cab-remove-item').forEach(button => {
                button.onclick = function () {
                    this.parentElement.remove();
                };
            });
        }

        attachRemoveHandlers();
    });
    </script>

    <style>
        .cab-item {
            margin-bottom: 15px;
            padding: 10px;
            background: #f9f9f9;
            border: 1px solid #ddd;
        }

        .cab-item input[type="text"],
        .cab-item textarea {
            width: 100%;
            margin-bottom: 5px;
        }

        .cab-item textarea {
            height: 100px;
        }

        #cab-items .cab-item .cab-remove-item {
            margin-top: 5px;
        }
    </style>
    <?php
}

// Handle form submission
add_action('admin_init', function () {
    if (isset($_POST['cab_save']) && check_admin_referer('cab_save_accordion', 'cab_nonce')) {
        $id = sanitize_title($_POST['cab_accordion_id']);
        $items = $_POST['cab_items'] ?? [];

        $cleaned_items = [];
        foreach ($items as $item) {
            if (trim($item['title']) === '' && trim($item['content']) === '') continue;
            $cleaned_items[] = [
                'title' => sanitize_text_field($item['title']),
                'content' => wp_kses_post($item['content']),
            ];
        }

        $accordions = get_option('cab_accordions', []);
        $accordions[$id] = $cleaned_items;
        update_option('cab_accordions', $accordions);

        wp_safe_redirect(admin_url('admin.php?page=cab_accordion_list'));
        exit;
    }
});
