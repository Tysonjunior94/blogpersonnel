<?php
include 'inc/connexion.php';
$sql = "SELECT ArticleID, Titre, DatePublication FROM Article ORDER BY DatePublication DESC";
$articles = $pdo->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Mon Blog Personnel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Mon Blog Personnel</h1>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="admin.php">Admin</a>
        </nav>
    </header>
    <main>
        <?php
        if ($articles) {
            while ($article = $articles->fetch(PDO::FETCH_ASSOC)) {
                echo "<article>";
                echo "<h2><a href='article.php?id=" . $article['ArticleID'] . "'>" . htmlspecialchars($article['Titre']) . "</a></h2>";
                echo "<p>Publié le: " . date('d/m/Y', strtotime($article['DatePublication'])) . "</p>";
                echo "</article>";
            }
        } else {
            echo "<p>Aucun article trouvé.</p>";
        }
        ?>
    </main>
    <footer>
        <p>© 2024 Mon Blog Personnel. Tous droits réservés.</p>
    </footer>
</body>
</html>
