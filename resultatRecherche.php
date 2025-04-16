<?php
require 'config/db.php';
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool - Resultat recherche d'un trajet</title>
    <link rel="stylesheet" href="CSS/styleResultatRecherche.css">
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooterConnecte.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
    <link rel="icon" type="image/png" href="Images/favicon.ico" sizes="96x96" />
</head>

<body>
    <?php
    require_once 'templates/header.php';
    ?>

    <main>
        <section class="trajetContainer">
            <h2>Trajets disponibles</h2>

            <div class="trajetHeader">
                <p><strong>Départ :</strong> Paris</p>
                <p><strong>Destination :</strong> Lyon</p>
                <p><strong>Date :</strong> 2025-04-20</p>
            </div>

            <div class="trajetCard">
                <p><strong>De :</strong> Paris</p>
                <p><strong>À :</strong> Lyon</p>
                <p><strong>Date :</strong> 2025-04-20</p>
                <p><strong>Places disponibles :</strong> 3</p>
                <p><strong>Proposé par :</strong> Clara Dupont</p>
                <button type="button" class="demandeBtn">Faire une demande de covoiturage pour ce trajet</button>
            </div>

            <div class="trajetCard">
                <p><strong>De :</strong> Paris</p>
                <p><strong>À :</strong> Lyon</p>
                <p><strong>Date :</strong> 2025-04-20</p>
                <p><strong>Places disponibles :</strong> 2</p>
                <p><strong>Proposé par :</strong> Marc Lemoine</p>
                <button type="button" class="demandeBtn">Faire une demande de covoiturage pour ce trajet</button>
            </div>

            <!-- Résultat vide à afficher si besoin -->
            <!-- <p>Aucun trajet trouvé pour les critères sélectionnés.</p> -->

            <a href="index.php" class="retour">← Revenir à la recherche</a>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

</body>

</html>