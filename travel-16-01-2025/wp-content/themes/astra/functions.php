<?php
/**
 * Astra functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
define( 'ASTRA_THEME_VERSION', '4.8.2' );
define( 'ASTRA_THEME_SETTINGS', 'astra-settings' );
define( 'ASTRA_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'ASTRA_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );

/**
 * Minimum Version requirement of the Astra Pro addon.
 * This constant will be used to display the notice asking user to update the Astra addon to the version defined below.
 */
define( 'ASTRA_EXT_MIN_VER', '4.8.2' );

/**
 * Setup helper functions of Astra.
 */
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-theme-options.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-theme-strings.php';
require_once ASTRA_THEME_DIR . 'inc/core/common-functions.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-icons.php';

define( 'ASTRA_PRO_UPGRADE_URL', astra_get_pro_url( 'https://wpastra.com/pricing/', 'dashboard', 'free-theme', 'dashboard' ) );
define( 'ASTRA_PRO_CUSTOMIZER_UPGRADE_URL', astra_get_pro_url( 'https://wpastra.com/pricing/', 'customizer', 'free-theme', 'upgrade' ) );

/**
 * Update theme
 */
require_once ASTRA_THEME_DIR . 'inc/theme-update/astra-update-functions.php';
require_once ASTRA_THEME_DIR . 'inc/theme-update/class-astra-theme-background-updater.php';

/**
 * Fonts Files
 */
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-font-families.php';
if ( is_admin() ) {
	require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-fonts-data.php';
}

require_once ASTRA_THEME_DIR . 'inc/lib/webfont/class-astra-webfont-loader.php';
require_once ASTRA_THEME_DIR . 'inc/lib/docs/class-astra-docs-loader.php';
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-fonts.php';

require_once ASTRA_THEME_DIR . 'inc/dynamic-css/custom-menu-old-header.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/container-layouts.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/astra-icons.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-walker-page.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-enqueue-scripts.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-gutenberg-editor-css.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-wp-editor-css.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/block-editor-compatibility.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/inline-on-mobile.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/content-background.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-dynamic-css.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-global-palette.php';

/**
 * Custom template tags for this theme.
 */
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-attr.php';
require_once ASTRA_THEME_DIR . 'inc/template-tags.php';

require_once ASTRA_THEME_DIR . 'inc/widgets.php';
require_once ASTRA_THEME_DIR . 'inc/core/theme-hooks.php';
require_once ASTRA_THEME_DIR . 'inc/admin-functions.php';
require_once ASTRA_THEME_DIR . 'inc/core/sidebar-manager.php';

/**
 * Markup Functions
 */
require_once ASTRA_THEME_DIR . 'inc/markup-extras.php';
require_once ASTRA_THEME_DIR . 'inc/extras.php';
require_once ASTRA_THEME_DIR . 'inc/blog/blog-config.php';
require_once ASTRA_THEME_DIR . 'inc/blog/blog.php';
require_once ASTRA_THEME_DIR . 'inc/blog/single-blog.php';

/**
 * Markup Files
 */
require_once ASTRA_THEME_DIR . 'inc/template-parts.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-loop.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-mobile-header.php';

/**
 * Functions and definitions.
 */
require_once ASTRA_THEME_DIR . 'inc/class-astra-after-setup-theme.php';

// Required files.
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-admin-helper.php';

require_once ASTRA_THEME_DIR . 'inc/schema/class-astra-schema.php';

/* Setup API */
require_once ASTRA_THEME_DIR . 'admin/includes/class-astra-api-init.php';

if ( is_admin() ) {
	/**
	 * Admin Menu Settings
	 */
	require_once ASTRA_THEME_DIR . 'inc/core/class-astra-admin-settings.php';
	require_once ASTRA_THEME_DIR . 'admin/class-astra-admin-loader.php';
	require_once ASTRA_THEME_DIR . 'inc/lib/astra-notices/class-astra-notices.php';
}

/**
 * Metabox additions.
 */
require_once ASTRA_THEME_DIR . 'inc/metabox/class-astra-meta-boxes.php';

require_once ASTRA_THEME_DIR . 'inc/metabox/class-astra-meta-box-operations.php';

/**
 * Customizer additions.
 */
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-customizer.php';

/**
 * Astra Modules.
 */
require_once ASTRA_THEME_DIR . 'inc/modules/posts-structures/class-astra-post-structures.php';
require_once ASTRA_THEME_DIR . 'inc/modules/related-posts/class-astra-related-posts.php';

