<?php 
/*
Plugin Name: Plexus Preloader
Description: A simple and elegant preloader, utilizing the plexus effect.
Author: Angel Petrov
Version: 0.1.1
Author URI: https://quaxen.com
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


/* Add newest jquery */

function plexus_preloader_latest_jquery() {

		wp_register_script('preloader-TweenLite', plugins_url('/js/TweenLite.min.js', __FILE__) );	
		wp_register_script('preloader-EasePack', plugins_url('/js/EasePack.min.js', __FILE__) );	
		wp_register_script('preloader-main', plugins_url('/js/main.js', __FILE__) );	
		
		wp_enqueue_script('jquery');		
		wp_enqueue_script('preloader-TweenLite');	
		wp_enqueue_script('preloader-EasePack');	
		wp_enqueue_script('preloader-main');	

}

add_action('init', 'plexus_preloader_latest_jquery');

/* The CSS */

function plexus_preloader_plugin_styles() {

	wp_register_style( 'preloader-plugin-style', plugins_url('css/style.css', __FILE__) );	
	wp_register_style( 'animate-css', plugins_url('css/animate.css', __FILE__) );
	
    wp_enqueue_style( 'preloader-plugin-style' );    
	wp_enqueue_style( 'animate-css' );

}

add_action( 'wp_enqueue_scripts', 'plexus_preloader_plugin_styles' );



/* Main body*/

function plexus_preloader_markup() {

?>

<div id="large-header" class="large-header">
 <canvas id="plexus-canvas"></canvas>
  <h1 class="main-title-plexus animated infinite pulse">Loading...</h1>
</div>


<?php
}
add_action ('wp_enqueue_scripts', 'plexus_preloader_markup');


/* Activate */

function plexus_preloader_activation() {

?>

<script>
   jQuery(document).ready(function(){
       setTimeout(function(){ jQuery("#large-header").fadeOut('slow'); }, 900);
   });
</script>


<?php
}
add_action ('wp_footer', 'plexus_preloader_activation');

