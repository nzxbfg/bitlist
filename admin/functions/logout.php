<?php
session_start();
unset($_SESSION['login']);
session_destroy();
echo '<meta HTTP-EQUIV="Refresh" Content="0; URL=../../">';
?>