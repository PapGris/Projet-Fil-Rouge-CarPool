document.addEventListener('DOMContentLoaded', () => {
let inputVille = document.querySelector('.recherche .depart');
    const suggestionsBox = document.getElementById('suggestionsDepart'); 

let inputVilleDestination = document.querySelector('.recherche .destination');
    const suggestionsBoxDestination = document.getElementById('suggestionsDestination'); 

    inputVille.addEventListener('input', () => { 
        const recherche = inputVille.value.trim();

        if (recherche.length >= 2) {  
            fetch(`https://geo.api.gouv.fr/communes?nom=${recherche}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsBox.innerHTML = '';

                    data.forEach(ville => {
                        const div = document.createElement('div');
                        div.classList.add('suggestion');
                        div.textContent = `${ville.nom}`;

                        div.addEventListener('click', () => {
                            inputVille.value = ville.nom;  
                            suggestionsBox.innerHTML = ''; 
                        });

                        suggestionsBox.appendChild(div);
                    });
                })
                .catch(error => console.error('Erreur:', error));
        } else {
            suggestionsBox.innerHTML = '';
        }
    });

    inputVilleDestination.addEventListener('input', () => { 
        const recherche = inputVilleDestination.value.trim();

        if (recherche.length >= 2) {  
            fetch(`https://geo.api.gouv.fr/communes?nom=${recherche}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsBoxDestination.innerHTML = '';

                    data.forEach(ville => {
                        const div = document.createElement('div');
                        div.classList.add('suggestion');
                        div.textContent = `${ville.nom}`;

                        div.addEventListener('click', () => {
                            inputVilleDestination.value = ville.nom;  
                            suggestionsBoxDestination.innerHTML = ''; 
                        });

                        suggestionsBoxDestination.appendChild(div);
                    });
                })
                .catch(error => console.error('Erreur:', error));
        } else {
            suggestionsBoxDestination.innerHTML = '';
        }
    });

    document.addEventListener('click', (event) => {
        if (!inputVille.contains(event.target) && !suggestionsBox.contains(event.target)) {
            suggestionsBox.innerHTML = '';
        }

        if (!inputVilleDestination.contains(event.target) && !suggestionsBoxDestination.contains(event.target)) {
            suggestionsBoxDestination.innerHTML = '';
        }
    });
});

