<?php
session_start();
require_once '../admin/functions/connect.php';

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST['login_reg'];
        $email = $_POST['email_reg'];
        $password = password_hash($_POST['password_reg'], PASSWORD_BCRYPT);

        $checkUserQuery = $pdo->prepare("SELECT * FROM `user` WHERE `login` = :login");
        $checkUserQuery->bindParam(':login', $login);
        $checkUserQuery->execute();

        if ($checkUserQuery->rowCount() > 0) {
            echo "Username already exists. Please choose a different username.";
        } else {
            $sql = "INSERT INTO `user` (`login`, `email`, `password`) VALUES ('$login', '$email', '$password')";

            $pdo->exec($sql);
            $_SESSION["login_reg"] = $login;
            $_SESSION['user_type'] = 'register';

            echo "Registration has been successful!";
            header("Location: ../user");
        }
    }
} catch (PDOException $e) {
    echo "Registration error: " . $e->getMessage();
}
?>