<?php
session_start();
include('../BD/conexao.php');

$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];
$cpf = $_POST['cpf'];
$birthdate = $_POST['birthdate'];
$baptismdate = $_POST['baptismdate'];
$fathername = $_POST['fathername'];
$mothername = $_POST['mothername'];
$congregation = $_POST['congregation'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];

$sql = "INSERT INTO users (username, password, level, cpf, birthdate, baptismdate, fathername, mothername, congregation, phone, gender) 
VALUES ('$username', '$password', '$level', '$cpf', '$birthdate', '$baptismdate', '$fathername', '$mothername', '$congregation', '$phone', '$gender')";

if ($conn->query($sql) === TRUE) {
  header("Location: admin.php");
  exit();
} else {
  echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>