<?php
session_start();

if (isset($_SESSION['email']) && isset($_FILES['foto'])) {
    $target_dir = "uploads_photos/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is an image
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check !== false) {
        // Check if the file already exists
        if (!file_exists($target_file)) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                // File uploaded successfully, update the database with the new file's path
                $email = $_SESSION['email'];
                $foto_path = basename($_FILES["foto"]["name"]);

                // Replace the following lines with your code to update the database
                // Example using MySQLi:
                $conn = new mysqli("localhost", "root", "", "fwtube");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "UPDATE fwtube SET foto = '$foto_path' WHERE email = '$email'";
                if ($conn->query($sql) === TRUE) {
                    // Database updated successfully, return JSON response
                    echo json_encode(array("success" => true, "foto" => $foto_path));
                } else {
                    // Error updating the database
                    $error_message = "Erro ao atualizar o banco de dados: " . $conn->error;
                    echo json_encode(array("success" => false, "error" => $error_message));
                }

                $conn->close();
            } else {
                // Error moving the file
                echo json_encode(array("success" => false, "error" => "Erro ao mover o arquivo."));
            }
        } else {
            // File already exists
            echo json_encode(array("success" => false, "error" => "O arquivo já existe."));
        }
    } else {
        // File is not an image
        echo json_encode(array("success" => false, "error" => "O arquivo não é uma imagem."));
    }
} else {
    // User not logged in or file not provided
    echo json_encode(array("success" => false, "error" => "Usuário não autenticado ou arquivo não fornecido."));
}
?>
