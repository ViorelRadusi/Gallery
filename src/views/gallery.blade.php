{{-- HTML::style('/packages/request/gallery/css/bootstrap.min.css')     --}}
{{ HTML::style('/packages/request/gallery/css/jquery.fileupload.css') }}
{{ HTML::style('/packages/request/gallery/css/gallery.min.css')       }}

<div class="modal-dialog big">
  <div class="modal-content">

    <!-- MODAL HEADER -->
    <div class="modal-header slight-modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove-circle"></span></button>
      <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span> Gallery Manager</h4>
    </div>

    <div class="modal-body">
      <div role="tabpanel" class="gallery-tabs">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#captions" aria-controls="captions" role="tab" data-toggle="tab">Captions & Covers</a></li>
            <li role="presentation"><a href="#manager" aria-controls="manager" role="tab" data-toggle="tab">Galelry Manager</a></li>
          </ul>

          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="captions">

              <div class="panel panel-default small-panel">
                  <div class="panel-body">
                      {{ Form::text('caption', null, ['class' => 'form-control pull-right', 'placeholder' => 'Caption', 'id' => 'caption']) }}
                  </div>
                  <hr>

                  @if($gallery->photos->count())
                    <div class="gallery">
                      @foreach(array_chunk($gallery->photos->all(), 4) as $row)
                        <div class='row'>
                          @foreach($row as $photo)
                            <div class='col-md-3 pic'>
                              {{ HTML::image(Config::get("gallery::uploadPath") . \Str::slug($photo->imageable_type) . "/" . \Str::slug($photo->imageable->name) . "-" . "$photo->imageable_id/thumbnail/$photo->path", $photo->path) }}
                              <div class='edit-caption' data-id="{{ $photo->id }}" data-caption="{{ $photo->caption }}">
                                <span class="glyphicon glyphicon-pencil {{ $photo->caption ? 'is'  : '' }}"> </span>
                              </div>
                              <div class='overlay'> <p>Set cover</p> </div>
                              <div class='selected'>
                                  {{ Form::label("cover-$gallery->name-$photo->id", "&nbsp;") }}
                                  {{ Form::radio("cover", $photo->id, $photo->cover, ['class' => 'set-cover', 'data-id' => "$photo->id", 'id' =>"cover-$gallery->name-$photo->id" ]) }}
                                  <p><span>Selected Cover</span></p>
                              </div>
                            </div>
                          @endforeach
                        </div>
                      @endforeach
                    </div>
                  @else
                    <div class="text-center alert alert-warning">No pictures!</div>
                  @endif
                </div>

             </div>
            <div role="tabpanel" class="tab-pane" id="manager">
              <hr/>

              <form id="fileupload" action="" method="POST" enctype="multipart/form-data"  data-url="/request/gallery/gallery-manager/upload/{{ get_class($gallery) }}/{{ $gallery->name }}/{{ $gallery->id }}">
                      <input type="hidden" name="_id" value="{{ $gallery->id }}">
                      <div class="row fileupload-buttonbar">
                        <div class="col-lg-7">
                          <!-- The fileinput-button span is used to style the file input field as button -->
                          <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Add Files...</span>
                            <input type="file" name="files[]" multiple>
                          </span>
                          <button type="submit" class="btn btn-primary start">
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>Start upload</span>
                          </button>
                          <button type="reset" class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancel upload</span>
                          </button>
                          <button type="button" class="btn btn-danger delete">
                            <i class="glyphicon glyphicon-trash"></i>
                            <span>Delete</span>
                          </button>
                          <input type="checkbox" class="toggle">
                          <!-- The global file processing state -->
                          <span class="fileupload-process"></span>
                        </div>
                        <!-- The global progress state -->
                        <div class="col-lg-5 fileupload-progress fade">
                          <!-- The global progress bar -->
                          <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                          </div>
                          <!-- The extended global progress state -->
                          <div class="progress-extended">&nbsp;</div>
                        </div>
                      </div>
                      <!-- The table listing the files available for upload/download -->
                      <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                    </form>

                    @include('gallery::tpl-upload')
                    @include('gallery::tpl-download')

                    {{ HTML::script('/packages/request/gallery/js/jquery.min.js')                }}
                    {{ HTML::script('/packages/request/gallery/js/bootstrap.min.js')             }}
                    {{ HTML::script('/packages/request/gallery/js/jquery.ui.widget.js')          }}
                    {{ HTML::script('/packages/request/gallery/js/tmpl.min.js')                  }}
                    {{ HTML::script('/packages/request/gallery/js/load-image.min.js')            }}
                    {{ HTML::script('/packages/request/gallery/js/canvas-to-blob.min.js')        }}
                    {{ HTML::script('/packages/request/gallery/js/jquery.fileupload.js')         }}
                    {{ HTML::script('/packages/request/gallery/js/jquery.fileupload-process.js') }}
                    {{ HTML::script('/packages/request/gallery/js/jquery.fileupload-image.js')   }}
                    {{ HTML::script('/packages/request/gallery/js/jquery.fileupload-ui.js')      }}
                    {{ HTML::script('/packages/request/gallery/js/upload.js')                    }}

                    {{ HTML::script("/packages/request/gallery/js/gallery-manager.js")           }}
                </div>
          </div>
      </div> <!-- gallery-tabs -->
    </div> <!-- modal-body -->
  </div> <!-- modal content -->
</div> <!-- modal-dialog -->

