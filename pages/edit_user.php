<?php  
include('../BD/conexao.php');
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
    $cpf = $row['cpf'];
    $birthdate = $row['birthdate'];
    $baptismdate = $row['baptismdate'];
    $fathername = $row['fathername'];
    $mothername = $row['mothername'];
    $congregation = $row['congregation'];
    $phone = $row['phone'];
    $gender = $row['gender'];
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
  $new_cpf = $_POST['cpf'];
  $new_birthdate = $_POST['birthdate'];
  $new_baptismdate = $_POST['baptismdate'];
  $new_fathername = $_POST['fathername'];
  $new_mothername = $_POST['mothername'];
  $new_congregation = $_POST['congregation'];
  $new_phone = $_POST['phone'];
  $new_gender = $_POST['gender'];

  $sql = "UPDATE users SET 
          username='$new_username', 
          password='$new_email', 
          level='$new_level', 
          cpf='$new_cpf', 
          birthdate='$new_birthdate', 
          baptismdate='$new_baptismdate', 
          fathername='$new_fathername', 
          mothername='$new_mothername', 
          congregation='$new_congregation', 
          phone='$new_phone', 
          gender='$new_gender'
          WHERE id=$id";

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

<label for="cpf">CPF:</label>
<input type="text" id="cpf" name="cpf" value="<?php echo $cpf; ?>"><br>

<label for="birthdate">Data de Nascimento:</label>
<input type="text" id="birthdate" name="birthdate" value="<?php echo $birthdate; ?>"><br>

<label for="baptismdate">Data de Batismo:</label>
<input type="text" id="baptismdate" name="baptismdate" value="<?php echo $baptismdate; ?>"><br>

<label for="fathername">Nome do Pai:</label>
<input type="text" id="fathername" name="fathername" value="<?php echo $fathername; ?>"><br>

<label for="mothername">Nome da Mãe:</label>
<input type="text" id="mothername" name="mothername" value="<?php echo $mothername; ?>"><br>

<label for="congregation">Congregação:</label>
<input type="text" id="congregation" name="congregation" value="<?php echo $congregation; ?>"><br>

<label for="phone">Telefone:</label>
<input type="text" id="phone" name="phone" value="<?php echo $phone; ?>"><br>

<label for="gender">Gênero:</label>
<select id="gender" name="gender">
<option value="Masculino" <?php if($gender == 'Masculino') echo 'selected'; ?>>Masculino</option>
<option value="Feminino" <?php if($gender == 'Feminino') echo 'selected'; ?>>Feminino</option>
<option value="Outro" <?php if($gender == 'Outro') echo 'selected'; ?>>Outro</option>
</select><br>

  <input type="submit" name="submit" value="Atualizar">
</form>
</body>
</html> 