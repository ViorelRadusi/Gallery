(function(){
  $(function(){
    "use strict";
    var maxW = $("#fileupload").data("maxw");
    var maxH = $("#fileupload").data("maxh");

    return $("#fileupload").fileupload({
      disableImageResize: false,
      autoUpload    : false,
      imageMaxWidth : maxW,
      imageMaxHeight: maxH
    }).bind('fileuploadsubmit', function(e, data) {
          //
      var caption = data.context.find(':input');
      data.formData = {
        'caption' : caption.val()
      }
    }),

    $("#fileupload").addClass("fileupload-processing"),
    $.ajax({
      url      : $("#fileupload").fileupload("option","url"),
      dataType : "json",
      context  : $("#fileupload")[0]
    }).always(function(){
      return $(this).removeClass("fileupload-processing")
    }).done(function(e){
      return $(this).fileupload("option","done").call(this,$.Event("done"),{result:e})
    });
  })
}).call(this);
