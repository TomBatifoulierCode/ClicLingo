let score_update = './click_lingot/score_user.php';
let score_update_post = './click_lingot/update_score.php';

console.log("v 3.11");

const clickButton = document.getElementById("clickButton");
const scoreDisplay = document.getElementById("score");
let clickValue = 1;
let clickMultiplier = 1;
let score = 0; // Définir la variable score

// Fonction pour incrémenter le score
function incrementScore() {
    score += clickValue * clickMultiplier;
    scoreDisplay.textContent = "Score: " + score;
    updateScoreInDatabase(score);
}

// Ajouter un écouteur d'événement de clic
clickButton.addEventListener("click", incrementScore);

// Mettre à jour le score toutes les 5 secondes
setInterval(incrementScore, 5000);

// Fonction pour envoyer le score au serveur
function updateScoreInDatabase(score) {
    fetch(score_update_post, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'score=' + encodeURIComponent(score)
    })
    .then(response => response.text())
    .then(data => {
        console.log("Score mis à jour : " + data);
    })
    .catch(error => {
        console.error('Une erreur s\'est produite:', error);
    });
}

// Charger le score utilisateur depuis le serveur
fetch(score_update)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.text();
    })
    .then(data => {
        score = parseInt(data, 10);
        console.log("Le score est : " + score);
        scoreDisplay.textContent = "Score: " + score;
    })
    .catch(error => {
        console.error('Une erreur s\'est produite:', error);
    });
