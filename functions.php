<?php

add_action( 'after_setup_theme', 'ascendant_child_theme_setup' );

function ascendant_child_theme_setup() {

    // Remove parent font
	remove_action('wp_head', 'cpotheme_styling_fonts', 20 );

	remove_filter('cpotheme_background_args', 'cpotheme_background_args');
	add_filter('cpotheme_background_args', 'cpotheme_child_background_args');

}

//Add public stylesheets
if(!function_exists('ascendant_child_add_styles')){
	add_action('wp_enqueue_scripts', 'ascendant_child_add_styles', 9);
	function ascendant_child_add_styles(){

		wp_enqueue_style( 'ascendant-google-font', 'https://fonts.googleapis.com/css?family=Lato:400,700|Raleway:100,400,500,700,800,900' );	
		wp_enqueue_style('ascendant-main', get_template_directory_uri().'/style.css');

	}
}

if(!function_exists('ascendant_child_add_fontawesome')){
	add_action('wp_enqueue_scripts', 'ascendant_child_add_fontawesome',11);
	function ascendant_child_add_fontawesome(){

		wp_enqueue_style('cpotheme-fontawesome');

	}
}

if(!function_exists('cpotheme_child_background_args')){
	function cpotheme_child_background_args($data){ 
		$data = array(
		'default-color' => 'eeeeee',
		'default-image' => get_stylesheet_directory_uri().'/images/background.jpg',
		'default-repeat' => 'no-repeat',
		'default-position-x' => 'center',
		'default-attachment' => 'fixed',
		);
		return $data;
	}
}

add_filter( 'cpotheme_customizer_controls', 'ascendant_add_customizer_fields' );
function ascendant_add_customizer_fields( $data ){

	$data['transparent_header'] = array(
		'label' => __('Transparent Header', 'allegiant'),
		'description' => __('Your header will be transparent.', 'allegiant'),
		'section' => 'cpotheme_management',
		'type' => 'checkbox',
		'sanitize' => 'cpotheme_sanitize_bool',
		'default' => '1');

	return $data;

}