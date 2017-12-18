<?php
if (!function_exists('mch_add_meta_boxes')):
    function mch_add_meta_boxes()
    {
        add_meta_box('happy_customers', __('Happy Customers', 'mch_localization'), 'happy_customers_meta_box_callback', 'achievements', 'normal', 'default');
        add_meta_box('completed_requests', __('Completed Requests', 'mch_localization'), 'completed_requests_meta_box_callback', 'achievements', 'normal', 'default');
        add_meta_box('pre_orders', __('Pre Orders', 'mch_localization'), 'pre_orders_meta_box_callback', 'achievements', 'normal', 'default');

        add_meta_box('parent', __('Parent', 'mch_localization'), 'parent_meta_box_callback', 'points', 'side', 'default');
        add_meta_box('short_desc', __('Short Description', 'mch_localization'), 'short_desc_meta_box_callback', 'points', 'normal', 'default');
        add_meta_box('address', __('Address', 'mch_localization'), 'address_meta_box_callback', 'points');
        add_meta_box('location', __('Location', 'mch_localization'), 'location_meta_box_callback', 'points');

        add_meta_box('map_setting', __('Map Settings', 'mch_localization'), 'map_settings_meta_box_callback', 'maps', 'normal', 'default');

        add_meta_box('contacts', __('Contacts', 'mch_localization'), 'contacts_meta_box_callback', 'contacts', 'normal', 'default');
        add_meta_box('socials', __('Social Profiles', 'mch_localization'), 'socials_meta_box_callback', 'contacts', 'normal', 'default');
    }
endif;
add_action('add_meta_boxes', 'mch_add_meta_boxes');

function happy_customers_meta_box_callback($post)
{
    wp_nonce_field(plugin_basename(__FILE__), 'meta_box_nonce');

    $title = get_post_meta($post->ID, '_meta-happy-customers-title', true);
    $num = get_post_meta($post->ID, '_meta-happy-customers-num', true);

    echo '<div style="margin:12px 0">';
    echo '<label for="_meta-happy-customers-title" style="min-width:75px;display:inline-block;vertical-align:middle;">' . __('Title', 'mch_localization') . '</label>';
    echo '<input type="text" id="_meta-happy-customers-title" name="_meta-happy-customers-title" style="min-width:225px;" value="' . esc_textarea($title ? $title : 'Счастливых клиентов') . '"/>';
    echo '</div>';

    echo '<div>';
    echo '<label for="_meta-happy-customers-num" style="min-width:75px;display:inline-block;vertical-align:middle;">' . __('Amount', 'mch_localization') . '</label>';
    echo '<input type="number" id="_meta-happy-customers-num" name="_meta-happy-customers-num" style="min-width:225px;" value="' . esc_textarea($num ? $num : 0) . '"/>';
    echo '</div>';
}

function completed_requests_meta_box_callback($post)
{
    wp_nonce_field(plugin_basename(__FILE__), 'meta_box_nonce');

    $title = get_post_meta($post->ID, '_meta-completed-requests-title', true);
    $num = get_post_meta($post->ID, '_meta-completed-requests-num', true);

    echo '<div style="margin:12px 0">';
    echo '<label for="_meta-completed-requests-title" style="min-width:75px;display:inline-block;vertical-align:middle;">' . __('Title', 'mch_localization') . '</label>';
    echo '<input type="text" id="_meta-completed-requests-title" name="_meta-completed-requests-title" style="min-width:225px;" value="' . esc_textarea($title ? $title : 'Выполненых заявок') . '"/>';
    echo '</div>';

    echo '<div>';
    echo '<label for="_meta-completed-requests-num" style="min-width:75px;display:inline-block;vertical-align:middle;">' . __('Amount', 'mch_localization') . '</label>';
    echo '<input type="number" id="_meta-completed-requests-num" name="_meta-completed-requests-num" style="min-width:225px;" value="' . esc_textarea($num ? $num : 0) . '"/>';
    echo '</div>';
}

function pre_orders_meta_box_callback($post)
{
    wp_nonce_field(plugin_basename(__FILE__), 'meta_box_nonce');

    $title = get_post_meta($post->ID, '_meta-pre-orders-title', true);
    $num = get_post_meta($post->ID, '_meta-pre-orders-num', true);

    echo '<div style="margin:12px 0">';
    echo '<label for="_meta-pre-orders-title" style="min-width:75px;display:inline-block;vertical-align:middle;">' . __('Title', 'mch_localization') . '</label>';
    echo '<input type="text" id="_meta-pre-orders-title" name="_meta-pre-orders-title" style="min-width:225px;" value="' . esc_textarea($title ? $title : 'Предзаказов') . '"/>';
    echo '</div>';

    echo '<div>';
    echo '<label for="_meta-pre-orders-num" style="min-width:75px;display:inline-block;vertical-align:middle;">' . __('Amount', 'mch_localization') . '</label>';
    echo '<input type="number" id="_meta-pre-orders-num" name="_meta-pre-orders-num" style="min-width:225px;" value="' . esc_textarea($num ? $num : 0) . '"/>';
    echo '</div>';

    echo '<input name="_custom-meta-fields" value="_meta-happy-customers-title _meta-happy-customers-num _meta-completed-requests-title _meta-completed-requests-num _meta-pre-orders-title _meta-pre-orders-num" hidden/>';
}

