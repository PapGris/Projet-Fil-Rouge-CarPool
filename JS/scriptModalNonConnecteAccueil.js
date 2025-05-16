// Modal accueil si non connecté 

const lienCovoiturage = document.getElementById("lienCovoiturage");
const modal = document.getElementById("modalConnexion");
const closeModal = document.getElementById("closeModal");

if (lienCovoiturage && modal && closeModal) {
    lienCovoiturage.addEventListener("click", function (e) {
        e.preventDefault(); // Empêche la navigation
        modal.style.display = "block"; // Affiche la modale
    });

    closeModal.addEventListener("click", function () {
        modal.style.display = "none";
    }); 

}