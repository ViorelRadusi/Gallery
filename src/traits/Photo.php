<?php namespace Request\Gallery\Traits;

use Config, Str, File;


trait Photo {
  public function photos(){
    return $this->morphMany('\Request\Gallery\Models\Rg_photo', 'imageable');
  }

  
  public function delete(){
   if($this->photos->count()){
  	 $path =  public_path() . Config::get("gallery::uploadPath") . Str::slug($this->photos->first()->imageable_type) . '/' . $this->name . '-' . $this->id ;
  	 File::deleteDirectory($path);
   }
   $this->photos()->delete();
   parent::delete();
  }

}
