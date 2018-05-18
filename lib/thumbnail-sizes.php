<?php

if( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
}

if( function_exists( 'add_image_size' ) ) {
  add_image_size( 'admin-thumb', 150, 150, false );
  add_image_size( 'opengraph', 1200, 630, true );

  add_image_size( '1920', 1920, 9999, false );
  add_image_size( '1440', 1440, 9999, false );
  add_image_size( '960', 960, 9999, false );
  add_image_size( '640', 640, 9999, false );
  add_image_size( '320', 320, 9999, false );
}
