var TabbedContent = {
	init: function() {	
		$(".tab_item").mouseover(function() {
		  $(this).addClass("current").siblings().removeClass("current");
		 
			var background = $(this).parent().find(".moving_bg2");
			 
			$(background).stop().animate({
				left: $(this).position()['left']
				 
			});
			
			TabbedContent.slideContent($(this));
			
		});
	},
	
	slideContent: function(obj) {
		
		var margin = $(obj).parent().parent().find(".slide_content").width();
		margin = margin * ($(obj).prevAll().size() - 1);
		margin = margin * -1;
		
		$(obj).parent().parent().find(".tabslider").stop().animate({
			 
			marginLeft: margin + "px"
		}, {
			duration: 500
		});
	}
}

$(document).ready(function() {
TabbedContent.init();
});
