<?php
session_start();
include('../BD/conexao.php');


$id = $_GET['id'];

$sql = "DELETE FROM users WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  header("Location: admin.php");
  exit();
} else {
  echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>