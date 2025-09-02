<?php
/*
Plugin Name: Fuhgeddaboudit
Description: Hide content from the most prevalent search engines using the [forget][/forget] or [fuhget][/fuhget] shortcode
Version: 1.0
Author: Kenny Katzgrau
*/

function fuhget_is_crawler() {
   $crawlers = array(
       'googlebot',
       'bingbot',
       'slurp',         // Yahoo
       'duckduckbot',
       'baiduspider',
       'yandexbot',
       'sogou',
       'exabot',
       'facebookexternalhit',
       'ia_archiver',   // Internet Archive
       'semrushbot',
       'ahrefsbot',
       'mj12bot',
       'dotbot'
   );

   $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
   
   foreach($crawlers as $crawler) {
       if (strpos($user_agent, $crawler) !== false) {
           return true;
       }
   }
   
   return false;
}

function fuhget_text_shortcode($atts, $content = null) {
   // Parse attributes
   $attributes = shortcode_atts(array(
       'start' => null
   ), $atts);

   if (fuhget_is_crawler()) {
           // If there's no start attribute, or there is and where not at that date yet, hide the content
        if (!$attributes['start'] || ($attributes['start'] && strtotime($attributes['start']) <= time())) {
            $content = '';
        }
   }

   return $content;
}

add_shortcode('fuhget', 'fuhget_text_shortcode');
add_shortcode('forget', 'fuhget_text_shortcode');

// Add a meta box to the post editor for posts and pages
function fuhget_add_meta_box() {
    $post_types = ['post', 'page'];
    foreach ($post_types as $post_type) {
        add_meta_box(
            'fuhget_meta_box',          // ID
            'Fuhgeddaboudit',           // Title
            'fuhget_meta_box_html',     // Callback function
            $post_type,                 // Screen to show on
            'side',                     // Context
            'default'                   // Priority
        );
    }
}
add_action('add_meta_boxes', 'fuhget_add_meta_box');

// Render the meta box HTML
function fuhget_meta_box_html($post) {
    wp_nonce_field('fuhget_save_meta_box_data', 'fuhget_meta_box_nonce');
    $value = get_post_meta($post->ID, '_fuhget_it', true);
    ?>
    <label for="fuhget_it_field">
        <input type="checkbox" id="fuhget_it_field" name="fuhget_it_field" value="yes" <?php checked($value, 'yes'); ?>>
        <?php _e('Forget It', 'fuhget'); ?>
    </label>
    <p class="description"><?php _e('Hide this page from search engines.', 'fuhget'); ?></p>
    <?php
}

// Save meta box data
function fuhget_save_meta_box_data($post_id) {
    if (!isset($_POST['fuhget_meta_box_nonce']) || !wp_verify_nonce($_POST['fuhget_meta_box_nonce'], 'fuhget_save_meta_box_data')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $value = isset($_POST['fuhget_it_field']) && $_POST['fuhget_it_field'] === 'yes' ? 'yes' : 'no';
    update_post_meta($post_id, '_fuhget_it', $value);
}
add_action('save_post', 'fuhget_save_meta_box_data');

// Check if we need to 404 for crawlers on page load
function fuhget_maybe_404() {
    if (is_singular()) {
        $post_id = get_queried_object_id();
        if ($post_id && get_post_meta($post_id, '_fuhget_it', true) === 'yes' && fuhget_is_crawler()) {
            global $wp_query;
            $wp_query->set_404();
            status_header(404);
            echo "<!-- Fuhgeddaboudit -->";
            exit;
        }
    }
}
add_action('template_redirect', 'fuhget_maybe_404');