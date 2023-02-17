<?php  
require_once('../BD/conexao.php');
session_start();
if(!isset($_SESSION['username']) || $_SESSION['level'] != 'root') {
  header("Location: ../index.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Root</title>
</head>
<body>
  <h1>Root</h1>
  <p>Bem-vindo, <?php echo $_SESSION['username']; ?>!</p>
  <p>Você tem acesso de root.</p>
  <a href="../logout.php">Sair</a>

  <h2>Cadastrar Usuário</h2>
  <form action="register_user.php" method="post">
    <label for="username">Nome de Usuário:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Senha:</label>
    <input type="password" id="password" name="password" required><br><br>
    <label for="level">Nível de Acesso:</label>
    <select id="level" name="level">
      <option value="user">User</option>
      <option value="admin">Admin</option>
    </select><br><br>
    <input type="submit" value="Cadastrar">
  </form>

  <h2>Usuários Cadastrados</h2>
  <?php
    $sql = "SELECT id, username, level FROM users";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo "<table><tr><th>ID</th><th>Nome de Usuário</th><th>Nível de Acesso</th><th>Ações</th></tr>";
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["username"]. "</td><td>" . $row["level"]. "</td><td><a href='delete_user.php?id=" . $row["id"] . "'>Excluir</a> | <a href='edit_user.php?id=" . $row["id"] . "'>Editar</a></td></tr>";
      }
      echo "</table>";
    } else {
      echo "Não há usuários cadastrados.";
    }
  ?>

  <h2>Notícias</h2>
  <?php
    $sql = "SELECT title, content, author, date FROM news ORDER BY id DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<h3>" . $row["title"] . "</h3>";
        echo "<p>" . $row["content"] . "</p>";
        echo "<p><i>Publicado por " . $row["author"] . " em " . $row["date"] . "</i></p>";
      }
    } else {
      echo "Não há notícias para exibir.";
    }
  ?>

<h2>Adicionar Notícia</h2>
<form action="process_news.php" method="POST">
  <label for="titulo">Título:</label>
  <input type="text" id="titulo" name="titulo" required><br>
<label for="data">Data:</label>
<input type="date" id="data" name="data" required><br>

<label for="autor">Autor:</label>
<input type="text" id="autor" name="autor" required><br>

<label for="conteudo">Conteúdo:</label>

  <textarea id="conteudo" name="conteudo" required></textarea><br>
  <input type="submit" name="submit" value="Adicionar Notícia">
</form>
</body>
</html>