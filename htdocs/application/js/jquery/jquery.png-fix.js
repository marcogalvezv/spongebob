/**
 * --------------------------------------------------------------------
 * jQuery-Plugin "pngFix"
 * Version: 1.2, 09.03.2009
 * by Andreas Eberhard, andreas.eberhard@gmail.com
 *                      http://jquery.andreaseberhard.de/
 *
 * Copyright (c) 2007 Andreas Eberhard
 * Licensed under GPL (http://www.opensource.org/licenses/gpl-license.php)
 *
 * Changelog:
 *    09.03.2009 Version 1.2
 *    - Update for jQuery 1.3.x, removed @ from selectors
 *    11.09.2007 Version 1.1
 *    - removed noConflict
 *    - added png-support for input type=image
 *    - 01.08.2007 CSS background-image support extension added by Scott Jehl, scott@filamentgroup.com, http://www.filamentgroup.com
 *    31.05.2007 initial Version 1.0
 * --------------------------------------------------------------------
 * @example $(function(){$(document).pngFix();});
 * @desc Fixes all PNG's in the document on document.ready
 *
 * jQuery(function(){jQuery(document).pngFix();});
 * @desc Fixes all PNG's in the document on document.ready when using noConflict
 *
 * @example $(function(){$('div.examples').pngFix();});
 * @desc Fixes all PNG's within div with class examples
 *
 * @example $(function(){$('div.examples').pngFix( { blankgif:'ext.gif' } );});
 * @desc Fixes all PNG's within div with class examples, provides blank gif for input with png
 * --------------------------------------------------------------------
 */

(function($) {

jQuery.fn.pngFix = function(settings) {

	// Settings
	settings = jQuery.extend({
		blankgif: 'blank.gif',
		no_fix_class:'.no-fixpng'
	}, settings);

	var ie55 = (navigator.appName == "Microsoft Internet Explorer" && parseInt(navigator.appVersion) == 4 && navigator.appVersion.indexOf("MSIE 5.5") != -1);
	var ie6 = (navigator.appName == "Microsoft Internet Explorer" && parseInt(navigator.appVersion) == 4 && navigator.appVersion.indexOf("MSIE 6.0") != -1);

	if (jQuery.browser.msie && (ie55 || ie6)) {

		//fix images with png-source
		jQuery(this).find("img[src$=.png]:not("+settings.no_fix_class+")").each(function() {
			var this_img = this;
			var oImg=new Image;
			oImg.onload = function(){
				this_img.src=oImg.src;
			};
			oImg.onerror=function(){
				jQuery(this_img).attr('width',jQuery(this_img).width());
				jQuery(this_img).attr('height',jQuery(this_img).height());

				var prevStyle = '';
				var strNewHTML = '';
				var imgId = (jQuery(this_img).attr('id')) ? 'id="' + jQuery(this_img).attr('id') + '" ' : '';
				var imgClass = (jQuery(this_img).attr('class')) ? 'class="' + jQuery(this_img).attr('class') + ' png-fix" ' : ' class="png-fix" ';
				var imgTitle = (jQuery(this_img).attr('title')) ? 'title="' + jQuery(this_img).attr('title') + '" ' : '';
				var imgAlt = (jQuery(this_img).attr('alt')) ? 'alt="' + jQuery(this_img).attr('alt') + '" ' : '';
				var imgAlign = (jQuery(this_img).attr('align')) ? 'float:' + jQuery(this_img).attr('align') + ';' : '';
				var imgHand = (jQuery(this_img).parent().attr('href')) ? 'cursor:hand;' : '';
				if (this_img.style.border) {
					prevStyle += 'border:'+this_img.style.border+';';
					this_img.style.border = '';
				}
				if (this_img.style.padding) {
					prevStyle += 'padding:'+this_img.style.padding+';';
					this_img.style.padding = '';
				}
				if (this_img.style.margin) {
					prevStyle += 'margin:'+this_img.style.margin+';';
					this_img.style.margin = '';
				}
				var imgStyle = (this_img.style.cssText);

				strNewHTML += '<span '+imgId+imgClass+imgTitle+imgAlt;
				strNewHTML += 'style="position:relative;white-space:pre-line;display:inline-block;background:transparent;'+imgAlign+imgHand;
				strNewHTML += 'width:' + jQuery(this_img).width() + 'px;' + 'height:' + jQuery(this_img).height() + 'px;';
				strNewHTML += 'filter:progid:DXImageTransform.Microsoft.AlphaImageLoader' + '(src=\'' + jQuery(this_img).attr('src') + '\', sizingMethod=\'scale\');';
				strNewHTML += imgStyle+'"></span>';
				if (prevStyle != ''){
					strNewHTML = '<span style="position:relative;display:inline-block;'+prevStyle+imgHand+'width:' + jQuery(this_img).width() + 'px;' + 'height:' + jQuery(this_img).height() + 'px;'+'">' + strNewHTML + '</span>';
				}

				jQuery(this_img).hide().wrap(strNewHTML);				
			};
			oImg.src = this_img.src + ".gif";
		});
		// fix css background pngs
		jQuery(this).find("*").each(function(){
			var this_obj = this;
			var bgIMG = jQuery(this_obj).css('background-image');
			if(bgIMG.toLowerCase().match("\.png['\"]")){
				bgIMG = bgIMG.split('url("')[1].split('")')[0];
				var oImg=new Image;
				oImg.onload = function(){
					jQuery(this_obj).css('background-image', "url('"+oImg.src+"')");
				};
				oImg.onerror=function(){
					jQuery(this_obj).css('background-image', 'none');
					jQuery(this_obj).get(0).runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + bgIMG + "',sizingMethod='scale')";					
				};
				oImg.src = bgIMG+".gif";
			}
			
			var list_style_img = jQuery(this_obj).css('list-style-image');
			if(list_style_img.toLowerCase().match("\.png['\"]")){
				list_style_img = list_style_img.split('url("')[1].split('")')[0];
				var oImg=new Image;
				oImg.onload = function(){
					jQuery(this_obj).css('list-style-image', "url('"+oImg.src+"')");
				};
				oImg.src = list_style_img+".gif";
			}			
		});
		
		//fix input with png-source
		jQuery(this).find("input[src$=.png]").each(function() {
			var bgIMG = jQuery(this).attr('src');
			jQuery(this).get(0).runtimeStyle.filter = 'progid:DXImageTransform.Microsoft.AlphaImageLoader' + '(src=\'' + bgIMG + '\', sizingMethod=\'scale\');';
   		jQuery(this).attr('src', settings.blankgif)
		});	
	}
	
	return jQuery;

};

})(jQuery);

jQuery(function(){$("body").pngFix();});

