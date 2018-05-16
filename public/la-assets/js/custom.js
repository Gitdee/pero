$(document).ready(function(){
	function resizeChat(){
		var width = $(".chat-content.main-block-scroll").width();
		var height = $(".chat-content.main-block-scroll").height();
		$(".chat-content.main-block-scroll iframe").attr("width", width);
		$(".chat-content.main-block-scroll iframe").attr("height", (height - 5));
	}
	resizeChat();
	$(window).resize(function () {
    resizeChat();
  });
  
  $(".regions_wrapper #region-more [data-region_id]").click(function(e){
  	e.preventDefault();
  	var regionID = $(this).data("region_id");
  	var regionTitle = $(this).data("region_title");
  	console.log(regionID);
  	$(".regions_wrapper .regions_title").text(regionTitle);
  	$(".regions_wrapper #region-more [data-region_id]").removeClass("activecity");
  	$(this).addClass("activecity");
  	$(".regions_wrapper .region_news_container").removeClass("active");
  	$(".regions_wrapper #region_news_container_region_" + regionID).addClass("active");
  	
  	console.log(base_url);
  	$.ajax({
			url: base_url + '/ajax/set-region',
			type: 'GET',
			data: {action: 'set_region', region_id: regionID},
      dataType: "json",
			success: function (response) {
			}
		});
  });
  
});