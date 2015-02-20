<?php namespace Request\Gallery\Controllers;

use Request\Gallery\ImageGallery;

class ImageGalleryController extends \BaseController {

  protected $imageGallery;

  public function __construct(ImageGallery $imageGallery) {
    $this->imageGallery = $imageGallery;
  }

  public function index($collection, $photoName, $id) {
    $this->imageGallery->initUploader($collection, $photoName, $id);
  }

  public function create($collection, $photoName, $id) {
    $this->imageGallery->addPhoto($collection, $photoName, $id);
  }

  public function delete($collection, $photoName, $id) {
    $this->imageGallery->remove($collection, $photoName, $id);
  }

  public function caption($id){
    $this->imageGallery->updateCaption($id);
  }

}
