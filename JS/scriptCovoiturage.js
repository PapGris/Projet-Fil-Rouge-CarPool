let modal = document.getElementById("confirmationModal");
let proposerBtn = document.querySelector('.btnProposer');
let confirmBtn = document.getElementById("confirmBtn");
let form = document.getElementById("formProposer");
let errorMessage = document.getElementById("error-message");


proposerBtn.addEventListener('click', function(event) {
    event.preventDefault();
    errorMessage.style.display = "none"; 

        let depart = form.querySelector('.departDepot').value.trim();
        let destination = form.querySelector('.destinationDepot').value.trim();
        let date = form.querySelector('.date').value.trim();
        let places = form.querySelector('.places').value.trim();

    let erreurs = [];

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


