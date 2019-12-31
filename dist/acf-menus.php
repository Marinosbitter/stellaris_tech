<?php
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Stellaris Game Mechanics',
		'menu_title'	=> 'SGM',
		'menu_slug' 	=> 'sgm',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'TODO',
		'menu_title'	=> 'TODO',
		'parent_slug'	=> 'sgm',
	));	
}