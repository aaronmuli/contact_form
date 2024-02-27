<?php

add_shortcode("contact","show_contact_form");
add_action('rest_api_init', 'create_rest_endpoint');
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

        foreach ($params as $key => $value) {
            echo $key . " : " . $value . "\n";
        }

    }
}

function contact_custom_post() {
    register_post_type('wporg_submissions',
		array(
			'labels'      => array(
				'name'          => __('Submissions', 'textdomain'),
				'singular_name' => __('Submission', 'textdomain'),
			),
				'public'      => true,
				'has_archive' => true,
		)
	);
}