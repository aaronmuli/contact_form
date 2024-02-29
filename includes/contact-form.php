<?php

// adds a shortcode
add_shortcode("contact","show_contact_form");
// creates a rest endpoint
add_action('rest_api_init', 'create_rest_endpoint');
// creates a custom post type
add_action('init', 'contact_custom_post');

function show_contact_form() {
    include 'templates/form.php';
}

function create_rest_endpoint() {
    register_rest_route('/contact_form/v1', '/submit', array(
        'methods' => 'POST',
        'callback' => 'handle_enq'
    ));

    function handle_enq($data) {

        $params = $data -> get_params();

        if(!wp_verify_nonce($params['_wpnonce'], 'wp_rest')) {
            return new WP_Rest_Response('Message not sent', 422);
        }

        // return new WP_Rest_Response('Message sent', 200);

        unset($params['_wp_http_referer']);
        unset($params['_wpnonce']);

        // send email to the admin
        /* get admin email as sender to prevent email going to spam, because 
           because if use email from params it will act like the browser is 
           pretending to be that user trying to send the email which will
           take it to spam folder.
        */
        $admin_email = get_bloginfo('admin_email'); 
        $admin_name = get_bloginfo('name');

        $headers = [];

        $headers[] = "From: {$admin_name} <{$admin_email}>";
        $headers[] = "Reply-to: {$params['name']} <{$params['email']}>";
        
        $subject = "New enquiry from {$params['name']}"; 
        
        $message = "";
        $message .= "Message has been sent from {$params['name']}<br/>";

         foreach ($params as $key => $value) {
            $message .= ucfirst($key) . " : " . $value;
        }
        
        wp_mail($admin_email, $subject, $message, $headers);

        return new WP_Rest_Response('Message has been sent', 200);
    }
}

function contact_custom_post() {
    register_post_type('submissions',
		array(
			'labels'      => array(
				'name'          => __('Submissions', 'textdomain'),
				'singular_name' => __('Submission', 'textdomain'),
			),
				'public'      => true,
				'has_archive' => true,
                'menu_icon' => 'dashicons-email-alt',
		)
	);
}