/**
 * Compatibility
 */
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-gutenberg.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-jetpack.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/woocommerce/class-astra-woocommerce.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/edd/class-astra-edd.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/lifterlms/class-astra-lifterlms.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/learndash/class-astra-learndash.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-beaver-builder.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-bb-ultimate-addon.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-contact-form-7.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-visual-composer.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-site-origin.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-gravity-forms.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-bne-flyout.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-ubermeu.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-divi-builder.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-amp.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-yoast-seo.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/surecart/class-astra-surecart.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-starter-content.php';
require_once ASTRA_THEME_DIR . 'inc/addons/transparent-header/class-astra-ext-transparent-header.php';
require_once ASTRA_THEME_DIR . 'inc/addons/breadcrumbs/class-astra-breadcrumbs.php';
require_once ASTRA_THEME_DIR . 'inc/addons/scroll-to-top/class-astra-scroll-to-top.php';
require_once ASTRA_THEME_DIR . 'inc/addons/heading-colors/class-astra-heading-colors.php';
require_once ASTRA_THEME_DIR . 'inc/builder/class-astra-builder-loader.php';

// Elementor Compatibility requires PHP 5.4 for namespaces.
if ( version_compare( PHP_VERSION, '5.4', '>=' ) ) {
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-elementor.php';
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-elementor-pro.php';
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-web-stories.php';
}

// Beaver Themer compatibility requires PHP 5.3 for anonymous functions.
if ( version_compare( PHP_VERSION, '5.3', '>=' ) ) {
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-beaver-themer.php';
}

require_once ASTRA_THEME_DIR . 'inc/core/markup/class-astra-markup.php';

/**
 * Load deprecated functions
 */
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-filters.php';
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-hooks.php';
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-functions.php';

function custom_single_post_styles() {
    if (is_single() || is_page(32)) {  // Checks if it's a single post page
        wp_enqueue_style('single-post-style', get_template_directory_uri() . '/assets/css/minified/styles.css');
    }
}
add_action('wp_enqueue_scripts', 'custom_single_post_styles');


