<?php
  Route::get('/gallery-manager/upload/{resource}/{id}'    , [ 'as' => 'request.gallery.index'  , 'uses' => 'Request\Gallery\PhotosController@index']);
  Route::post('/gallery-manager/upload/{resource}/{id}'   , [ 'as' => 'request.gallery.store'  , 'uses' => 'Request\Gallery\PhotosController@create']);
  Route::delete('/gallery-manager/upload/{resource}/{id}' , [ 'as' => 'request.gallery.update' , 'uses' => 'Request\Gallery\PhotosController@delete']);
  Route::post('/gallery-manager/{id}/caption'             , [ 'as' => 'request.gallery.caption', 'uses' => 'Request\Gallery\PhotosController@caption']);
