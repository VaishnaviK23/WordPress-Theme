<?php
// Add scripts and stylesheets
function themeforwp_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6' );
	wp_enqueue_style( 'blog', get_template_directory_uri() . '/css/blog.css' );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.6', true );
}

add_action( 'wp_enqueue_scripts', 'themeforwp_scripts' );

// Add Google Fonts
function themeforwp_google_fonts() {
				wp_register_style('OpenSans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800');
				wp_enqueue_style( 'OpenSans');
				wp_register_style('Tangerine', 'http://fonts.googleapis.com/css?family=Tangerine:400,600,700,800');
				wp_enqueue_style( 'Tangerine');
				wp_register_style('TimesNewRoman', 'http://fonts.googleapis.com/css?family=Times+New+Roman:400,600,700,800');
				wp_enqueue_style( 'TimesNewRoman');
				wp_register_style('Ubuntu', 'http://fonts.googleapis.com/css?family=Ubuntu:400,600,700,800');
				wp_enqueue_style( 'Ubuntu');
				wp_register_style('Arvo', 'http://fonts.googleapis.com/css?family=Arvo:400,600,700,800');
				wp_enqueue_style( 'Arvo');
				wp_register_style('JosefinSlab', 'http://fonts.googleapis.com/css?family=Josefin+Slab:400,600,700,800');
				wp_enqueue_style( 'JosefinSlab');
				wp_register_style('Lato', 'http://fonts.googleapis.com/css?family=Lato:400,600,700,800');
				wp_enqueue_style( 'Lato');
				wp_register_style('Vollkorn', 'http://fonts.googleapis.com/css?family=Vollkorn:400,600,700,800');
				wp_enqueue_style( 'Vollkorn');
				wp_register_style('DroidSans', 'http://fonts.googleapis.com/css?family=Droid+Sans:400,600,700,800');
				wp_enqueue_style( 'DroidSans');
				wp_register_style('AbrilFatface', 'http://fonts.googleapis.com/css?family=Abril+Fatface:400,600,700,800');
				wp_enqueue_style( 'AbrilFatface');

		}

add_action('wp_print_styles', 'themeforwp_google_fonts');

// WordPress Titles
add_theme_support( 'title-tag' );

// Custom settings
function custom_settings_add_menu() {
  add_menu_page( 'Custom Settings', 'Custom Settings', 'manage_options', 'custom-settings', 'custom_settings_page', null, 99 );
}
add_action( 'admin_menu', 'custom_settings_add_menu' );

// Create Custom Settings page
function custom_settings_page() { ?>
  <div class="wrap">
    <h1>Custom Settings</h1>
    <form method="post" action="options.php">
       <?php
           settings_fields( 'section' );
           do_settings_sections( 'theme-options' );      
           submit_button(); 
       ?>          
    </form>
  </div>
<?php }

// Twitter
function setting_twitter() { ?>
  <input type="text" name="twitter" id="twitter" value="<?php echo get_option( 'twitter' ); ?>" />
<?php }

//Github
function setting_github() { ?>
  <input type="text" name="github" id="github" value="<?php echo get_option('github'); ?>" />
<?php }

//Facebook
function setting_facebook() { ?>
  <input type="text" name="facebook" id="facebook" value="<?php echo get_option('facebook'); ?>" />
<?php }

//Instagram
function setting_instagram() { ?>
  <input type="text" name="instagram" id="instagram" value="<?php echo get_option('instagram'); ?>" />
<?php }

function custom_settings_page_setup() {
  add_settings_section( 'section', 'All Settings', null, 'theme-options' );
  add_settings_field( 'twitter', 'Twitter URL', 'setting_twitter', 'theme-options', 'section' );
  add_settings_field( 'github', 'GitHub URL', 'setting_github', 'theme-options', 'section' );
  add_settings_field( 'facebook', 'Facebook URL', 'setting_facebook', 'theme-options', 'section' );
  add_settings_field( 'instagram', 'Instagram URL', 'setting_Instagram', 'theme-options', 'section' );

  register_setting('section', 'twitter');
  register_setting('section', 'github');
  register_setting('section', 'facebook');
  register_setting('section', 'instagram');
}
add_action( 'admin_init', 'custom_settings_page_setup' );

// Support Featured Images
add_theme_support( 'post-thumbnails' );

// Custom Post Type
function create_custom_post() {
	register_post_type( 'my-custom-post',
			array(
			'labels' => array(
					'name' => __( 'Custom Posts' ),
					'singular_name' => __( 'Custom Posts' ),
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array(
					'title',
					'editor',
					'thumbnail',
				  	'custom-fields')
	));
}
add_action( 'init', 'create_custom_post' );

//flush rewrite

function my_rewrite_flush() {
    create_custom_post();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'my_rewrite_flush' );







?>
