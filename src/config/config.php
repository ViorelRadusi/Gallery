<?php

return [

  /**
   *  integer
   *  this is the max width of the uploaded image
   */
  'maxWidth'    => 1300,

  /**
   *  integer
   *  this is the max height of the uploaded image
   */
  'maxHeight'   => 1000,

  /**
   *  integer
   *  this is the max size of the uploaded image
   *  defaut :  10MB
   */
  'maxFileSize' => 10485760 , // 10MB = 10 * 1024 * 1024


  /**
   *  string
   *  this is the path from the public folder where the images are uploaded
   */
  'uploadPath'  => '/galleries/',

  /**
   *  string
   *  this is the name of the file to uploaded
   *  value  : random(will be renamed to a random string of 20 chargs) | filename (will be renamed to the slug version of the original name)
   *  defaut :  random
   */
  'fileName'    => 'random', //  random | filename


  /**
   *  bool
   *  this is uses to add in the loaded page bootstrap.css and bootstrap.js if they dont exist
   */
  'needBootstrap' => false,

  /**
   *  array of arrays
   *  this is used to create different variations of the uploaded file  eg: thumbnails
   *  keep the `thumbnail` variation, it is used internally by the package
   *  if you need others add more :)
   */
  'variations'  => [
    'thumbnail'   => [ 'max_width' => 198, 'max_height' => 132 ]
  ]

];
