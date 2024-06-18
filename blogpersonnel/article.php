<?php
session_start();
include('inc/connexion.php');

// Vérification si l'ID de l'article est présent et est un nombre valide
$articleId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($articleId > 0) {
    // Préparation de la requête pour récupérer l'article
    $stmt = $pdo->prepare("SELECT * FROM Article WHERE ArticleID = ?");
    $stmt->execute([$articleId]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$article) {
        echo "<p>Article introuvable.</p>";
        exit;
    }

    // Préparation de la requête pour récupérer les commentaires de cet article
    $stmt = $pdo->prepare("SELECT AuteurCommentaire, ContenuCommentaire, DateCommentaire FROM Commentaire WHERE ArticleID = ? ORDER BY DateCommentaire DESC");
    $stmt->execute([$articleId]);
    $commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC);

} else {
    echo "<p>Identifiant d'article invalide.</p>";
    exit;
}

// Gestion de l'ajout de commentaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contenu_commentaire'])) {
    if (!isset($_SESSION['user_id'])) {
        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        header('Location: login.php');
        exit;
    }

    // Ajout du commentaire à la base de données
    $contenuCommentaire = $_POST['contenu_commentaire'];
    $stmt = $pdo->prepare("INSERT INTO Commentaire (ArticleID, AuteurCommentaire, ContenuCommentaire, DateCommentaire) VALUES (?, ?, ?, ?)");
    $stmt->execute([$articleId, $_SESSION['user_id'], $contenuCommentaire, date('Y-m-d H:i:s')]);

    // Rafraîchir la page pour montrer le nouveau commentaire
    header("Location: article.php?id=$articleId");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($article['Titre']); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1><?php echo htmlspecialchars($article['Titre']); ?></h1>
    <p>Date de publication: <?php echo date('d/m/Y', strtotime($article['DatePublication'])); ?></p>
    <div>
        <?php echo nl2br(htmlspecialchars($article['Contenu'])); ?>
    </div>

    <section>
        <h2>Commentaires</h2>
        <?php if (!empty($commentaires)): ?>
            <?php foreach ($commentaires as $commentaire): ?>
                <div class="comment">
                    <p><strong><?php echo htmlspecialchars($commentaire['AuteurCommentaire']); ?></strong> (<?php echo date('d/m/Y', strtotime($commentaire['DateCommentaire'])); ?>)</p>
                    <p><?php echo nl2br(htmlspecialchars($commentaire['ContenuCommentaire'])); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun commentaire pour cet article.</p>
        <?php endif; ?>

        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Formulaire pour ajouter un commentaire si connecté -->
            <form action="article.php?id=<?php echo $articleId; ?>" method="post">
                <textarea name="contenu_commentaire" required></textarea>
                <button type="submit">Ajouter un commentaire</button>
            </form>
        <?php else: ?>
            <p><a href="login.php">Connectez-vous</a> pour commenter cet article.</p>
        <?php endif; ?>
    </section>

    <a href="index.php">Retour à la liste des articles</a>
</body>
</html>
