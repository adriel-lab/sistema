<?php
session_start();

if(isset($_SESSION['username']) && $_SESSION['level'] == 'user') {
  // Usuário já está logado e tem acesso de usuário base
} else {
  // Usuário não está logado ou não tem acesso, redirecionar para a página de login
  header("Location: ../index.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Usuário Base</title>
</head>
<body>
  <h1>Usuário Base</h1>
  <p>Bem-vindo, <?php echo $_SESSION['username']; ?>!</p>
  <p>Você tem acesso de usuário base.</p>
  <a href="../logout.php">Sair</a>
</body>
</html>