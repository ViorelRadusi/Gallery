(function(){$(function(){var t,n;return t=null,n=null,$(".edit-caption").on("click",function(){var n;return n=$(this).data("caption"),t=$(this).data("id"),$(".edit-caption span").removeClass("active"),$(this).find("span").addClass("active"),$("#caption").addClass("active").focus().val(n)}),$("#caption").on("keyup",function(){return clearTimeout(n),n=setTimeout(function(n){return function(){return $.post("/request/gallery/gallery-manager/"+t+"/caption",{caption:$(n).val()})}}(this),1e3)}),$(".set-cover").on("change",function(){return $.post("/admin/gallery-manager/"+t+"/cover",{id:$(this).data("id")})})})}).call(this);