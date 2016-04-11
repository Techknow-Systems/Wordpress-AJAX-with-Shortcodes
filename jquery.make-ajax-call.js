jQuery(function($){

  // The page variable here allows us to page data that comes back fromthe AJAX call
  var page = 2;
  var loading = false;

  $('body').on('click', '.ajax-button', function() {  // Activate AJAX call on button click

    If (!loading ) {
		
      loading = true;

      // Set up the data to call my-ajax-call.php with
      var data = {
	nonce: ajaxcall.nonce,
	page: page,
	query: ajaxcall.query,
      };
      $.post(ajaxcall.url, data, function(result) {
		
        if( result.success) {

          // Output the info returned in "result.data" from my-ajax-call.php here
          // Example:
          // $('.ajax-results').append( result.data );

	  page = page + 1;
	  loading = false;

        } else {

      	  // If the AJAX call failed, output the reason to the console
	  console.log(result);

        }

      }).fail(function(xhr, textStatus, e) {

        // If the AJAX call failed, output the reason to the console
        console.log(xhr.responseText);

      });

    }
  
  });
		
}); 
