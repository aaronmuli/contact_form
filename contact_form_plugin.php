<?php

/*
 * Plugin Name:       Contact Form
 * Plugin URI:        https://github.com/AaronMuli/contact_form.git
 * Description:       A plugin that adds a contact form to a page
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Aaron Muliyunda
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */
 
 if(!defined("ABSPATH")) {
    die("You can not be here!");
 }


 if(!class_exists("ContactFormPlugin")) {

    define("PLUGIN_PATH", plugin_dir_path(__FILE__));

    class ContactFormPlugin {
         public function _construct() {
            require_once(PLUGIN_PATH.'/vendor/autoload.php');
         }
         
         public function initialize() {
            include_once(PLUGIN_PATH.'/includes/utilities.php');
            include_once(PLUGIN_PATH.'/includes/options-page.php');
            include_once(PLUGIN_PATH.'/includes/contact-form.php');
         }
    }

    $contactPlugin = new ContactFormPlugin();
    $contactPlugin -> initialize();

 }