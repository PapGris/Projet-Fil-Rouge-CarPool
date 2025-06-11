<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/session.php';

$confirmation = isset($_GET['confirmation']) && $_GET['confirmation'] == 1;
$nom = htmlspecialchars($_GET['nom'] ?? '');
$prenom = htmlspecialchars($_GET['prenom'] ?? '');
$places = (int) ($_GET['places'] ?? 0);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool - Résultat de recherche</title>
    <link rel="stylesheet" href="CSS/styleResultatRecherche.css">
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooterConnecte.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="Images/favicon.ico" sizes="96x96" />
    <script src="JS/script.js" defer></script>
</head>

<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>

    <main>
        <section class="trajetContainer">
            <h2>Trajets disponibles</h2>

            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deja_fait' && $places): ?>
                <div class="trajetHeader">
                    <p><strong>
                            Vous avez déjà fait une demande de réservation de <?= $places ?> place<?= $places > 1 ? 's' : '' ?> pour ce trajet.
                        </strong></p>
                </div>
            <?php elseif ($confirmation && $nom && $prenom && $places): ?>
                <div class="trajetHeader">
                    <p><strong>
                            Une demande de réservation a bien été envoyée à <?= $prenom . ' ' . $nom ?> pour
                            <?= $places ?> place<?= $places > 1 ? 's' : '' ?>.
                        </strong></p>
                </div>
            <?php endif; ?>

            <a href="javascript:history.back()" class="retour">← Revenir à la recherche</a>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>
</body>

</html>