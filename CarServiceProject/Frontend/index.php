<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <meta charset="utf-8">
    <title>Gelima</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
<<?php
  if (isset($_REQUEST['loginError'])) {
  }
 ?>
<form class="box" action="checkUser.php" method="post">
  <h1>Sign in</h1>
  <h5>Only for employees</h5>
  <h6 id="errorMessage">Wrong email or password</h6>
  <input type="text" name="UserName" placeholder="Email">
  <input type="password" name="pwd" placeholder="Password">
  <input type="submit" value="Влез">

<script type="text/javascript">
   $('#errorMessage').hide();
  if (window.location.href.indexOf('?loginError') > 0) {
     $('#errorMessage').show();
  }
</script>
</form>
  </body>
</html>
