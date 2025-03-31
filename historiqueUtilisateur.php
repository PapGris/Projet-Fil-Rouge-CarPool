<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool - Historique</title>
    <link rel="stylesheet" href="CSS/sytleHistoriqueUtilisateur.css">
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooterConnecte.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
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
        <div class="historyContainer">
            <h2>Vos trajets passés</h2>
            <table class="historyTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Départ</th>
                        <th>Arrivée</th>
                        <th>Passagers</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>15/03/2025</td>
                        <td>Paris</td>
                        <td>Lyon</td>
                        <td>3</td>
                        <td>Terminé</td>
                        <td>
                            <div>
                                <button class="detailsBtn">Voir</button>
                                <a href="economieUtilisateur.php"><button class="detailsBtn">Économies</button></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>08/03/2025</td>
                        <td>Bordeaux</td>
                        <td>Toulouse</td>
                        <td>2</td>
                        <td>Annulé</td>
                        <td>
                            <div>
                                <button class="detailsBtn">Voir</button>
                                <a href="economieUtilisateur.php"><button class="detailsBtn">Économies</button></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <a href="profilUtilisateur.php">
                    <button type="button" class="retour">Retour au profil</button>
                </a>
            </div>
        </div>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>

</body>

</html>