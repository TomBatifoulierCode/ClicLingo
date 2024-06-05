<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - LunePage</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,500&family=Rubik:wght@500&family=Wendy+One&display=swap');

        body {
            background: linear-gradient(to right, #253493, #4534dc);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .register_submite {
            width: 140px;
            height: 45px;
            font-family: 'Rubik', sans-serif;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            font-weight: 500;
            color: #000;
            background-color: white;
            border: none;
            border-radius: 45px;
            box-shadow: 0px 8px 15px;
            cursor: pointer;
            outline: none;
            transition: all 0.3s ease 0s;
            justify-content: center;
            align-items: center;
        }

        .register_submite:hover {
            background-color: white;
            box-shadow: 0px 15px 20px;
            transform: translateY(-7px);
        }

        .container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 500px;
            align-items: center;
            justify-content: center;
        }

        .wrapper1 {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .step {
            display: none;
        }

        .active {
            display: block;
        }

        .input-groupe {
            font-size: 1.25rem;
            position: relative;
            --primary: #2196f3;
        }

        .input {
            all: unset;
            color: black;
            padding: 1rem;
            border: 1px solid #9e9e9e;
            border-radius: 10px;
            transition: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            font-family: 'Kanit';
            width: 460px;
        }

        .label {
            position: absolute;
            top: 1rem;
            left: 1rem;
            color: #d4d4d4;
            pointer-events: none;
            transition: 150ms cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input:focus {
            border: 1px solid var(--primary);
        }

        .input:is(:focus, :valid) ~ label {
            transform: translateY(-120%) scale(0.7);
            background-color: white;
            padding-inline: 0.3rem;
            color: var(--primary);
        }

        .title {
            text-align: center;
            font-family: 'Kanit';
        }

        .error-msg {
            color: red;
            text-align: center;
            font-family: 'Rubik', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php

        require_once '../database_config.php';
 
        session_start();



        if (isset($_COOKIE['user_id'])) {
            header("Location: ../index.php");
            exit;
        }

        $error_msg = "";

        $servername = DB_HOST;
        $username = DB_USER;
        $password = DB_PASS;
        $dbname = DB_NAME;

        try {
            $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                include 'back_login.php';
            }
        } catch (PDOException $e) {
            error_log("Erreur : " . $e->getMessage());
            $error_msg = "Une erreur est survenue. Veuillez réessayer ultérieurement. Erreur: " . $e->getMessage();
        }
        ?>

        <form method="POST" action="">
            <h1 class="title">Connexion</h1>
            <div class="input-groupe">
                <input class="input" required type="text" id="email" name="email">
                <label class="label" for="email">Adresse mail</label>
            </div>
            <br>
            <div class="input-groupe">
                <input class="input" required type="password" id="password" name="password">
                <label class="label" for="password">Mot de passe</label>
            </div>
            <br>
            <div class="wrapper1">
                <button name="okk" class="register_submite">Se connecter</button>
            </div>
        </form>
        <?php
        if ($error_msg) {
            echo "<p class=\"error-msg\">" . htmlspecialchars($error_msg) . "</p>";
        }
        ?>
    </div>
</body>
</html>


