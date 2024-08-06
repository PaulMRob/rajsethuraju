<?php

function raj_post_types() {
    // Event Post Type
    register_post_type('event', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array('slug' => 'events'),
        'has_archive' => true,
        'public'      => true,
        'labels'      => array(
            'name'          => 'Events',
            'add_new_item'  => 'Add New Event',
            'edit_item'     => 'Edit Event',
            'all_items'     => 'All Events',
            'singular_name' => 'Event'
        ),
        'menu_icon' => 'dashicons-calendar-alt'
    ));

    // Rubric Post Type
    register_post_type('rubric', array(
        'show_in_rest' => true,
        'supports'     => array('title', 'editor', 'excerpt', 'thumbnail'),
        'rewrite'      => array('slug' => 'rubric'),
        'has_archive'  => true,
        'public'       => true,
        'labels'       => array(
            'name'          => 'Rubrics',
            'add_new_item'  => 'Add New Rubric',
            'edit_item'     => 'Edit Rubric',
            'all_items'     => 'All Rubrics',
            'singular_name' => 'Rubric',
        ),
        'menu_icon'   => 'dashicons-pressthis'
    ));

    // News Post Type
    register_post_type('news', array(
        'show_in_rest' => true,
        'supports'     => array('title', 'editor', 'thumbnail', 'excertp'),
        'rewrite'      => array('slug' => 'news'),
        'has_archive'  => true,
        'public'       => true,
        'labels'       => array(
            'name'          => 'News',
            'add_new_item'  => 'Add New News',
            'edit_item'     => 'Edit News',
            'all_items'     => 'All News',
            'singular_name' => 'News',
        ),
        'menu_icon'   => 'dashicons-format-aside'
    ));
}

add_action('init', 'raj_post_types');

