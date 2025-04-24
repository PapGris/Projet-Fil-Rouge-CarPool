var modal = document.getElementById("confirmationModal");
var proposerBtn = document.querySelector('.btnProposer');
var confirmBtn = document.getElementById("confirmBtn");
var form = document.getElementById("formProposer");
var errorMessage = document.getElementById("error-message");


proposerBtn.addEventListener('click', function(event) {
    event.preventDefault();
    errorMessage.style.display = "none"; 

        var depart = form.querySelector('.departDepot').value.trim();
        var destination = form.querySelector('.destinationDepot').value.trim();
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
        errorMessage.style.display = "block"; 
        return; 
    }


    modal.style.display = "block";
});


confirmBtn.addEventListener('click', function() {
    form.submit();
});


