<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastrar</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <style>
    .content-container {
      max-width: 400px;
      padding: 25px;
    }
  </style>
</head>

<body class="d-flex align-items-center justify-content-center py-4 bg-body-tertiary">
  <div class="content-container">
    <main class="mx-auto w-100">
      <form action="autentify.php" method="post">
        <img class="mb-4" src="icone.png" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Cadastrar-se</h1>

        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingFirstName" name="firstname" placeholder="João" required>
          <label for="floatingFirstName">Nome:</label>
        </div>

        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingLastName" name="lastname" placeholder="Dourado" required>
          <label for="floatingLastName">Sobrenome:</label>
        </div>

        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="name@example.com" required>
          <label for="floatingEmail">E-mail:</label>
        </div>

        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
          <label for="floatingPassword">Senha:</label>
        </div>

        <div class="form-check text-start my-3">
          <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
            Remember me
          </label>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">Cadastrar</button>

        <p class="mt-5 mb-3 text-body-secondary">© 2025–2030</p>
      </form>
    </main>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBud7l5eOAowQf607c+mC2G2LnFJ3f55bDruM/zcSbqJ7FIZ" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html
