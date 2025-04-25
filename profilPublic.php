<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/init.php';

// Sécuriser l'ID
$utilisateurId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Récupérer les infos utilisateur
$userPublic = null;

if ($utilisateurId > 0) {
    $query = "SELECT u.*, p.poste_nom
            FROM utilisateur u
            LEFT JOIN poste p ON u.poste_id = p.poste_id
            WHERE u.utilisateur_id = :id";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $utilisateurId, PDO::PARAM_INT);
    $stmt->execute();
    $userPublic = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="CSS/styleProfilUtilisateur.css">
    <link rel="stylesheet" href="CSS/styleModalMessage.css">
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooterConnecte.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="Images/favicon.ico" sizes="96x96" />
    <script src="JS/script.js" defer></script>
    <script src="JS/scriptModalEnvoiMessage.js" defer></script>
</head>

<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>

    <main>
        <div class="profileContainer">
            <?php if ($userPublic): ?>
                <div class="profileHeader">
                    <img src="<?= htmlspecialchars($userPublic['utilisateur_photo'] ?? 'Images/photoProfilParDefaut.png') ?>" alt="Photo de profil" class="profilePic">
                    <h1 class="profile-name"><?= htmlspecialchars($userPublic['utilisateur_pseudo']) ?></h1>
                </div>

                <div class="infoButton">
                    <div class="profileInfo">
                        <p class="icon">👤</p><strong>Nom :</strong> <span><?= htmlspecialchars($userPublic['utilisateur_nom'] . ' ' . $userPublic['utilisateur_prenom']) ?></span></p>
                        <p class="icon">✉</p><strong>Email :</strong> <span><?= htmlspecialchars($userPublic['utilisateur_email']) ?></span></p>
                        <p class="icon">📞</p><strong>Téléphone :</strong> <span><?= htmlspecialchars($userPublic['utilisateur_telephone']) ?></span></p>
                        <p class="icon">👔</p><strong>Service :</strong> <span><?= htmlspecialchars($userPublic['poste_nom'] ?? 'Non défini') ?></span></p>
                        <p class="icon">🌍</p><strong>Lieu :</strong> <span><?= htmlspecialchars($userPublic['utilisateur_lieu']) ? htmlspecialchars($userPublic['utilisateur_lieu']) : '' ?></span></p>
                    </div>

                    <div class="profileInfosBtn">
                        <div class="aPropos">
                            <p class="icon">🚗</p>
                            <strong>Conducteur :</strong>
                            <span><?= htmlspecialchars($userPublic['utilisateur_conducteur']) ? 'Oui' : 'Non' ?></span>
                            <p class="icon">❤</p>
                            <strong>Préférences :</strong>
                            <span>
                                <?= htmlspecialchars($userPublic['utilisateur_preference_fumeur']) == 1 ? ' Fumeur' : 'Non fumeur' ?>
                                <?= htmlspecialchars($userPublic['utilisateur_preference_nourriture']) == 1 ? ', Nourriture' : ', Sans nourriture' ?>
                                <?= htmlspecialchars($userPublic['utilisateur_preference_musique']) == 1 ? ', Musique' : ', Sans musique' ?>
                            </span>
                        </div>

                        <div class="profilePublicActions">
                            <button class="boutonMessage" id="openModalBtn">Envoyer un message</button>
                            <a href="javascript:history.back()" class="boutonRetour">← Retour aux résultats</a>
                        </div>

                        <!-- Modal -->
                        <div id="messageModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h3>Envoyer un message à <?= htmlspecialchars($userPublic['utilisateur_pseudo']) ?></h3>
                                <form action="action/envoyerMessage.php" method="POST">
                                    <input type="hidden" name="destinataire_id" value="<?= htmlspecialchars($userPublic['utilisateur_id']) ?>">
                                    <textarea name="message_contenu" rows="5" placeholder="Votre message..." required></textarea>
                                    <button type="submit" class="send-button">Envoyer</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            <?php else: ?>
                <p>Utilisateur introuvable.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

</body>

</html>