(function($){
	 $.do_ext_form_post = new Array();
	 $.fn.extend({
	 	ext_ajax_submit:function(options){
		 	var settings = $.extend({}, {bypass_validation:false, fix_png:true, ajax_upload_link:"ajax_upload/resource/"}, options);
 			return this.each(function() {
 				var form = this;
 				$form = $(this);
 				if(settings.bypass_validation || typeof $form.validate == 'undefined' || $form.valid()){
 					
	 				$file_inputs = $(form).find("input[type=file]");
	 				var form_position =  $(form).position();
	 				if($(form).css("position").toLowerCase()=="relative" || 
	 						$(form).css("position").toLowerCase()=="absolute"){
	 					form_position = {top:0,left:0};
	 				}
	 				$(form).append('<div style="opacity:.2;filter:: alpha(opacity=20);background:gray;position:absolute;top:'+form_position.top+'px;left:'+form_position.left+'px;width:100%;height:'+$(form).height()+'px;z-index:1000">&nbsp;</div>').focus();
	 				var file_count = 0;
	 				var post_idx = "" + Math.random(); 
	 				$.do_ext_form_post[post_idx] = function(){
	 					if(file_count > 0){
	 						setTimeout("$.do_ext_form_post['"+post_idx+"']();",200);
	 						return;
	 					}
		 				var thissetting = $.extend({				
		 					success:function(data){
		 						status = $.ajax_status(data);
		 						data = $.clear_ajax_status(data);
		 						if(settings.fix_png){
		 							var marker = $('<span style="display:none"></span>').insertAfter(form);
		 						}	 					
		 						$(form).html("").replaceWith(data);
		 						if(settings.fix_png && typeof jQuery.fn.pngFix != "undefined"){
		 							marker.prev().pngFix();
		 							marker.remove();
		 						}
		 						if(status && thissetting.callback){
		 							thissetting.callback(data, form);
		 						}
		 					}
		 				}, settings);
		 				$(form).ajaxSubmit(thissetting);
		 				$.do_ext_form_post[post_idx] = null;
	 				};
	 				
	 				if(settings.clean_files){
	 					$file_inputs.remove();
	 					$.do_ext_form_post[post_idx]();
	 				}else{
	 					file_count = $file_inputs.length;
	 					$file_inputs.each(function(){
	 						var file = this;
	 						if($(file).hasClass("cleared-on-submit") || !$(file).attr('file_field_name')){
	 							$(file).remove();
	 							file_count--;
	 							return;
	 						}
	 						var file_field_name = $(file).attr('file_field_name');
	 						var $upload_form = $('<form  style="display: none;" enctype="multipart/form-data"' 
	 								+ 'method="post" action="' + base_url 
	 								+ settings.ajax_upload_link + this.name+'"></form>').appendTo('body');
	 						$upload_form
	 							.append('<input type="hidden" name="HTTP_X_REQUESTED_WITH" value="XMLHttpRequest"/>')
	 							.append(file)
	 							.ajaxSubmit({
								success : function(data) {
	 								file_count--;
									var status = $.ajax_status(data);		
									alter_name = '__files__'+file_field_name;
									if(status){
										data = eval('(' + $.clear_ajax_status(data) + ')');
										$(form).append('<input type="hidden" name="'+alter_name+'" value="'+data['input_value']+'">');
									}else{
										$(form).append('<input type="hidden" name="'+alter_name+'[error]" value="'+$.get_ajax_error(data)+'">');
									}
								},
								complete : function() {
									$upload_form.remove();
								}
							});	 						
	 					});
	 					// multi recurrcyly call this to wait for all file uploaded.
	 					setTimeout("$.do_ext_form_post['"+post_idx+"']();",200);
	 				} 
 				}
 			});
	 	}
	 });
})(jQuery);

function input_label_click(label){
	$(label).parent().find('input:first').focus();
}