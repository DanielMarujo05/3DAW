<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'viagens';

// Conectar ao banco de dados
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
