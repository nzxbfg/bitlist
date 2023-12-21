<?php
session_start();
require_once '../admin/functions/connect.php';

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST['login_log'];
        $password = $_POST['password_log'];

        $stmt = $pdo->prepare("SELECT id, login, password FROM user WHERE login = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $storedPassword = $row["password"];

            if (password_verify($password, $storedPassword)) {
                $_SESSION['login_log'] = $row["login"];
                $_SESSION['user_type'] = 'login';
                header("Location: ../user");
            } else {
                echo "Invalid password";
            }
        } else {
            echo "User not found";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
