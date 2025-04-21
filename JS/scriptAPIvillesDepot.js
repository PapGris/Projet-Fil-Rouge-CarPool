document.addEventListener('DOMContentLoaded', () => {
let inputVille = document.querySelector('.proposer .departDepot');
    const suggestionsBoxDepot = document.getElementById('suggestionsDepart'); 

let inputVilleDestination = document.querySelector('.proposer .destinationDepot');
    const suggestionsBoxDestinationDepot = document.getElementById('suggestionsDestinationDepot'); 

    inputVille.addEventListener('input', () => { 
        const recherche = inputVille.value.trim();

        if (recherche.length >= 2) {  
            fetch(`https://geo.api.gouv.fr/communes?nom=${recherche}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsBoxDepot.innerHTML = '';

                    data.forEach(ville => {
                        const div = document.createElement('div');
                        div.classList.add('suggestion');
                        div.textContent = `${ville.nom}`;

                        div.addEventListener('click', () => {
                            inputVille.value = ville.nom;  
                            suggestionsBoxDepot.innerHTML = ''; 
                        });

                        suggestionsBoxDepot.appendChild(div);
                    });
                })
                .catch(error => console.error('Erreur:', error));
        } else {
            suggestionsBoxDepot.innerHTML = '';
        }
    });

    inputVilleDestination.addEventListener('input', () => { 
        const recherche = inputVilleDestination.value.trim();

        if (recherche.length >= 2) {  
            fetch(`https://geo.api.gouv.fr/communes?nom=${recherche}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsBoxDestinationDepot.innerHTML = '';

                    data.forEach(ville => {
                        const div = document.createElement('div');
                        div.classList.add('suggestion');
                        div.textContent = `${ville.nom}`;

                        div.addEventListener('click', () => {
                            inputVilleDestination.value = ville.nom;  
                            suggestionsBoxDestinationDepot.innerHTML = ''; 
                        });

                        suggestionsBoxDestinationDepot.appendChild(div);
                    });
                })
                .catch(error => console.error('Erreur:', error));
        } else {
            suggestionsBoxDestinationDepot.innerHTML = '';
        }
    });
    

    document.addEventListener('click', (event) => {
        if (!inputVille.contains(event.target) && !suggestionsBoxDepot.contains(event.target)) {
            suggestionsBoxDepot.innerHTML = '';
        }

        if (!inputVilleDestination.contains(event.target) && !suggestionsBoxDestinationDepot.contains(event.target)) {
            suggestionsBoxDestinationDepot.innerHTML = '';
        }
    });
});