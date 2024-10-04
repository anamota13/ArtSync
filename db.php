<?php
// Configurações do banco de dados
$servername = "localhost"; 
$username = "root";        
$password = "lauanafatec";    
$dbname = "artsync";  

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
