<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title('|',true,'right'); bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

<?php
// get_template_part('partials/globie');
get_template_part('partials/seo');
?>

  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />

  <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/apple-touch-icon.png?v=ngkEOmRy4y">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon-32x32.png?v=ngkEOmRy4y">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon-16x16.png?v=ngkEOmRy4y">
  <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon.ico?v=ngkEOmRy4y">

<?php if (is_singular() && pings_open(get_queried_object())) { ?>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php } ?>

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!--[if lt IE 9]><p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

<div id="main-container">

  <header id="header" class="padding-top-basic margin-bottom-large font-heavy">
    <h1 class="u-visuallyhidden"><?php bloginfo('name'); ?></h1>

    <div class="container">
      <nav id="main-nav">
        <ul id="main-nav-list-row" class="grid-row font-uppercase font-bold">
          <li class="grid-item offset-m-6 hover-dot">
            <a href="<?php echo home_url('exhibitions'); ?>">Exhibitions</a>
            <div class="dot"></div>
          </li>
          <li class="grid-item hover-dot">
            <a href="<?php echo home_url('artists'); ?>">Artists</a>
            <div class="dot"></div>
          </li>
          <li class="grid-item hover-dot">
            <a href="<?php echo home_url('everything-else'); ?>">Everything else</a>
            <div class="dot"></div>
          </li>
        </ul>
      </nav>
      <div id="logo-holder-mobile" class="padding-top-mid">
        <?php get_template_part('partials/logo'); ?>
      </div>
    </div>
  </header>
