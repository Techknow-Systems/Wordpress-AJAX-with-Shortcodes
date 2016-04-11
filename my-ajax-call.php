<?php

	// Set up the WP environment so we have access to the WP functions & shortcodes

  // Get the absolute path of wp-load.php
	$yourBaseURL = 'your_base_URL.com';
	$absPath= getcwd();
	$WPpath = substr($absPath, 0, strpos($absPath, $yourBaseURL) + strlen($yourBaseURL) + 1) . 'wp-load.php';
	require($WPpath);

  // Output headers to stop caching of this script
	@header('Content-Type: text/html; charset=' . get_option('blog_charset'));
	@header('X-Robots-Tag: noindex');
	send_nosniff_header();
	nocache_headers();

  // Check that this AJAX call is in fact an AJAX call and not being called directly
	check_ajax_referer( 'ajaxcall', 'nonce' );
    
  // Get the data passed from the JS to work with WP_Query
	$args = isset( $_POST['query'] ) ? array_map( 'esc_attr', $_POST['query'] ) : array();
	$args['paged'] = esc_attr( $_POST['page'] );
	
  // Turn on output buffering so we can output HTML without it being sent to the browser
	ob_start();
    
    // Set up the WP Loop so we can output the posts
		$loop = new WP_Query( $args );
    $postIDs = '';
    
    // Loop through WP_Query
		if( $loop->have_posts() ): while( $loop->have_posts() ): $loop->the_post();

      // Get whatever info you require here form WP_Query and start outputting it. Here I am getting a list
      // of Pst IDs to pass to the architect plugin via a shortcode
    	$postIDs .= get_the_ID() . ',';
    
    endwhile; endif; wp_reset_postdata();
    
    // Output the posts using the Architect plugin. Without lines 4-10, we could not do the code below, 
    // Or use WP_Query for that matter
    $short = 'architect container-popular-top-2 ids="' . $postIDs . '"';
    echo do_shortcode ( '['.$short.']' );

	$data = ob_get_clean();
	
	// Send the output back to jquery.make-ajax-call.js and stop any more execution.=
  wp_send_json_success ($data);
	wp_die();

?>
