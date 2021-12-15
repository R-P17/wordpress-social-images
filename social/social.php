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

if(!defined('WPINC')){
	die;
}

function social_menu(){
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
add_action('admin_menu','social_menu');

function social_page(){
	if(!current_user_can('manage_options')){
		return;
} }

function social_settings(){
	register_setting('socialplugin_options','facebook');
}
add_action('admin_init','social_settings');


function social_settings_2(){
	register_setting('socialplugin_options','instagram');
}
add_action('admin_init','social_settings_2');


function social_settings_3(){
	register_setting('socialplugin_options','twitter');
}
add_action('admin_init','social_settings_3');


function social_settings_4(){
	register_setting('socialplugin_options', 'linkedin');
}
add_action('admin_init', 'social_settings_4');


function social_settings_5(){
	register_setting('socialplugin_options', 'pinterest');
}
add_action('admin_init', 'social_settings_5');

function setting_page(){	?>
<div class="set" ">
	<h1><?php esc_html_e(get_admin_page_title());?> </h1>
	<form method="post" action="options.php" >
		<?php settings_errors() ?>
		<?php settings_fields('socialplugin_options'); ?>
		<div class="fb">
			<label for="facebook_label"><?php esc_html_e('Facebook', 'social')?></label>
			<input type="url" id="facebook_label" name="facebook" value="<?php echo get_option('facebook'); ?>"><br>
		</div>
		<div class="insta">		
			<label for="instagram_label"><?php esc_html_e('Instagram', 'social') ?></label>
			<input type="url" id="instagram_label" name="instagram" value="<?php echo get_option('instagram'); ?>"><br>
		</div>
		<div class="twit">
			<label for="twitter_label"><?php esc_html_e('Twitter', 'social') ?></label>
			<input type="url" id="twitter_label" name="twitter" value="<?php echo get_option('twitter'); ?>"><br>
		</div>
		<div class="linkd">
			<label for="linkedin_label"><?php esc_html_e('Linkedin', 'social') ?></label>
			<input type="url" id="linkedin_label" name="linkedin" value="<?php echo get_option('linkedin'); ?>"><br>
		</div>
		<div class="pint">
			<label for="pinterest_label"><?php esc_html_e('Pinterest', 'social') ?></label>
			<input type="url" id="pinterest_label" name="pinterest" value="<?php echo get_option('pinterest'); ?>"><br>
		</div>
		<div class="but">
		<?php submit_button(); ?>
		</div>
	</form>
</div>
	
<?php }

function foot_social(){ ?>
<div class="foot">
	<h4><?php echo 'Social Media'?></h4>
	<a href="<?php echo esc_attr( esc_url(get_option('facebook')));?>"><?php echo '<img src="'.esc_url(plugins_url('img/facebook.png', __FILE__)).'">'?></a>
	<a href="<?php echo esc_attr( esc_url(get_option('instagram')));?>"><?php echo '<img src="'.esc_url(plugins_url('img/instagram.png', __FILE__)).'">'?></a>
	<a href="<?php echo esc_attr( esc_url(get_option('twitter')));?>"><?php echo '<img src="'.esc_url(plugins_url('img/twitter.png', __FILE__)).'">'?></a>
	<a href="<?php echo esc_attr( esc_url(get_option('linkedin')));?>"><?php echo '<img src="'.esc_url(plugins_url('img/linkedin.png', __FILE__)).'">'?></a>
	<a href="<?php echo esc_attr( esc_url(get_option('pinterest')));?>"><?php echo '<img src="'.esc_url(plugins_url('img/pinterest.png', __FILE__)).'">'?></a>
</div>

<?php }


if(empty($_POST['instagram'])){

	echo esc_attr( esc_url(get_option('instagram')))=="https://www.example.com";
}

add_action('wp_footer', 'foot_social');

function social_css(){
	echo 
	'<style>
		.set h1{text-align:center;}
		.set label{font-size:20px; font-weight:bold; text-decoration:underline; margin-right:50px; cursor:auto; }
		.set form{padding-top:50px;}
		.set .fb{padding-top:20px;}
		.set .fb input{margin-left:15px; width:350px;}
		.set .insta{padding-top:20px;}
		.set .insta input{margin-left:10px; width:350px;}
		.set .twit{padding-top:20px;}
		.set .twit input{margin-left:40px; width:350px;}
		.set .linkd{padding-top:20px;}
		.set .linkd input{margin-left:27px; width:350px;}
		.set .pint{padding-top:20px;}
		.set .pint input{margin-left:25px; width:350px;}
		.set .but{padding-top:40px;}
	</style>';
}
function social_css_front(){
	echo
	'<style>
		.foot {margin-bottom:50px; text-align:center; }
		.foot h4{padding-bottom:40px; text-decoration:underline; }
		.foot a{display:inline-flex; padding-left:30px;}
	</style>';
}

add_action('admin_init', 'social_css');
add_action('wp_footer', 'social_css_front' );
?>