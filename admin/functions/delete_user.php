<?php
require_once 'connect.php';

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM user WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo '<meta HTTP-EQUIV="Refresh" Content="0; URL=../panel.php">';
        exit();
    } else {
        echo "Error deleting user.";
    }
}
?>