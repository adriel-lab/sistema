<?php 
  include('../BD/conexao.php');
  session_start();
  
  if(!isset($_SESSION['username']) || $_SESSION['level'] !== 'admin') {
    header("Location: ../index.php");
    exit();

    
  }

// Verifica se o usuário logado é o próprio administrador
$self_edit = false;
if(isset($_GET['username']) && $_GET['username'] === $_SESSION['username']) {
  $self_edit = true;
}

// Obtém os dados do perfil do administrador
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Administrador</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>

 

    <div class="container">
    <h1 class="mt-4">Administrador</h1>
      <p>Bem-vindo, <?= $_SESSION['username'] ?>!</p>
      <p>Você tem acesso de administrador.</p>
      <a href="../logout.php">Sair</a>

      <button id="editar-perfil">Editar perfil</button>

      <div id="modal-editar-perfil" style="display:none;">
      <form method="post" action="atualizar_perfil.php">
        <label for="nome">Username:</label>
        <input type="text" name="username" value="<?php echo $row['username']; ?>">
        <br>
        <label for="password">Senha:</label>
        <input type="text" name="password" value="<?php echo $row['password']; ?>">
        <br>
        <input type="submit" value="Salvar">
      </form>
    </div>
    
    <a href="index.php">Voltar para a página inicial</a>

      <h2 class="mt-4">Cadastrar Usuário</h2>
      <form action="register_user.php" method="post">
    <div class="form-group">
        <label for="username">Nome de Usuário:</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Senha:</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="form-group">
        <label for="cpf">CPF:</label>
        <input type="text" class="form-control" id="cpf" name="cpf" required>
    </div>
    <div class="form-group">
        <label for="birthdate">Data de Nascimento:</label>
        <input type="date" class="form-control" id="birthdate" name="birthdate" required>
    </div>
    <div class="form-group">
        <label for="baptismdate">Data de Batismo:</label>
        <input type="date" class="form-control" id="baptismdate" name="baptismdate" required>
    </div>
    <div class="form-group">
        <label for="fathername">Nome do Pai:</label>
        <input type="text" class="form-control" id="fathername" name="fathername" required>
    </div>
    <div class="form-group">
        <label for="mothername">Nome da Mãe:</label>
        <input type="text" class="form-control" id="mothername" name="mothername" required>
    </div>
    <div class="form-group">
        <label for="congregation">Comum Congregação:</label>
        <input type="text" class="form-control" id="congregation" name="congregation" required>
    </div>
    <div class="form-group">
        <label for="phone">Telefone:</label>
        <input type="text" class="form-control" id="phone" name="phone" required>
    </div>
    <div class="form-group">
        <label for="gender">Sexo:</label>
        <select class="form-control" id="gender" name="gender" required>
            <option value="">Selecione o Sexo</option>
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
        </select>
    </div>
    <input type="hidden" name="level" value="user">
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form> 

  <h2 class="mt-4">Usuários Cadastrados</h2>
  <?php
  $sql = "SELECT * FROM users WHERE level='user'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "<table class='table'><tr><th>ID</th><th>Nome de Usuário</th><th>CPF</th><th>Data de Nascimento</th><th>Data de Batismo</th><th>Nome do Pai</th><th>Nome da Mãe</th><th>Comum de Congregação</th><th>Telefone</th><th>Gênero</th><th>Ações</th></tr>";
    while($row = $result->fetch_assoc()) {
      $id = $row["id"];
      $username = $row["username"];
      $cpf = $row["cpf"];
      $birthdate = $row["birthdate"];
      $baptismdate = $row["baptismdate"];
      $fathername = $row["fathername"];
      $mothername = $row["mothername"];
      $congregation = $row["congregation"];
      $phone = $row["phone"];
      $gender = $row["gender"];
      echo "<tr><td>$id</td><td>$username</td><td>$cpf</td><td>$birthdate</td><td>$baptismdate</td><td>$fathername</td><td>$mothername</td><td>$congregation</td><td>$phone</td><td>$gender</td>";
      echo "<td><a href='delete_user.php?id=$id'>Excluir</a> | ";
      echo "<a href='edit_user_admin.php?id=$id'>Editar</a></td></tr>";
    }
    echo "</table>";
  } else {
    echo "Não há usuários cadastrados.";
  }

  $conn->close();
?>
</div>


   
    
    
    
    
    
    <script>
      const btnEditarPerfil = document.getElementById('editar-perfil');
      const modalEditarPerfil = document.getElementById('modal-editar-perfil');
      
      btnEditarPerfil.addEventListener('click', function() {
        modalEditarPerfil.style.display = 'block';
      });
    </script>
 


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>