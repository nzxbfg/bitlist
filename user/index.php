<?php session_start();

if (!isset($_SESSION["login_reg"]) && !isset($_SESSION["login_log"])) {
    header('Location: ../');
    exit();
}

require_once '../admin/functions/connect.php';

if ($_SESSION['user_type'] == 'login') {
    $login = $_SESSION["login_log"];
} elseif ($_SESSION['user_type'] == 'register') {
    $login = $_SESSION["login_reg"];
} else {
    header('Location: ../');
    exit();
}

$new = $pdo->prepare("SELECT * FROM `user` WHERE login = :login");
$new->bindParam(':login', $login);
$new->execute();
$base = $new->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>BitList - User Panel</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <link rel="shortcut icon" href="../images/favicons/favicon.ico"/>
      <link rel="apple-touch-icon" sizes="180x180" href="../images/favicons/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="../images/favicons/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="../images/favicons/favicon-16x16.png">
      <link rel="stylesheet" href="../css/main.css">
   </head>
   <body class="user-body">
      <header class="user-top">
         <h2>Hello, <?php echo $base[0]->login?>! Welcome to <a href="../"><img src="../images/logos/logo.svg" alt="logo"></a></h2>
         <a href="logout.php">Logout</a>
      </header>
   </body>
</html>