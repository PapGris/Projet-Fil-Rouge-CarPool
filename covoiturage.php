<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/action/depotTrajet.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool</title>
    <link rel="stylesheet" href="CSS/styleCovoiturage.css">
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooterConnecte.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
    <link rel="icon" type="image/png" href="Images/favicon.ico" sizes="96x96" />
    <script src="JS/scriptAPIvillesDepot.js" defer></script>
    <script src="JS/scriptAPIvillesRecherche.js" defer></script>
    <script src="JS/scriptCovoiturage.js" defer></script>
    <script src="JS/script.js" defer></script>
    <script src="JS/scriptCalendar.js" defer></script>

</head>

<body>

    <?php
    require_once 'templates/header.php';
    ?>

    <main>
        <div class="container">
            <section class="recherche">
                <h2>Rechercher un trajet</h2>
                <form method="GET" action="resultatRecherche.php">
                    <p><strong>Départ :</strong></p>
                    <div class="inputForm">
                        <input class="depart" type="text" name="depart" id="depart" placeholder="Départ" autocomplete="off">
                        <div id="suggestionsDepart" class="suggestionsListDepart"></div>
                    </div>

                    <p><strong>Destination :</strong></p>
                    <div class="inputForm">
                        <input class="destination" type="text" name="destination" id="destination" placeholder="Destination" autocomplete="off">
                        <div id="suggestionsDestination" class="suggestionsListDestination"></div>
                    </div>

                    <p><strong>Date :</strong></p>
                    <input class="date" type="date" name="date" id="date">

                    <p><strong>Heure de départ :</strong></p>
                    <input class="heure" type="time" name="heureProposer">

                    <p><strong>Nombre de passagers :</strong></p>
                    <select class="places" name="nombre_passagers">
                        <option value="1">1 passager</option>
                        <option value="2">2 passagers</option>
                        <option value="3">3 passagers</option>
                        <option value="4">4 passagers</option>
                    </select>

                    <p><strong>Type de voyage :</strong></p>
                    <span class="voyage">
                        <label><input type="radio" name="voyage" value="aller" checked> Aller</label>
                        <label><input type="radio" name="voyage" value="retour"> Retour</label>
                        <label><input type="radio" name="voyage" value="aller_retour"> Aller/Retour</label>
                    </span>

                    <button class="btnRechercher" type="submit">Rechercher</button>
                </form>
            </section>






            <section class="proposer">
                <h2>Proposer un trajet</h2>

                <div id="error-message" style="color: red; margin-bottom: 15px; display: none;">
                </div>

                <form id="formProposer" method="POST">
                    <input type="hidden" name="proposer_trajet" value="1">
                    <p><strong>Départ* :</strong></p>
                    <div class="inputForm">
                        <input class="departDepot" type="text" name="departProposer" id="departDepot" placeholder="Départ" autocomplete="off" required>
                        <div id="suggestionsDepartDepot" class="suggestionsListDepartDepot"></div>
                    </div>

                    <p><strong>Destination* :</strong></p>
                    <div class="inputForm">
                        <input class="destinationDepot" type="text" name="destinationProposer" id="destinationDepot" placeholder="Destination" autocomplete="off" required>
                        <div id="suggestionsDestinationDepot" class="suggestionsListDestinationDepot"></div>
                    </div>

                    <p><strong>Date* :</strong></p>
                    <input class="date" type="date" name="dateProposer" required>

                    <p><strong>Heure de départ :</strong></p>
                    <input class="heure" type="time" name="heureProposer">

                    <p><strong>Nombre de places disponibles :</strong></p>
                    <select class="places" name="placesProposer" required>
                        <option value="1">1 place</option>
                        <option value="2">2 places</option>
                        <option value="3">3 places</option>
                        <option value="4">4 places</option>
                    </select>

                    <p><strong>Type de voyage :</strong></p>
                    <span class="voyageProposer">
                        <label><input type="radio" name="voyageProposer" value="1" checked> Aller</label>
                        <label><input type="radio" name="voyageProposer" value="2"> Retour</label>
                        <label><input type="radio" name="voyageProposer" value="3"> Aller/Retour</label>
                    </span>

                    <button type="button" class="btnProposer">Proposer</button>
                </form>

                <!-- Modale de confirmation -->
                <div id="confirmationModal" class="modal">
                    <div class="modal-content">
                        <h2>Votre trajet a bien été enregistré !</h2>
                        <p>Veuillez appuyer sur OK pour finaliser le dépôt !</p>
                        <button id="confirmBtn">OK</button>
                    </div>
                </div>
            </section>
        </div><br>

        <div class="obligatoire">
            <p>* Ces champs sont obligatoires</p>
        </div>

    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

</body>

</html>