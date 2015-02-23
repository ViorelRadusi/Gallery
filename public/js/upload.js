(function(){
  $(function(){
    "use strict";
    return $("#fileupload").fileupload
    ({
      url:"/upload/pages/",
      disableImageResize:/Android(?!.*Chrome)|Opera/.test(window.navigator&&navigator.userAgent),
      imageMaxWidth:1300,
      imageMaxHeight:1200
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
