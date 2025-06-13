// Modale suppression utilisateur

function ouvrirModale(id, nomComplet) {
    document.getElementById('texte-modale').innerText =
        "Êtes-vous sûr de vouloir supprimer le profil de " + nomComplet + " ?";
    document.getElementById('utilisateur-id-supprimer').value = id;
    document.getElementById('modale-suppression').style.display = 'flex';
}

function fermerModale() {
    document.getElementById('modale-suppression').style.display = 'none';
}

// Modification utilisateur 

function activerEdition(utilisateurId) {
    const ligne = document.getElementById('ligne-utilisateur-' + utilisateurId);
    const colonnes = ligne.querySelectorAll('td');

    // Récupérer les valeurs actuelles (colonnes 0 à 6)
    const valeurs = [];
    for (let i = 0; i < 7; i++) {
        valeurs.push(colonnes[i].innerText.trim());
    }

    // Remplacer les cellules par des champs de saisie
    colonnes[0].innerHTML = `<input class="input-modif" type="text" name="nom_prenom" value="${valeurs[0]}" />`;
    colonnes[1].innerHTML = `<input class="input-modif" type="text" name="pseudo" value="${valeurs[1]}" />`;
    colonnes[2].innerHTML = `<input class="input-modif" type="email" name="email" value="${valeurs[2]}" />`;
    colonnes[3].innerHTML = `<input class="input-modif" type="text" name="telephone" value="${valeurs[3]}" />`;
    colonnes[4].innerHTML = `<input class="input-modif" type="text" name="service" value="${valeurs[4]}" />`;
    colonnes[5].innerHTML = `<input class="input-modif" type="text" name="lieu" value="${valeurs[5]}" />`;
    colonnes[6].innerHTML = `
        <select name="conducteur" class="input-modif">
            <option value="1" ${valeurs[6] === 'Oui' ? 'selected' : ''}>Oui</option>
            <option value="0" ${valeurs[6] === 'Non' ? 'selected' : ''}>Non</option>
        </select>
    `;

    // Remplacer les boutons
    colonnes[7].innerHTML = `
        <button class="btn-valider" onclick="validerEdition(${utilisateurId})">Valider</button>
        <button class="btn-annuler" onclick="annulerEdition(${utilisateurId})">Annuler</button>
`   ;
}

function annulerEdition(utilisateurId) {
    location.reload(); // recharge la page pour revenir à l'état initial
}

function validerEdition(utilisateurId) {
    const ligne = document.getElementById('ligne-utilisateur-' + utilisateurId);
    const inputs = ligne.querySelectorAll('input, select');

    const data = {
        utilisateur_id: utilisateurId,
        nom_prenom: inputs[0].value,
        pseudo: inputs[1].value,
        email: inputs[2].value,
        telephone: inputs[3].value,
        service: inputs[4].value,
        lieu: inputs[5].value,
        conducteur: inputs[6].value
    };

    fetch('action/modifierUtilisateur.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    }).then(response => response.json())
      .then(result => {
          if (result.success) {
              alert("Modification réussie !");
              location.reload();
          } else {
              alert("Erreur : " + result.message);
          }
      });
}
