<?php
  
  get_header();

  while(have_posts()) {
    the_post(); 
    pageBanner();
    ?>
    

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('news'); ?>"><i class="fa fa-home" aria-hidden="true"></i>Back to All News</a> <span class="metabox__main"><?php the_title(); ?></span></p>
        </div>

        <div class="generic-content"><?php the_content(); ?></div>

        <?php 

          $relatedRubrics = get_field('related_rubrics');
          
          if($relatedRubrics) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--tiny">Related Rubrics</h2>';
            echo '<ul class="link-list min-list">';
            foreach($relatedRubrics as $rubric) { ?>
              <li><a href="<?php echo get_the_permalink($rubric); ?>"><?php echo get_the_title($rubric); ?></a></li>
            <?php }
            echo '</ul>';
          }
          
        ?>

    </div>
    


<?php }

  get_footer();

?>