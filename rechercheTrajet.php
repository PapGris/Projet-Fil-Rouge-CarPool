<?php
require 'config/db.php';
session_start();
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
                <form method="POST">
                    <p><strong>Départ :</strong></p>
                    <input class="depart" type="text" placeholder="Départ">

                    <p><strong>Destination :</strong></p>
                    <input class="destination" type="text" placeholder="Destination">

                    <p><strong>Date :</strong></p>
                    <input class="date" type="date" id="date">

                    <p><strong>Nombre de passager :</strong></p>
                    <select class="places">
                        <option>1 passager</option>
                        <option>2 passagers</option>
                        <option>3 passagers</option>
                        <option>4 passagers</option>
                    </select>

                    <div class="preferences">
                        <p><strong>Fumeur :</strong></p>
                        <span class="fumeur">
                            <label><input type="radio" name="fumeur" value="oui" checked> Oui</label>
                            <label><input type="radio" name="fumeur" value="non"> Non</label>
                        </span>
                        <p><strong>Nourriture :</strong></p>
                        <span class="nourriture">
                            <label><input type="radio" name="nourriture" value="oui" checked> Oui</label>
                            <label><input type="radio" name="nourriture" value="non"> Non</label>
                        </span>
                        <p><strong>Musique :</strong></p>
                        <span class="musique">
                            <label><input type="radio" name="musique" value="oui" checked> Oui</label>
                            <label><input type="radio" name="musique" value="non"> Non</label>
                        </span>
                    </div>
                    <p><strong>Type de voyage :</strong></p>
                    <span class="voyage">
                        <label><input type="radio" name="voyage" value="oui" checked> Aller</label>
                        <label><input type="radio" name="voyage" value="non"> Retour</label>
                        <label><input type="radio" name="voyage" value="non"> Aller/Retour</label>
                    </span>
                    <button class="btnRechercher" type="submit">Rechercher</button>
                </form>
            </section>

            <section class="proposer">
                <h2>Proposer un trajet</h2>
                <form method="POST">
                    <p><strong>Départ :</strong></p>
                    <input class="depart" type="text" placeholder="Départ">

                    <p><strong>Destination :</strong></p>
                    <input class="destination" type="text" placeholder="Destination">

                    <p><strong>Date :</strong></p>
                    <input class="date" type="date" id="date">

                    <p><strong>Nombre de places disponibles :</strong></p>
                    <select class="places">
                        <option>1 place</option>
                        <option>2 places</option>
                        <option>3 places</option>
                        <option>4 places</option>
                    </select>

                    <div class="preferences">
                        <p><strong>Fumeur :</strong></p>
                        <span class="fumeurProposer">
                            <label><input type="radio" name="fumeurProposer" value="oui" checked> Oui</label>
                            <label><input type="radio" name="fumeurProposer" value="non"> Non</label>
                        </span>
                        <p><strong>Nourriture :</strong></p>
                        <span class="nourritureProposer">
                            <label><input type="radio" name="nourritureProposer" value="oui" checked> Oui</label>
                            <label><input type="radio" name="nourritureProposer" value="non"> Non</label>
                        </span>
                        <p><strong>Musique :</strong></p>
                        <span class="musiqueProposer">
                            <label><input type="radio" name="musiqueProposer" value="oui" checked> Oui</label>
                            <label><input type="radio" name="musiqueProposer" value="non"> Non</label>
                        </span>
                    </div>
                    <p><strong>Type de voyage :</strong></p>
                    <span class="voyageProposer">
                        <label><input type="radio" name="voyageProposer" value="oui" checked> Aller</label>
                        <label><input type="radio" name="voyageProposer" value="non"> Retour</label>
                        <label><input type="radio" name="voyageProposer" value="non"> Aller/Retour</label>
                    </span>
                    <button class="btnRechercher" type="submit">Proposer</button>
                </form>
            </section>
        </div>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

</body>

</html>