<?php
session_start();

if(isset($_SESSION['username'])) {
  // Usuário já está logado, redirecionar para a página correta
  if($_SESSION['level'] == 'user') {
    header("Location: ./pages/user.php");
  } elseif($_SESSION['level'] == 'admin') {
    header("Location: ./pages/admin.php");
  } elseif($_SESSION['level'] == 'root') {
    header("Location: ./pages/root.php");
  }
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Processar o formulário de login
  include('./BD/conexao.php');

  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $row['username'];
    $_SESSION['level'] = $row['level'];

    if($_SESSION['level'] == 'user') {
      header("Location: ./pages/user.php");
    } elseif($_SESSION['level'] == 'admin') {
      header("Location: ./pages/admin.php");
    } elseif($_SESSION['level'] == 'root') {
      header("Location: ./pages/root.php");
    }
  } else {
    // Login inválido, mostrar mensagem de erro
    $error_message = "Nome de usuário ou senha inválidos.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h1>Login</h1>
  <?php if(isset($error_message)) { ?>
  <p style="color: red;"><?php echo $error_message; ?></p>
  <?php } ?>
  <form action="" method="post">
    <label for="username">Nome de usuário:</label>
    <input type="text" name="username" id="username" required>
    <br>
    <label for="password">Senha:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <button type="submit">Entrar</button>
  </form>
</body>
</html>