
// Menu Burger

// Sélection des éléments
const logoBurger = document.getElementById('logoBurger'); // Logo 
const menuBurger = document.querySelector('.burger'); // Menu

// Fonction pour ouvrir/fermer le menu
logoBurger.addEventListener('click', function(event) { // Au clic sur le logo
    menuBurger.classList.toggle('active');  // Ajouter ou retirer la classe active
    logoBurger.classList.toggle('active'); // Ajouter ou retirer la classe active

    // Appliquer une rotation à chaque clic
    let rotationAngle = logoBurger.classList.contains('active') ? 360 : 0; // Si la classe active est présente, rotation de 360° sinon 0°
    logoBurger.style.transition = "transform 0.8s"; // Animation de la rotation
    logoBurger.style.transform = `rotate(${rotationAngle}deg)`; // Rotation

    // Empêcher la propagation pour éviter la fermeture immédiate
    event.stopPropagation();
});

// Fermer le menu si on clique en dehors
document.addEventListener('click', function(event) { // Au clic sur le document
    if (!menuBurger.contains(event.target) && !logoBurger.contains(event.target)) { // Si on ne clique pas sur le menu ni sur le logo
        menuBurger.classList.remove('active'); // Retirer la classe active
        logoBurger.classList.remove('active'); // Retirer la classe active
        
        // Réinitialiser la rotation
        logoBurger.style.transition = "transform 0.8s"; // Animation de la rotation
        logoBurger.style.transform = "rotate(0deg)"; // Rotation
    }
});


