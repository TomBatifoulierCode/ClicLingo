<?php 

include '../database_config.php';

// Connexion à la base de données (assurez-vous de remplacer les valeurs par les vôtres)
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

    // Mettre à jour les colonnes warn et score de l'utilisateur
    $nouveau_warn = $ligne['warn'] + 1;
    $nouveau_score = 0;

    $ban_until = NULL;
    if ($nouveau_warn == 3) {
        $ban_until = date('Y-m-d H:i:s', strtotime('10 days'));
    } elseif ($nouveau_warn == 4) {
        $ban_until = date('Y-m-d H:i:s', strtotime('+1 month'));
    }

    // Mettre à jour la base de données avec les nouvelles valeurs de warn et score
    $sql_update = "UPDATE eleves SET warn = $nouveau_warn, score = $nouveau_score";
    if ($ban_until !== NULL) {
        $sql_update .= ", ban_until = '$ban_until'";
    }
    $sql_update .= " WHERE id = $user_id";

    if ($connexion->query($sql_update) === TRUE) {
        // Rediriger l'utilisateur vers une autre page ou afficher un message de confirmation
        //echo "Nous nous avons donc retirer 5000 click lingot pour le nom respect du règlement.";
        header("Location: ./warn.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de la base de données : " . $connexion->error;
    }
} else {
    echo "Aucun utilisateur trouvé avec cet ID.";
}

// Fermer la connexion à la base de données
$connexion->close();
?>
