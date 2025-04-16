// Script pour ouvrir et fermer la modale
document.addEventListener("DOMContentLoaded", () => {
    const openBtn = document.querySelector(".editPhotoBtn"); // Bouton Modifier photo
    const modal = document.getElementById("photoModal");
    const closeBtn = document.getElementById("closeModalBtn")
    // Ouvrir la modale
    openBtn.addEventListener("click", () => {
        modal.style.display = "block";
    })
    // Fermer la modale en cliquant sur la croix
    closeBtn.addEventListener("click", () => {
        modal.style.display = "none";
    })
    // Fermer la modale si on clique en dehors de celle-ci
    window.addEventListener("click", (e) => {
        if (e.target == modal) {
            modal.style.display = "none";
        }
    });
});

// modif Pseudo
document.addEventListener("DOMContentLoaded", () => {
    const editBtn = document.querySelector(".editPseudoBtn");
    const saveBtn = document.querySelector(".savePseudoBtn");
    const nameText = document.querySelector(".profilePseudo");
    const nameInput = document.querySelector(".profilePseudoInput")
    editBtn.addEventListener("click", () => {
        nameText.style.display = "none";
        nameInput.style.display = "inline-block";
        saveBtn.style.display = "inline-block";
        editBtn.style.display = "none";
        nameInput.focus();
    });
});