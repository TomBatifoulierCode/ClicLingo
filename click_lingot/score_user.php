<?php

include '../database_config.php';

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

$user_id = intval($_COOKIE['user_eleves']);

// Récupérer le score de l'utilisateur dans la base de données
$sql = "SELECT score FROM eleves WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['score'];
} else {
    echo "0";
}

// Fermer la connexion
$conn->close();
?>
