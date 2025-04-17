var modal = document.getElementById("confirmationModal");
var proposerBtn = document.querySelector('.btnProposer');
var confirmBtn = document.getElementById("confirmBtn");
var form = document.getElementById("formProposer");
var errorMessage = document.getElementById("error-message");

// Quand on clique sur "Proposer"
proposerBtn.addEventListener('click', function(event) {
    event.preventDefault();
    errorMessage.style.display = "none"; // On cache l'erreur au début

    var depart = form.querySelector('.depart').value.trim();
    var destination = form.querySelector('.destination').value.trim();
    var date = form.querySelector('.date').value.trim();
    var places = form.querySelector('.places').value.trim();

    var erreurs = [];

    if (depart === "") {
        erreurs.push("Départ");
    }
    if (destination === "") {
        erreurs.push("Destination");
    }
    if (date === "") {
        erreurs.push("Date");
    }

    if (erreurs.length > 0) {
        errorMessage.innerHTML = "Merci de remplir les champs obligatoires suivants : <strong>" + erreurs.join(", ") + "</strong>.";
        errorMessage.style.display = "block"; // On affiche l'erreur
        return; // NE PAS ouvrir la modale
    }

    // Pas d'erreurs => on ouvre la modale
    modal.style.display = "block";
});

// Quand on clique sur "OK" dans la modale
confirmBtn.addEventListener('click', function() {
    form.submit();
});


