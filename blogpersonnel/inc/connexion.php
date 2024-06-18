<?php
// inc/connexion.php
$host = 'mysql-lassalle.alwaysdata.net';
$dbname = 'lassalle_blog_personnel';
$username = 'lassalle';
$password = 'Florianboss94';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
