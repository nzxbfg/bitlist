<?php
session_start();
require_once 'connect.php';

$login = $_POST['login'] ?? null;
$password = md5($_POST['password']) ?? null;

$sql = $pdo->prepare("SELECT id, login FROM admin WHERE login=:login AND password=:password");
$sql->execute(array('login' => $login, 'password' => $password));
$array = $sql->fetch(PDO::FETCH_ASSOC);

if ( $array["id"] > 0 ) {
    $_SESSION["login"] = $array["login"];
    echo '<meta HTTP-EQUIV="Refresh" Content="0; URL=../panel.php">';
} else {
    echo '<meta HTTP-EQUIV="Refresh" Content="0; URL=../">';
}
?>