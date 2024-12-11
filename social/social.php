<?php 
/*
Plugin Name: Social Icons
Description: Demo plugin for social icons in the footer of the page
Version: 1.0.0
Author: Renos P
Text Domain: social
License: GPLv2 or later
Domain Path: /languages
*/

if (!defined('WPINC')) {
    die;
}

function social_menu() {
    add_menu_page(
        'Social Plugin',
        'Social Icons',
        'manage_options',
        'social',
        'setting_page',
        'dashicons-share',
        100
    );
}
add_action('admin_menu', 'social_menu');

$social_networks = [
    'facebook' => 'Facebook',
    'instagram' => 'Instagram',
    'twitter' => 'Twitter',
    'linkedin' => 'LinkedIn',
    'pinterest' => 'Pinterest'
];

function social_register_settings() {
    global $social_networks;
    
    foreach ($social_networks as $key => $label) {
        register_setting('socialplugin_options', $key);
    }
}
add_action('admin_init', 'social_register_settings');

function setting_page() { 
    global $social_networks; 
    ?>
    <div class="set">
        <h1><?php esc_html_e(get_admin_page_title()); ?> </h1>
        <form method="post" action="options.php">
            <?php 
            settings_errors(); 
            settings_fields('socialplugin_options'); 
            
            foreach ($social_networks as $key => $label): 
            ?>
                <div class="<?php echo esc_attr($key); ?>">
                    <label for="<?php echo esc_attr($key . '_label'); ?>">
                        <?php esc_html_e($label, 'social'); ?>
                    </label>
                    <input type="url" id="<?php echo esc_attr($key . '_label'); ?>" name="<?php echo esc_attr($key); ?>" value="<?php echo esc_url(get_option($key)); ?>">
                </div>
            <?php endforeach; ?>
            
            <div class="but">
                <?php submit_button(); ?>
            </div>
        </form>
    </div>
    <?php 
}

function foot_social() { 
    global $social_networks; 
    ?>
    <div class="foot">
        <h4><?php esc_html_e('Social Media', 'social'); ?></h4>
        <?php 
        foreach ($social_networks as $key => $label): 
            $url = esc_url(get_option($key));
            if ($url):
        ?>
            <a href="<?php echo esc_attr($url); ?>">
                <img src="<?php echo esc_url(plugins_url('img/' . $key . '.png', __FILE__)); ?>" alt="<?php echo esc_attr($label); ?>">
            </a>
        <?php 
            endif; 
        endforeach; 
        ?>
    </div>
    <?php 
}
add_action('wp_footer', 'foot_social');

function social_css() {
    echo 
    '<style>
        .set h1 { text-align: center; }
        .set label { font-size: 20px; font-weight: bold; text-decoration: underline; margin-right: 50px; cursor: auto; }
        .set form { padding-top: 50px; }
        .set div { padding-top: 20px; }
        .set input { margin-left: 15px; width: 350px; }
        .set .but { padding-top: 40px; }
    </style>';
}
add_action('admin_head', 'social_css');

function social_css_front() {
    echo 
    '<style>
        .foot { margin-bottom: 50px; text-align: center; }
        .foot h4 { padding-bottom: 40px; text-decoration: underline; }
        .foot a { display: inline-block; padding-left: 30px; }
        .foot img { width: 32px; height: 32px; }
    </style>';
}
add_action('wp_footer', 'social_css_front');
