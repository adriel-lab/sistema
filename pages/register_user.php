<?php
session_start();
include('../BD/conexao.php');


$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];

$sql = "INSERT INTO users (username, password, level) VALUES ('$username', '$password', '$level')";

if ($conn->query($sql) === TRUE) {
  header("Location: admin.php");
  
  exit();
} else {
  echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>