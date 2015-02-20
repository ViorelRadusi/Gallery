<?php namespace Request\Gallery\Controllers;

use Request\Gallery\ImageGallery;

class ImageGalleryController extends \BaseController {

  protected $imageGallery;

  public function __construct(ImageGallery $imageGallery) {
    $this->imageGallery = $imageGallery;
  }

  public function index($photo, $id) {
    $this->imageGallery->initUploader($photo, $id);
  }

  public function create($photo, $id) {
    $this->imageGallery->addPhoto($photo, $id);
  }

  public function delete($photo, $id) {
    $this->imageGallery->remove($photo, $id);
  }

  public function caption($id){
    $this->imageGallery->updateCaption($id);
  }

}

