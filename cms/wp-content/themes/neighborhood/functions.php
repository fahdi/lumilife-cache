<?php
	
	/* ==================================================
	
	Swift Framework Main Functions
	
	================================================== */
	
	
	/* VARIABLE DEFINITIONS
	================================================== */ 
	define('SF_TEMPLATE_PATH', get_template_directory());
	define('SF_INCLUDES_PATH', SF_TEMPLATE_PATH . '/includes');
	define('SF_FRAMEWORK_PATH', SF_INCLUDES_PATH . '/swift-framework');
	define('SF_WIDGETS_PATH', SF_INCLUDES_PATH . '/widgets');
	define('SF_LOCAL_PATH', get_template_directory_uri());
	
	/* INCLUDES
	================================================== */
	
	/* Add custom post types */
	require_once(SF_INCLUDES_PATH . '/custom-post-types/portfolio-type.php');
	require_once(SF_INCLUDES_PATH . '/custom-post-types/team-type.php');
	require_once(SF_INCLUDES_PATH . '/custom-post-types/clients-type.php');
	require_once(SF_INCLUDES_PATH . '/custom-post-types/testimonials-type.php');
	require_once(SF_INCLUDES_PATH . '/custom-post-types/jobs-type.php');
	require_once(SF_INCLUDES_PATH . '/custom-post-types/faqs-type.php');
	
	/* Add image resizer */
	require_once(SF_INCLUDES_PATH . '/plugins/aq_resizer.php');

	/* Add taxonomy meta boxes */
	require_once(SF_INCLUDES_PATH . '/taxonomy-meta-class/Tax-meta-class.php');
	
	/* Include plugins */
	include(SF_INCLUDES_PATH . '/plugin-includes.php');	
	include(SF_INCLUDES_PATH . '/plugins/love-it-pro/love-it-pro.php');

	/* Include widgets */
	include(SF_WIDGETS_PATH . '/widget-twitter.php');
	include(SF_WIDGETS_PATH . '/widget-flickr.php');
	include(SF_WIDGETS_PATH . '/widget-video.php');
	include(SF_WIDGETS_PATH . '/widget-posts.php');
	include(SF_WIDGETS_PATH . '/widget-portfolio.php');
	include(SF_WIDGETS_PATH . '/widget-portfolio-grid.php');
	include(SF_WIDGETS_PATH . '/widget-advertgrid.php');
	include(SF_WIDGETS_PATH . '/widget-infocus.php');
	
	
	/* CHECK WOOCOMMERCE IS ACTIVE
	================================================== */ 
	if ( ! function_exists( 'sf_woocommerce_activated' ) ) {
		function sf_woocommerce_activated() {
			if ( class_exists( 'woocommerce' ) ) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	
	/* SWIFT FRAMEWORK
	================================================== */ 
	require_once(SF_FRAMEWORK_PATH . '/swift-framework.php');
	

	/* THEME SUPPORT
	================================================== */  	
		
	add_theme_support( 'structured-post-formats', array(
	    'audio', 'gallery', 'image', 'link', 'video'
	) );
	add_theme_support( 'post-formats', array(
	    'aside', 'chat', 'quote', 'status'
	) );
	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	set_post_thumbnail_size( 220, 150, true);
	add_image_size( 'widget-image', 94, 70, true);
	add_image_size( 'thumb-image', 600, 450, true);
	add_image_size( 'thumb-image-twocol', 900, 675, true);
	add_image_size( 'thumb-image-onecol', 1280, 960, true);
	add_image_size( 'blog-image', 1280, 9999);
	add_image_size( 'full-width-image', 1280, 720, true);
	add_image_size( 'full-width-image-gallery', 1280, 720, true);
	
	
	/* CONTENT WIDTH
	================================================== */
	
	if ( ! isset( $content_width ) ) $content_width = 1170;
	
	
	/* LOAD THEME LANGUAGE
	================================================== */
	
	load_theme_textdomain('swiftframework', SF_TEMPLATE_PATH.'/language');
	
	$locale = get_locale();
	$locale_file = SF_TEMPLATE_PATH."/language/$locale.php";
	
	if (is_readable($locale_file)) {
		require_once($locale_file);
	}
	
	
	/* LOAD STYLES & SCRIPTS
	================================================== */
		
	function sf_enqueue_styles() {  
		
		$options = get_option('sf_neighborhood_options');
		$enable_responsive = $options['enable_responsive'];		
	
	    wp_register_style('bootstrap', SF_LOCAL_PATH . '/css/bootstrap.min.css', array(), NULL, 'screen');  
	    wp_register_style('bootstrap-responsive', SF_LOCAL_PATH . '/css/bootstrap-responsive.min.css', array(), NULL, 'screen');  
	    wp_register_style('fontawesome-css', SF_LOCAL_PATH . '/css/font-awesome.min.css', array(), NULL, 'screen');  
	    wp_register_style('main-css', get_stylesheet_directory_uri() . '/style.css', array(), NULL, 'screen');  
	    wp_register_style('responsive-css', SF_LOCAL_PATH . '/css/responsive.css', array(), NULL, 'screen');  
	
	    wp_enqueue_style('bootstrap');  
	    wp_enqueue_style('bootstrap-responsive');  
	    wp_enqueue_style('fontawesome-css'); 
	    wp_enqueue_style('main-css');  
	    
	    if ($enable_responsive) {
	    	wp_enqueue_style('responsive-css');  
	    }
	
	}
	
	add_action('wp_enqueue_scripts', 'sf_enqueue_styles', 99);  
	
	function sf_enqueue_scripts() {
	    
	    wp_register_script('sf-bootstrap-js', SF_LOCAL_PATH . '/js/bootstrap.min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-flexslider', SF_LOCAL_PATH . '/js/jquery.flexslider-min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-isotope', SF_LOCAL_PATH . '/js/jquery.isotope.min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-hoverIntent', SF_LOCAL_PATH . '/js/jquery.hoverIntent.min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-easing', SF_LOCAL_PATH . '/js/jquery.easing.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-carouFredSel', SF_LOCAL_PATH . '/js/jquery.carouFredSel.min.js', 'jquery', NULL, TRUE); 
	    wp_register_script('sf-jquery-ui', SF_LOCAL_PATH . '/js/jquery-ui-1.10.2.custom.min.js', 'jquery', NULL, TRUE);
		wp_register_script('sf-prettyPhoto', SF_LOCAL_PATH . '/js/jquery.prettyPhoto.js', 'jquery', NULL, TRUE);
		wp_register_script('sf-viewjs', SF_LOCAL_PATH . '/js/view.min.js?auto', 'jquery', NULL, TRUE);
	    wp_register_script('sf-fitvids', SF_LOCAL_PATH . '/js/jquery.fitvids.js', 'jquery', NULL , TRUE);
	    wp_register_script('sf-maps', 'http://maps.google.com/maps/api/js?sensor=false', 'jquery', NULL, TRUE);
	    wp_register_script('sf-respond', SF_LOCAL_PATH . '/js/respond.min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-elevatezoom', SF_LOCAL_PATH . '/js/jquery.elevateZoom.min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-parallax', SF_LOCAL_PATH . '/js/parallaxScripts.min.js', NULL, NULL, TRUE);
	    wp_register_script('sf-superscrollorama', SF_LOCAL_PATH . '/js/jquery.superscrollorama.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-functions', SF_LOCAL_PATH . '/js/functions.js', 'jquery', NULL, TRUE);
		
	    wp_enqueue_script('jquery');
		wp_enqueue_script('sf-bootstrap-js');
		wp_enqueue_script('sf-hoverIntent');
		wp_enqueue_script('sf-easing');
	    wp_enqueue_script('sf-flexslider');
	    wp_enqueue_script('sf-prettyPhoto');
	   	
	    wp_enqueue_script('sf-fitvids');
	    
	    if ( sf_woocommerce_activated() ) {
	    	if (!is_account_page()) {
	    		wp_enqueue_script('sf-viewjs');
	    	}
	    } else {
	   		wp_enqueue_script('sf-viewjs');
	    }
	    	    
	    if (!is_admin()) {
	    	wp_enqueue_script('sf-functions');
	    }
	    
	    if (is_singular()) {
	    	wp_enqueue_script('comment-reply');
	    }
	    
		global $is_IE;
		
		if ( $is_IE ) {
				wp_enqueue_script('sf-respond');
		}
		
	}
	
	add_action('wp_enqueue_scripts', 'sf_enqueue_scripts');
	
	function sf_admin_scripts() {
	    wp_register_script('admin-functions', get_template_directory_uri() . '/js/sf-admin.js', 'jquery', '1.0', TRUE);
		wp_enqueue_script('admin-functions');
	}
	add_action('admin_init', 'sf_admin_scripts');
	
	
	function sf_load_custom_script() {
		global $include_maps, $include_isotope, $include_carousel, $include_parallax;
		
		if ($include_maps) {
			wp_print_scripts('sf-maps');
		}
		
		if ($include_isotope) {
			wp_print_scripts('sf-isotope');
		}
		
		if ($include_carousel) {
			wp_print_scripts('sf-carouFredSel');
		}
		
		if ($include_parallax) {
			wp_print_scripts('sf-parallax');
			wp_print_scripts('sf-superscrollorama');
		}
		
		$options = get_option('sf_neighborhood_options');
		
		if (isset($options['enable_product_zoom'])) {	
			$enable_product_zoom = $options['enable_product_zoom'];	
			if ($enable_product_zoom) {
				wp_enqueue_script('sf-elevatezoom');
			}
		}
		
	}
	
	add_action('wp_footer', 'sf_load_custom_script');
	
	
	/* MAINTENANCE MODE
	================================================== */
	
	function sf_maintenance_mode() {
		
		$options = get_option('sf_neighborhood_options');
		$custom_logo = $custom_logo_output = $maintenance_mode = "";
		if (isset($options['custom_admin_login_logo'])) {
		$custom_logo = $options['custom_admin_login_logo'];
		}
		if ($custom_logo) {		
		$custom_logo_output = '<img src="'. $custom_logo .'" alt="maintenance" style="margin: 0 auto; display: block;" />';
		} else {
		$custom_logo_output = '<img src="'. get_template_directory_uri() .'/images/custom-login-logo.png" alt="maintenance" style="margin: 0 auto; display: block;" />';
		}

		if (isset($options['enable_maintenance'])) {
		$maintenance_mode = $options['enable_maintenance'];
		} else {
		$maintenance_mode = false;
		}
		
		if ($maintenance_mode) {
		
		    if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
		        wp_die($custom_logo_output . '<p style="text-align:center">'.__('We are currently in maintenance mode, please check back shortly.', 'swiftframework').'</p>');
		    }
	    
	    }
	}
	add_action('get_header', 'sf_maintenance_mode');
	
	
	/* BETTER WORDPRESS MINIFY FILTER
	================================================== */
	
	add_filter('bwp_minify_style_ignore', 'sf_bwm_exclude_css');
	
	function sf_bwm_exclude_css($excluded)
	{
		$excluded = array('fontawesome-css');
		return $excluded;
	}
	
	
	/* REVSLIDER RETURN FUNCTION
	================================================== */
	
	function return_slider($revslider_shortcode) {
	    ob_start();
	    putRevSlider($revslider_shortcode);
	    return ob_get_clean();
	}
	
	/* CUSTOM ADMIN MENU ITEMS
	================================================== */
	
	if(!function_exists('sf_admin_bar_menu')) {
				
		function sf_admin_bar_menu() {
		
			global $wp_admin_bar;
			
			if ( current_user_can( 'manage_options' ) ) {
			
				$theme_options = array(
					'id' => '1',
					'title' => __('Theme Options', 'swiftframework'),
					'href' => admin_url('/admin.php?page=sf_theme_options'),
					'meta' => array('target' => 'blank')
				);
				
				$wp_admin_bar->add_menu($theme_options);
				
				$theme_customizer = array(
					'id' => '2',
					'title' => __('Color Customizer', 'swiftframework'),
					'href' => admin_url('/customize.php'),
					'meta' => array('target' => 'blank')
				);
				
				$wp_admin_bar->add_menu($theme_customizer);
			
			}
			
		}
		
		add_action('admin_bar_menu', 'sf_admin_bar_menu', 99);
	}
	

	/* ADMIN CUSTOM POST TYPE ICONS
	================================================== */
	
	add_action( 'admin_head', 'sf_admin_css' );
	function sf_admin_css() {
	    ?>
	    
	    <?php
	 		// Alt Background
	 		$options = get_option('sf_neighborhood_options');
	 		$section_divide_color = get_option('section_divide_color', '#e4e4e4');
	 		$alt_one_bg_color = $options['alt_one_bg_color'];
	 		$alt_one_text_color = $options['alt_one_text_color'];
	 		if (isset($options['alt_one_bg_image'])) {
	 		$alt_one_bg_image = $options['alt_one_bg_image'];
	 		}
	 		$alt_one_bg_image_size = $options['alt_one_bg_image_size'];
	 		$alt_two_bg_color = $options['alt_two_bg_color'];
	 		$alt_two_text_color = $options['alt_two_text_color'];
	 		if (isset($options['alt_two_bg_image'])) {
	 		$alt_two_bg_image = $options['alt_two_bg_image'];
	 		}
	 		$alt_two_bg_image_size = $options['alt_two_bg_image_size'];
	 		$alt_three_bg_color = $options['alt_three_bg_color'];
	 		$alt_three_text_color = $options['alt_three_text_color'];
	 		if (isset($options['alt_three_bg_image'])) {
	 		$alt_three_bg_image = $options['alt_three_bg_image'];
	 		}
	 		$alt_three_bg_image_size = $options['alt_three_bg_image_size'];
	 		$alt_four_bg_color = $options['alt_four_bg_color'];
	 		$alt_four_text_color = $options['alt_four_text_color'];
	 		if (isset($options['alt_four_bg_image'])) {
	 		$alt_four_bg_image = $options['alt_four_bg_image'];
	 		}
	 		$alt_four_bg_image_size = $options['alt_four_bg_image_size'];
	 		$alt_five_bg_color = $options['alt_five_bg_color'];
	 		$alt_five_text_color = $options['alt_five_text_color'];
	 		if (isset($options['alt_five_bg_image'])) {
	 		$alt_five_bg_image = $options['alt_five_bg_image'];
	 		}
	 		$alt_five_bg_image_size = $options['alt_five_bg_image_size'];
	 		$alt_six_bg_color = $options['alt_six_bg_color'];
	 		$alt_six_text_color = $options['alt_six_text_color'];
	 		if (isset($options['alt_six_bg_image'])) {
	 		$alt_six_bg_image = $options['alt_six_bg_image'];
	 		}
	 		$alt_six_bg_image_size = $options['alt_six_bg_image_size'];
	 		$alt_seven_bg_color = $options['alt_seven_bg_color'];
	 		$alt_seven_text_color = $options['alt_seven_text_color'];
	 		if (isset($options['alt_seven_bg_image'])) {
	 		$alt_seven_bg_image = $options['alt_seven_bg_image'];
	 		}
	 		$alt_seven_bg_image_size = $options['alt_seven_bg_image_size'];
	 		$alt_eight_bg_color = $options['alt_eight_bg_color'];
	 		$alt_eight_text_color = $options['alt_eight_text_color'];
	 		if (isset($options['alt_eight_bg_image'])) {
	 		$alt_eight_bg_image = $options['alt_eight_bg_image'];
	 		}
	 		$alt_eight_bg_image_size = $options['alt_eight_bg_image_size'];
	 		$alt_nine_bg_color = $options['alt_nine_bg_color'];
	 		$alt_nine_text_color = $options['alt_nine_text_color'];
	 		if (isset($options['alt_nine_bg_image'])) {
	 		$alt_nine_bg_image = $options['alt_nine_bg_image'];
	 		}
	 		$alt_nine_bg_image_size = $options['alt_nine_bg_image_size'];
	 		$alt_ten_bg_color = $options['alt_ten_bg_color'];
	 		$alt_ten_text_color = $options['alt_ten_text_color'];
	 		if (isset($options['alt_ten_bg_image'])) {
	 		$alt_ten_bg_image = $options['alt_ten_bg_image'];
	 		}
	 		$alt_ten_bg_image_size = $options['alt_ten_bg_image_size'];  	
	    ?>
	    	    
	    <style type="text/css" media="screen">
	    	
	    	/* REVSLIDER HIDE ACTIVATION */
	    	a[name="activateplugin"] + div, a[name="activateplugin"] + div + div, a[name="activateplugin"] + div + div + div, a[name="activateplugin"] + div + div + div + div {
	    		display: none;
	    	}
	    	
	        #menu-posts-slide .wp-menu-image img {
	        	width: 16px;
	        }
	        #toplevel_page_sf_theme_options .wp-menu-image img {
	        	width: 11px;
	        	margin-top: -2px;
	        	margin-left: 3px;
	        }
	        .toplevel_page_sf_theme_options #adminmenu li#toplevel_page_sf_theme_options.wp-has-current-submenu a.wp-has-current-submenu, .toplevel_page_sf_theme_options #adminmenu #toplevel_page_sf_theme_options .wp-menu-arrow div, .toplevel_page_sf_theme_options #adminmenu #toplevel_page_sf_theme_options .wp-menu-arrow {
	        	background: #222;
	        	border-color: #222;
	        }
	        #wpbody-content {
	        	min-height: 815px;
	        }
			<?php
				echo "\n".'/*========== Asset Background Styles ==========*/'."\n";
				echo '.alt-bg {border-color: '.$section_divide_color.';}'. "\n";
				echo '.alt-one {background-color: '.$alt_one_bg_color.';}'. "\n";
				if (isset($options['alt_one_bg_image']) && $alt_one_bg_image != "") {
					if ($alt_one_bg_image_size == "cover") {
						echo '.alt-one {background-image: url('.$alt_one_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-one {background-image: url('.$alt_one_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-one {color: '.$alt_one_text_color.';}'. "\n";
				echo '.alt-one.full-width-text:after {border-top-color:'.$alt_one_bg_color.';}'. "\n";
				echo '.alt-two {background-color: '.$alt_two_bg_color.';}'. "\n";
				if (isset($options['alt_two_bg_image']) && $alt_two_bg_image != "") {
					if ($alt_two_bg_image_size == "cover") {
						echo '.alt-two {background-image: url('.$alt_two_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-two {background-image: url('.$alt_two_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-two {color: '.$alt_two_text_color.';}'. "\n";
				echo '.alt-two.full-width-text:after {border-top-color:'.$alt_two_bg_color.';}'. "\n";	
				echo '.alt-three {background-color: '.$alt_three_bg_color.';}'. "\n";
				if (isset($options['alt_three_bg_image']) && $alt_three_bg_image != "") {
					if ($alt_three_bg_image_size == "cover") {
						echo '.alt-three {background-image: url('.$alt_three_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-three {background-image: url('.$alt_three_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-three {color: '.$alt_three_text_color.';}'. "\n";
				echo '.alt-three.full-width-text:after {border-top-color:'.$alt_three_bg_color.';}'. "\n";	
				echo '.alt-four {background-color: '.$alt_four_bg_color.';}'. "\n";
				if (isset($options['alt_four_bg_image']) && $alt_four_bg_image != "") {
					if ($alt_four_bg_image_size == "cover") {
						echo '.alt-four {background-image: url('.$alt_four_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-four {background-image: url('.$alt_four_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-four {color: '.$alt_four_text_color.';}'. "\n";
				echo '.alt-four.full-width-text:after {border-top-color:'.$alt_four_bg_color.';}'. "\n";	
				echo '.alt-five {background-color: '.$alt_five_bg_color.';}'. "\n";
				if (isset($options['alt_five_bg_image']) && $alt_five_bg_image != "") {
					if ($alt_five_bg_image_size == "cover") {
						echo '.alt-five {background-image: url('.$alt_five_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-five {background-image: url('.$alt_five_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-five {color: '.$alt_five_text_color.';}'. "\n";
				echo '.alt-five.full-width-text:after {border-top-color:'.$alt_five_bg_color.';}'. "\n";			
				echo '.alt-six {background-color: '.$alt_six_bg_color.';}'. "\n";
				if (isset($options['alt_six_bg_image']) && $alt_six_bg_image != "") {
					if ($alt_six_bg_image_size == "cover") {
						echo '.alt-six {background-image: url('.$alt_six_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-six {background-image: url('.$alt_six_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-six {color: '.$alt_six_text_color.';}'. "\n";
				echo '.alt-six.full-width-text:after {border-top-color:'.$alt_six_bg_color.';}'. "\n";
				echo '.alt-seven {background-color: '.$alt_seven_bg_color.';}'. "\n";
				if (isset($options['alt_seven_bg_image']) && $alt_seven_bg_image != "") {
					if ($alt_seven_bg_image_size == "cover") {
						echo '.alt-seven {background-image: url('.$alt_seven_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-seven {background-image: url('.$alt_seven_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-seven {color: '.$alt_seven_text_color.';}'. "\n";
				echo '.alt-seven.full-width-text:after {border-top-color:'.$alt_seven_bg_color.';}'. "\n";
				echo '.alt-eight {background-color: '.$alt_eight_bg_color.';}'. "\n";
				if (isset($options['alt_eight_bg_image']) && $alt_eight_bg_image != "") {
					if ($alt_eight_bg_image_size == "cover") {
						echo '.alt-eight {background-image: url('.$alt_eight_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-eight {background-image: url('.$alt_eight_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-eight {color: '.$alt_eight_text_color.';}'. "\n";
				echo '.alt-eight.full-width-text:after {border-top-color:'.$alt_eight_bg_color.';}'. "\n";
				echo '.alt-nine {background-color: '.$alt_nine_bg_color.';}'. "\n";
				if (isset($options['alt_nine_bg_image']) && $alt_nine_bg_image != "") {
					if ($alt_nine_bg_image_size == "cover") {
						echo '.alt-nine {background-image: url('.$alt_nine_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-nine {background-image: url('.$alt_nine_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-nine {color: '.$alt_nine_text_color.';}'. "\n";
				echo '.alt-nine.full-width-text:after {border-top-color:'.$alt_nine_bg_color.';}'. "\n";
				
				
				echo '.alt-ten {background-color: '.$alt_ten_bg_color.';}'. "\n";
				if (isset($options['alt_ten_bg_image']) && $alt_ten_bg_image != "") {
					if ($alt_ten_bg_image_size == "cover") {
						echo '.alt-ten {background-image: url('.$alt_ten_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-ten {background-image: url('.$alt_ten_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-ten {color: '.$alt_nine_text_color.';}'. "\n";
				echo '.alt-ten.full-width-text:after {border-top-color:'.$alt_ten_bg_color.';}'. "\n";
			?>
		</style>
	
	<?php }
	
	
	/* BETTER SEO PAGE TITLE
	================================================== */
	
	add_filter( 'wp_title', 'filter_wp_title' );
	/**
	 * Filters the page title appropriately depending on the current page
	 *
	 * This function is attached to the 'wp_title' fiilter hook.
	 *
	 * @uses	get_bloginfo()
	 * @uses	is_home()
	 * @uses	is_front_page()
	 */
	function filter_wp_title( $title ) {
		global $page, $paged;
	
		if ( is_feed() )
			return $title;
	
		$site_description = get_bloginfo( 'description' );
	
		$filtered_title = $title . get_bloginfo( 'name' );
		$filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
		$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s' ), max( $paged, $page ) ) : '';
	
		return $filtered_title;
	}
	
	
	/* SET SIDEBAR GLOBAL
	================================================== */
		
	function sf_set_sidebar_global($sidebar_config) {
		
		global $sidebars;
		
		if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
		$sidebars = 'one-sidebar';
		} else if ($sidebar_config == "both-sidebars") {
		$sidebars = 'both-sidebars';
		} else {
		$sidebars = 'no-sidebars';
		}
	}
	
	
	/* WORDPRESS GALLERY MODS
	================================================== */
	
	add_filter( 'wp_get_attachment_link', 'sant_lightboxadd');
	 
	function sant_lightboxadd($content) {
	    $content = preg_replace("/<a/","<a class=\"view\" rel='gallery'",$content,1);
	    return $content;
	}
	
	add_filter( 'gallery_style', 'custom_gallery_styling', 99 );
	
	function custom_gallery_styling() {
	    return "<div class='gallery'>";
	}
	
	
	/* WORDPRESS TAG CLOUD WIDGET MODS
	================================================== */
	
	add_filter( 'widget_tag_cloud_args', 'sf_tag_cloud_args' );
	
	function sf_tag_cloud_args( $args ) {
		$args['largest'] = 12;
		$args['smallest'] = 12;
		$args['unit'] = 'px';
		$args['format'] = 'list';
		return $args;
	}
	
	
	/* WORDPRESS CATEGORY WIDGET MODS
	================================================== */
	
	add_filter('wp_list_categories', 'sf_category_widget_mod');
	
	function sf_category_widget_mod($output) {
		$output = str_replace('</a> (',' <span>(',$output);
		$output = str_replace(')',')</span></a> ',$output);
		return $output;
	}
	
	
	/* WORDPRESS ARCHIVES WIDGET MODS
	================================================== */
	
	add_filter('wp_get_archives', 'sf_archives_widget_mod');
	
	function sf_archives_widget_mod($output) {
		$output = str_replace('</a> (',' <span>(',$output);
		$output = str_replace(')',')</span></a> ',$output);
		return $output;
	}
	
	
	/* GET CUSTOM POST TYPE TAXONOMY LIST
	================================================== */

	function get_category_list( $category_name, $filter=0 ){
		
		if (!$filter) { 
		
			$get_category = get_categories( array( 'taxonomy' => $category_name	));
			$category_list = array( '0' => 'All');
			
			foreach( $get_category as $category ){
				if (isset($category->slug)) {
				$category_list[] = $category->slug;
				}
			}
				
			return $category_list;
			
		} else {
			
			$get_category = get_categories( array( 'taxonomy' => $category_name	));
			$category_list = array( '0' => 'All');
			
			foreach( $get_category as $category ){
				if (isset($category->cat_name)) {
				$category_list[] = $category->cat_name;
				}
			}
				
			return $category_list;	
		
		}
	}
	
	function get_category_list_key_array($category_name) {
			
		$get_category = get_categories( array( 'taxonomy' => $category_name	));
		$category_list = array( 'all' => 'All');
		
		foreach( $get_category as $category ){
			if (isset($category->slug)) {
			$category_list[$category->slug] = $category->cat_name;
			}
		}
			
		return $category_list;
	}
	
	function get_woo_product_filters_array() {
		
		global $woocommerce;
		
		$attribute_array = array();
		
		$transient_name = 'wc_attribute_taxonomies';
		
		if ( false === ( $attribute_taxonomies = get_transient( $transient_name ) ) ) {

			global $wpdb;

			$attribute_taxonomies = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies" );

			set_transient( $transient_name, $attribute_taxonomies );
		}

		$attribute_taxonomies = apply_filters( 'woocommerce_attribute_taxonomies', $attribute_taxonomies );
		
		$attribute_array['product_cat'] = __('Product Category', 'swiftframework');
		$attribute_array['price'] = __('Price', 'swiftframework');
				
		if ( $attribute_taxonomies ) {
			foreach ( $attribute_taxonomies as $tax ) {
				$attribute_array[$tax->attribute_name] = $tax->attribute_name;
			}
		}
		
		return $attribute_array;	
	}
	
	
	/* TWEET FUNCTIONS
	================================================== */
	
	function sf_get_tweets($twitterID, $count) {
	
		$content = "";
				
		if (function_exists('getTweets')) {
						
			$tweets = getTweets($twitterID, $count);
					
			if(is_array($tweets)){
						
				foreach($tweets as $tweet){
										
					$content .= '<li>';
				
				    if(is_array($tweet) && isset($tweet['text']) && $tweet['text']){
				    	
				    	$content .= '<div class="tweet-text">';
				    	
				        $the_tweet = $tweet['text'];
				        /*
				        Twitter Developer Display Requirements
				        https://dev.twitter.com/terms/display-requirements
				
				        2.b. Tweet Entities within the Tweet text must be properly linked to their appropriate home on Twitter. For example:
				          i. User_mentions must link to the mentioned user's profile.
				         ii. Hashtags must link to a twitter.com search with the hashtag as the query.
				        iii. Links in Tweet text must be displayed using the display_url
				             field in the URL entities API response, and link to the original t.co url field.
				        */
				
				        // i. User_mentions must link to the mentioned user's profile.
				        if(isset($tweet['entities']['user_mentions']) && is_array($tweet['entities']['user_mentions'])){
				            foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
				                $the_tweet = preg_replace(
				                    '/@'.$user_mention['screen_name'].'/i',
				                    '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
				                    $the_tweet);
				            }
				        }
				
				        // ii. Hashtags must link to a twitter.com search with the hashtag as the query.
				        if(isset($tweet['entities']['hashtags']) && is_array($tweet['entities']['hashtags'])){
				            foreach($tweet['entities']['hashtags'] as $key => $hashtag){
				                $the_tweet = preg_replace(
				                    '/#'.$hashtag['text'].'/i',
				                    '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&amp;src=hash" target="_blank">#'.$hashtag['text'].'</a>',
				                    $the_tweet);
				            }
				        }
				
				        // iii. Links in Tweet text must be displayed using the display_url
				        //      field in the URL entities API response, and link to the original t.co url field.
				        if(isset($tweet['entities']['urls']) && is_array($tweet['entities']['urls'])){
				            foreach($tweet['entities']['urls'] as $key => $link){
				                $the_tweet = preg_replace(
				                    '`'.$link['url'].'`',
				                    '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
				                    $the_tweet);
				            }
				        }
				
				        $content .= $the_tweet;
						
						$content .= '</div>';
				
				        // 3. Tweet Actions
				        //    Reply, Retweet, and Favorite action icons must always be visible for the user to interact with the Tweet. These actions must be implemented using Web Intents or with the authenticated Twitter API.
				        //    No other social or 3rd party actions similar to Follow, Reply, Retweet and Favorite may be attached to a Tweet.
				        // 4. Tweet Timestamp
				        //    The Tweet timestamp must always be visible and include the time and date. e.g., “3:00 PM - 31 May 12”.
				        // 5. Tweet Permalink
				        //    The Tweet timestamp must always be linked to the Tweet permalink.
				        
				       	$content .= '<div class="twitter_intents">'. "\n";
				        $content .= '<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'"><i class="fa-reply"></i></a>'. "\n";
				        $content .= '<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'"><i class="fa-retweet"></i></a>'. "\n";
				        $content .= '<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'"><i class="fa-star"></i></a>'. "\n";
				        
				        $date = strtotime($tweet['created_at']); // retrives the tweets date and time in Unix Epoch terms
				        $blogtime = current_time('U'); // retrives the current browser client date and time in Unix Epoch terms
				        $dago = human_time_diff($date, $blogtime) . ' ' . sprintf(__('ago', 'swiftframework')); // calculates and outputs the time past in human readable format
						$content .= '<a class="timestamp" href="https://twitter.com/'.$twitterID.'/status/'.$tweet['id_str'].'" target="_blank">'.$dago.'</a>'. "\n";
						$content .= '</div>'. "\n";
				    } else {
				        $content .= '<a href="http://twitter.com/'.$twitterID.'" target="_blank">@'.$twitterID.'</a>';
				    }
				    $content .= '</li>';
				}
			}
			return $content;
		} else {
			return '<li><div class="tweet-text">Please install the oAuth Twitter Feed Plugin and follow the theme documentation to set it up.</div></li>';
		}	

	}
	
	function sf_hyperlinks($text) {
		    $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
		    $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
		    // match name@address
		    $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
		        //mach #trendingtopics. Props to Michael Voigt
		    $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
		    return $text;
		}
		
	function sf_twitter_users($text) {
	       $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
	       return $text;
	}

    function sf_encode_tweet($text) {
            $text = mb_convert_encoding( $text, "HTML-ENTITIES", "UTF-8");
            return $text;
    }
	
	
	/* VIDEO EMBED FUNCTIONS
	================================================== */
	
	function video_embed($url, $width = 640, $height = 480) {
		if (strpos($url,'youtube')){
			return video_youtube($url, $width, $height);
		} else {
			return video_vimeo($url, $width, $height);
		}
	}
	
	function video_youtube($url, $width = 640, $height = 480){
	
		preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $video_id);
		
		return '<iframe itemprop="video" src="http://www.youtube.com/embed/'. $video_id[1] .'?wmode=transparent" width="'. $width .'" height="'. $height .'" ></iframe>';
				
	}
	
	function video_vimeo($url, $width = 640, $height = 480){
	
		preg_match('/http:\/\/vimeo.com\/(\d+)$/', $url, $video_id);		
		
		return '<iframe itemprop="video" src="http://player.vimeo.com/video/'. $video_id[1] .'?title=0&amp;byline=0&amp;portrait=0?wmode=transparent" width="'. $width .'" height="'. $height .'"></iframe>';
		
	}
	
		
	/* MAP EMBED FUNCTIONS
	================================================== */

	function map_embed($address) {
	    if (!is_string($address))die("All Addresses must be passed as a string");
	    
	    $address = str_replace(" ", "+", $address); // replcae all the white space with "+" sign to match with google search pattern
	     
	    $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";
	     
	    $response = @file_get_contents($url);	    

	    if ($response === FALSE) {
	    	return "error";
	    }
	    
	    $json = json_decode($response,TRUE); //generate array object from the response from the web   

		if ($json['status'] === "OVER_QUERY_LIMIT") {
			return "over_limit";
		}
		
		if ($json['status'] === "ZERO_RESULTS") {
			return "unknown_address";
		}
		
	    $_coords['lat'] = $json['results'][0]['geometry']['location']['lat'];
	    $_coords['long'] = $json['results'][0]['geometry']['location']['lng'];
	    
	    return $_coords;
	}
	
		
	/* FEATURED IMAGE TITLE
	================================================== */
	
	function sf_featured_img_title() {
	  global $post;
	  $sf_thumbnail_id = get_post_thumbnail_id($post->ID);
	  $sf_thumbnail_image = get_posts(array('p' => $sf_thumbnail_id, 'post_type' => 'attachment', 'post_status' => 'any'));
	  if ($sf_thumbnail_image && isset($sf_thumbnail_image[0])) {
	    return $sf_thumbnail_image[0]->post_title;
	  }
	}
	
	
	/* LANGUAGE FLAGS
	================================================== */
	
	if (! function_exists( 'language_flags' )) {
	function language_flags() {
		
		$language_output = "";
		
		if (function_exists('icl_get_languages')) {
		    $languages = icl_get_languages('skip_missing=0&orderby=code');
		    if(!empty($languages)){
		        foreach($languages as $l){
		            $language_output .= '<li>';
		            if($l['country_flag_url']){
		                if(!$l['active']) {
		                	$language_output .= '<a href="'.$l['url'].'"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /><span class="language name">'.$l['translated_name'].'</span></a>'."\n";
		                } else {
		                	$language_output .= '<div class="current-language"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /><span class="language name">'.$l['translated_name'].'</span></div>'."\n";
		                }
		            }
		            $language_output .= '</li>';
		        }
		    }
	    } else {
	    	//echo '<li><div>No languages set.</div></li>';
	    	$flags_url = get_template_directory_uri() . '/images/flags';
	    	$language_output .= '<li><a href="#">DEMO - EXAMPLE PURPOSES</a><li><a href="#"><span class="language name">German</span></a></li><li><div class="current-language"><span class="language name">English</span></div></li><li><a href="#"><span class="language name">Spanish</span></a></li><li><a href="#"><span class="language name">French</span></a></li>'."\n";
	    }
	    
	    return $language_output;
	}
	}
	
	
	/* PAGINATION
	================================================== */
	
	function pagination() {
		global $wp_query;
		
		$big = 999999999; // need an unlikely integer
		
		return paginate_links( array(
			'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages
		) );
	}
	
	
	/* LATEST TWEET FUNCTION
	================================================== */
	
	function latestTweet($count, $twitterID) {
	
		global $include_twitter;
		$include_twitter = true;
		
		$content = "";
		
		if (function_exists('getTweets')) {
						
			$tweets = getTweets($twitterID, $count);
		
			if(is_array($tweets)){
						
				foreach($tweets as $tweet){
										
					$content .= '<li>';
				
				    if($tweet['text']){
				    	
				    	$content .= '<div class="tweet-text">';
				    	
				        $the_tweet = $tweet['text'];
				        /*
				        Twitter Developer Display Requirements
				        https://dev.twitter.com/terms/display-requirements
				
				        2.b. Tweet Entities within the Tweet text must be properly linked to their appropriate home on Twitter. For example:
				          i. User_mentions must link to the mentioned user's profile.
				         ii. Hashtags must link to a twitter.com search with the hashtag as the query.
				        iii. Links in Tweet text must be displayed using the display_url
				             field in the URL entities API response, and link to the original t.co url field.
				        */
				
				        // i. User_mentions must link to the mentioned user's profile.
				        if(is_array($tweet['entities']['user_mentions'])){
				            foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
				                $the_tweet = preg_replace(
				                    '/@'.$user_mention['screen_name'].'/i',
				                    '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
				                    $the_tweet);
				            }
				        }
				
				        // ii. Hashtags must link to a twitter.com search with the hashtag as the query.
				        if(is_array($tweet['entities']['hashtags'])){
				            foreach($tweet['entities']['hashtags'] as $key => $hashtag){
				                $the_tweet = preg_replace(
				                    '/#'.$hashtag['text'].'/i',
				                    '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&amp;src=hash" target="_blank">#'.$hashtag['text'].'</a>',
				                    $the_tweet);
				            }
				        }
				
				        // iii. Links in Tweet text must be displayed using the display_url
				        //      field in the URL entities API response, and link to the original t.co url field.
				        if(is_array($tweet['entities']['urls'])){
				            foreach($tweet['entities']['urls'] as $key => $link){
				                $the_tweet = preg_replace(
				                    '`'.$link['url'].'`',
				                    '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
				                    $the_tweet);
				            }
				        }
				
				        $content .= $the_tweet;
						
						$content .= '</div>';
				
				        // 3. Tweet Actions
				        //    Reply, Retweet, and Favorite action icons must always be visible for the user to interact with the Tweet. These actions must be implemented using Web Intents or with the authenticated Twitter API.
				        //    No other social or 3rd party actions similar to Follow, Reply, Retweet and Favorite may be attached to a Tweet.
				        // 4. Tweet Timestamp
				        //    The Tweet timestamp must always be visible and include the time and date. e.g., “3:00 PM - 31 May 12”.
				        // 5. Tweet Permalink
				        //    The Tweet timestamp must always be linked to the Tweet permalink.
				        
				       	$content .= '<div class="twitter_intents">'. "\n";
				        $content .= '<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'"><i class="fa-reply"></i></a>'. "\n";
				        $content .= '<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'"><i class="fa-retweet"></i></a>'. "\n";
				        $content .= '<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'"><i class="fa-star"></i></a>'. "\n";
				        
				        $date = strtotime($tweet['created_at']); // retrives the tweets date and time in Unix Epoch terms
				        $blogtime = current_time('U'); // retrives the current browser client date and time in Unix Epoch terms
				        $dago = human_time_diff($date, $blogtime) . ' ' . sprintf(__('ago', 'swiftframework')); // calculates and outputs the time past in human readable format
						$content .= '<a class="timestamp" href="https://twitter.com/'.$twitterID.'/status/'.$tweet['id_str'].'" target="_blank">'.$dago.'</a>'. "\n";
						$content .= '</div>'. "\n";
				    } else {
				        $content .= '<a href="http://twitter.com/'.$twitterID.'" target="_blank">@'.$twitterID.'</a>';
				    }
				    $content .= '</li>';
				}
			}
			return $content;
		} else {
			return '<li><div class="tweet-text">Please install the oAuth Twitter Feed Plugin and follow the theme documentation to set it up.</div></li>';
		}	
	}
	
		
	/* CONTENT RETURN FUNCTIONS
	================================================== */
	
	function get_the_content_with_formatting() {
	    $content = get_the_content();
	    $content = apply_filters('the_content', $content);
	    $content = str_replace(']]>', ']]&gt;', $content);
	    return $content;
	}
	function sf_add_formatting($content) {
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}
	
	
	/* SHORTCODE FIX
	================================================== */
	
	function sf_shortcode_fix($content){   
	    $array = array (
	        '<p>[' => '[', 
	        ']</p>' => ']', 
	        ']<br />' => ']'
	    );
	
	    $content = strtr($content, $array);
	    return $content;
	}
	add_filter('the_content', 'sf_shortcode_fix');
	
	
	/* CATEGORY REL FIX
	================================================== */
		 
	function add_nofollow_cat( $text) {
	    $strings = array('rel="category"', 'rel="category tag"', 'rel="whatever may need"');
	    $text = str_replace('rel="category tag"', "", $text);
	    return $text;
	}
	add_filter( 'the_category', 'add_nofollow_cat' );
	
	
	
	/* CUSTOM MENU SETUP
	================================================== */
	
	add_action( 'after_setup_theme', 'setup_menus' );
	function setup_menus() {
		// This theme uses wp_nav_menu() in four locations.
		register_nav_menus( array(
		'main_navigation' => __( 'Main Menu', "swiftframework" ),
		'top_bar_menu' => __( 'Top Bar Menu', "swiftframework" )
		) );
	}
	add_filter('nav_menu_css_class', 'mbudm_add_page_type_to_menu', 10, 2 );
	//If a menu item is a page then add the template name to it as a css class 
	function mbudm_add_page_type_to_menu($classes, $item) {
	    if($item->object == 'page'){
	        $template_name = get_post_meta( $item->object_id, '_wp_page_template', true );
	        $new_class =str_replace(".php","",$template_name);
	        array_push($classes, $new_class);
	    }   
	    return $classes;
	}
		
	
	/* EXCERPT
	================================================== */
	
	function new_excerpt_length($length) {
	    return 60;
	}
	add_filter('excerpt_length', 'new_excerpt_length');
	
	// Blog Widget Excerpt
	function excerpt($limit) {
	      $excerpt = explode(' ', get_the_excerpt(), $limit);
	      if (count($excerpt)>=$limit) {
	        array_pop($excerpt);
	        $excerpt = implode(" ",$excerpt).'...';
	      } else {
	        $excerpt = implode(" ",$excerpt).'';
	      } 
	      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	      return '<p>' . $excerpt . '</p>';
	    }
	
	function content($limit) {
	      $content = explode(' ', get_the_content(), $limit);
	      if (count($content)>=$limit) {
	        array_pop($content);
	        $content = implode(" ",$content).'...';
	      } else {
	        $content = implode(" ",$content).'';
	      } 
	      $content = preg_replace('/\[.+\]/','', $content);
	      $content = apply_filters('the_content', $content); 
	      $content = str_replace(']]>', ']]&gt;', $content);
	      return $content;
	}
	
	function custom_excerpt($custom_content, $limit) {
		$content = explode(' ', $custom_content, $limit);
		if (count($content)>=$limit) {
		  array_pop($content);
		  $content = implode(" ",$content).'...';
		} else {
		  $content = implode(" ",$content).'';
		} 
		$content = preg_replace('/\[.+\]/','', $content);
		$content = apply_filters('the_content', $content); 
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}	
	
	/* REGISTER SIDEBARS
	================================================== */
	if (!function_exists('sf_register_sidebars')) {
		function sf_register_sidebars() {
			if ( function_exists('register_sidebar')) {
			
				$options = get_option('sf_neighborhood_options');
				if (isset($options['footer_layout'])) {
				$footer_config = $options['footer_layout'];
				} else {
				$footer_config = 'footer-1';
				}
			    register_sidebar(array(
			        'name' => 'Sidebar One',
			        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			        'after_widget' => '</section>',
			        'before_title' => '<div class="widget-heading clearfix"><h4><span>',
			        'after_title' => '</span></h4></div>',
			    ));
			    register_sidebar(array(
			        'name' => 'Sidebar Two',
			        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			        'after_widget' => '</section>',
			        'before_title' => '<div class="widget-heading clearfix"><h4><span>',
			        'after_title' => '</span></h4></div>',
			    ));
				register_sidebar(array(
					'name' => 'Sidebar Three',
					'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
					'after_widget' => '</section>',
					'before_title' => '<div class="widget-heading clearfix"><h4><span>',
					'after_title' => '</span></h4></div>',
				));
				register_sidebar(array(
					'name' => 'Sidebar Four',
					'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
					'after_widget' => '</section>',
					'before_title' => '<div class="widget-heading clearfix"><h4><span>',
					'after_title' => '</span></h4></div>',
				));
				register_sidebar(array(
				    'name' => 'Sidebar Five',
				    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
				    'after_widget' => '</section>',
				    'before_title' => '<div class="widget-heading clearfix"><h4><span>',
				    'after_title' => '</span></h4></div>',
				));
				register_sidebar(array(
				    'name' => 'Sidebar Six',
				    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
				    'after_widget' => '</section>',
				    'before_title' => '<div class="widget-heading clearfix"><h4><span>',
				    'after_title' => '</span></h4></div>',
				));
				register_sidebar(array(
					'name' => 'Sidebar Seven',
					'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
					'after_widget' => '</section>',
					'before_title' => '<div class="widget-heading clearfix"><h4><span>',
					'after_title' => '</span></h4></div>',
				));
				register_sidebar(array(
					'name' => 'Sidebar Eight',
					'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
					'after_widget' => '</section>',
					'before_title' => '<div class="widget-heading clearfix"><h4><span>',
					'after_title' => '</span></h4></div>',
				));
			    register_sidebar(array(
			        'name' => 'Footer Column 1',
			        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			        'after_widget' => '</section>',
			        'before_title' => '<div class="widget-heading clearfix"><h4><span>',
			        'after_title' => '</span></h4></div>',
			    ));
			    register_sidebar(array(
			        'name' => 'Footer Column 2',
			        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			        'after_widget' => '</section>',
			        'before_title' => '<div class="widget-heading clearfix"><h4><span>',
			        'after_title' => '</span></h4></div>',
			    ));
			    register_sidebar(array(
			        'name' => 'Footer Column 3',
			        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			        'after_widget' => '</section>',
			        'before_title' => '<div class="widget-heading clearfix"><h4><span>',
			        'after_title' => '</span></h4></div>',
			    ));
			    if ($footer_config == "footer-1") {
			    register_sidebar(array(
			        'name' => 'Footer Column 4',
			        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			        'after_widget' => '</section>',
			        'before_title' => '<div class="widget-heading clearfix"><h4><span>',
			        'after_title' => '</span></h4></div>',
			    ));
			    }
			    register_sidebar(array(
			        'id' => 'woocommerce-sidebar',
			        'name' => 'WooCommerce Sidebar',
			        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			        'after_widget' => '</section>',
			        'before_title' => '<div class="widget-heading clearfix"><h4><span>',
			        'after_title' => '</span></h4></div>',
			    ));
			} 
		}
		add_action( 'after_setup_theme', 'sf_register_sidebars', 10);
	}
	
	function sf_sidebars_array() {
	 	$sidebars = array();
	 	
	 	foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
	 		$sidebars[ucwords($sidebar['id'])] = $sidebar['name'];
	 	}
	 	return $sidebars;
	}
	
	
	/* ADD SHORTCODE FUNCTIONALITY TO WIDGETS
	================================================== */
	
	add_filter('widget_text', 'do_shortcode');
	
	
	/* NAVIGATION CHECK
	================================================== */
	
	//functions tell whether there are previous or next 'pages' from the current page
	//returns 0 if no 'page' exists, returns a number > 0 if 'page' does exist
	//ob_ functions are used to suppress the previous_posts_link() and next_posts_link() from printing their output to the screen
	
	function has_previous_posts() {
		ob_start();
		previous_posts_link();
		$result = strlen(ob_get_contents());
		ob_end_clean();
		return $result;
	}
	
	function has_next_posts() {
		ob_start();
		next_posts_link();
		$result = strlen(ob_get_contents());
		ob_end_clean();
		return $result;
	}
	
	
	/* REMOVE CERTAIN HEAD TAGS
	================================================== */
	
	add_action('init', 'remheadlink');
	function remheadlink() {
		remove_action('wp_head', 'index_rel_link');
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
	}
	
	
	/* CUSTOM LOGIN LOGO
	================================================== */
	
	function sf_custom_login_logo() {
		$options = get_option('sf_neighborhood_options');
		$custom_logo = "";
		if (isset($options['custom_admin_login_logo'])) {
		$custom_logo = $options['custom_admin_login_logo'];
		}
		if ($custom_logo) {		
		echo '<style type="text/css">
		    .login h1 a { background-image:url('. $custom_logo .') !important; height: 95px!important; width: 100%!important; background-size: auto!important; }
		</style>';
		} else {
		echo '<style type="text/css">
		    .login h1 a { background-image:url('. get_template_directory_uri() .'/images/custom-login-logo.png) !important; height: 95px!important; background-size: auto!important; }
		</style>';
		}
	}
	
	add_action('login_head', 'sf_custom_login_logo');
		
	
	/* COMMENTS
	================================================== */
	
	// Custom callback to list comments in the your-theme style
	function custom_comments($comment, $args, $depth) {
	  $GLOBALS['comment'] = $comment;
	    $GLOBALS['comment_depth'] = $depth;
	  ?>
	    <li id="comment-<?php comment_ID() ?>" <?php comment_class('clearfix') ?>>
	        <div class="comment-wrap clearfix">
	            <div class="comment-avatar">
	            	<?php if(function_exists('get_avatar')) { echo get_avatar($comment, '100'); } ?>
	            	<?php if ($comment->comment_author_email == get_the_author_meta('email')) { ?>
	            	<span class="tooltip"><?php _e("Author", "swiftframework"); ?><span class="arrow"></span></span>
	            	<?php } ?>
	            </div>
	    		<div class="comment-content">
	            	<div class="comment-meta">
	            			<?php
	            				printf('<span class="comment-author">%1$s</span> <span class="comment-date">%2$s</span>',
	            					get_comment_author_link(),
	            					get_comment_date()
	            				);
	                        	edit_comment_link(__('Edit', 'swiftframework'), '<span class="edit-link">', '</span><span class="meta-sep"> |</span>');
	                        ?>
	                        <?php if($args['type'] == 'all' || get_comment_type() == 'comment') :
	                        	comment_reply_link(array_merge($args, array(
	                            	'reply_text' => __('Reply','swiftframework'),
	                            	'login_text' => __('Log in to reply.','swiftframework'),
	                            	'depth' => $depth,
	                            	'before' => '<span class="comment-reply">',
	                            	'after' => '</span>'
	                        	)));
	                        endif; ?>
	    			</div>
	      			<?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'swiftframework') ?>
	            	<div class="comment-body">
	                	<?php comment_text() ?>
	            	</div>
	    		</div>
	        </div>
	<?php } // end custom_comments
	
	// Custom callback to list pings
	function custom_pings($comment, $args, $depth) {
	       $GLOBALS['comment'] = $comment;
	        ?>
	            <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
	                <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'swiftframework'),
	                        get_comment_author_link(),
	                        get_comment_date(),
	                        get_comment_time() );
	                        edit_comment_link(__('Edit', 'swiftframework'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
	    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'swiftframework') ?>
	            <div class="comment-content">
	                <?php comment_text() ?>
	            </div>
	<?php } // end custom_pings
	
	
	
	/* PAGINATION
	================================================== */
	
	 
	/* Function that Rounds To The Nearest Value.
	   Needed for the pagenavi() function */
	function round_num($num, $to_nearest) {
	   /*Round fractions down (http://php.net/manual/en/function.floor.php)*/
	   return floor($num/$to_nearest)*$to_nearest;
	}
	 
	/* Function that performs a Boxed Style Numbered Pagination (also called Page Navigation).
	   Function is largely based on Version 2.4 of the WP-PageNavi plugin */
	function pagenavi($query, $before = '', $after = '') {
	    
	    wp_reset_query();
	    global $wpdb, $paged;
	    
	    $pagenavi_options = array();
	    //$pagenavi_options['pages_text'] = ('Page %CURRENT_PAGE% of %TOTAL_PAGES%:');
	    $pagenavi_options['pages_text'] = ('');
	    $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
	    $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
	    $pagenavi_options['first_text'] = ('First Page');
	    $pagenavi_options['last_text'] = ('Last Page');
	    $pagenavi_options['next_text'] = __("Next <i class='fa-angle-right'></i>", "swiftframework");
	    $pagenavi_options['prev_text'] = __("<i class='fa-angle-left'></i> Previous", "swiftframework");
	    $pagenavi_options['dotright_text'] = '...';
	    $pagenavi_options['dotleft_text'] = '...';
	    $pagenavi_options['num_pages'] = 5; //continuous block of page numbers
	    $pagenavi_options['always_show'] = 0;
	    $pagenavi_options['num_larger_page_numbers'] = 0;
	    $pagenavi_options['larger_page_numbers_multiple'] = 5;
	 
	 	$output = "";
	 	
	    //If NOT a single Post is being displayed
	    /*http://codex.wordpress.org/Function_Reference/is_single)*/
	    if (!is_single()) {
	        $request = $query->request;
	        //intval — Get the integer value of a variable
	        /*http://php.net/manual/en/function.intval.php*/
	        $posts_per_page = intval(get_query_var('posts_per_page'));
	        //Retrieve variable in the WP_Query class.
	        /*http://codex.wordpress.org/Function_Reference/get_query_var*/
	        if ( get_query_var('paged') ) {
	        $paged = get_query_var('paged');
	        } elseif ( get_query_var('page') ) {
	        $paged = get_query_var('page');
	        } else {
	        $paged = 1;
	        }
	        $numposts = $query->found_posts;
	        $max_page = $query->max_num_pages;
	 
	        //empty — Determine whether a variable is empty
	        /*http://php.net/manual/en/function.empty.php*/
	        if(empty($paged) || $paged == 0) {
	            $paged = 1;
	        }
	 
	        $pages_to_show = intval($pagenavi_options['num_pages']);
	        $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
	        $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
	        $pages_to_show_minus_1 = $pages_to_show - 1;
	        $half_page_start = floor($pages_to_show_minus_1/2);
	        //ceil — Round fractions up (http://us2.php.net/manual/en/function.ceil.php)
	        $half_page_end = ceil($pages_to_show_minus_1/2);
	        $start_page = $paged - $half_page_start;
	 
	        if($start_page <= 0) {
	            $start_page = 1;
	        }
	 
	        $end_page = $paged + $half_page_end;
	        if(($end_page - $start_page) != $pages_to_show_minus_1) {
	            $end_page = $start_page + $pages_to_show_minus_1;
	        }
	        if($end_page > $max_page) {
	            $start_page = $max_page - $pages_to_show_minus_1;
	            $end_page = $max_page;
	        }
	        if($start_page <= 0) {
	            $start_page = 1;
	        }
	 
	        $larger_per_page = $larger_page_to_show*$larger_page_multiple;
	        //round_num() custom function - Rounds To The Nearest Value.
	        $larger_start_page_start = (round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
	        $larger_start_page_end = round_num($start_page, 10) + $larger_page_multiple;
	        $larger_end_page_start = round_num($end_page, 10) + $larger_page_multiple;
	        $larger_end_page_end = round_num($end_page, 10) + ($larger_per_page);
	 
	        if($larger_start_page_end - $larger_page_multiple == $start_page) {
	            $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
	            $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
	        }
	        if($larger_start_page_start <= 0) {
	            $larger_start_page_start = $larger_page_multiple;
	        }
	        if($larger_start_page_end > $max_page) {
	            $larger_start_page_end = $max_page;
	        }
	        if($larger_end_page_end > $max_page) {
	            $larger_end_page_end = $max_page;
	        }
	        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
	            /*http://php.net/manual/en/function.str-replace.php */
	            /*number_format_i18n(): Converts integer number to format based on locale (wp-includes/functions.php*/
	            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
	            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
	            $output .= $before.'<ul class="pagenavi">'."\n";
	 
	            if(!empty($pages_text)) {
	                $output .= '<li><span class="pages">'.$pages_text.'</span></li>';
	            }
	            //Displays a link to the previous post which exists in chronological order from the current post.
	            /*http://codex.wordpress.org/Function_Reference/previous_post_link*/
	            if ($paged > 1) {
	            $output .= '<li class="prev">' . get_previous_posts_link($pagenavi_options['prev_text']) . '</li>';
	 			}
	 			
	            if ($start_page >= 2 && $pages_to_show < $max_page) {
	                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
	                //esc_url(): Encodes < > & " ' (less than, greater than, ampersand, double quote, single quote).
	                /*http://codex.wordpress.org/Data_Validation*/
	                //get_pagenum_link():(wp-includes/link-template.php)-Retrieve get links for page numbers.
	                $output .= '<li><a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">1</a></li>';
	                if(!empty($pagenavi_options['dotleft_text'])) {
	                    $output .= '<li><span class="expand">'.$pagenavi_options['dotleft_text'].'</span></li>';
	                }
	            }
	 
	            if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
	                for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
	                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
	                    $output .= '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
	                }
	            }
	 
	            for($i = $start_page; $i  <= $end_page; $i++) {
	                if($i == $paged) {
	                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
	                    $output .= '<li><span class="current">'.$current_page_text.'</span></li>';
	                } else {
	                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
	                    $output .= '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
	                }
	            }
	 
	            if ($end_page < $max_page) {
	                if(!empty($pagenavi_options['dotright_text'])) {
	                    $output .= '<li><span class="expand">'.$pagenavi_options['dotright_text'].'</span></li>';
	                }
	                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
	                $output .= '<li><a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$max_page.'</a></li>';
	            }
	            $output .= '<li class="next">' . get_next_posts_link($pagenavi_options['next_text'], $max_page) . '</li>';
	 
	            if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
	                for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
	                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
	                    $output .= '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
	                }
	            }
	            $output .= '</ul>'.$after."\n";
	        }
	    }
	    
	    return $output;
	}	
?>