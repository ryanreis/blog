<?php
$host = 'db4free.net';
$db   = 'blog123456789';
$user = 'ryanzada';
$pass = 'ryanzada2007';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conectado via PDO!";
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>