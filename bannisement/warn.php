<?php 
    include '../database_config.php';

    $serveur = DB_HOST;
    $utilisateur = DB_USER;
    $mot_de_passe = DB_PASS;
    $nom_base_de_données = DB_NAME;

    $connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $nom_base_de_données);

    // Vérifier la connexion
    if ($connexion->connect_error) {
        die("La connexion a échoué : " . $connexion->connect_error);
    }

    // Récupérer l'ID de l'utilisateur à partir du cookie
    $user_id = $_COOKIE['user_eleves'];

    // Récupérer les informations de l'utilisateur à partir de la base de données
    $sql = "SELECT * FROM eleves WHERE id = $user_id";
    $resultat = $connexion->query($sql);

    if ($resultat->num_rows > 0) {
        $ligne = $resultat->fetch_assoc();
        
        $actu_warn = $ligne['warn'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- cette page est temporaire -->
    <h1>Auto-click à était détecter.</h1>
    <h3>Notre anti-cheat vous a détecter en train d'utiliser un auto-click, se qui est strictement interdit sur clickLingot.</h3>
    <p>Votre score à donc été réintialisé, vous avez donc 0 de click lingot. De plus votre enseignant à était prévenue que vous aviez tricher.</p>
    <p>C'est votre <?php echo $actu_warn ?> avertissement.</p><br>
    <p>Au 3ème avertissement vous serez banni pendant 10 jours.</p>
    <p>Au 4ème avertissement vous serez banni pendant 1 mois.</p>
    <p>Au 5ème avertissement vous serez banni définitivement de ClickLino.</p>
</body>
</html>