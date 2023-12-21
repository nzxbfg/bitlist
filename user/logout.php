<?php
session_start();
unset($_SESSION['login_reg']);
unset($_SESSION['login_log']);
session_destroy();
header('Location: ../');
?>