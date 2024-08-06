<?php

get_header(); 
pageBanner(array(
  'title' => 'Academic Record',
  'photo' => get_theme_file_uri('/images/academic-banner.png')
));
?>

<div class="container container--narrow page-section">

<ul class="link-list min-list">

<?php
  while(have_posts()) {
    the_post(); ?>
    <li class="underline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
  <?php }
  echo paginate_links();
?>
</ul>



</div>

<?php get_footer();

?>