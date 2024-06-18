<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include('inc/connexion.php');

// Vérification des identifiants de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT UtilisateurID, MotDePasse FROM Utilisateur WHERE NomUtilisateur = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['MotDePasse'])) {
        $_SESSION['is_admin'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

// Gérer la déconnexion
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    unset($_SESSION['is_admin']);
    session_destroy();
    header('Location: index.php');
    exit;
}

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Connexion Admin</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h1>Connexion Administration</h1>
        <?php if (isset($error_message)) echo "<p>$error_message</p>"; ?>
        <form action="admin.php" method="post">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Connexion">
        </form>
    </body>
    </html>
    <?php
    exit;
}

$message = '';
$articleId = isset($_GET['edit']) ? (int) $_GET['edit'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $datePublication = date('Y-m-d');

    if (empty($articleId)) {
        // Ajout d'un nouvel article
        $sql = "INSERT INTO Article (Titre, Contenu, DatePublication) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$titre, $contenu, $datePublication])) {
            $message = 'Article ajouté avec succès.';
        }
    } else {
        // Mise à jour d'un article existant
        $sql = "UPDATE Article SET Titre = ?, Contenu = ?, DatePublication = ? WHERE ArticleID = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$titre, $contenu, $datePublication, $articleId])) {
            $message = 'Article mis à jour avec succès.';
        }
    }
}

if ($articleId > 0) {
    // Chargement de l'article à modifier
    $sql = "SELECT * FROM Article WHERE ArticleID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$articleId]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Suppression d'un article
if (isset($_GET['delete'])) {
    $deleteId = (int) $_GET['delete'];
    $sql = "DELETE FROM Article WHERE ArticleID = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$deleteId])) {
        $message = 'Article supprimé avec succès.';
    }
}

// Récupération de tous les articles
$sql = "SELECT * FROM Article";
$articles = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration du Blog</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Administration du Blog</h1>
    <nav>
        <a href="index.php">Page d'accueil</a>
        <a href="admin.php?action=logout">Déconnexion</a>
    </nav>
    <?php if ($message) echo "<p>$message</p>"; ?>
    <form action="admin.php<?php if ($articleId) echo "?edit=$articleId"; ?>" method="post">
        <input type="text" name="titre" placeholder="Titre de l'article" value="<?php echo isset($article) ? $article['Titre'] : ''; ?>" required>
        <textarea name="contenu" placeholder="Contenu de l'article" required><?php echo isset($article) ? $article['Contenu'] : ''; ?></textarea>
        <input type="submit" value="Sauvegarder">
    </form>

    <table>
        <tr>
            <th>Titre</th>
            <th>Date de Publication</th>
            <th>Actions</th>
        </tr>
        <?php while ($article = $articles->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($article['Titre']); ?></td>
                <td><?php echo htmlspecialchars($article['DatePublication']); ?></td>
                <td>
                    <a href="admin.php?edit=<?php echo $article['ArticleID']; ?>">Modifier</a>
                    <a href="admin.php?delete=<?php echo $article['ArticleID']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article?');">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
