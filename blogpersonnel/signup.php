<?php
session_start();
include('inc/connexion.php');
// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hashage du mot de passe
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Tentative d'insertion de l'utilisateur dans la base de données
    $stmt = $pdo->prepare("INSERT INTO Utilisateur (NomUtilisateur, MotDePasse) VALUES (?, ?)");
    if ($stmt->execute([$username, $passwordHash])) {
        echo "Utilisateur enregistré avec succès.";
        // Connecte l'utilisateur directement et redirige vers la page principale
        $_SESSION['user_id'] = $pdo->lastInsertId();
        header('Location: index.php');
        exit;
    } else {
        echo "Erreur lors de l'enregistrement. Peut-être que le nom d'utilisateur existe déjà.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Inscription</h1>
    <form action="signup.php" method="post">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
