<?php

require_once 'database_config.php';

// Connexion à la base de données
$servername = DB_HOST;
$username = DB_USER;
$password = DB_PASS;
$dbname = DB_NAME1;

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer le coût de l'amélioration depuis la base de données
$sql = "SELECT cost FROM upgrades_clic ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $upgradeCost = $row["cost"];
} else {
    $upgradeCost = 0; // Valeur par défaut si aucune amélioration n'est enregistrée
}

// Fermer la connexion
$conn->close();

// Retourner le coût de l'amélioration


?>
