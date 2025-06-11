<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/session.php';

$depart = isset($_GET['depart']) ? htmlspecialchars($_GET['depart']) : '';
$destination = isset($_GET['destination']) ? htmlspecialchars($_GET['destination']) : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';
$nbPlaces = isset($_GET['nombre_passagers']) ? (int)$_GET['nombre_passagers'] : 1;

$trajets = [];

if ($depart && $destination && $date) {
    $query = "SELECT 
                t.*, 
                u.utilisateur_nom, 
                u.utilisateur_prenom,
                u.utilisateur_preference_fumeur,
                u.utilisateur_preference_nourriture,
                u.utilisateur_preference_musique
            FROM trajet t
            JOIN utilisateur_trajet ut ON ut.trajet_id = t.trajet_id
            JOIN utilisateur u ON u.utilisateur_id = ut.utilisateur_id
            WHERE t.trajet_lieu_depart LIKE :depart 
            AND t.trajet_lieu_arrivee LIKE :destination
            AND t.trajet_date_depart = :date
            AND t.trajet_nombre_places_disponibles >= :nombre_passagers";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':depart', "%$depart%");
    $stmt->bindValue(':destination', "%$destination%");
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':nombre_passagers', $nbPlaces, PDO::PARAM_INT);
    $stmt->execute();
    $trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool - Résultat de recherche</title>
    <link rel="stylesheet" href="CSS/styleResultatRecherche.css">
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooterConnecte.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="Images/favicon.ico" sizes="96x96" />
    <script src="JS/script.js" defer></script>
</head>

<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>


    <main>
        <section class="trajetContainer">
            <h2>Trajets disponibles</h2>

            <div class="trajetHeader">
                <p><strong>Départ :</strong> <?php echo htmlspecialchars($depart); ?></p>
                <p><strong>Destination :</strong> <?php echo htmlspecialchars($destination); ?></p>
                <p><strong>Date :</strong> <?php echo htmlspecialchars($date); ?></p>
            </div>

            <?php if (count($trajets) > 0): ?>
                <?php foreach ($trajets as $trajet): ?>
                    <div class="trajetCard">

                        <div class="proposePar">
                            <p><strong>🫡 Proposé par :</strong>
                                <a class="profil" href="profilPublic.php?id=<?= urlencode($trajet['utilisateur_id']) ?>">
                                    <?= htmlspecialchars($trajet['utilisateur_prenom'] . ' ' . $trajet['utilisateur_nom']) ?>
                                </a>
                            </p>
                        </div>

                        <div class="infosTrajet">
                            <div class="left">
                                <p><strong>🅰️ Départ :</strong> <?php echo htmlspecialchars($trajet['trajet_lieu_depart']); ?></p>
                                <p><strong>🅱️ Arrivée :</strong> <?php echo htmlspecialchars($trajet['trajet_lieu_arrivee']); ?></p>
                                <p><strong>📆 Date :</strong> <?php echo htmlspecialchars($trajet['trajet_date_depart']); ?></p>

                                <?php if (!empty($trajet['trajet_heure_depart'])): ?>
                                    <p><strong>🕰️ Heure de départ :</strong> <?php echo htmlspecialchars($trajet['trajet_heure_depart']); ?></p>
                                <?php endif; ?>

                                <?php if ($trajet['trajet_nombre_places_disponibles'] > 0): ?>
                                    <p><strong>👤 Places disponibles :</strong> <?= (int) $trajet['trajet_nombre_places_disponibles']; ?></p>
                                <?php else: ?>
                                    <p><strong>👤 Places disponibles :</strong> <span style="color: red;">Plus de place disponibles</span></p>
                                <?php endif; ?>
                            </div>

                            <div class="right">

                                <p><strong>🚬 Fumeur :</strong> <?php echo htmlspecialchars($trajet['utilisateur_preference_fumeur'] == 1) ? 'Oui' : 'Non'; ?></p>
                                <p><strong>🍗 Nourriture acceptée :</strong> <?php echo htmlspecialchars($trajet['utilisateur_preference_nourriture'] == 1) ? 'Oui' : 'Non'; ?></p>
                                <p><strong>🎵 Musique acceptée :</strong> <?php echo htmlspecialchars($trajet['utilisateur_preference_musique'] == 1) ? 'Oui' : 'Non'; ?></p>

                                <p><strong>🚗 Type de trajet :</strong>
                                    <?php
                                    if ($trajet['trajet_aller_retour'] == 1) {
                                        echo 'Aller';
                                    } elseif ($trajet['trajet_aller_retour'] == 2) {
                                        echo 'Retour';
                                    } elseif ($trajet['trajet_aller_retour'] == 3) {
                                        echo 'Aller/Retour';
                                    } else {
                                        echo 'Inconnu';
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>

                        <form method="POST" action="action/faireDemande.php">
                            <input type="hidden" name="trajet_id" value="<?= $trajet['trajet_id'] ?>">
                            <input type="hidden" name="conducteur_id" value="<?= $trajet['utilisateur_id'] ?>">
                            <input type="hidden" name="nombre_places" value="<?= $nbPlaces ?>">
                            <button type="submit" class="demandeBtn">Faire une demande de covoiturage pour ce trajet</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun trajet trouvé pour les critères sélectionnés.</p>
            <?php endif; ?>

            <a href="javascript:history.back()" class="retour">← Revenir à la recherche</a>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
</body>

</html>