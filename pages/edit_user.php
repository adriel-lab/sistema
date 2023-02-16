<?php  include('../BD/conexao.php');
 ?>

<?php

session_start();


if(isset($_SESSION['username'])) {
  // Usuário já está logado
} else {
  // Usuário não está logado, redirecionar para a página de login
  header("Location: ../index.php");
  exit();
}

if(isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "SELECT * FROM users WHERE id=$id";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $email = $row['password'];
    $level = $row['level'];
  } else {
    echo "Usuário não encontrado.";
    exit();
  }
} else {
  echo "ID do usuário não especificado.";
  exit();
}

if(isset($_POST['submit'])) {
  $new_username = $_POST['username'];
  $new_email = $_POST['email'];
  $new_level = $_POST['level'];

  $sql = "UPDATE users SET username='$new_username', password='$new_email', level='$new_level' WHERE id=$id";

  if ($conn->query($sql) === TRUE) {
    echo "Informações do usuário atualizadas com sucesso.";
    header("Location: root.php");
  } else {
    echo "Erro ao atualizar informações do usuário: " . $conn->error;
  }

  $conn->close();
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Editar Usuário</title>
</head>
<body>

<h1>Editar Usuário</h1>

<form method="post">
  <label for="username">Nome de Usuário:</label>
  <input type="text" id="username" name="username" value="<?php echo $username; ?>"><br>

  <label for="email">Senha</label>
  <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br>

  <label for="level">Nível de Acesso:</label>
  <select id="level" name="level">
    <option value="user" <?php if($level == 'user') echo 'selected'; ?>>Usuário</option>
    <option value="admin" <?php if($level == 'admin') echo 'selected'; ?>>Administrador</option>
    <option value="root" <?php if($level == 'root') echo 'selected'; ?>>Root</option>
  </select><br>

  <input type="submit" name="submit" value="Atualizar">
</form>

</body>
</html>