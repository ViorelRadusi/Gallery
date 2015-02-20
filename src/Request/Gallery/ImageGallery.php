<?php namespace Request\Gallery;

use Requet\Gallery\UploadHandler, Input;

use Config;

class ImageGallery {

  protected $thumbnails = [
    'thumbnail' => [ 'max_width' => 198, 'max_height' => 132 ]
  ];

  protected $name, $imageableModel, $id;

  protected $maxSize = 10485760 ; // 10MB = 10 * 1024 *1024


  public function initUploader($imageableModel, $id){
    $this->initPhoto($imageableModel, $id);
    new UploadHandler([
      'user_dirs_path' => "$this->imageableModel/$this->id/",
      'filename'       => $this->name,
      'script_url'     => "/admin/gallery-manager/upload/$this->imageableModel/$this->id",
      'upload_dir'     => public_path().'/galleries/',
      'upload_url'     => '/galleries/',
      'max_file_size'  => $this->maxSize,
      'image_versions' => $this->thumbnails
    ]);
  }

  protected function initPhoto($imageableModel, $id){
    $this->imageableModel = $imageableModel;
    $this->id      = $id;
  }

  public function addPhoto($imageableModel, $id){
    $picture   = Input::file('files')[0];
    $caption   = Input::get('caption');
    $extension = $picture->getClientOriginalExtension();
    $size      = $picture->getClientSize();
    $this->name .= "." . $extension;

    $this->initUploader($imageableModel, $id);

    if($size < $this->maxSize) {
      (new $imageableModel)->find($this->id)->photos()->create([
        'path'     => $this->name,
        'caption'  => $caption
      ]);
    }

  }

  public function remove($imageableModel, $id){
    $this->initUploader($imageableModel, $id);
    $image = Input::get('file');
    (new $imageableModel)->find($this->id)
      ->photos()->where('path', $image)->delete();
  }

  public function updateCaption($id){
    Photo::find($id)->update([ 'caption' => Input::get('caption') ]);
  }

  public function setThumbnails(array $thumbnails){
    $this->thumbnails = $thumbnails;
  }

}
