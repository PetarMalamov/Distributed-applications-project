<?php
    session_start();
    if (isset($_GET['end'])) {
      session_destroy();
      header("Location: http://localhost/WebSite/");
    }

    if (!isset($_SESSION['token'])){
      header("Location: http://localhost/WebSite/");
    }
 ?>
