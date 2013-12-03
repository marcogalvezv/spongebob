(function($){ 
	 $.fn.extend({
			replace_with_ajax:function(url, params){
			 	var options = $.extend({}, {fix_png:true}, params);
				var $this = $(this);
				$.get(url, null, function(data){
					if(options.fix_png){
						var marker = $('<span style="display:none"></span>').insertAfter($this);
					}	 					
					$this.html("").replaceWith(data);
					if(options.fix_png && typeof jQuery.fn.pngFix != "undefined"){
						marker.prev().pngFix();
						marker.remove();
					}
					if(status && options.callback){
						options.callback(data, $this);
					}
				});				
			},
	 
		 apply_alter_row : function(params){
			   var row_idx = 0;
			   return this.each(function(){
				   if(row_idx == 1){
					   $(this).addClass("alter-row");
				   }else{
					   $(this).removeClass("alter-row");
				   }
				   row_idx = (row_idx+1)%2;
			   });		
		 },
		 	
		 	apply_clear_row:function(params){
		 		var options = $.extend({}, {item_per_row:2}, params);
		 		options.item_per_row = parseInt(options.item_per_row);
		 		if(options.item_per_row<=0){
		 			options.item_per_row = 2;
		 		}
		 		var clear_idx = 0;
		 		return this.each(function(){
		 			clear_idx = (clear_idx+1)%options.item_per_row;
		 			if(clear_idx==0){
		 				$('<div class="clear"></div>').insertAfter(this);
		 			}
		 		});
		 	},
		 	
		 	apply_active_link:function(prefix, href){
				var active_link = null;
				if (href==null){
					href = window.location.href;
				}
				
				this.each(function(){
					 if(href.indexOf(this.href) >=0  
						&& (active_link==null 
							|| active_link.href.length < this.href.length
							|| href.indexOf(this.href) < href.indexOf(active_link.href))){
						 active_link = this;
					 }
				});
				
				this.each(function(){			
						var active_class = "";
						if(prefix==null){
							active_class = this.id ? this.id + "-active" : "active";
						}else{
							active_class = prefix + "-active";
						}		
						if(active_link && this.href == active_link.href){
							$(this ).addClass(active_class);
						}else{
							$(this).removeClass(active_class);
						}
				});
		 		return this;
		 	},
		 	
		 	
		 	build_values_obj:function(options){
		 		res = {};
	 			var setting = $.extend({}, {clean_pattern:/\s*/}, options);
		 		this.each(function(){
						var name = this.name.replace(setting.clean_pattern,"");
						var value = $(this).fieldValue();
						if (this.type!='radio'){
							if(value.length){
								res[name] = value[0].replace(/^\s+|\s+$/g, '');
							}else{
								res[name] = '';
							}
						}else{
							if(typeof res[name] == "undefined" || !res[name]){
								if(value.length){
									res[name] = value[0].replace(/^\s+|\s+$/g, '');
								}else{
									res[name] = '';
								}								
							}
						}
		 		});
		 		return res;
		 	}
		 
	 });
	 
	 $.S4 = function() {
		   return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
	 };
	 $.guid = function() {
	    return ($.S4()+$.S4()+"-"+$.S4()+"-"+$.S4()+"-"+$.S4()+"-"+$.S4()+$.S4()+$.S4());
	 };

})(jQuery);