function parent_meta_box_callback($post)
{
    wp_nonce_field(plugin_basename(__FILE__), 'meta_box_nonce');

    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'points',
        'exclude' => $post->ID
    );
    $posts = get_posts($args);
    $posts_without_parent = array();

    foreach ($posts as $key => $p) {
        $meta_value = get_post_meta($p->ID, '_meta-point-parent-id', true);

        if (empty($meta_value)) {
            $posts_without_parent[$p->ID] = !empty($p->post_title) ? $p->post_title : 'Post ID: ' . $p->ID;
        }
    }

    echo '<select name="_meta-point-parent-id" style="margin-top:6px;width:100%">';
    echo '<option value="">--</option>';
    foreach ($posts_without_parent as $key => $pwp) {
        if ($key == get_post_meta($post->ID, "_meta-point-parent-id", true)) {
            ?>
            <option selected value="<?php echo $key; ?>"><?php echo $pwp; ?></option>
            <?php
        } else {
            ?>
            <option value="<?php echo $key; ?>"><?php echo $pwp; ?></option>
            <?php
        }
    }
    echo '</select>';
}

function short_desc_meta_box_callback($post)
{
    wp_nonce_field(plugin_basename(__FILE__), 'meta_box_nonce');

    $meta_value = get_post_meta($post->ID, '_meta-point-short-desc', true);

    wp_editor($meta_value, '_meta-point-short-desc', array(
        'wpautop' => false,
        'textarea_name' => '_meta-point-short-desc',
        'textarea_rows' => 7,
        'teeny' => false
    ));
}

function address_meta_box_callback($post)
{
    wp_nonce_field(plugin_basename(__FILE__), 'meta_box_nonce');

    $current_address = get_post_meta($post->ID, '_meta-point-address', true);

    echo '<textarea type="text" id="_meta-point-address" name="_meta-point-address" style="display:block;margin-top:12px;height:4em;width:100%;">' . esc_textarea($current_address) . '</textarea>';
}

function location_meta_box_callback($post)
{
    wp_nonce_field(plugin_basename(__FILE__), 'meta_box_nonce');

    $current_lat = get_post_meta($post->ID, '_meta-point-lat', true);
    $current_lng = get_post_meta($post->ID, '_meta-point-lng', true);

    echo '<div style="display:flex;align-items:center">';
    echo '<label for="_meta-point-lat" style="padding-right:5px">' . __('Latitude', 'mch_localization') . '</label>';
    echo '<input type="number" step="any" id="_meta-point-lat" name="_meta-point-lat" value="' . esc_textarea($current_lat) . '" style="margin-right:20px"/>';

    echo '<label for="_meta-point-lng" style="padding-right:5px">' . __('Longitude', 'mch_localization') . '</label>';
    echo '<input type="number" step="any" id="_meta-point-lng" name="_meta-point-lng" value="' . esc_textarea($current_lng) . '"/>';
    echo '</div>';

    echo '<input name="_custom-meta-fields" value="_meta-point-parent-id _meta-point-short-desc _meta-point-address _meta-point-lat _meta-point-lng" hidden/>';
}

function map_settings_meta_box_callback($post)
{
    wp_nonce_field(plugin_basename(__FILE__), 'meta_box_nonce');

    $api = get_post_meta($post->ID, '_meta-map-api', true);
    $lat = get_post_meta($post->ID, '_meta-map-lat', true);
    $lng = get_post_meta($post->ID, '_meta-map-lng', true);
    $zoom = get_post_meta($post->ID, '_meta-map-zoom', true);

    echo '<div style="margin:12px 0">';
    echo '<label for="_meta-map-api" style="min-width:75px;display:inline-block;vertical-align:middle;">' . __('Api key', 'mch_localization') . '</label>';
    echo '<input type="text" id="_meta-map-api" name="_meta-map-api" style="min-width:225px;" value="' . esc_textarea($api) . '"/>';
    echo '</div>';

    echo '<div style="margin:12px 0">';
    echo '<label for="_meta-map-lat" style="min-width:75px;display:inline-block;vertical-align:middle;">' . __('Latitude', 'mch_localization') . '</label>';
    echo '<input type="number" id="_meta-map-lat" name="_meta-map-lat" style="min-width:225px;" value="' . esc_textarea($lat ? $lat : 41.3108501) . '"/>';
    echo '</div>';

    echo '<div style="margin:12px 0">';
    echo '<label for="_meta-map-lng" style="min-width:75px;display:inline-block;vertical-align:middle;">' . __('Longitude', 'mch_localization') . '</label>';
    echo '<input type="number" id="_meta-map-lng" name="_meta-map-lng" style="min-width:225px;" value="' . esc_textarea($lng ? $lng : 69.2816558) . '"/>';
    echo '</div>';

    echo '<div>';
    echo '<label for="_meta-map-zoom" style="min-width:75px;display:inline-block;vertical-align:middle;">' . __('Zoom', 'mch_localization') . '</label>';
    echo '<input type="number" id="_meta-map-zoom" name="_meta-map-zoom" style="min-width:225px;" value="' . esc_textarea($zoom ? $zoom : 15) . '"/>';
    echo '</div>';

    echo '<input name="_custom-meta-fields" value="_meta-map-api _meta-map-lat _meta-map-lng _meta-map-zoom" hidden/>';
}

