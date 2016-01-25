$(document).ready(function(){

});
function switch_tab(obj){
	$(".nav > li").attr("class", "tab");
	$(obj).attr("class", "active");
}
//common Function
function load(page,div){
	var image_load="<div class='ajax_loading'><img src='"+loading_image_large+"' /></div>";
	$.ajax({
		url: site+""+page,
		beforeSend: function(){
			$(div).html(image_load);
		},
		success: function(response){
			$(div).html(response);
		},
		dataType:"html"
	});
	return false;
}
function send_form(formObj,action,responDIV){
	$.ajax({
		url:site+"/"+action,
		data:$(formObj.elements).serialize(),
		success:function(response){
			$(responDIV).html(response);
		},
		type: "post",
		dataType:"html"
	});
	return false;
}
