<?php
/**
 * Plugin Name: Auth Images Manager
 * Description: A plugin to upload and manage signup and login images, with a REST API to fetch them.
 * Version: 1.1
 * Author: Your Name
 * Text Domain: auth-images
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register the settings page
add_action('admin_menu', function () {
    add_options_page(
        'Login and Signup Images',
        'Auth Images',
        'manage_options',
        'auth-images',
        'auth_images_settings_page'
    );
});

// Register settings and fields
add_action('admin_init', function () {
    register_setting('auth-images-settings-group', 'signup_image_id');
    register_setting('auth-images-settings-group', 'login_image_id');

    add_settings_section('auth-images-section', 'Authentication Images', null, 'auth-images');

    add_settings_field(
        'signup_image',
        'Signup Page Image',
        'auth_image_upload_field',
        'auth-images',
        'auth-images-section',
        ['option_name' => 'signup_image_id']
    );

    add_settings_field(
        'login_image',
        'Login Page Image',
        'auth_image_upload_field',
        'auth-images',
        'auth-images-section',
        ['option_name' => 'login_image_id']
    );
});

// Render the upload fields
function auth_image_upload_field($args) {
    $option_name = $args['option_name'];
    $image_id = get_option($option_name, '');
    $image_url = $image_id ? wp_get_attachment_url($image_id) : '';

    ?>
    <div>
        <input type="hidden" name="<?php echo esc_attr($option_name); ?>" id="<?php echo esc_attr($option_name); ?>" value="<?php echo esc_attr($image_id); ?>">
        <button type="button" class="button auth-image-upload-button" data-target="<?php echo esc_attr($option_name); ?>">Upload Image</button>
        <button type="button" class="button auth-image-remove-button" data-target="<?php echo esc_attr($option_name); ?>">Remove Image</button>
        <div class="auth-image-preview" style="margin-top: 10px;">
            <?php if ($image_url): ?>
                <img src="<?php echo esc_url($image_url); ?>" style="max-width: 300px; max-height: 300px;">
            <?php endif; ?>
        </div>
	<span>Image Url : <?php echo esc_url($image_url); ?> </span>
    </div>
    <?php
}

// Render the settings page
function auth_images_settings_page() {
    ?>
    <div class="wrap">
        <h1>Login and Signup Images</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('auth-images-settings-group');
            do_settings_sections('auth-images');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Enqueue admin scripts
add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook === 'settings_page_auth-images') {
        wp_enqueue_media();
        wp_enqueue_script('auth-images-script', plugin_dir_url(__FILE__) . 'auth-images.js', ['jquery'], null, true);
    }
});

// Register REST API endpoint
add_action('rest_api_init', function () {
    register_rest_route('auth-images/v1', '/images', [
        'methods' => 'GET',
        'callback' => 'get_auth_images',
        'permission_callback' => '__return_true',
    ]);
});

// REST API callback function
function get_auth_images() {
    $signup_image_id = get_option('signup_image_id', '');
    $login_image_id = get_option('login_image_id', '');

    return [
        'signup_image' => $signup_image_id ? wp_get_attachment_url($signup_image_id) : null,
        'login_image' => $login_image_id ? wp_get_attachment_url($login_image_id) : null,
    ];
}

