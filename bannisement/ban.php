<?php 
   
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



    $sql = "SELECT ban_until FROM eleves WHERE id = $user_id";
    $resultat = $connexion->query($sql);
    
    if ($resultat->num_rows > 0) {
        $ligne = $resultat->fetch_assoc();
        $ban_until = $ligne['ban_until'];
    
        if ($ban_until !== NULL && strtotime($ban_until) > time()) {
            die("Vous êtes banni jusqu'au " . date('d-m-Y H:i:s', strtotime($ban_until)));
        }
    }
    
    $connexion->close();


?>