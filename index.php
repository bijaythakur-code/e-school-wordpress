<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package E School
 */

get_header();
?>

<main>
  <!-- hero section -->
  <section class="hero-section">
    <div class="hero container">
      <div class="hero-left">
        <p class="are-you-ready">Are you ready to Learn?</p>
        <h1>Learn With fun on <span class="h1-span">any schedule</span></h1>
        <p class="website-desc">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Varius
          blandit facilisis quam netus.
        </p>
        <a href="#">
          <button class="btn-get-started">Get Started</button>
        </a>
      </div>
      <div class="hero-right">
        <img src="<?php echo get_theme_file_uri(); ?>/assets/images/image-hero.png" alt="E-school hero" />
      </div>
    </div>
  </section>

  <!-- progress section -->
  <section class="progress">
    <div class="container progress-container">
      <div class="progress-section">
        <img src="<?php echo get_theme_file_uri(); ?>/assets/images/img-icon-1-topic.png" alt="Topic E-school">
        <h3>1500+ Topic</h3>
        <p>Learn Anythings</p>
      </div>

      <div class="progress-section">
        <img src="<?php echo get_theme_file_uri(); ?>/assets/images/img-icon-2-students.png" alt="Students E-school">
        <h3>1800+ Students</h3>
        <p>Learn Anythings</p>
      </div>

      <div class="progress-section">
        <img src="<?php echo get_theme_file_uri(); ?>/assets/images/img-icon-3-token.png" alt="Test E-school">
        <h3>9K+ Test Token</h3>
        <p>Learn Anythings</p>
      </div>

      <div class="progress-section">
        <img src="<?php echo get_theme_file_uri(); ?>/assets/images/img-icon-4-student.png" alt="Student E-school">
        <h3>2000+ Student</h3>
        <p>Learn Anythings</p>
      </div>

    </div>
  </section>

  <!-- Online Courses Section -->

  <section id="courses">
    <div class="container online-courses">
      <h2>Online Courses</h2>
      <div class="courses-section">

        <?php
        $homepageCourses = new WP_Query(array(
          'posts_per_page' => 3,
          'post_type' => 'online-course',
          'orderby' => 'title',
          'order' => 'ASC'
        ));

        while ($homepageCourses->have_posts()) {
          $homepageCourses->the_post();
          get_template_part('template-parts/content', 'course');
        }
        ?>


      </div>
  </section>

  <!-- Testimonial section -->
  <section>
    <div class="container testimonial-container">
      <h2>Testimonial</h2>
      <div class="testimonial-section">
        <figure class="testimonial">
          <img class="testimonial-img" alt="Photo of customer Dave Bryson" src="<?php echo get_theme_file_uri(); ?>/assets/images/image-testimonial.png" />
          <blockquote class="testimonial-text">
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
          </blockquote>
        </figure>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>