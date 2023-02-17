<?php
// Conecta ao banco de dados
include('../BD/conexao.php');

// Checa se a conexão foi bem sucedida
if (!$conn) {
	die("Conexão falhou: " . mysqli_connect_error());
}

// Coleta as informações do formulário
$titulo = $_POST['titulo'];
$data = $_POST['data'];
$autor = $_POST['autor'];
$conteudo = $_POST['conteudo'];

// Insere a notícia no banco de dados
$sql = "INSERT INTO news (title, date, author, content) VALUES ('$titulo', '$data', '$autor', '$conteudo')";

if (mysqli_query($conn, $sql)) {
	echo "Notícia adicionada com sucesso!";
    header("Location: root.php");
} else {
	echo "Erro ao adicionar notícia: " . mysqli_error($conn);
}

mysqli_close($conn);
?>