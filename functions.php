<?php

// Setup
define('ESCHOOL_DEV_MODE', true);


// Theme Styles and Scripts
function eschool_scripts()
{

  $uri                =   get_theme_file_uri();
  $ver                =   ESCHOOL_DEV_MODE ? time() : false;

  // Template Google fonts
  wp_enqueue_style('eschool-google-fonts', '//fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Roboto&display=swap');

  // Template Styles
  wp_enqueue_style('eschool-template-general-style', $uri . '/assets/css/general.css', array(), $ver, 'all');
  wp_enqueue_style('eschool-template-main-style', $uri . '/assets/css/style.css', array(), $ver, 'all');
  wp_enqueue_style('eschool-template-query-style', $uri . '/assets/css/queries.css', array(), $ver, 'all');

  ///// Template  Scripts
  // smooth scroll script
  wp_enqueue_script('smooth-scroll-template-script', '//unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js', array('jquery'), false, true);

  wp_enqueue_script('eschool-template-main-script', $uri . '/assets/js/script.js', array('jquery'), $ver, true);

  ///// Main Scripts
  // Theme's main stylesheet
  wp_enqueue_style('eschool-theme-main-style', get_stylesheet_uri(), array(), $ver, 'all');

  // Theme's main Scripts
  wp_enqueue_script('eschool-theme-main-script', $uri . '/assets/js/eschool.js', array('jquery'), $ver, true);
}
add_action('wp_enqueue_scripts', 'eschool_scripts');


// Theme Support (adds support for various features)
function eschool_features()
{
  add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'eschool_features');


add_action('wp_ajax_nopriv_get_breweries_from_api', 'get_breweries_from_api');
add_action('wp_ajax_get_breweries_from_api', 'get_breweries_from_api');

// Get breweries form API
function get_breweries_from_api()
{

  $file = get_stylesheet_directory() . '/report.txt';

  $current_page = (!empty($_POST['current_page'])) ? $_POST['current_page'] : 1;
  $breweries = [];

  // Should return an array of objects
  $results = wp_remote_retrieve_body(wp_remote_get('https://api.openbrewerydb.org/breweries?page=' . $current_page . '&per_page=50'));

  file_put_contents($file, "Current Page: " . $current_page . "\n\n", FILE_APPEND);

  // turn it into a PHP array from JSON string
  $results = json_decode($results);

  // Either the API is down or something else spooky happened. Just be done.
  if (!is_array($results) || empty($results)) {
    return false;
  }

  $breweries[] = $results;

  foreach ($breweries[0] as $brewery) {

    $brewery_slug = sanitize_title($brewery->name . '-' . $brewery->id);

    $inserted_brewery = wp_insert_post([
      'post_name' => $brewery_slug,
      'post_title' => $brewery_slug,
      'post_type' => 'brewery',
      'post_status' => 'publish'
    ]);

    if (is_wp_error($inserted_brewery)) {
      continue;
    }

    // add meta fields
    $fillable = [
      'field_631d76d550903' => 'name',
      'field_631d76f750904' => 'brewery_type',
      'field_631d771c50905' => 'street',
      'field_631d772950906' => 'city',
      'field_631d773250907' => 'state',
      'field_631d774950908' => 'postal_code',
      'field_631d775850909' => 'country',
      'field_631d77695090a' => 'longitude',
      'field_631d777c5090b' => 'latitude',
      'field_631d77895090c' => 'phone',
      'field_631d77925090d' => 'website',
      'field_631d77aa5090e' => 'updated_at',
    ];

    foreach ($fillable as $key => $name) {
      update_field($key, $brewery->$name, $inserted_brewery);
    }
  }

  $current_page = $current_page + 1;
  wp_remote_post(admin_url('admin-ajax.php?action=get_breweries_from_api'), [
    'blocking' => false,
    'sslverify' => false, // we are sending this to ourselves, so trust it.
    'body' => [
      'current_page' => $current_page
    ]
  ]);
}

// function slugify($text)
// {

//   // remove unwanted characters
//   $text = preg_replace('~[^-\w]+~', '', $text);

//   // trim
//   $text = trim($text, '-');

//   // remove duplicate -
//   $text = preg_replace('~-+~', '-', $text);

//   // lowercase
//   $text = strtolower($text);

//   if (empty($text)) {
//     return 'n-a';
//   }

//   return $text;
// }
