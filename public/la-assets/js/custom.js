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
  	$(".regions_wrapper .regions_title").text(regionTitle);
  	$(".regions_wrapper #region-more [data-region_id]").removeClass("activecity");
  	$(this).addClass("activecity");
  	$(".regions_wrapper .region_news_container").removeClass("active");
  	$(".regions_wrapper #region_news_container_region_" + regionID).addClass("active");
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

$(function(){
	var buttons = $('.resize-text-buttons .resize-button');
	var zoom = 0;
	var scales = [1, 1.5];
	var items = 'p,a,.wrap.news-line,.regions_title';
	var skips = ["header", "footer"];
	var params = ['font-size', 'line-height'];
	var cookie = readCookie('font-zoom');
	if(buttons.length){
		buttons.filter('.increase').click(function(){
			setZoom(zoom + 1);
		});
		
		buttons.filter('.decrease').click(function(){
			setZoom(zoom - 1);
		});
		
		$(window).resize(function(){
			var i = zoom;
			removeZoom();
			setZoom(i);
		});
		
		if(cookie){
			setZoom(parseInt(cookie));
		}
	}
		
	function setZoom(i){
		if(i in scales){
			var scale = scales[i];
			zoom = i;
			createCookie('font-zoom', zoom, 1);
			$(items).each(function(){
				var item = $(this);
				if(item.closest(".top-header").length){
					return true;
				}
				if(item.closest("footer").length){
					return true;
				}
				if(item.closest(".nav-and-baners .additional").length){
					return true;
				}
				
				var data = item.data('font-zoom');
				if(!data){
					data = {};
					$.each(params, function(i, param){
						data[param] = {
							value: item.css(param),
							inline: item.prop("style")[param] != ''
						}
					});
					item.data('font-zoom', data);
				}
				if(data){
					$.each(params, function(i, param){
						var value = (scale == 1 ? '' : parseFloat(parseFloat(data[param].value) * scale));
						item.css(param, (value ? value + 'px' : ''));
					});
				}
			});
		}
	}
	
	function removeZoom(){
		$(items).each(function(){
			var item = $(this);
			var data = item.data('font-zoom');
			if(data){
				$.each(params, function(i, param){
					if(data[param].inline){
						item.css(param, data[param].value)
					}else{
						item.css(param, '');
					}
				});
				item.data('font-zoom', null);
			}
		});
		zoom = 0
	}

});

function createCookie(name, value, days){
	var expires = "";
	if(days){
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		expires = "; expires=" + date.toGMTString();
	}
	document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name){
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i < ca.length; i++){
		var c = ca[i];
		while(c.charAt(0) == ' ') c = c.substring(1, c.length);
		if(c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
	}
	return null;
}

function eraseCookie(name){
	createCookie(name, "", -1);
}