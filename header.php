<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package E School
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="profile" href="https://gmpg.org/xfn/11" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <header>
    <div class="nav-container">
      <div class="logo">
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <img src="<?php echo get_theme_file_uri(); ?>/assets/images/logo.png" alt="E-school logo" />
        </a>
      </div>
      <nav class="main-nav">
        <ul class="main-nav-list">
          <li>
            <a href="<?php echo site_url('/books') ?>">
              <img src="<?php echo get_theme_file_uri(); ?>/assets/images/img-icon-books-nav.png" alt="E-school Books" />
            </a>
          </li>
          <li>
            <a class="nav-link" href="#courses">Courses</a>
          </li>
          <li>
            <a class="nav-link" href="<?php echo site_url('/others') ?>">Others</a>
          </li>
          <li>
            <a class="nav-link" href="<?php echo site_url('/blog') ?>">Blog</a>
          </li>
          <li>
            <a class="sign-in nav-link" href="#">Sign In</a>
          </li>
        </ul>
      </nav>

      <button class="btn-mobile-nav">
        <ion-icon class="icon-mobile-nav" name="menu-outline"></ion-icon>
        <ion-icon class="icon-mobile-nav" name="close-outline"></ion-icon>
      </button>
    </div>
  </header>