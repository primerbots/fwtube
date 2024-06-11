<!DOCTYPE html>
<html>
<head>
  <title>Meu Perfil</title>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    load_user_data();

    document.getElementById('change-pic-btn').addEventListener('click', function(e) {
      e.preventDefault();
      document.getElementById('profile-pic-input').click();
    });

    document.getElementById('profile-pic-input').addEventListener('change', function(e) {
      const formData = new FormData();
      formData.append('foto', e.target.files[0]);

      fetch("upload_photo.php", {
        method: "POST",
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          document.getElementById('profile-pic').src = "uploads_photos/" + data.foto;
        } else {
          alert(data.error);
        }
      })
      .catch(error => {
        console.error('Erro:', error);
        alert('Ocorreu um erro ao carregar a foto de perfil.');
      });
    });
  });

  function load_user_data() {
  fetch("user_data.php")
  .then(response => {
    console.log("Response:", response);
    return response.json();
  })
  .then(data => {
    console.log("Data:", data);
    // use the data to populate the HTML elements on the page
    const nomeElement = document.getElementById("nome");
    const sobrenomeElement = document.getElementById("sobrenome");
    const emailElement = document.getElementById("email");

    if (nomeElement) {
      nomeElement.innerText = data.nome;
    } else {
      console.error("Element with ID 'nome' not found");
    }

    if (sobrenomeElement) {
      sobrenomeElement.innerText = data.sobrenome;
    } else {
      console.error("Element with ID 'sobrenome' not found");
    }

    if (emailElement) {
      emailElement.innerText = data.email;
    } else {
      console.error("Element with ID 'email' not found");
    }

    // ...and so on for other data
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Ocorreu um erro ao carregar os dados do usuário.');
  });
}


</script>


  <style>

.center-content {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .sair {
      color: red;
      text-decoration: none;
    }

    .profile-pic {
  border-radius: 50%;
}


    .dropdown-menu .dropdown-item-photo,
    .dropdown-menu {
      text-decoration: none;
    }

    .profile-pic-container {
      position: relative;
      display: inline-block;
    }

    .profile-pic-container .edit-icon {
      position: absolute;
      top: 0;
      right: 0;
      display: none;
      cursor: pointer;
    }

    .profile-pic-container:hover .edit-icon {
      display: block;
    }

    /* Rest of your CSS code */
  </style>
</head>
<body>
<div class="center-content">
  <div class="profile-pic-container">
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

    echo '<img id="profile-pic" src="uploads_photos/' . $user_profile_picture . '" alt="User" class="rounded-circle me-2 profile-pic" width="200" height="200">
          <span class="edit-icon" id="change-pic-btn">
            <!-- Add your edit icon here, for example, a pencil icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
              <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.849 3.849-1.528.106-.106a.5.5 0 0 1 .707 0l1.528 3.849 3.849-1.528.106-.106a.5.5 0 0 1 .707 0l3.849 1.528 1.528-3.849-.106-.106a.5.5 0 0 1 0-.707l-1.528-3.849-3.849 1.528-.106.106a.5.5 0 0 1-.707 0l-3.849-1.528-1.528 3.849z"/>
            </svg>
          </span>
          <input type="file" id="profile-pic-input" style="display: none;">';
}
?>


  </div>

  <h1>Bem-vindo(a), <span id="nome"></span></h1>
  <p>Seu sobrenome é: <span id="sobrenome"></span></p>
  <p>Seu E-mail é: <span id="email"></span></p>
  <p>Sua senha é: <span id="senha">*******</span></p>
  <!-- Rest of your HTML code -->
</div>
</body>
</html>
