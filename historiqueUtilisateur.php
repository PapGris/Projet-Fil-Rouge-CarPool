<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/session.php';

$utilisateur_id = $_SESSION['id'];
$aujourdhui = date('Y-m-d');

// --- Requête générique pour les trajets ---
function getTrajets($db, $utilisateur_id, $aujourdhui, $sens = 'passe')
{
    $comparateur = $sens === 'passe' ? '<' : '>=';

    // Conducteur
    $sqlConducteur = "
        SELECT t.trajet_id, t.trajet_date_depart, t.trajet_lieu_depart, t.trajet_lieu_arrivee,
               (SELECT COUNT(*) FROM demande_trajet dt 
                WHERE dt.trajet_id = t.trajet_id AND dt.statut = 'acceptee') AS passagers,
               'Conducteur' AS role
        FROM trajet t
        WHERE t.utilisateur_id = ?
        AND t.trajet_date_depart $comparateur ?
    ";

    // Passager
    $sqlPassager = "
        SELECT t.trajet_id, t.trajet_date_depart, t.trajet_lieu_depart, t.trajet_lieu_arrivee,
               dt.nombre_places AS passagers,
               'Passager' AS role
        FROM demande_trajet dt
        JOIN trajet t ON t.trajet_id = dt.trajet_id
        WHERE dt.utilisateur_id = ?
        AND dt.statut = 'acceptee'
        AND t.trajet_date_depart $comparateur ?
    ";

    $stmt1 = $db->prepare($sqlConducteur);
    $stmt1->execute([$utilisateur_id, $aujourdhui]);
    $conducteur = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    $stmt2 = $db->prepare($sqlPassager);
    $stmt2->execute([$utilisateur_id, $aujourdhui]);
    $passager = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    $resultats = array_merge($conducteur, $passager);
    usort($resultats, function ($a, $b) {
        return strtotime($b['trajet_date_depart']) - strtotime($a['trajet_date_depart']);
    });

    return $resultats;
}

$trajetsPasses = getTrajets($db, $utilisateur_id, $aujourdhui, 'passe');
$trajetsFuturs = getTrajets($db, $utilisateur_id, $aujourdhui, 'futur');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Carpool - Historique</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="CSS/styleHistoriqueUtilisateur.css">
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooterConnecte.css">
    <link rel="icon" type="image/png" href="Images/favicon.ico" sizes="96x96" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

</head>

<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>

    <main>
        <div class="historyContainer">
            <h2>Vos trajets passés</h2>
            <?= afficherTableauTrajets($trajetsPasses) ?>

            <h2>Vos trajets à venir</h2>
            <?= afficherTableauTrajets($trajetsFuturs) ?>

            <div>
                <a href="profilUtilisateur.php"><button class="retour">Retour au profil</button></a>
            </div>
        </div>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
</body>

</html>

<?php
// Fonction pour générer le HTML du tableau
function afficherTableauTrajets($trajets)
{
    if (empty($trajets)) {
        return '<p>Aucun trajet trouvé.</p>';
    }

    ob_start(); ?>
    <table class="historyTable">
        <thead>
            <tr>
                <th>Date</th>
                <th>Départ</th>
                <th>Arrivée</th>
                <th>Passagers</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trajets as $trajet): ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($trajet['trajet_date_depart'])) ?></td>
                    <td><?= htmlspecialchars($trajet['trajet_lieu_depart']) ?></td>
                    <td><?= htmlspecialchars($trajet['trajet_lieu_arrivee']) ?></td>
                    <td><?= $trajet['passagers'] ?></td>
                    <td>
                        <span class="<?= $trajet['role'] === 'Conducteur' ? 'role-conducteur' : 'role-passager' ?>">
                            <?= $trajet['role'] ?>
                        </span>
                    </td>
                    <td>
                        <div>
                            <a href="detailsTrajet.php?trajet_id=<?= $trajet['trajet_id'] ?>"><button class="detailsBtn">Voir</button></a>
                            <a href="economieUtilisateur.php"><button class="detailsBtn">Économies</button></a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php
    return ob_get_clean();
}
?>