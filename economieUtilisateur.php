<?php
require 'config/db.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool - Mes économies</title>
    <link rel="stylesheet" href="CSS/styleEconomieUtilisateur.css">
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooterConnecte.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
    <link rel="icon" type="image/png" href="Images/favicon.ico" sizes="96x96" />
    <script src="JS/scriptInscription.js" defer></script>
    <script src="JS/script.js" defer></script>
</head>

<body>

    <div class="burger">
        <div class="profilePicContainer">
            <a href="profilUtilisateur.php"><img src="Images/person.jpg" alt="Photo de profil" class="profile-picMini-burger"></a>
        </div>
        <ul>
            <li><a href="indexConnecte.php">Accueil</a></li>
            <li><a href="rechercheTrajet.php">Trouver/Proposer un trajet</a></li>
            <li><a href="notificationUtilisateur.php">Notifications</a></li>
            <li><a href="historiqueUtilisateur.php">Historique</a></li>
            <li><a href="modifProfil.php">Modifier mon profil</a></li>
            <li><a href="index.php">Déconnexion</a></li>
        </ul>
    </div>

    <header>
        <div class="headerContainer">
            <i class="material-symbols-outlined" id="logoBurger">
                search_hands_free
            </i>

            <div class="title">
                <a href="indexConnecte.php"><img class="logoCarPool" src="Images/logoCarPool.png" alt="Logo CarPool"></a>
                <h1>CarPool</h1>
            </div>
            <div class="CoDeco">
                <a href="profilUtilisateur.php"><img src="Images/person.jpg" alt="Photo de profil" class="profile-picMini"></a>
                <a href="profilUtilisateur.php"><button class="btn">Mon profil</button></a>
            </div>
        </div>
    </header>

    <main>
        <div class="statsContainer">
            <h2>Statistiques du Voyage</h2>
            <div class="statsCard">
                <h3>Économies financières</h3>
                <p class="statsValue">€45.60</p>
                <p class="statsDescription">Montant économisé grâce à ce trajet de covoiturage</p>
            </div>

            <div class="statsCard">
                <h3>Économie de CO2</h3>
                <p class="statsValue">18 kg</p>
                <p class="statsDescription">CO2 évité grâce à ce trajet (comparé à un trajet seul en voiture)</p>
            </div>

            <div class="statsCard">
                <h3>Nombre d'arbres plantés</h3>
                <p class="statsValue">1.2 arbres</p>
                <p class="statsDescription">Cela correspond à l'impact écologique positif d'une réduction de CO2 équivalente</p>
            </div>

            <div class="statsCard">
                <h3>Distance parcourue</h3>
                <p class="statsValue">120 km</p>
                <p class="statsDescription">Distance totale parcourue lors de ce trajet</p>
            </div>

            <div class="buttonContainer">
                <a href="historiqueUtilisateur.php"><button class="retour">Retour à l'historique</button></a>
                <a href="profilUtilisateur.php"><button class="retour">Retour au profil</button></a>
            </div>
        </div>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>

</body>

</html>