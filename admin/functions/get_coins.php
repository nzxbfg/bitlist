<?php
require_once 'connect.php';

$query = $pdo->prepare("SELECT short_name, full_name, icon FROM coins");
$query->execute();
$coins = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($coins);
?>