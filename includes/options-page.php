<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('after_setup_theme', 'load_carbon_fields');
add_action('carbon_fields_register_fields', 'create_options_page');

function load_carbon_fields() {
    // define("PLUGIN_PATH", plugin_dir_path(__FILE__));
    require_once(PLUGIN_PATH.'/vendor/autoload.php');

    \Carbon_Fields\Carbon_Fields::boot();
}

function create_options_page() {
    Container::make( 'theme_options', __( 'Contact Form' ) )
    ->set_icon('dashicons-media-text')
    ->add_fields( array(
        Field::make( 'checkbox', 'contact_form_active', __( 'is active' ) ),

        Field::make( 'text', 'contact_form_plugin_email', __( 'Receipient Email' ) )
        ->set_attribute('placeholder', 'e.g mail@example.com')
        ->set_help_text("The email where the message will be sent"),

        Field::make( 'textarea', 'contact_form_plugin_msg', __( 'Your Message' ) )
        ->set_attribute('placeholder', 'Your message to the receipient email')
        ->set_help_text("The message that will be sent to the receipient email"),
    ) );
}