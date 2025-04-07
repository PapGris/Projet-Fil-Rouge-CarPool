<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/config/session.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooterConnecte.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
    <link rel="icon" type="image/png" href="Images/favicon.ico" sizes="96x96" />
    <script src="JS/script.js" defer></script>
    <script src="JS/scriptCalendar.js" defer></script>

</head>

<body>

    <div class="burger">
        <div class="profilePicContainer">
            <a href="profilUtilisateur.php"><img src="Images/person.jpg" alt="Photo de profil" class="profile-picMini-burger"></a>
        </div>
        <ul>
            <li><a href="profilUtilisateur.php">Mon Profil</a></li>
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
                <a href="profilUtilisateur.php"><button class="btn">Mon Profil</button></a>
                <a href="index.php" class="btn">Déconnexion</a>
            </div>
        </div>
    </header>

    <main>
        <section class="acceuil">
            <div class="centerSlogan">
                <span class="slogan">"Le covoiturage simplifié, pour un trajet partagé."</span>
            </div>
            <div class="recherche">
                <form method="POST">
                    <input class="depart" type="text" placeholder="Départ">
                    <input class="destination" type="text" placeholder="Destination">
                    <input class="date" type="date" value="aujourd'hui" id="date">

                    <select class="passager">
                        <option>1 passager</option>
                        <option>2 passagers</option>
                        <option>3 passagers</option>
                        <option>4 passagers</option>
                    </select>

                    <button class="btnRechercher" type="submit">Rechercher</button>
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
            <a href="rechercheTrajet.php" class="box">
                <div>Cherche un trajet<br>ou<br>Propose un trajet</div>
            </a>
            <a href="economieUtilisateur.php" class="box">
                <div>Économise pour ta planète !</div>
            </a>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>

</body>

</html>