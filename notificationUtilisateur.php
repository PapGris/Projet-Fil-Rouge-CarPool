<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool - Messagerie</title>
    <link rel="stylesheet" href="CSS/styleNotificationUtilisateur.css"> 
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooterConnecte.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free"/>
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
            <li><a href="#">Qui sommes nous ?</a></li>
            <li><a href="#">Proposer un trajet</a></li>
            <li><a href="#">Contactez-nous</a></li>
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
        <div class="notificationsContainer">
            <h2 class="page-title">Notifications</h2>

            <div class="notificationsList">

                <div class="notification">
                    <div class="notificationHeader">
                        <p class="notificationIcon">💬</p>
                        <strong>Message de Jean Dupont</strong>
                    </div>
                    <p class="notificationContent">Bonjour, j’ai réservé un trajet pour demain, est-ce que tu es toujours disponible pour partager la voiture ?</p>
                    <div class="notificationActions">
                        <a href="#" class="notificationBtn acceptBtn">Accepter</a>
                        <a href="#" class="notificationBtn declineBtn">Refuser</a>
                    </div>
                </div>

                <div class="notification">
                    <div class="notificationHeader">
                        <p class="notificationIcon">🚗</p>
                        <strong>Demande de trajet de Marie Lefevre</strong>
                    </div>
                    <p class="notificationContent">Marie souhaite partager un trajet avec toi pour lundi prochain, serait-il possible de le confirmer ?</p>
                    <div class="notificationActions">
                        <a href="#" class="notificationBtn acceptBtn">Accepter</a>
                        <a href="#" class="notificationBtn declineBtn">Refuser</a>
                    </div>
                </div>

                <div class="notification">
                    <div class="notificationHeader">
                        <p class="notificationIcon">💬</p>
                        <strong class="notificationTitle">Message de Sophie Martin</strong>
                    </div>
                    <p class="notificationContent">Salut, je n'ai pas pu réserver à temps, est-ce que tu as encore de la place pour demain ?</p>
                    <div class="notificationActions">
                        <a href="#" class="notificationBtn acceptBtn">Accepter</a>
                        <a href="#" class="notificationBtn declineBtn">Refuser</a>
                    </div>
                </div>
                <div>
                    <a href="profilUtilisateur.php">
                        <button type="button" class="retour">Retour au profil</button>
                    </a>
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
                <a href="index2.php"><img class="logoCarPool"  src="Images/logoCarPool.png" alt="Logo CarPool"></a>
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