let score = 0;
let clickValue = 1;
let clickMultiplier = 1;
let baseUpgradeCost = 0; // Coût de l'amélioration, récupéré depuis la base de données

const clickButton = document.getElementById("clickButton");
const resetButton = document.getElementById("resetButton");
const doubleButton = document.getElementById("doubleButton");
const scoreDisplay = document.getElementById("score");
const upgradeCostDisplay = document.getElementById("upgradeCost");

function incrementScore() {
    score += clickValue * clickMultiplier;
    scoreDisplay.textContent = "Score: " + score;
}

// Met à jour le coût de l'amélioration dans le bouton
function updateUpgradeCost(upgradeCost) {
    upgradeCostDisplay.textContent = upgradeCost + " score";
}

// Affiche ou masque le bouton d'amélioration en fonction du coût récupéré depuis la base de données
function toggleUpgradeButtonVisibility() {
    doubleButton.style.display = baseUpgradeCost > 0 ? "inline-block" : "none";
}

// Charge le coût de l'amélioration depuis la base de données
function fetchUpgradeCost() {
    fetch("upgrade_clic.php")
    .then(response => response.text())
    .then(data => {
        baseUpgradeCost = parseInt(data);
        updateUpgradeCost(baseUpgradeCost);
        toggleUpgradeButtonVisibility(); // Affiche ou masque le bouton en fonction du coût récupéré
    })
    .catch(error => {
        console.error("Error fetching upgrade cost:", error);
    });
}

clickButton.addEventListener("click", () => {
    score += clickValue * clickMultiplier;
    scoreDisplay.textContent = "Score: " + score;
});

resetButton.addEventListener("click", () => {
    score = 0;
    scoreDisplay.textContent = "Score: " + score;
});

doubleButton.addEventListener("click", () => {
    if (score >= baseUpgradeCost ){
        score -= baseUpgradeCost;
        clickMultiplier *= 2;
        baseUpgradeCost *= upgradeCostMultiplier; // Multiplie le coût de l'amélioration par le facteur d'augmentation
        updateUpgradeCost(baseUpgradeCost);
        toggleUpgradeButtonVisibility(); // Affiche ou masque le bouton en fonction du nouveau coût
    } else {
        alert("Vous n'avez pas assez de score pour doubler la production par clic !");
    }
});

setInterval(incrementScore, 1000);

// Appel initial pour récupérer le coût de l'amélioration depuis la base de données
fetchUpgradeCost();
