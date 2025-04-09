<?php
require 'config/db.php';
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool - Messagerie</title>
    <link rel="stylesheet" href="CSS/styleNotificationUtilisateur.css">
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooterConnecte.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
    <link rel="icon" type="image/png" href="Images/favicon.ico" sizes="96x96" />
    <script src="JS/scriptInscription.js" defer></script>
    <script src="JS/script.js" defer></script>
</head>

<body>

    <?php
    require_once 'templates/header.php';
    ?>

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

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

</body>

</html>