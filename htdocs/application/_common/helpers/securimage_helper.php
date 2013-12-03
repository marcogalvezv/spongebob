<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include("securimage/securimage.php");

function showimage()
{
	$img = new securimage();

	// Change some settings

	//$img->image_width = 275;
	//$img->image_height = 90;
	//$img->perturbation = 0.9; // 1.0 = high distortion, higher numbers = more distortion
	//$img->image_bg_color = new Securimage_Color("#0099CC");
	//$img->text_color = new Securimage_Color("#EAEAEA");
	//$img->text_transparency_percentage = 65; // 100 = completely transparent
	//$img->num_lines = 8;
	//$img->line_color = new Securimage_Color("#0000CC");
	//$img->signature_color = new Securimage_Color(rand(0, 64), rand(64, 128), rand(128, 255));
	//$img->image_type = SI_IMAGE_PNG;
	$img->use_sqlite_db = TRUE;

	//return $img->show(); // alternate use:  $img->show('/path/to/background_image.jpg');
	return $img->show(); // alternate use:  $img->show('/path/to/background_image.jpg');
}

function playsound()
{
	
	$img    = new Securimage();
	$img->audio_format = (isset($_GET['format']) && in_array(strtolower($_GET['format']), array('mp3', 'wav')) ? strtolower($_GET['format']) : 'mp3');
	$img->use_sqlite_db = TRUE;
	//$img->setAudioPath('/path/to/securimage/audio/');

	return $img->outputAudioFile();
}

function validcode($code = false)
{
	$img = new Securimage();
	$img->use_sqlite_db = TRUE;

	return $img->check($code);
}
?>