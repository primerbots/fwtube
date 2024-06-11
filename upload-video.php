<?php
if(isset($_POST["submit"])){
    $target_dir = "uploads-videos/";
    $videoTitle = $_POST["videoTitle"];
    $videoDescription = $_POST["videoDescription"]; // add this line to store the description
    $videoFileType = strtolower(pathinfo($_FILES["videoFile"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . $videoTitle . "." . $videoFileType;

    // Check if file is a actual video or fake video
    $mime_type = mime_content_type($_FILES["videoFile"]["tmp_name"]);
    if(strpos($mime_type, "video/") === 0) {
        echo "File is a video - " . $mime_type . ".";
        if (move_uploaded_file($_FILES["videoFile"]["tmp_name"], $target_file)) {
            echo "The video ". htmlspecialchars( basename( $target_file)). " has been uploaded.";

            // Now, let's save the file path to the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "fwtube";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // prepare sql and bind parameters
                $stmt = $conn->prepare("UPDATE fwtube SET nome_video = :title, video = :file_path, dsc_video = :description"); // add "descricao = :description" to the SQL statement
                $stmt->bindParam(':title', $videoTitle);
                $stmt->bindParam(':file_path', $target_file);
                $stmt->bindParam(':description', $videoDescription); // add this line to bind the description parameter

                // update the row
                $stmt->execute();

                // print out debugging information
                echo "SQL statement: " . $stmt->queryString . "<br>";
                echo "Number of rows affected: " . $stmt->rowCount() . "<br>";

                // check if the row exists in the database
                $stmt = $conn->prepare("SELECT * FROM fwtube WHERE email = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    echo "Row found in database:<br>";
                    print_r($row);
                } else {
                    echo "Row not found in database.";
                }

                echo "Record updated successfully";
                // Redirect to index.php
                header("Location: index.php");
                exit();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not a video.";
    }
}
?>
