// fenêtre MODAL 

document.getElementById("displayModal").addEventListener("click", function() { 
    document.getElementById("modal").style.display = "flex";  
    document.querySelector("#modal > div").focus(); 
});

document.getElementById("closeModal").addEventListener("click", function() { 
    document.getElementById("modal").style.display = "none";   
});

document.getElementById('mot_de_passe').addEventListener('input', function () {
    let password = this.value;

    function updateCriteria(id, condition) {
        let element = document.getElementById(id);
        if (condition) {
            element.style.color = "green";
            element.innerText = "✅ " + element.innerText.slice(2); 
        } else {
            element.style.color = "red";
            element.innerText = "❌ " + element.innerText.slice(2); 
        }
    }

    updateCriteria('length', password.length >= 8);
    updateCriteria('uppercase', /[A-Z]/.test(password));
    updateCriteria('lowercase', /[a-z]/.test(password));
    updateCriteria('number', /[0-9]/.test(password));
    updateCriteria('special', /[#?!@$%^&*-]/.test(password));
});

// FORMULAIRE 

function formsubmit(event) {

    // Suppression des anciennes erreurs
    document.getElementById("form").querySelectorAll(".error").forEach(function(divError) {
        divError.classList.remove("error"); 
        let errDiv = divError.querySelector('div');
        if (errDiv) {
            divError.removeChild(errDiv);
        }
    });

    let allValid = true;

    // Correction des attributs required (il faut juste input[required], textarea[required], select[required])
    document.getElementById('form').querySelectorAll('input[required], textarea[required], select[required]').forEach(function(input) { 
        if (input.value.trim() === "") { 
            input.closest('div').classList.add('error'); 
            let div = document.createElement('div'); 
            div.textContent = 'Attention, champ obligatoire'; 
            input.closest('div').appendChild(div); 

            allValid = false; 
        }
    });

    // EMAIL
    let inputMail = document.getElementById('email'); 
    if (inputMail.value.trim() !== "") {
        const regex = /^[A-Za-z0-9.\-_+]+@[A-Za-z0-9.\-]+\.[A-Za-z0-9]{2,}$/i; 

        if (!regex.test(inputMail.value)) { 
            inputMail.closest('div').classList.add('error'); 
            let div = document.createElement('div'); 
            div.textContent = 'Email invalide'; 
            inputMail.closest('div').appendChild(div); 

            allValid = false; 
        }
    }

    // MDP
    let inputPass = document.getElementById('mot_de_passe');
    if (inputPass.value.trim() !== "") {
        let errors = [];
        if (!/[a-z]/.test(inputPass.value)) errors.push("au moins une lettre minuscule");
        if (!/[A-Z]/.test(inputPass.value)) errors.push("au moins une lettre majuscule");
        if (!/[0-9]/.test(inputPass.value)) errors.push("au moins un chiffre");
        if (!/[^a-zA-Z0-9]/.test(inputPass.value)) errors.push("au moins un caractère spécial");
        if (inputPass.value.length < 8) errors.push("au moins 8 caractères");

        if (errors.length > 0) {
            inputPass.closest('div').classList.add('error');
            let div = document.createElement('div');
            div.textContent = 'Mot de passe invalide: ' + errors.join(', ');
            inputPass.closest('div').appendChild(div);

            allValid = false;
        }
    }

    // MDP IDENTIQUE 
    let confirmPass = document.getElementById("confirmer_mot_de_passe");
    if (inputPass.value !== confirmPass.value) {
        confirmPass.closest('div').classList.add('error');
        let div = document.createElement('div');
        div.textContent = "Mot de passe différent";
        confirmPass.closest('div').appendChild(div);

        allValid = false;
    } 

    // **IMPORTANT** : Bloquer la soumission si invalides
    if (!allValid) {
        event.preventDefault();
        return false;
    }
}

// GESTION EMAIL AVEC AJAX

let inputEmail = document.getElementById('email');
inputEmail.addEventListener('blur', function() {
    let formData = new FormData();
    formData.append('email', this.value);
    fetch('ajax/checkEmail.php', {
        method: 'POST',       
        body: formData
    })
    .then(response => response.text())
    .then(data => { 
        if (inputEmail.value !== "") {
            // Supprimer l’erreur précédente si elle existe
            let prevError = inputEmail.closest('div').querySelector('.error');
            if (prevError) prevError.remove();

            if (data.trim() !== '') {
                let div = document.createElement('div'); 
                div.classList.add('error');
                div.textContent = data; 
                inputEmail.closest('div').appendChild(div); 
            }
        } else {
            let prevError = inputEmail.closest('div').querySelector('.error');
            if (prevError) prevError.remove();
        }
    })
}); 

inputEmail.addEventListener('click', function() {
    let prevError = inputEmail.closest('div').querySelector('.error');
    if (prevError) prevError.remove();
});

// GESTION PSEUDO AVEC AJAX 
let inputPseudo = document.getElementById('pseudo');
inputPseudo.addEventListener('blur', function() {
    let formData = new FormData();
    formData.append('pseudo', this.value);
    fetch('ajax/checkPseudo.php', {
        method: 'POST',       
        body: formData
    })
    .then(response => response.text())
    .then(data => { 
        if (inputPseudo.value !== "") {
            // Supprimer erreur précédente
            let prevError = inputPseudo.closest('div').querySelector('.error');
            if (prevError) prevError.remove();

            if (data.trim() !== '') {
                let div = document.createElement('div'); 
                div.classList.add('error');
                div.textContent = data; 
                inputPseudo.closest('div').appendChild(div); 
            }
        } else {
            let prevError = inputPseudo.closest('div').querySelector('.error');
            if (prevError) prevError.remove();
        }
    })
}); 

inputPseudo.addEventListener('click', function() {
    let prevError = inputPseudo.closest('div').querySelector('.error');
    if (prevError) prevError.remove();
});

// Écouteur sur formulaire
document.getElementById('form').addEventListener('submit', formsubmit);

// Tu peux supprimer cette ligne si le bouton appelle le submit natif
document.getElementById('btn').addEventListener('click', formsubmit);
