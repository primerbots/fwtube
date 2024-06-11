<?php
$hostname = 'localhost';
$dbname = 'fwtube';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check for the "Remember Me" cookie
    if (isset($_COOKIE['remember_me'])) {
        list($user_id, $token) = explode(':', $_COOKIE['remember_me']);

        $stmt = $conn->prepare('SELECT * FROM fwtube WHERE id = ? AND token = ? AND expires > NOW()');
        $stmt->execute([$user_id, $token]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['sobrenome'] = $user['sobrenome'];

            // Redirect to the dashboard or another authenticated page
            header('Location: dash.php');
            exit;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_email = $_POST['email'];
        $user_password = $_POST['password'];

        $stmt = $conn->prepare('SELECT * FROM fwtube WHERE email = :email');
        $stmt->bindParam(':email', $user_email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo "No user found with the given email.";
            exit;
        }

        if (!password_verify($user_password, $user['senha'])) {
            echo "The provided password is incorrect.";
            exit;
        }

        session_start();
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $user_email;
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['sobrenome'] = $user['sobrenome'];

        if (isset($_POST['remember_me'])) {
            $token = bin2hex(random_bytes(16));
            $expiration = time() + 30 * 24 * 60 * 60; // Expires in 30 days
            setcookie('remember_me', $user['id'] . ':' . $token, $expiration, '/');

            // Store the token in your database
            $stmt = $conn->prepare('UPDATE fwtube SET token = ?, expires = ? WHERE id = ?');
            $stmt->execute([$token, date('Y-m-d H:i:s', $expiration), $user['id']]);

            if ($stmt->rowCount() == 0) {
    echo "Error: Failed to update token.";
    exit;
            }
        }

        // Redirect to the dashboard or another authenticated page
        header('Location: dash.php');
        exit;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
