<?php namespace Request\Gallery\Traits;

trait Photo {
  public function photos() {
    return $this->morphMany('\Request\Gallery\Models\Rg_photo', 'imageable');
  }

}
