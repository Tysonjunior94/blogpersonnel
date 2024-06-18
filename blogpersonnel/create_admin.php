<?php
// Inclure le fichier de connexion à la base de données
include 'inc/connexion.php';

// Nom d'utilisateur et mot de passe pour l'administrateur
$username = "admin";
$password = "admin123";

// Préparer la requête SQL pour insérer le nouvel utilisateur
$sql = "INSERT INTO Utilisateur (NomUtilisateur, MotDePasse) VALUES (?, ?)";
$stmt = $pdo->prepare($sql);

// Exécuter la requête
try {
    $stmt->execute([$username, $password]);
    echo "Utilisateur administratif ajouté avec succès.";
} catch (PDOException $e) {
    echo "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage();
}
?>
