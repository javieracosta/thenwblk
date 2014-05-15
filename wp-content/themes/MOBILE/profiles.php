<?php
/*
Template Name: Individual Profiles
*/


global $post;

wp_redirect( site_url() . '/product/' . $post->post_name );

exit;