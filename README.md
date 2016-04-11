# Wordpress-AJAX-with-Shortcodes
Using shortcodes with AJAX calls in Wordpress can be challenging because the Worpdress core is not "loaded" when the AJAX call is made, so the normal wordpress fuctions aren't readily available. This repository shows how to load the Wordpress core so all of the usual WP fiunctions are avaialble. This allows us to use WP_Query and a whole host of useful and secure WP functions.

One of the keys here is not use the normal "/wp-admin/admin-ajax.php" AJAX function call. Its a bit of a hack anyway as it is really written for use in the WP backend and if you want to do anything useful, this functuon is very limited. To have more flexibility, we create our own PHP file to call and simply load the WP core first.

This repository uses jQuery to make the AJAX call.

## Functions.php
Add this function to your functions.php in your child theme. This simply sets up parameters to use WP_Query ($query) and a nonce (number used once) to make sure that the PHP called by the AJAX call (my-ajax-call.php) is not being called directly. The jQuery script to make the AJAX call is registered and localised so that we can pass data from the server to the jQuery script.

## jquery.make-ajax-call.js
Makes the AJAX Call. The $nonce and the $query parameters are passed to my-ajax-call.php. If the call is made successfully, we do what we need to with the data that is passed back and output it.

## my-ajax-call.php
Lines 4-10 load the WP core and set up the necessary headers. Here I have made sure that we do not cache this AJAX call so we can call it again and again on the same page with different parameters. After, we simply check the nonce, grab the WP_Query parameters that were passed through the AJAX call and do what you need to do server-side. As the WP core is loaded, we can run shorcodes, Loop through WP_Query etc.

This is a mash up of code from a few different sources as there isn't really a good straight answer anywhere on how to do this efficiently without some kind of hack. So, shout outs go to: <a href="http://dion-designs.com/" rel="nofollow">Dion Designs</a> and various others that I can't seem to find the link for :)

PLEASE NOTE: This does not the the WP Action Hooks 'wp_ajax_<function>' (WP backend AJAX call) and 'wp_ajax_nopriv_<function>' (front end AJAX call) as these are only necessary with '/wp-admin/admin-ajax.php' to hook in code from functions.php. We are calling a separate PHP file altogether, not putting a function in functions.php.
