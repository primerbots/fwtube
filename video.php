<?php
session_start();

// Check if the user is logged in
if(!isset($_SESSION['email'])) {
    // If not, redirect to the login page
    header('Location: login.php');
    exit;
}

// Rest of your video.php code here
?>

<!DOCTYPE html>
<head>
    <title>Enviar video</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        form {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }
        form input,
        form textarea {
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
        }
        form textarea#videoDescription {
            height: 100px;
            resize: vertical;
        }
    </style>
</head>

<body>
<form action="upload-video.php" method="post" enctype="multipart/form-data">
  Titulo do video: <input type="text" name="videoTitle" id="videoTitle"><br>
  Descrição do video: <textarea name="videoDescription" id="videoDescription"></textarea><br>
  Selecionar video:
  <input type="file" name="videoFile" id="videoFile"><br>
  <input type="submit" value="Upload Video" name="submit">
</form>

</body>
</html>
