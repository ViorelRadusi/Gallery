<?php namespace Request\Gallery;

use Illuminate\Support\ServiceProvider,
    Illuminate\Foundation\AliasLoader;

class GalleryServiceProvider extends ServiceProvider {

  /**
   * Indicates if loading of the provider is deferred.
   *
   * @var bool
   */
  protected $defer = false;

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('imageGallery', '\Request\Gallery\ImageGallery');
  }


  public function boot()
  {

    $this->package('request/gallery');

    include __DIR__ . '/../../routes.php';
    include __DIR__ . '/../../controllers/ImageGalleryController.php';

    AliasLoader::getInstance()
      ->alias("ImageGallery", "\Request\Gallery\Facades\ImageGallery");
  }

  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  public function provides()
  {
    return array();
  }

}