function contacts_meta_box_callback($post)
{
    wp_nonce_field(plugin_basename(__FILE__), 'meta_box_nonce');

    $mail = get_post_meta($post->ID, '_meta-contact-mail', true);
    $phone = get_post_meta($post->ID, '_meta-contact-phone', true);
    $start = get_post_meta($post->ID, '_meta-wh-start', true);
    $end = get_post_meta($post->ID, '_meta-wh-end', true);

    echo '<div style="margin:12px 0">';
    echo '<label for="_meta-contact-mail" style="min-width:75px;display:inline-block;vertical-align:middle;">' . __('Email', 'mch_localization') . '</label>';
    echo '<input type="email" id="_meta-contact-mail" name="_meta-contact-mail" placeholder="example@mail.com" style="min-width:225px;" value="' . esc_textarea($mail) . '"/>';
    echo '</div>';

    echo '<div style="margin:12px 0">';
    echo '<label for="_meta-contact-phone" style="min-width:75px;display:inline-block;vertical-align:middle;">' . __('Phone', 'mch_localization') . '</label>';
    echo '<input type="tel" id="_meta-contact-phone" name="_meta-contact-phone" placeholder="+998 97 777 77 77" style="min-width:225px;" value="' . esc_textarea($phone) . '"/>';
    echo '</div>';

    echo '<div style="margin:12px 0">';
    echo '<label for="_meta-wh-start" style="min-width:75px;display:inline-block;vertical-align:middle;">' . __('WH start', 'mch_localization') . '</label>';
    echo '<input type="time" id="_meta-wh-start" name="_meta-wh-start" style="min-width:225px;" value="' . esc_textarea($start) . '"/>';
    echo '</div>';

    echo '<div style="margin:12px 0">';
    echo '<label for="_meta-wh-end" style="min-width:75px;display:inline-block;vertical-align:middle;">' . __('WH end', 'mch_localization') . '</label>';
    echo '<input type="time" id="_meta-wh-end" name="_meta-wh-end" style="min-width:225px;" value="' . esc_textarea($end) . '"/>';
    echo '</div>';
}

function socials_meta_box_callback($post)
{
    wp_nonce_field(plugin_basename(__FILE__), 'meta_box_nonce');

    $instagram = get_post_meta($post->ID, '_meta-socials-in', true);
    $facebook = get_post_meta($post->ID, '_meta-socials-fb', true);
    $telegram = get_post_meta($post->ID, '_meta-socials-tg', true);

    echo '<div style="margin:12px 0">';
    echo '<label for="_meta-socials-in" style="min-width:75px;display:inline-block;vertical-align:middle;">Instagram</label>';
    echo '<input type="text" id="_meta-socials-in" name="_meta-socials-in" placeholder="username" style="min-width:225px;" value="' . esc_textarea($instagram) . '"/>';
    echo '</div>';

    echo '<div style="margin:12px 0">';
    echo '<label for="_meta-socials-fb" style="min-width:75px;display:inline-block;vertical-align:middle;">Facebook</label>';
    echo '<input type="text" id="_meta-socials-fb" name="_meta-socials-fb" placeholder="username" style="min-width:225px;" value="' . esc_textarea($facebook) . '"/>';
    echo '</div>';

    echo '<div style="margin:12px 0">';
    echo '<label for="_meta-socials-tg" style="min-width:75px;display:inline-block;vertical-align:middle;">Telegram</label>';
    echo '<input type="text" id="_meta-socials-tg" name="_meta-socials-tg" placeholder="username" style="min-width:225px;" value="' . esc_textarea($telegram) . '"/>';
    echo '</div>';

    echo '<input name="_custom-meta-fields" value="_meta-contact-mail _meta-contact-phone _meta-wh-start _meta-wh-end _meta-socials-in _meta-socials-fb _meta-socials-tg" hidden/>';
}

if (!function_exists('mch_save_meta_data')):
    function mch_save_meta_data($post_id)
    {
        if (isset($_POST['_custom-meta-fields'])) {

            if (empty($_POST) || !wp_verify_nonce($_POST['meta_box_nonce'], plugin_basename(__FILE__)))
                return;

            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return;

            if (!current_user_can('edit_post', $post_id))
                return;

            $meta_fields = explode(' ', $_POST['_custom-meta-fields']);

            foreach ($meta_fields as $field) {

                if (isset($_POST[$field])) {

                    if ($field === '_meta-point-short-desc') {
                        update_post_meta($post_id, '_meta-point-short-desc', $_POST[$field]);
                    } else {
                        $data = sanitize_text_field($_POST[$field]);
                        update_post_meta($post_id, $field, $data);
                    }
                }
            }
        }
    }
endif;
add_action('save_post', 'mch_save_meta_data'); ?>
