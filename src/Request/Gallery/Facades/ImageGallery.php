<?php namespace Request\Gallery\Facades;

use Illuminate\Support\Facades\Facade;

class ImageGallery extends Facade{

  protected static function getFacadeAccessor(){
    return 'imageGallery';
  }
}
