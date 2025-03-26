// fenêtre MODAL 

document.getElementById("displayModal").addEventListener("click",function(){ 
    document.getElementById("modal").style.display="flex";  
    document.querySelector("#modal > div").focus(); 
});

document.getElementById("closeModal").addEventListener("click",function(){ 
    document.getElementById("modal").style.display="none";   
});

// Vérification en direct des critères du mot de passe
document.getElementById('mot_de_passe').addEventListener('input', function () {
    let password = this.value;

    // Fonction pour mettre à jour les critères avec une icône rouge ❌ ou verte ✅
    function updateCriteria(id, condition) {
        let element = document.getElementById(id);
        if (condition) {
            element.style.color = "green";
            element.innerText = "✅ " + element.innerText.slice(2); // Remplace ❌ par ✅
        } else {
            element.style.color = "red";
            element.innerText = "❌ " + element.innerText.slice(2); // Remet ❌ si la condition est fausse
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

    document.getElementById("form").querySelectorAll(".error").forEach(function(divError){
        divError.classList.remove("error"); 
        divError.removeChild(divError.querySelector('div')); 
    });

    let allValid = true;

    document.getElementById('form').querySelectorAll('input[required],textarea,[requierd],select[requierd]').forEach(function(input){ 
        if (input.value ==""){ 
            input.closest('div').classList.add('error'); 
            let div = document.createElement('div'); 
            let text = document.createTextNode('Attention, champ obligatoire'); 
            div.append(text); 
            input.closest('div').appendChild(div); 

            allValid = false; 
        }
    });

    // EMAIL

    let inputMail = document.getElementById('email'); 
    if(inputMail.value!=""){
        const regex = new RegExp('^[A-Za-z0-9.\-_\+]+@[A-Za-z0-9.\-]+[.]{1}[A-Za-z0-9]{2,}$',"i"); 

        if(!regex.test(inputMail.value)){ 
            inputMail.closest('div').classList.add('error') 
            let div = document.createElement('div'); 
            let text = document.createTextNode('Email invalide'); 
            div.append(text); 
            inputMail.closest('div').appendChild(div); 

            allValid=false; 
        }
    }

    // MDP

    let inputPass = document.getElementById('mot_de_passe');
    if(inputPass.value!=""){
        let errors = [];
        if (!/[a-z]/.test(inputPass.value)) {
            errors.push("au moins une lettre minuscule");
        }
        if (!/[A-Z]/.test(inputPass.value)) {
            errors.push("au moins une lettre majuscule");
        }
        if (!/[0-9]/.test(inputPass.value)) {
            errors.push("au moins un chiffre");
        }
        if (!/[^a-zA-Z0-9]/.test(inputPass.value)) {
            errors.push("au moins un caractère spécial");
        }
        if (inputPass.value.length < 8) {
            errors.push("au moins 8 caractères");
        }

        if (errors.length > 0) {
            inputPass.closest('div').classList.add('error');
            let div = document.createElement('div');
            let text = document.createTextNode('Mot de passe invalide: ' + errors.join(', '));
            div.append(text);
            inputPass.closest('div').appendChild(div);

            allValid = false;
        }
    }

    if(!allValid){    
        event.preventDefault();  
    } 

    // GESTION PSEUDO AVEC AJAX 

    let pseudo = document.getElementById('pseudo');
    if (pseudo.value.trim() !== '') {
        fetch("checkPseudo.php")
        .then(response => response.text())
        .then(data => {
            if (data === "0") {
                input.closest('div').classList.add('error'); 
                let div = document.createElement('div'); 
                let text = document.createTextNode('Ce pseudo n\'est pas disponible'); 
                div.append(text); 
                input.closest('div').appendChild(div); 
                allValid = false;
            }
        })
    }
}

document.getElementById('form').addEventListener('submit',formsubmit); 
document.getElementById('btn').addEventListener('click',formsubmit);


// MDP IDENTIQUE 

function checkPass() {
    var champA = document.getElementById("mot_de_passe").value;
    var champB = document.getElementById("confirme_mot_de_passe").value;
    var div_comp = document.getElementById("divcomp");

        if(champA != champB)
            {
            div_comp.innerHTML = "Mot de passe différent !";
        }
}