<?php
require_once 'config/db.php';
require_once 'config/session.php';



$utilisateur_id = $_SESSION['id'];


$sql = "SELECT 
            u.utilisateur_nom, u.utilisateur_prenom, u.utilisateur_pseudo, 
            u.utilisateur_email, u.utilisateur_telephone, u.utilisateur_photo,
            u.utilisateur_conducteur, u.utilisateur_lieu,
            p.poste_nom,
            pr.preference_fumeur, pr.preference_nourriture, pr.preference_musique
        FROM utilisateur u
        LEFT JOIN poste p ON u.poste_id = p.poste_id
        LEFT JOIN preference pr ON u.utilisateur_id = pr.utilisateur_id
        WHERE u.utilisateur_id = :id";

$stmt = $db->prepare($sql);
$stmt->execute(['id' => $utilisateur_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

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
    <script src="JS/scriptInscription.js" defer></script>
    <script src="JS/script.js" defer></script>
</head>

<body>

    <?php require_once 'templates/header.php'; ?>

    <main>
        <div class="profileContainer">
            <div class="profileHeader">
                <img src="<?= htmlspecialchars($user['utilisateur_photo'] ?? 'Images/person.jpg') ?>" alt="Photo de profil" class="profilePic">
                <h1 class="profile-name"><?= htmlspecialchars($user['utilisateur_pseudo']) ?></h1>
            </div>

            <div class="infoButton">
                <div class="profileInfo">
                    <p class="icon">👤</p><strong>Nom :</strong> <span><?= htmlspecialchars($user['utilisateur_nom'] . ' ' . $user['utilisateur_prenom']) ?></span></p>
                    <p class="icon">✉</p><strong>Email :</strong> <span><?= htmlspecialchars($user['utilisateur_email']) ?></span></p>
                    <p class="icon">📞</p><strong>Téléphone :</strong> <span><?= htmlspecialchars($user['utilisateur_telephone']) ?></span></p>
                    <p class="icon">👔</p><strong>Service :</strong> <span><?= htmlspecialchars($user['poste_nom'] ?? 'Non défini') ?></span></p>
                    <p class="icon">🌍</p><strong>Lieu :</strong> <span><?= $user['utilisateur_lieu']? htmlspecialchars($user['utilisateur_lieu']):''?></span></p>
                </div>

                <div class="profileInfosBtn">
                    <div class="aPropos">
                        <p class="icon">🚗</p>
                        <strong>Conducteur :</strong>
                        <span><?= $user['utilisateur_conducteur'] ? 'Oui' : 'Non' ?></span>
                        <p class="icon">❤</p>
                        <strong>Préférences :</strong>
                        <span>
                            <?= $user['preference_fumeur'] == 1 ? ' Fumeur' : 'Non fumeur' ?>
                            <?= $user['preference_nourriture'] == 1 ? ', Nourriture' : ', Sans nourriture' ?>
                            <?= $user['preference_musique'] == 1 ? ', Musique' : ', Sans musique' ?> 
                        </span>
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

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

</body>

</html>