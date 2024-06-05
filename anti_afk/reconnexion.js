var afk = 0;

function resetIdleTime() {
    afk = 1;
}

// Écoute les mouvements de la souris pour réinitialiser le compteur d'inactivité
document.addEventListener("mousemove", resetIdleTime);

// Écoute les clics de la souris pour réinitialiser le compteur d'inactivité
document.addEventListener("mousedown", resetIdleTime);

// Vérifie si l'utilisateur est AFK et redirige si nécessaire
setInterval(function() {
    if (afk === 1) {
        window.location.href = "../index.php";
    }
}, 1000); // Vérification toutes les secondes
