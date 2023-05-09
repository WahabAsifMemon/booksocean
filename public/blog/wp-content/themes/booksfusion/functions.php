<?php 
	if ( !function_exists('booksofusion_setup') ) {
		function booksofusion_setup() {
			$lang_dir = get_stylesheet_directory_uri() . '/assets/language';
			load_theme_textdomain( 'booksocean', $lang_dir );
			add_theme_support( 'automatic_feed_links' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'post-formats', [
				'gallery', 'link', 'image', 'quote', 'video', 'audio'
			] );
		}
		add_action( 'after_setup_theme', 'booksofusion_setup' );
	}

 ?>