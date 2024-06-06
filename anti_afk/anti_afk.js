var idleTime = 0;

// Réinitialise le compteur de temps d'inactivité lorsque l'utilisateur est actif
function resetIdleTime() {
    idleTime = 0;
}

// Incrémente le compteur de temps d'inactivité toutes les secondes
setInterval(function() {
    idleTime++;
    if (idleTime > 180) { // Si l'utilisateur est inactif pendant plus de 5 secondes
        // Exécutez votre code pour traiter l'inactivité ici
        console.log("Utilisateur inactif depuis " + idleTime + ".");
        window.location.href = "./anti_afk/afk.php";
    }
}, 1000);

// Écoute les mouvements de la souris pour réinitialiser le compteur d'inactivité
document.addEventListener("mousemove", resetIdleTime);

// Écoute les clics de la souris pour réinitialiser le compteur d'inactivité
document.addEventListener("mousedown", resetIdleTime);
