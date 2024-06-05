<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Enseignant</title>
</head>
<body>
    <h2>Inscription Enseignant</h2>
    <form action="inscription_enseignants_traitement.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="prenom">Prenom :</label>
        <input type="text" id="prenom" name="prenom" required><br><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="num">Numéro de téléphone :</label>
        <input type="text" id="num" name="num" required><br><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>

        <label for="etablissement">Etablissement :</label>
        <input type="text" id="etablissement" name="etablissement" required><br><br>

        <label for="nombre_eleves">Nombre d'élèves :</label>
        <input type="number" id="nombre_eleves" name="nombre_eleves" required><br><br>


        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
