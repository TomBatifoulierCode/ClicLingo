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

if (!isset($_POST['score'])) {
    die("Score not provided.");
}

$user_id = intval($_COOKIE['user_eleves']);
$score = intval($_POST['score']);

// Préparer et lier la requête
$stmt = $conn->prepare("UPDATE eleves SET score = ? WHERE id = ?");
$stmt->bind_param("ii", $score, $user_id);

if ($stmt->execute()) {
    echo "Score mis à jour avec succès";
} else {
    echo "Erreur de mise à jour du score: " . $stmt->error;
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>
