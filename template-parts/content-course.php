<div class="course-item">
  <?php echo get_the_post_thumbnail(); ?>
  <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
  <p class="course-sub-desc"><?php if (has_excerpt()) {
                                echo get_the_excerpt();
                              } else {
                                echo wp_trim_words(get_the_content(), 18);
                              } ?></p>
  <a href="<?php the_permalink(); ?>">
    <button class="btn-buy-course">Buy Course</button>
  </a>
  <div class="course-details">
    <p class="course-start">Start <?php echo get_field('start_date'); ?></p>
    <p class="course-seats"><?php echo get_field('seats'); ?> seats</p>
  </div>
</div>