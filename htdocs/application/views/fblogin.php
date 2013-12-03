<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Welcome to Facebook Login</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="//connect.facebook.net/en_US/all.js"></script>
	</head>
	<body>
    <div id="fb-root"></div>
		
		<?if(isset($me) && !empty($me)){?>
		Welcome back, <?= $me['first_name']?>!
		<br />
		<button id="fb-logout" onclick="logout()">Log out</button>
		<?}else{?>
		<fb:login-button>Ingresar con Facebook</fb:login-button>
		<p>You can can view the advanced features by clicking <a href="<?= $login_login ?>">this link</a> to authorize the app!</p>
		<?}?>
		
        <div id="fb-root"></div>
        <script>
          window.fbAsyncInit = function() {
            FB.init({
              appId      : '524342177594799', // App ID
              channelUrl : '//pidamosalgo.synapse.com.bo/channel.html', // Channel File
              scope      : 'email', // check login status
              status     : true, // check login status
              cookie     : true, // enable cookies to allow the server to access the session
              xfbml      : true  // parse XFBML
            });
			FB.Event.subscribe('auth.login', function(response) {
				
				window.location.reload();
			  //window.location = "http://pidamosalgo.synapse.com.bo/welcome/logged";
			});
          };
          // Load the SDK Asynchronously
          (function(d){
             var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement('script'); js.id = id; js.async = true;
             js.src = "//connect.facebook.net/en_US/all.js";
             ref.parentNode.insertBefore(js, ref);
           }(document));
		   
			function logout() {
				FB.logout(function() {
					// Reload the same page after logout
					window.location.reload();
					// Or uncomment the following line to redirect
					//window.location = "http://ykyuen.wordpress.com";
				});
			}
		   
        </script>

  </body>
</html>
	
</body>
</html>