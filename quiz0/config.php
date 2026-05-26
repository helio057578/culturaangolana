<?php
// config.php

$host = "localhost";
$user = "root";   // padrão do XAMPP
$pass = "";       // sem senha por padrão
$db   = "quiz_angola3"; // nome do banco que criaste

// Tentar conectar ao banco de dados MySQL
$conn = new mysqli($host, $user, $pass, $db);

// Verificar a conexão
if($conn->connect_error){
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Opcional: Definir o charset para UTF-8 para evitar problemas com acentuação
$conn->set_charset("utf8mb4");

// Esta conexão ($conn) será usada em outros scripts PHP
?>