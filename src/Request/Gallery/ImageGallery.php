<?php namespace Request\Gallery;

use Request\Gallery\Models\Rg_Photo,
    Input, View, Config, Str, Session;

class ImageGallery {

  protected $thumbnails = [
    'thumbnail' => [ 'max_width' => 198, 'max_height' => 132 ]
  ];

  protected $name, $imageableModel, $id;



  public function initUploader($collection, $album, $id){

    $this->initPhoto($collection, $album, $id);

    new UploadHandler([
      'user_dirs_path' => Str::slug($this->collection). "/" . Str::slug($this->album). "-" . $this->id . "/",
      'filename'       => $this->name,
      'script_url'     => "/request/gallery/gallery-manager/upload/$this->collection/$this->album/$this->id",
      'upload_dir'     => public_path(). Config::get('gallery::uploadPath'),
      'upload_url'     => Config::get('gallery::uploadPath'),
      'max_file_size'  => Config::get('gallery::maxFileSize'),
      'image_versions' => Config::get('gallery::variations')
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
    $this->name  = (Config::get('gallery::fileName') == 'random') ? str_random(20) : Str::slug($picture->getClientOriginalName());
    $this->name .= "." . $extension;

    $this->initUploader($collection, $album, $id);

    if($size < Config::get("gallery::maxFileSize")) {
      (new $collection)->find($this->id)->photos()->create([
        'path'    => $this->name,
        'caption' => $caption
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
    Rg_Photo::find($id)
      ->update(['caption' => Input::get('caption')]);
  }

  public function updateCover($id){
    $photo = Rg_Photo::find($id);
    $photo->imageable->photos()->update(['cover' => 0]);
    $photo->update(['cover' => 1]);
  }

  public function view($info){
    $gallery['gallery'] = reset($info);
    return View::make("gallery::gallery", $gallery);
  }

  public function loadBs(){
    Session::put('request.gallery.bs', true);
    return $this;
  }

}
