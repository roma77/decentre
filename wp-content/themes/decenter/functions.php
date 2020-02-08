<?php
// Support thumbnails
add_theme_support( 'post-thumbnails' );
//Register style
function theme_name_scripts() {
wp_enqueue_style( 'main-style', get_stylesheet_uri() );

wp_enqueue_script('decenter.js', get_template_directory_uri() . '/src/js/decenter.js', array('jquery'), '', true);
}
add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );

function styles_for_single_page() {
    if ( is_single() || is_page() ) {
        wp_enqueue_style ( 'decentre', get_template_directory_uri(). '/src/css/decentre.css', array(), '1.0' );
    }
	if (is_page_template('page-empty-footer-template.php')){
		wp_dequeue_style('decentre');
		wp_enqueue_style ( 'style_empty', get_template_directory_uri(). '/src/css/style_empty_page.css', array(), '1.0' );
	}
}
add_action( 'wp_enqueue_scripts', 'styles_for_single_page' );

//Register nav menu
register_nav_menus(array(
	'top'    		=> 'Top menu',
	'top_chinese'   => 'Top menu Chinese',
	'header'    	=> 'Header menu',
	'language'		=> 'Language menu',
	'footer'		=> 'Footer menu'
));

// Change for select Language
class SelectBox_Menu_Walker extends Walker_Nav_Menu {
        
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$selected = in_array('current-menu-item',$classes) ? 'selected="selected"' : '';
			$output .= '<option '.$selected.' value="'.$item->url.'">';
			$output .= $item->title;
	}
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
			$output .= "</option>";
	}
}

// Remove h2 from navigation
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
	return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}

// Remove category magazine from main query
function dc_pre_redefining_query($query) {
	if ($query->is_home) {
		$query->set('category__not_in', array(16));
	}
	// Post on author page
	if ($query->is_author) {
		$query->set('posts_per_page', '12');
	}
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}
add_filter('pre_get_posts', 'dc_pre_redefining_query');


/**
 * Modify the "must_log_in" string of the comment form.
 *
 * @see http://wordpress.stackexchange.com/a/170492/26350
 */
add_filter( 'comment_form_defaults', function( $fields ) {
    $fields['must_log_in'] = sprintf( 
        __( '<p class="must-log-in">
                 You must <button class=”lrm-login lrm-hide-if-logged-in”>Login</button> to post a comment.</p>' 
        ),
        wp_registration_url(),
        wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )   
    );
    return $fields;
});

// Change display format date in comments
add_filter( 'get_comment_date', 'dc_comment_form_date' );    
	function dc_comment_form_date( $date ) {
	// $date = date("m.d.y");   
	$date = date_i18n ( 'j F Y - H:i', strtotime( $date )) . ': (UTC)';
	return $date;
}


// load_bitcoin_curs will be call when the Cron is executed
add_action( 'load_bitcoin_curs', 'load_bitcoin_curs_hendler' );

// This function will run once the 'load_bitcoin_curs' is called
function load_bitcoin_curs_hendler() {
	$content = @file_get_contents('http://api.bitcoincharts.com/v1/markets.json');
	$decode = json_decode($content,true);
	global $wpdb;
	if (isset($decode[258][close])) {
		$carr_date = date('Y-m-d');
		$data_curs[date] = $carr_date;
		$data_curs[BTC] = $decode[258][close];
		$result_isset = $wpdb->get_var($wpdb->prepare(
			"SELECT id FROM wp_curs WHERE date = %s", date('Y-m-d')
		));									
		if($result_isset){	
			$wpdb->update( 'wp_curs',$data_curs,array('id' => $result_isset ) );
		} else {
			$wpdb->insert( 'wp_curs', $data_curs);
		}
	}
}

// Add function to register event to WordPress init
add_action( 'init', 'register_load_bitcoin_curs_event');

// Function which will register the event
function register_load_bitcoin_curs_event() {
	// Make sure this event hasn't been scheduled
	if( !wp_next_scheduled( 'load_bitcoin_curs' ) ) {
		// Schedule the event
		wp_schedule_event( time(), 'ten_min', 'load_bitcoin_curs' );
	}
}

// Registre 10 min
add_filter( 'cron_schedules', 'cron_add_five_min' );
function cron_add_five_min( $schedules ) {
	$schedules['ten_min'] = array(
		'interval' => 60 * 10,
		'display' => 'Once at 10 min'
	);
	return $schedules;
}

// handler for subscribe
add_action( 'wp_ajax_subscribe_post_handler', 'subscribe_post_handler' );
add_action( 'wp_ajax_nopriv_subscribe_post_handler', 'subscribe_post_handler' );

function subscribe_post_handler( ) {
	global $wpdb;
	$action_data = null;
	$subscribe_email = trim ( strip_tags($_POST[ 'subscribe_email' ] ));
	
	if ( wp_verify_nonce( $_POST['security'], 'subscribe') && filter_var($subscribe_email, FILTER_VALIDATE_EMAIL) && $subscribe_email) {
		$lang = qtranxf_getLanguage();
		$user_id = $_POST[ 'subscriber_id' ];
		$data_email[email] = $subscribe_email;
		$data_email[user_id] = $user_id;	
		$result_isset = $wpdb->get_var($wpdb->prepare(
			"SELECT id FROM wp_subscriber WHERE email = %s", $subscribe_email
		));
		
		if($result_isset){
			$wpdb->update( 'wp_subscriber',$data_curs,array('id' => $result_isset ) );
			if ($lang == 'en') {
				$msg = 'You are already subscribed!';
			} elseif ($lang == 'zh') {
				$msg = '您已经订阅';
			} else {
				$msg = 'Вы уже подписаны!';
			}
			$action_data = array( 'success' => true, 'subscribe' => 'subscribed', 'msg' =>  $msg );
		} else {
			if ($lang == 'en') {
				$msg = 'You successfully subscribed!';
			} elseif ($lang == 'zh') {
				$msg = '您已成功订阅';
			} else {
				$msg = 'Вы успешно подписались!';
			}
			$wpdb->insert( 'wp_subscriber', $data_email);
			$action_data = array( 'success' => true, 'subscribe' => 'subscribe', 'msg' =>  $msg );
		}
	} else {	
		$action_data = array(
			'success' => false,
			'error_code' => 400,
			'error' => __( 'Bad request 2', 'wp-job-manager-bookmarks' ),
			'msg' =>  __( 'Error!', 'wp-job-manager' )
		);
	}
	wp_send_json_success($action_data);
}


function translate_searh($atts) { 
	
	$output = '<div class="search">
					<form role="search" method="get" id="searchform" class="searchform" action="'. esc_url( home_url( '/' ) ) .'"><div id="search-bar">
						<input name="s" id="s" type="text" placeholder="'. qtranxf_use(qtranxf_getLanguage(),'[:ru]Искать[:en]Search[:zh]搜寻[:]') . '..."> 
						<div class="control">
							<div class="clear"></div> 
							<button class="button">'. qtranxf_use(qtranxf_getLanguage(),'[:ru]Искать[:en]Search[:zh]搜寻[:]') . '</button>
							</div>
						</div>
					</form>
				</div>';


	return $output;
}
add_shortcode('search', 'translate_searh');
// использование: [iframe href="http://www.exmaple.com" height="480" width="640"]

