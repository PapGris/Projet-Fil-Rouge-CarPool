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
    <link rel="stylesheet" href="CSS/style.css">
    <?php
    if (!isset($_SESSION['id'])) {
    ?>
        <link rel="stylesheet" href="CSS/styleHeaderBurgerFooter.css">
    <?php
    } else {
    ?>
        <link rel="stylesheet" href="CSS/styleHeaderBurgerFooterConnecte.css">
    <?php
    }
    ?>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
    <link rel="icon" type="Images/png" href="Images/favicon.ico" sizes="96x96" />
    <script src="JS/scriptAPIvilles.js"></script>
    <script src="JS/script.js" defer></script>
    <script src="JS/scriptCalendar.js" defer></script>

</head>

<body>

    <?php
    require_once 'templates/header.php';
    ?>

    <main>
        <section class="acceuil">
            <div class="centerSlogan">
                <span class="slogan">"Le covoiturage simplifié, pour un trajet partagé."</span>
            </div>
            <div class="recherche">
                <form method="GET" action="resultatRecherche.php">
                    <div class="inputForm">
                        <input class="depart" type="text" name="depart" id="depart" placeholder="Départ" autocomplete="off">
                        <div id="suggestionsDepart" class="suggestionsListDepart"></div>
                    </div>

                    <div class="inputForm">
                        <input class="destination" type="text" name="destination" id="destination" placeholder="Destination" autocomplete="off">
                        <div id="suggestionsDestination" class="suggestionsListDestination"></div>
                    </div>

                    <div class="inputForm">
                        <input class="date" type="date" name="date" value="aujourd'hui" id="date">
                    </div>

                    <div class="inputForm">
                        <select class="passager" name="nombre_passagers">
                            <option>1 passager</option>
                            <option>2 passagers</option>
                            <option>3 passagers</option>
                            <option>4 passagers</option>
                        </select>
                    </div>

                    <div class="inputForm">
                        <button class="btnRechercher" type="submit">Rechercher</button>
                    </div>
                </form>
            </div>
        </section>

        <div class="texteInformatif">
            <p>
                <strong>Inscris-toi !</strong><br><br>
                Crée ton compte en quelques clics pour commencer à profiter des avantages du covoiturage au sein de ton entreprise.<br><br>

                <strong>Cherche un trajet ou Propose un trajet</strong><br><br>
                Tu as un trajet quotidien à faire ? Cherche une offre de covoiturage ou propose ta propre place pour partager ton parcours avec tes collègues. <br><br>

                <strong>Économise pour ta planète !</strong><br><br>
                Réduis ton empreinte carbone en covoiturant. Moins de voitures, moins de CO2, plus de bénéfices pour l’environnement ! <br><br>
            </p>
        </div>
        <section class="boxs">
            <a href="inscription.php" class="box">
                <div>Inscris toi !</div>
            </a>
            <a href="covoiturage.php" class="box">
                <div>Cherche un trajet<br>ou<br>Propose un trajet</div>
            </a>
            <a href="economieUtilisateur.php" class="box">
                <div>Économise pour ta planète !</div>
            </a>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

</body>

</html>