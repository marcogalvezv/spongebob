<!DOCTYPE html>

<!-- JavaScript Plugins -->
<script src="<?= base_url()?>js/admin/libs/jquery-1.8.3.min.js"></script>
<script src="<?= base_url()?>js/admin/libs/jquery.placeholder.min.js"></script>
<script src="<?= base_url()?>js/admin/custom-plugins/fileinput.js"></script>

<!-- jQuery-UI Dependent Scripts -->
<script src="<?= base_url()?>js/admin/jui/jquery-ui-effects.min.js"></script>

<!-- Plugin Scripts -->
<script src="<?= base_url()?>js/admin/plugins/validate/jquery.validate-min.js"></script>

<!-- Login Script -->
<script src="<?= base_url()?>js/admin/core/login.js"></script>

<head>
    <meta charset="utf-8">

    <!-- Viewport Metatag -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- Required Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>css/admin/bootstrap.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>css/admin/fonts/ptsans/stylesheet.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>css/admin/fonts/icomoon/style.css" media="screen">

    <link rel="stylesheet" type="text/css" href="<?= base_url()?>css/admin/login.css" media="screen">

    <link rel="stylesheet" type="text/css" href="<?= base_url()?>css/admin/mws-theme.css" media="screen">

    <title>SoliciTaxi - Login Page</title>

</head>

<body>

<div id="mws-login-wrapper">
    <div id="mws-login">
        <h1>Login Admin</h1>
        <div class="mws-login-lock"><i class="icon-lock"></i></div>
        <div id="mws-login-form">
            <form id="login" class="mws-form" method="post">
                <!--                /<div class="mws-form-message error">-->
                <div class="mws-form-message error" style="display: none" id="message-div">
                    <ul>
                        <li id="message" ></li>
                    </ul>
                </div>
                <div class="mws-form-row">
                    <div class="mws-form-item">
                        <input type="text" name="user[username]" class="mws-login-username required" placeholder="username">
                    </div>
                </div>
                <div class="mws-form-row">
                    <div class="mws-form-item">
                        <input type="password" name="user[password]" class="mws-login-password required" placeholder="password">
                    </div>
                </div>
                <div id="mws-login-remember" class="mws-form-row mws-inset">
                    <ul class="mws-form-list inline">
                        <li>
                            <input id="remember" type="checkbox">
                            <label for="remember">Remember me</label>
                        </li>
                    </ul>
                </div>
                <div class="mws-form-row">
                    <input type="submit" value="Login" class="btn btn-success mws-login-button" id="submit">
                </div>
            </form>
        </div>
    </div>
</div>



</body>
</html>

<script type="text/javascript">
    //prevent from submit
    $("#login").submit(function() { return false; });

    //onclick function we will validate the user
    $("#submit").on("click", function () {
        //validate form
        if (!$('#login').valid()) {
            return false;
        }

        //calling ajax function to check user
        $.ajax({
            //TODO: check the generated url, Remove this comment after the review of the url
            url:'<?= base_url();?>radiotaxi/user/ajaxlogin', //submits it to the given url of the form
            data: $('#login').serialize(),
            type: "POST",
            dataType:"JSON" // you want a difference between normal and ajax-calls, and json is standard
        }).success(function (data) {
                    if (data.success == false)
                    {
                        $("#message").text(data.message);
                        $("#message-div").show();
                    }
                    if (data.success == true)
                    {
                        window.location.href = data.redirectTo;
                    }
                });
    });


</script>
