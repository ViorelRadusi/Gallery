<?php namespace Request\Gallery\Models;

class Rg_photo extends \Eloquent {
  protected $fillable = ['path', 'caption','cover'];

  public function imageable(){
    return $this->morphTo();
  }

}

