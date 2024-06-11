<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fwtube";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Rest of your code...
?>


<!DOCTYPE html>
<head>
    <script src="/docs/5.3/assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>FW Tube - Inicio</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">

    <style>
      /* ... other CSS styles ... */
    </style>
    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </head>

<body>

<header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
    <img src="icone.png" width="50" height="50"></img>
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        </a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a class="nav-link px-2 text-secondary">Inicio</a></li>
          <li><a href="video.php" class="nav-link px-2 text-white">Enviar video</a></li>
          <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Ajuda</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
        </form>

        <?php
session_start();
if (isset($_SESSION['email'])) {
    // Fetch the user's profile picture from the database.
    // Replace the following lines with your code to get the user's profile picture from the database.
    $email = $_SESSION['email'];
    $conn = new mysqli('localhost', 'root', '', 'fwtube');
    $sql = "SELECT foto FROM fwtube WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $user_profile_picture = $row['foto'];

    // Check if the profile picture is empty or null
    if (empty($user_profile_picture)) {
        // Display a default profile picture
        $user_profile_picture = 'user.jpg';
    }

    echo '
    <div class="d-flex align-items-center ms-lg-3 dropdown dropdown-menu-end">
        <a href="#" class="dropdown-toggle d-flex align-items-center text-white text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="uploads_photos/' . $user_profile_picture . '" alt="User" class="rounded-circle me-2" width="40" height="40">
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="profile.php">' . 'Perfil' . '</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">Sair</a></li>
        </ul>
    </div>';
}
?>


      </div>
    </div>
  </header>

  <!-- Include the Bootstrap JavaScript bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBud7l5eOAowQf607c+mC2G2LnFJ3f55bDruM/zcSbqJ7FIZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>

<table>
  <tr>
  <?php
// ... seu código de conexão com o banco de dados e lógica de upload aqui ...

// Depois de salvar o caminho do arquivo no banco de dados, você pode exibir os vídeos da seguinte maneira:

// Primeiro, obtenha os caminhos dos arquivos e os títulos do banco de dados
$stmt = $conn->prepare("SELECT video, nome_video, dsc_video FROM fwtube");
$stmt->execute();
$result = $stmt->get_result();

// Em seguida, loop through the results and display each video and its title
while ($row = $result->fetch_assoc()) {
    $video_path = $row['video'];
    $video_title = $row['nome_video'];
    $video_dsc = $row['dsc_video'];
?>

<div>
  
  <video width="320" height="240" controls>
  <source src="<?php echo $video_path; ?>" type="video/mp4">
  Your browser does not support the video tag.
</video>
<h2><?php echo $video_title; ?></h2>
  <p><?php echo $video_dsc; ?></p>

</div>

<?php
}
?>

  </tr>
</table>

</body>
</html>
