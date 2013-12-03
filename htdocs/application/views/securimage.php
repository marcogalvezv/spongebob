<html>
<head>
  <title>Securimage Test Form</title>
</head>

<body>

<form method="POST" action="">
Username:<br />
<input type="text" name="username" /><br />
Password:<br />
<input type="text" name="password" /><br /><br />

<div style="width: 430px; float: left; height: 90px">
      <img id="siimage" align="left" style="padding-right: 5px; border: 0" src="/testsecurimage/show/sid/<?php echo md5(time()) ?>" />

        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle">
			    <param name="allowScriptAccess" value="sameDomain" />
			    <param name="allowFullScreen" value="false" />
			    <param name="movie" value="<?= base_url()?>securimage/securimage_play.swf?audio=<?= base_url()?>testsecurimage/play/bgColor1/#777/bgColor2/#fff/iconColor/#000/roundedCorner/5" />
			    <param name="quality" value="high" />
			
			    <param name="bgcolor" value="#ffffff" />
			    <embed src="<?= base_url()?>securimage/securimage_play.swf?audio=<?= base_url()?>testsecurimage/play/bgColor1/#777/bgColor2/#fff/iconColor/#000/roundedCorner/5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			  </object>

        <br />
        
        <!-- pass a session id to the query string of the script to prevent ie caching -->
        <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '/testsecurimage/show/sid/' + Math.random(); return false"><img src="/images/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" /></a>
</div>
<div style="clear: both"></div>
Code:<br />

<!-- NOTE: the "name" attribute is "code" so that $img->check($_POST['code']) will check the submitted form field -->
<input type="text" name="code" size="12" /><br /><br />

<input type="submit" value="Submit Form" />
</form>
</body>
</html>
