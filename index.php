<?php

     if (!isset($_COOKIE['user_id'])) {
        header("Location: ./user/inscription.php");
        exit;
    } else if (!isset($_COOKIE['user_eleves'])) {
        header("Location: ./user/inscription.php");
        exit;
    } else {

    }

    include './database_config.php';

    include './bannisement/ban.php';

    // Connexion à la base de données
    $servername = DB_HOST;
    $username = DB_USER;
    $password = DB_PASS;
    $dbname = DB_NAME;

    // Créer la connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Vérifier que les données nécessaires sont présentes
    if (!isset($_COOKIE['user_eleves'])) {
        die("User not authenticated.");
    }
    
    if (isset($_COOKIE['user_id'])) {
        // Récupérer l'identifiant utilisateur à partir du cookie
        $user_id = $_COOKIE['user_eleves'];
    
        // Préparer la requête SQL pour récupérer la colonne 'warn'
        $sql = "SELECT warn FROM eleves WHERE id = ?";
        
        // Préparer et lier
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $user_id);
            
            // Exécuter la requête SQL
            $stmt->execute();
            
            // Obtenir le résultat
            $result = $stmt->get_result();
            
            // Stocker le contenu de la colonne 'warn' dans la variable $ban
            if ($row = $result->fetch_assoc()) {
                $ban = $row['warn'];
                if ($ban > 4) {
                    header("Location: ./bannisement/Ban_perm.php");
                    exit;
                } else {

                }
                //echo "La valeur de warn est : $ban";
            } else {
                //echo "Aucun résultat trouvé pour l'utilisateur avec l'ID : $user_id";
            }
    
            // Fermer la déclaration
            $stmt->close();
        } else {
            //echo "Erreur lors de la préparation de la requête : " . $conn->error;
        }
    } else {
        //echo "Le cookie 'user_id' n'est pas défini.";
    }

    $conn->close();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clicker Game</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <main class="container">
        <section class="upgrades">
            <h2>UPGRADES</h2>
            <!-- Ajouter des options d'amélioration ici -->
        </section>
        <section class="clicker">
            <img src="./img/cl-logo-v1-removebg-preview.png" alt="Logo">
            <h2>Clicker</h2>
            <h3 id="score"></h3>
            <div id="clickButton" class="transparent-rectangle">
                <img id="myImage" src="./img/cl_ingot_clicker.png" alt="Image à cliquer" width="200">
            </div>
        </section>
        <section class="buildings">
            <h2>CONSTRUCTIONS</h2>
            <!-- Ajouter des options de construction ici -->
        </section>
    </main>
    <script src="./back/anti-cheat/anti-autoclick.js"></script>
    <script src="./click_lingot/generate.js"></script>
    <script src="anti_afk/anti_afk.js"></script>
    <script>console.log("v2.3");</script>
</body>
</html>

<?php 
    include 'back/back_ip.php';   
?>
