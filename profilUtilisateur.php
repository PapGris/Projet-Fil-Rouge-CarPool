<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/init.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool - Mon Profil</title>
    <link rel="stylesheet" href="CSS/styleProfilUtilisateur.css">
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooterConnecte.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
    <link rel="icon" type="image/png" href="Images/favicon.ico" sizes="96x96" />
    <script src="JS/script.js" defer></script>
</head>

<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>

    <main>
        <div class="profileContainer">
            <div class="profileHeader">
                <img src="<?= htmlspecialchars($user['utilisateur_photo'] ?? 'Images/photoProfilParDefaut.png') ?>" alt="Photo de profil" class="profilePic">
                <h1 class="profile-name"><?= htmlspecialchars($user['utilisateur_pseudo']) ?></h1>
            </div>

            <div class="infoButton">
                <div class="profileInfo">
                    <p class="icon">👤</p><strong>Nom :</strong> <span><?= htmlspecialchars($user['utilisateur_nom'] . ' ' . $user['utilisateur_prenom']) ?></span></p>
                    <p class="icon">🧠</p><strong>Rôle :</strong><span><?= htmlspecialchars($user['role_nom']) ?></span></p>
                    <p class="icon">✉</p><strong>Email :</strong> <span><?= htmlspecialchars($user['utilisateur_email']) ?></span></p>
                    <p class="icon">📞</p><strong>Téléphone :</strong> <span><?= htmlspecialchars($user['utilisateur_telephone']) ?></span></p>
                    <p class="icon">👔</p><strong>Service :</strong> <span><?= htmlspecialchars($user['poste_nom'] ?? 'Non défini') ?></span></p>
                    <p class="icon">🌍</p><strong>Lieu :</strong> <span><?= $user['utilisateur_lieu'] ? htmlspecialchars($user['utilisateur_lieu']) : '' ?></span></p>
                </div>

                <div class="profileInfosBtn">
                    <div class="aPropos">
                        <p class="icon">🚗</p>
                        <strong>Conducteur :</strong>
                        <span><?= $user['utilisateur_conducteur'] ? 'Oui' : 'Non' ?></span>
                        <p class="icon">❤</p>
                        <strong>Préférences :</strong>
                        <span>
                            <?= htmlspecialchars($user['utilisateur_preference_fumeur']) == 1 ? ' Fumeur' : 'Non fumeur' ?>
                            <?= htmlspecialchars($user['utilisateur_preference_nourriture']) == 1 ? ', Nourriture' : ', Sans nourriture' ?>
                            <?= htmlspecialchars($user['utilisateur_preference_musique']) == 1 ? ', Musique' : ', Sans musique' ?>
                        </span>
                    </div>
                    <div class="profileActions">
                        <a href="modifProfil.php"><button class="edit-button">Modifier profil</button></a>
                        <a href="historiqueUtilisateur.php"><button class="history-button">Mes trajets</button></a>
                        <a href="notificationUtilisateur.php" id="notifAlert"><button class="notifications-button">Notifications</button>
                            <?php if (!empty($notificationCount)): ?>
                                <span class="notif-bulle"><?= $notificationCount ?></span>
                            <?php endif; ?>
                        </a>
                        <?php if ($user['role_id'] == 1): ?>
                            <a href="backoffice.php"><button class="logout-button">Backoffice</button></a>
                        <?php endif; ?>
                        <a href="/action/logout.php"><button class="logout-button">Déconnexion</button></a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

</body>

</html>