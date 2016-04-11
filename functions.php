add_action( 'wp_enqueue_scripts', 'enqueue_ajax_call_js' );
function enqueue_ajax_call_js() {
  
    // The info we meed to build the WP_Query Object
  	$query = array( 
    	
    	// Set up your WP_Query arguements here 
    	
  	);

    // Info we need for the AJAX Call. 
    $args = array(
    	'nonce' => wp_create_nonce( 'ajax-nonce' ),
    	'url'   => '/link.to.your/my-ajax-call.php',
    	'query' => $query,
  	);

    // Enquue the jQuery and locallize it
	  wp_enqueue_script( 'ajax-call', '/link.to.your/js/jquery.make-ajax-call.js', array( 'jquery' ), '0.1', true );
  	wp_localize_script( 'ajax-call', 'ajaxcall', $args );

}
