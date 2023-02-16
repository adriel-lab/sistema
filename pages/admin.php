<?php  include('../BD/conexao.php');
 ?>

<?php
session_start();

if(isset($_SESSION['username']) && $_SESSION['level'] == 'admin') {
  // Usuário já está logado e tem acesso de administrador
} else {
  // Usuário não está logado ou não tem acesso, redirecionar para a página de login
  header("Location: ../index.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Administrador</title>
</head>
<body>
  <h1>Administrador</h1>
  <p>Bem-vindo, <?php echo $_SESSION['username']; ?>!</p>
  <p>Você tem acesso de administrador.</p>
  <a href="../logout.php">Sair</a>

  <h2>Cadastrar Usuário</h2>
<form action="register_user.php" method="post">
  <label for="username">Nome de Usuário:</label>
  <input type="text" id="username" name="username" required><br><br>
  
  <label for="password">Senha:</label>
  <input type="password" id="password" name="password" required><br><br>
  
  <input type="hidden" name="level" value="user">
  
  <input type="submit" value="Cadastrar">
</form>

<h2>Usuários Cadastrados</h2>
<?php
$sql = "SELECT * FROM users WHERE level='user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>ID</th><th>Nome de Usuário</th><th>Ações</th></tr>";
  
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["username"]. "</td><td><a href='delete_user.php?id=" . $row["id"] . "'>Excluir</a></td></tr>" . "</td><td><a href='edit_user_admin.php?id=" . $row["id"] . "'>Editar</a></td></tr>";
  }
  
  echo "</table>";
} else {
  echo "Não há usuários cadastrados.";
}

$conn->close();
?>



</body>
</html>