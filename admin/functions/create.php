<?php
require_once 'connect.php';

$add_full_name = isset($_POST['add_full_name']) ? $_POST['add_full_name'] : '';
$add_full_name = trim($add_full_name);

$add_short_name = isset($_POST['add_short_name']) ? $_POST['add_short_name'] : '';
$add_short_name = strtoupper(trim($add_short_name));

$add_icon = $_FILES["add_icon"]["name"];

$newFileName = '';

try {
    define('BASE_UPLOAD_DIR', '../../images/icons/');

    if (isset($_POST["add"])) {
        $maxFileSize = 3000 * 3000;

        function generateUniqueFileName($originalName) {
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $safeName = preg_replace('/[^a-zA-Z0-9_\-]/', '', $originalName);
            return uniqid() . '_' . $safeName . '.' . $extension;
        }

        function isAllowedMimeType($mime) {
            $allowedMimeTypes = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/svg', 'image/svg+xml', 'image/heic', 'image/avif', 'image/webp'];
            return in_array(strtolower($mime), $allowedMimeTypes);
        }

        if (isset($_FILES['add_icon'])) {
            $uploadFile = $_FILES['add_icon'];
            if ($uploadFile['error'] === UPLOAD_ERR_OK) {
                if ($uploadFile['size'] <= $maxFileSize) {
                    $newFileName = generateUniqueFileName($uploadFile['name']);
                    if (isAllowedMimeType($uploadFile['type'])) {
                        $destination = BASE_UPLOAD_DIR . $newFileName;
                        if (move_uploaded_file($uploadFile['tmp_name'], $destination)) {
                            echo "File uploaded successfully!";
                            $add_icon = $newFileName;
                        } else {
                            echo "File could not be uploaded.";
                        }
                    } else {
                        echo "File extension or type is not allowed.";
                    }
                } else {
                    echo "File is too large.";
                }
            } else {
                echo "Error uploading file.";
            }
        }
    }

    $sql = "INSERT INTO coins (full_name, short_name, icon) VALUES (:full_name, :short_name, :icon)";
    $query = $pdo->prepare($sql);
    $query->execute([
        "full_name" => $add_full_name,
        "short_name" => $add_short_name,
        "icon" => $add_icon
    ]);

    echo '<meta HTTP-EQUIV="Refresh" Content="0; URL=../panel.php">';
    } catch (PDOException $th) {
    echo "Database error: " . $th->getMessage();
}
?>