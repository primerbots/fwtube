<?php
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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Imprime o array $_GET na tela
    print_r($_GET);
  
    // Obtém o termo de pesquisa do formulário
    if (isset($_GET["search"])) {
      $search_term = $_GET["search"];
      // Execute a consulta e exiba os resultados
    } else {
      echo "erro";
      // Exiba uma mensagem de erro ou o formulário de pesquisa vazio
    }
}
  
    // Executa a consulta ao banco de dados
    $sql = "SELECT * FROM fwtube WHERE nome_video LIKE '%$search_term%'";
    $result = $conn->query($sql);
  
    if ($result->num_rows > 0) {
      // Exibe os resultados da pesquisa em uma tabela HTML
      echo "<table border='1'>";
      echo "<tr>";
      echo "<th>Video</th>";
      echo "<th>nome</th>";
      echo "<th>ddsc_video</th>";
      echo "</tr>";
  
      while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["video"]. "</td>";
        echo "<td>" . $row["nome_video"] . "</td>";
        echo "<td>" . $row["dsc_video"] . "</td>";
        echo "</tr>";
      }
  
      echo "</table>";
    } else {
      echo "Nenhum resultado encontrado.";
    }

  
  $conn->close();


  
?>