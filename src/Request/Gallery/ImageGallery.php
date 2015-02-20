<?php namespace Request\Gallery;

use Input, View, Config, Str;

class ImageGallery {

  protected $thumbnails = [
    'thumbnail' => [ 'max_width' => 198, 'max_height' => 132 ]
  ];

  protected $name, $imageableModel, $id;

  protected $maxSize = 10485760 ; // 10MB = 10 * 1024 *1024


  public function initUploader($collection, $album, $id){

    $this->initPhoto($collection, $album, $id);

    new UploadHandler([
      'user_dirs_path' => Str::slug($this->collection). "/" . Str::slug($this->album). "-" . $this->id . "/",
      'filename'       => $this->name,
      'script_url'     => "/request/gallery/gallery-manager/upload/$this->collection/$this->album/$this->id",
      'upload_dir'     => public_path().'/galleries/',
      'upload_url'     => '/galleries/',
      'max_file_size'  => $this->maxSize,
      'image_versions' => $this->thumbnails
    ]);
  }

  protected function initPhoto($collection, $album, $id){
    $this->collection = $collection;
    $this->album      = $album;
    $this->id         = $id;
  }

  public function addPhoto($collection, $album, $id){
    $picture   = Input::file('files')[0];
    $caption   = Input::get('caption');
    $extension = $picture->getClientOriginalExtension();
    $size      = $picture->getClientSize();
    $this->name =  str_random(20) . "." . $extension;

    $this->initUploader($collection, $album, $id);

    if($size < $this->maxSize) {
      (new $collection)->find($this->id)->photos()->create([
        'path'     => $this->name,
        'caption'  => $caption
      ]);
    }
  }

  public function remove($collection, $album, $id){
    $this->initUploader($collection, $album, $id);
    $image = Input::get('file');
    (new $collection)->find($this->id)
      ->photos()->where('path', $image)->delete();
  }

  public function updateCaption($id){
    \Photo::find($id)->update([ 'caption' => Input::get('caption') ]);
  }

  public function setThumbnails(array $thumbnails){
    $this->thumbnails = $thumbnails;
  }

  public function view($info){
    $gallery['gallery'] = reset($info);
    return View::make("gallery::gallery", $gallery);
  }
}
