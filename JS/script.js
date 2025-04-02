
// Menu Burger

// Sélection des éléments
const logoBurger = document.getElementById('logoBurger');
const menuBurger = document.querySelector('.burger');

// Fonction pour ouvrir/fermer le menu
logoBurger.addEventListener('click', function(event) { 
    menuBurger.classList.toggle('active');  
    logoBurger.classList.toggle('active');

    // Appliquer une rotation à chaque clic
    let rotationAngle = logoBurger.classList.contains('active') ? 360 : 0; 
    logoBurger.style.transition = "transform 0.8s"; 
    logoBurger.style.transform = `rotate(${rotationAngle}deg)`; 

    // Empêcher la propagation pour éviter la fermeture immédiate
    event.stopPropagation();
});

// Fermer le menu si on clique en dehors
document.addEventListener('click', function(event) { 
    if (!menuBurger.contains(event.target) && !logoBurger.contains(event.target)) {
        menuBurger.classList.remove('active');
        logoBurger.classList.remove('active'); 
        
        // Réinitialiser la rotation
        logoBurger.style.transition = "transform 0.8s"; 
        logoBurger.style.transform = "rotate(0deg)"; 
    }
});


