<?php
/*
Plugin Name: Event Espresso - Unique Email Enforcer
Description: Requires unique email addresses when entering multiple attendees
Version: 1.0
Author: Brian Uhl
*/
// Acquired from: https://gist.github.com/joshfeck/7eddc3977ed0ff480fc60a2b00d796aa

function ee_add_unique_email_validation(){
    wp_add_inline_script(
        'single_page_checkout',
        'jQuery( document ).ready(function($) {
      $(".ee-reg-qstn-email").addClass("unique");
        $.validator.addMethod("unique", function(value, element) {
        var parentForm = $(element).closest("form");
        var timeRepeated = 0;
        if (value != "") {
          $(parentForm.find(":text")).each(function () {
          if ($(this).val() === value) { timeRepeated++; }
      });
    }
    return timeRepeated === 1 || timeRepeated === 0;
    }, "* Duplicate! Please use a unique email address");
    } );'
    );
}
add_action( 'wp_enqueue_scripts', 'ee_add_unique_email_validation', 60 );
