<?php session_start();
if(empty($_SESSION["login"])) :
else: header('Location: panel.php');
endif;?>  
<!DOCTYPE html>
<html lang="en">
<head>
      <title>BitList - Log into Admin Panel</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <link rel="shortcut icon" href="../images/favicons/favicon.ico"/>
      <link rel="apple-touch-icon" sizes="180x180" href="../images/favicons/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="../images/favicons/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="../images/favicons/favicon-16x16.png">
      <link rel="stylesheet" href="../css/main.css">
</head>
    <body class="body-admin-login">
            <form class="form-admin-login" action="functions/login.php" method="post">
                <div class="modal-input login-container">
                  <input type="text" name="login" id="login" placeholder="Login" autocomplete="off" required autofocus>
               </div>
               <div class="modal-input pass-container">
                  <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required>
               </div>
                <button type="submit" class="button-light">Log in</button>
            </form>
    </body>
</html>