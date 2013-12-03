(function($){
	$.ajax_status={redirecting : false};
	$.check_ajax_redirect = function(data){
		var redirect = '';
		if(redirect = data.match(/^<redirect>(.+?)<\/redirect>/)){
			if(!$.ajax_status.redirecting){
				window.location.href = redirect[1];
				$.ajax_status.redirecting = true
			}
			return '<div class="ajax-redirect-notifier">Redirecting ...</div><div class="clear"></div>';
		}
		
		if(data.match(/^<refresh><\/refresh>/)){
			if(!$.ajax_status.redirecting){
				window.location.href = window.location.href;
				$.ajax_status.redirecting = true
			}			
			return '<div class="ajax-redirect-notifier">Refreshing ...</div><div class="clear"></div>';
		}		
		return false;
	};
	
	$.ajax_status = function(data){
		$.check_ajax_redirect(data);
		if(data.match(/^<failed>.*?<\/failed>/)){
			return false;
		}else{
			return true;
		}
	};
	
	$.clear_ajax_status = function(data){
		if(redirect = $.check_ajax_redirect(data)){
			return redirect;
		}
		return data.replace(/^<failed>.*?<\/failed>/, "")
					.replace(/^<refresh><\/refresh>/, "")
					.replace(/^<successed><\/successed>/, "")
					.replace(/^<redirect>.*?<\/redirect>/, "");
	};	
	
	$.get_ajax_error = function (data){
		var error = "";
		if(error = data.match(/^<failed>(.*?)<\/failed>/)){
			return error[1];
		}
		return ""
	}
	
})(jQuery);