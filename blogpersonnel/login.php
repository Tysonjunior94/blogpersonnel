<?php
session_start();
include('inc/connexion.php');  // Assure-toi que ce chemin vers ton fichier de connexion est correct.

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT UtilisateurID, MotDePasse FROM Utilisateur WHERE NomUtilisateur = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['MotDePasse'])) {
        $_SESSION['user_id'] = $user['UtilisateurID'];
        header('Location: index.php');  // ou autre page sécurisée
        exit;
    } else {
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Connexion</h1>
    <form action="login.php" method="post">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Connexion</button>
    </form>
    <?php if (!empty($error_message)) { echo "<p>$error_message</p>"; } ?>
    <p>Si vous n'avez pas de compte, <a href="signup.php">inscrivez-vous ici</a>.</p>
</body>
</html>
