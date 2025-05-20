const lienCovoiturage = document.getElementById("lienCovoiturage");
const modal = document.getElementById("modalConnexion");
const closeModal = document.getElementById("closeModal");
const boutonRechercher = document.getElementById("btnRechercherNonConnecte");

if (lienCovoiturage && modal && closeModal) {
    lienCovoiturage.addEventListener("click", function (e) {
        e.preventDefault();
        modal.style.display = "block";
    });

    closeModal.addEventListener("click", function () {
        modal.style.display = "none";
    });
}

if (boutonRechercher && modal) {
    boutonRechercher.addEventListener("click", function () {
        modal.style.display = "block";
    });
}
