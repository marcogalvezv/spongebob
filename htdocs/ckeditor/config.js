/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.baseHref = "<?=base_url()?>";
	config.toolbar = [
				['Source','-','NewPage','Preview','-','Templates'],
				['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
				['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
				'/',
				['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
				['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
				['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
				['Link','Unlink','Anchor','Image','Flash','Table','HorizontalRule','SpecialChar'],
				'/',
				['Styles','Format','Font','FontSize'],
				['TextColor','BGColor','-','About']
			];
	
	config.LinkBrowser = true ;
	config.ImageBrowser = true ;
	config.FlashBrowser = true ;
	config.LinkUpload = true ;
	config.ImageUpload = true ;
	config.FlashUpload = true ; 
};
