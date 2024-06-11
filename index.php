<?php

     if (!isset($_COOKIE['user_id'])) {
        header("Location: ./user/inscription.php");
        exit;
    } else if (!isset($_COOKIE['user_eleves'])) {
        header("Location: ./user/inscription.php");
        exit;
    } else {

    }
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
    <script src="./click_lingot/generate.js"></script>
    <script src="anti_afk/anti_afk.js"></script>
    <script>console.log("v2.2");</script>
</body>
</html>

<?php 
    include 'back/back_ip.php';   
?>