function enqueue_slick_slider() {
    wp_enqueue_style('slick-slider-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    wp_enqueue_script('slick-slider-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_slick_slider');

// function add_custom_js() {
//     if ( is_front_page() ) { // Only add it to the homepage
//         wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom.js', array(), false, true );
//     }
// }
// add_action( 'wp_enqueue_scripts', 'add_custom_js' );

function add_amplify_script() {
    wp_enqueue_script('amplify-js', 'https://unpkg.com/aws-amplify@latest/dist/aws-amplify.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'add_amplify_script');

function form_shortcode() {
    ob_start();
    include get_template_directory() . '/form-template.php';
    return ob_get_clean();
}
add_shortcode('Main-Form', 'form_shortcode');

// add_shortcode( 'dynamic-iframe', 'dynamic_iframe_func');

// function dynamic_iframe_func($atts) {
//     $a = shortcode_atts( array(
//         'url' => '', // The URL to load in the iframe
//         'width' => '600',
//         'height' => '400',
//         'id' => 'flightIframe' // Default id for the iframe
//     ), $atts );

//     // If the URL is provided
//     if (!empty($a['url'])) {
//         // Generate a unique cache-busting parameter (timestamp)
//         $uniqueParam = 'nocache=' . time(); // You can use new Date().getTime() for more precision

//         // Add the cache-busting param to the URL
//         $finalUrl = strpos($a['url'], '?') !== false ? $a['url'] . '&' . $uniqueParam : $a['url'] . '?' . $uniqueParam;
        
//         // Return the iframe HTML with the final URL, dimensions, and custom id
//         return '<iframe id="' . esc_attr($a['id']) . '" src="' . esc_url($finalUrl) . '" width="' . esc_attr($a['width']) . '" height="' . esc_attr($a['height']) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="true"></iframe>';
//     }
    
//     return ''; // Return an empty string if no URL is provided
// }

function disable_template_cache() {
    if (is_page_template('form-template.php')) { // Replace 'form-template.php' with your template file name
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
    }
}
add_action('send_headers', 'disable_template_cache');

// Callback function for the menu page
add_action('admin_menu', 'custom_image_section_menu');
function custom_image_section_menu() {
    add_menu_page(
        'Custom Image Section',
        'Image Uploader',
        'manage_options',
        'custom-image-uploader',
        'custom_image_section_callback',
        'dashicons-format-image',
        20
    );
}

add_action('admin_enqueue_scripts', 'enqueue_custom_image_uploader_script');
function enqueue_custom_image_uploader_script($hook) {
    if ($hook !== 'toplevel_page_custom-image-uploader') {
        return;
    }
    wp_enqueue_media(); // Enqueue WordPress media uploader
}

// Callback function for the menu page
function custom_image_section_callback() {
    $upload_dir = wp_upload_dir();
    $custom_image_path_1 = $upload_dir['basedir'] . '/custom-images/custom-image-1.jpg';
    $custom_image_url_1 = $upload_dir['baseurl'] . '/custom-images/custom-image-1.jpg';
    $custom_image_path_2 = $upload_dir['basedir'] . '/custom-images/custom-image-2.jpg';
    $custom_image_url_2 = $upload_dir['baseurl'] . '/custom-images/custom-image-2.jpg';

    if (isset($_POST['upload_image_nonce']) && wp_verify_nonce($_POST['upload_image_nonce'], 'upload_image_action')) {
        // Handle Image 1 update
        if (isset($_POST['image_id_1']) && !empty($_POST['image_id_1'])) {
            $image_id_1 = intval($_POST['image_id_1']);
            $attachment_path_1 = get_attached_file($image_id_1);

            // Ensure the directory exists
            $custom_dir = $upload_dir['basedir'] . '/custom-images';
            if (!file_exists($custom_dir)) {
                wp_mkdir_p($custom_dir);
            }

            // Copy the file to the new location
            if (copy($attachment_path_1, $custom_image_path_1)) {
                echo '<div class="updated"><p>Image 1 updated successfully!</p></div>';
            } else {
                echo '<div class="error"><p>Failed to save Image 1. Check file permissions.</p></div>';
            }
        }

        // Handle Image 2 update
        if (isset($_POST['image_id_2']) && !empty($_POST['image_id_2'])) {
            $image_id_2 = intval($_POST['image_id_2']);
            $attachment_path_2 = get_attached_file($image_id_2);

            // Copy the file to the new location
            if (copy($attachment_path_2, $custom_image_path_2)) {
                echo '<div class="updated"><p>Image 2 updated successfully!</p></div>';
            } else {
                echo '<div class="error"><p>Failed to save Image 2. Check file permissions.</p></div>';
            }
        }
    }

    // Check if the images exist at the consistent URL
    $image_exists_1 = file_exists($custom_image_path_1);
    $image_exists_2 = file_exists($custom_image_path_2);
    ?>
    <div class="wrap">
        <h1>Custom Image Uploader</h1>
        <form method="post">
            <?php wp_nonce_field('upload_image_action', 'upload_image_nonce'); ?>

            <!-- Image 1 Section -->
            <div>
                <label for="upload_image_1">Upload Image 1:</label>
                <div>
                    <input type="hidden" name="image_id_1" id="image_id_1">
                    <button type="button" id="upload_image_button_1" class="button">Select Image 1</button>
                </div>
                <div id="image_preview_section_1" style="margin-top: 15px;">
                    <?php if ($image_exists_1): ?>
                        <img id="image_preview_1" src="<?php echo esc_url($custom_image_url_1); ?>" alt="Image 1" style="max-width: 300px; margin-top: 10px;">
                        <p>
                            <input type="text" id="image_url_1" value="<?php echo esc_url($custom_image_url_1); ?>" readonly style="width: 100%; margin-top: 10px;">
                            <button type="button" class="button" onclick="copyToClipboard('image_url_1')">Copy URL</button>
                        </p>
                    <?php else: ?>
                        <p>No image selected yet.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Image 2 Section -->
            <div>
                <label for="upload_image_2">Upload Image 2:</label>
                <div>
                    <input type="hidden" name="image_id_2" id="image_id_2">
                    <button type="button" id="upload_image_button_2" class="button">Select Image 2</button>
                </div>
                <div id="image_preview_section_2" style="margin-top: 15px;">
                    <?php if ($image_exists_2): ?>
                        <img id="image_preview_2" src="<?php echo esc_url($custom_image_url_2); ?>" alt="Image 2" style="max-width: 300px; margin-top: 10px;">
                        <p>
                            <input type="text" id="image_url_2" value="<?php echo esc_url($custom_image_url_2); ?>" readonly style="width: 100%; margin-top: 10px;">
                            <button type="button" class="button" onclick="copyToClipboard('image_url_2')">Copy URL</button>
                        </p>
                    <?php else: ?>
                        <p>No image selected yet.</p>
                    <?php endif; ?>
                </div>
            </div>

            <p><input type="submit" class="button-primary" value="Save Images"></p>
        </form>
    </div>

    <script>
        jQuery(document).ready(function($) {
            // Image 1 uploader
            $('#upload_image_button_1').click(function(e) {
                e.preventDefault();
                var custom_uploader_1 = wp.media({
                    title: 'Select Image 1',
                    button: { text: 'Use this image' },
                    multiple: false
                })
                .on('select', function() {
                    var attachment = custom_uploader_1.state().get('selection').first().toJSON();
                    $('#image_id_1').val(attachment.id);
                })
                .open();
            });

            // Image 2 uploader
            $('#upload_image_button_2').click(function(e) {
                e.preventDefault();
                var custom_uploader_2 = wp.media({
                    title: 'Select Image 2',
                    button: { text: 'Use this image' },
                    multiple: false
                })
                .on('select', function() {
                    var attachment = custom_uploader_2.state().get('selection').first().toJSON();
                    $('#image_id_2').val(attachment.id);
                })
                .open();
            });
        });

        function copyToClipboard(elementId) {
            var copyText = document.getElementById(elementId);
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            alert("Copied the URL: " + copyText.value);
        }
    </script>
    <?php
}
