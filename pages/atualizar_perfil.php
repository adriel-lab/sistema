<?php
  include('../BD/conexao.php');
  session_start();

  if(!isset($_SESSION['username']) || $_SESSION['level'] !== 'admin') {
    header("Location: ../index.php");
    exit();
  }
  
  // Obtém as informações do formulário
  $username = $_SESSION['username'];
  $nome = mysqli_real_escape_string($conn, $_POST['username']);
  $senha = mysqli_real_escape_string($conn, $_POST['password']);
  
  // Atualiza o perfil do administrador no banco de dados
  $query = "UPDATE users SET username = '$nome', password = '$senha' WHERE username = '$username'";
  $result = mysqli_query($conn, $query);
  
  if($result) {
    echo "<script>alert('Perfil atualizado com sucesso!')</script>";
    echo "<script>window.location = 'admin.php?username=$username'</script>";
  } else {
    echo "<script>alert('Erro ao atualizar o perfil!')</script>";
    echo "<script>window.location = 'editar_perfil.php?username=$username'</script>";
  }
?>