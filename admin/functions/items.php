<?php
require_once 'connect.php';

$full_name = $_POST['full_name'];
$short_name = $_POST['short_name'];
$icon = $_FILES["icon"]["name"];

$id = $_POST["id"];

$sql = "UPDATE coins SET full_name=:full_name, short_name=:short_name WHERE id=$id";
$query = $pdo->prepare($sql);
$query->execute([
    "full_name" => $full_name,
    "short_name" => $short_name
]);

define('BASE_UPLOAD_DIR', '../../images/icons/');

$newFileName = '';

if (isset($_POST["save"])) {
    $maxFileSize = 3000 * 3000;

    function generateUniqueFileName($originalName) {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $safeName = preg_replace('/[^a-zA-Z0-9_\-]/', '', $originalName);
        return uniqid() . '_' . $safeName . '.' . $extension;
    }

    function isAllowedExtension($filename, $allowedExtensions) {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        return in_array($extension, $allowedExtensions);
    }

    function isAllowedMimeType($mime) {
        $allowedMimeTypes = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/svg', 'image/svg+xml', 'image/heic', 'image/avif', 'image/webp'];
        return in_array(strtolower($mime), $allowedMimeTypes);
    }

    if (isset($_FILES['icon'])) {
        $uploadFile = $_FILES['icon'];
        if ($uploadFile['error'] === UPLOAD_ERR_OK) {
            if ($uploadFile['size'] <= $maxFileSize) {
                $newFileName = generateUniqueFileName($uploadFile['name']);
                if (isAllowedMimeType($uploadFile['type'])) {
                    $destination = BASE_UPLOAD_DIR . $newFileName;
                    if (move_uploaded_file($uploadFile['tmp_name'], $destination)) {
                        echo "File uploaded successfully!";
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

if (!empty($newFileName)) {
    $blo = "UPDATE coins SET icon=:icon WHERE id=$id";
    $sts = $pdo->prepare($blo);
    $sts->execute([
        "icon" => $newFileName
    ]);
}

echo '<meta HTTP-EQUIV="Refresh" Content="0; URL=../panel.php">';

if(isset($_POST['delete'])) {
    try {
        $sql = "SELECT icon FROM coins WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $imgFileName = $row['icon'];
            
            $sqlDelete = "DELETE FROM coins WHERE id=:id";
            $stmtDelete = $pdo->prepare($sqlDelete);
            $stmtDelete->bindValue(':id', $id);
            $stmtDelete->execute();
            
            $imgPath = "../../images/icons/" . $imgFileName;
            if (file_exists($imgPath)) {
                if (unlink($imgPath)) {
                    echo "File successfully deleted.";
                } else {
                    echo "Failed to delete the file.";
                }
            } else {
                echo "File does not exist.";
            }
            
            echo '<meta HTTP-EQUIV="Refresh" Content="0; URL=../panel.php">';
        } else {
            echo 'Element not found.';
        }
    } catch (PDOException $th) {
        echo "Database error: " . $th->getMessage();
    }
}
?>