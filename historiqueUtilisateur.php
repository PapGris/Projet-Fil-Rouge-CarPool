<?php
require 'config/db.php';
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool - Historique</title>
    <link rel="stylesheet" href="CSS/sytleHistoriqueUtilisateur.css">
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
        <div class="historyContainer">
            <h2>Vos trajets passés</h2>
            <table class="historyTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Départ</th>
                        <th>Arrivée</th>
                        <th>Passagers</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>15/03/2025</td>
                        <td>Paris</td>
                        <td>Lyon</td>
                        <td>3</td>
                        <td>Terminé</td>
                        <td>
                            <div>
                                <button class="detailsBtn">Voir</button>
                                <a href="economieUtilisateur.php"><button class="detailsBtn">Économies</button></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>08/03/2025</td>
                        <td>Bordeaux</td>
                        <td>Toulouse</td>
                        <td>2</td>
                        <td>Annulé</td>
                        <td>
                            <div>
                                <button class="detailsBtn">Voir</button>
                                <a href="economieUtilisateur.php"><button class="detailsBtn">Économies</button></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <a href="profilUtilisateur.php">
                    <button type="button" class="retour">Retour au profil</button>
                </a>
            </div>
        </div>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

</body>

</html>