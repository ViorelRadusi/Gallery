<?php

  Route::get('/request/gallery/gallery-manager/upload/{collection}/{album}/{id}'       , [ 'as' => 'request.gallery.index'  , 'uses' => 'Request\Gallery\Controllers\ImageGalleryController@index']);
  Route::post('/request/gallery/gallery-manager/upload/{collection}/{album}/{id}'      , [ 'as' => 'request.gallery.store'  , 'uses' => 'Request\Gallery\Controllers\ImageGalleryController@create']);
  Route::delete('/request/gallery/gallery-manager/upload/{collection}/{resource}/{id}' , [ 'as' => 'request.gallery.delete' , 'uses' => 'Request\Gallery\Controllers\ImageGalleryController@delete']);
  Route::post('/request/gallery/gallery-manager/{id}/caption'                          , [ 'as' => 'request.gallery.caption', 'uses' => 'Request\Gallery\Controllers\ImageGalleryController@caption']);
