<?php

add_action('rest_api_init', 'drrajRegisterSearch');

function drrajRegisterSearch() {
    register_rest_route('drraj/v1', 'search', array(
        'methods' => 'GET',
        'callback' => 'drrajSearchResults'
    ));
}

function drrajSearchResults($data) {
    $mainQuery = new WP_Query(array(
        'post_type' => array('post', 'page', 'event', 'rubric', 'news'),
        's' => sanitize_text_field($data['term'])
    ));

    $results = array(
        'generalInfo' => array(),
        'events' => array(),
        'rubrics' => array(),
        'news' => array(),
    );

    while($mainQuery->have_posts()) {
        $mainQuery->the_post();

        if (get_post_type() == 'post' OR get_post_type() == 'page') {
            array_push($results['generalInfo'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'postType' => get_post_type(),
                'author' => get_the_author()
            ));
        }
        if (get_post_type() == 'event') {
            array_push($results['events'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ));
        }
        if (get_post_type() == 'news') {
            array_push($results['news'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ));
        }
        if (get_post_type() == 'rubric') {
            array_push($results['rubrics'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ));
        }
    }

    return $results;
}