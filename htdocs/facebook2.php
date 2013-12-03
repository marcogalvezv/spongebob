<?php

define('YOUR_APP_ID', '197158077038691');
define('YOUR_APP_SECRET', 'a1abcc5c817970efebe9217002358546');

$url = urlencode("http://flysocial.synapse.com.bo/facebook2.php");

function get_facebook_cookie($app_id, $app_secret) {
  $args = array();
  parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
  ksort($args);
  $payload = '';
  foreach ($args as $key => $value) {
    if ($key != 'sig') {
      $payload .= $key . '=' . $value;
    }
  }
  if (md5($payload . $app_secret) != $args['sig']) {
    return null;
  }
  return $args;
}

$cookie = get_facebook_cookie(YOUR_APP_ID, YOUR_APP_SECRET);

$user = json_decode(file_get_contents(
    'https://graph.facebook.com/me?access_token=' .
    $cookie['access_token']));

$logout = "https://www.facebook.com/logout.php?next={$url}&access_token=" .
    $cookie['access_token'];

?>
<html>
  <body>
    <?php if ($cookie) { ?>
      Welcome <?= $user->name ?> 
	  <br />
	  <a href="<?= $logout?>">Logout</a>
    <?php } else { ?>
      <div class="fb-login-button">Login with Facebook</div>
    <?php } ?>
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '<?= YOUR_APP_ID ?>',
          status     : true, 
          cookie     : true,
          xfbml      : true
        });

        FB.Event.subscribe('auth.login', function(response) {
          window.location.reload();
        });
      };

      (function(d){
         var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/en_US/all.js";
         d.getElementsByTagName('head')[0].appendChild(js);
       }(document));
    </script>
  </body>
</html>