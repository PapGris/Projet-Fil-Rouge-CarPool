<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool - Mon Profil</P>
    </title>
    <link rel="stylesheet" href="CSS/styleProfilUtilisateur.css">
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
            <li><a href="notifications.php">Notifications</a></li>
            <li><a href="historiqueUtilisateur.php">Historique</a></li>
            <li><a href="modifProfil.php">Modifier mon profil</a></li>
            <li><a href="backoffice.php">Déconnexion</a></li>
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
        <div class="profileContainer">
            <div class="profileHeader">
                <img src="Images/person.jpg" alt="Photo de profil" class="profilePic">
                <h1 class="profile-name">Papillon-Gris</h1>
            </div>

            <div class="infoButton">
                <div class="profileInfo">
                    <p class="icon">👤</p><strong>Nom :</strong><span>John Doe</span></p>
                    <p class="icon">✉</p><strong>Email :</strong><span>johndoe@exemple.com</span></p>
                    <p class="icon">📞</p><strong>Téléphone :</strong><span>06 25 54 43 61</span></p>
                    <p class="icon">👔</p><strong>Service :</strong><span>Développement Web</span></p>
                    <p class="icon">🌍</p><strong>Lieu :</strong><span>Paris, France</span></p>
                </div>

                <div class="profileInfosBtn">
                    <div class="aPropos">
                        <p class="icon">🚗</p>
                        <strong>Conducteur :</strong>
                        <span> Oui </span>
                        <p class="icon">❤</p>
                        <strong>Préférences :</strong>
                        <span>Non Fumeur, Animaux, Pas de nourriture</span>
                    </div>
                    <div class="profileActions">
                        <a href="modifProfil.php"><button class="edit-button">Modifier le profil</button></a>
                        <a href="historiqueUtilisateur.php"><button class="history-button">Historique des trajets</button></a>
                        <a href="notificationUtilisateur.php"><button class="notifications-button">Notifications</button></a>
                        <a href="backoffice.php"><button class="logout-button">Backoffice</button></a>
                        <a href="index.php"><button class="logout-button">Déconnexion</button></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="footerContent">
            <div class="footerLinks">
                <ul>
                    <li><a href="#">À propos</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Mentions légales</a></li>
                    <li><a href="#">Conditions d'utilisation</a></li>
                </ul>
            </div>
            <div class="footerLogo">
                <a href="index2.php"><img class="logoCarPool" src="Images/logoCarPool.png" alt="Logo CarPool"></a>
            </div>
            <div class="footerSocials">
                <ul>
                    <li><a href="#" class="social-link">Facebook</a></li>
                    <li><a href="#" class="social-link">Twitter</a></li>
                    <li><a href="#" class="social-link">Instagram</a></li>
                </ul>
            </div>
        </div>
        <div class="footerBottom">
            <p>&copy; 2025 CarPool. Tous droits réservés.</p>
        </div>
    </footer>
</body>

</html>