<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/session.php';

$utilisateurId = $_SESSION['id'] ?? null;

// TRAITEMENT DU FORMULAIRE POST POUR ENVOYER UN MESSAGE
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destinataireId = $_POST['destinataire_id'] ?? null;
    $messageReponse = trim($_POST['message_reponse'] ?? '');

    if ($utilisateurId && $destinataireId && $messageReponse !== '') {
        $insert = $db->prepare("
    INSERT INTO message (utilisateur_id, utilisateur_id_1, message_contenu, message_date, message_statut)
    VALUES (:utilisateur_id, :utilisateur_id_1, :message_contenu, NOW(), :message_statut)
    ");

        $statut = 0; // Non lu par exemple

        $insert->bindParam(':utilisateur_id', $utilisateurId, PDO::PARAM_INT);
        $insert->bindParam(':utilisateur_id_1', $destinataireId, PDO::PARAM_INT);
        $insert->bindParam(':message_contenu', $messageReponse, PDO::PARAM_STR);
        $insert->bindParam(':message_statut', $statut, PDO::PARAM_INT);
        $insert->execute();

        // Redirection pour éviter le re-post du formulaire au refresh
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $errorMessage = "Veuillez remplir tous les champs.";
    }
}

$query = $db->prepare("
    SELECT m.message_id, m.message_contenu, m.message_date, u.utilisateur_pseudo, u.utilisateur_id, u.utilisateur_prenom, u.utilisateur_nom
    FROM message m
    JOIN utilisateur u ON m.utilisateur_id = u.utilisateur_id
    WHERE m.utilisateur_id_1 = :utilisateurId
    ORDER BY m.message_date DESC
");
$query->bindParam(':utilisateurId', $utilisateurId, PDO::PARAM_INT);
$query->execute();
$messages = $query->fetchAll(PDO::FETCH_ASSOC);
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
    <script src="JS/script.js" defer></script>
    <script src="JS/scriptModalMessage.js" defer></script>
</head>

<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>

    <main>

        <?php if (!empty($errorMessage)): ?>
            <p style="color:red; text-align:center;"><?= htmlspecialchars($errorMessage) ?></p>
        <?php endif; ?>

        <div class="notificationsContainer">
            <h2 class="page-title">Notifications</h2>

            <div class="notificationsList">
                <?php if ($messages): ?>
                    <?php foreach ($messages as $message): ?>
                        <div class="notification">
                            <div class="notificationHeader">
                                <p class="notificationIcon">💬</p>
                                <strong>Message de :</strong>
                                <a class="profil" href="profilPublic.php?id=<?= urlencode($message['utilisateur_id']) ?>">
                                    <?= htmlspecialchars($message['utilisateur_prenom'] . ' ' . $message['utilisateur_nom']) ?>
                                </a>
                            </div>
                            <p class="notificationContent">
                                <?= htmlspecialchars(mb_strimwidth($message['message_contenu'], 0, 50, '...')) ?>
                            </p>
                            <p class="notificationDate">
                                Envoyé le <?= date('d/m/Y à H:i', strtotime($message['message_date'])) ?>
                            </p>
                            <div class="notificationActions">
                                <button
                                    class="openModalBtn"
                                    data-message="<?= htmlspecialchars($message['message_contenu']) ?>"
                                    data-recu="<?= htmlspecialchars($message['utilisateur_pseudo']) ?>"
                                    data-utilisateur-id="<?= $message['utilisateur_id'] ?>">
                                    Lire
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucun message reçu pour l'instant.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- MODAL -->
        <div id="messageModal" class="modal hidden">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <h2 id="modalRecu"></h2><br>
                <div class="containerMessage">
                    <p id="modalMessage"></p>
                </div><br>
                <button class="repondre">Répondre</button>

                <div id="repContainer" class="hidden">
                    <form method="POST" action="" class="reponse">
                        <input type="hidden" name="destinataire_id" id="destinataireId">
                        <textarea name="message_reponse" placeholder="Votre message..." class="textRep" required></textarea>
                        <button type="submit" class="envoyer">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

</body>

</html>