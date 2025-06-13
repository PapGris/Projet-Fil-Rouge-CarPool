<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    exit;
}

// Récupérer le role_id de l'utilisateur connecté
$sql = "SELECT role_id FROM utilisateur WHERE utilisateur_id = :id";
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $_SESSION['id']]);
$userRole = $stmt->fetchColumn();

if ($userRole != 1) { // 1 = administrateur
    header('Location: profil.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Carpool - Backoffice</title>
    <link rel="stylesheet" href="CSS/styleBackoffice.css" />
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooterConnecte.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
    <link rel="icon" type="image/png" href="Images/favicon.ico" sizes="96x96" />
    <script src="https://kit.fontawesome.com/08cd7dbe9f.js" crossorigin="anonymous"></script>
    <script src="JS/script.js" defer></script>
    <script src="JS/scriptBackoffice.js" defer></script>

</head>

<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>

    <main>
        <div class="userContainer">

            <h2>Backoffice des utilisateurs</h2>
            <div>
                <table class="userTable">
                    <thead>
                        <tr>
                            <th>Nom Prénom</th>
                            <th>Pseudo</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Service</th>
                            <th>Lieu</th>
                            <th>Conducteur</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT u.utilisateur_id, u.utilisateur_nom, u.utilisateur_prenom, u.utilisateur_pseudo,
                                   u.utilisateur_email, u.utilisateur_telephone, u.utilisateur_lieu,
                                   u.utilisateur_conducteur, p.poste_nom
                            FROM utilisateur u
                            LEFT JOIN poste p ON u.poste_id = p.poste_id";
                        $stmt = $db->query($sql);
                        $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($utilisateurs as $u): ?>
                            <tr id="ligne-utilisateur-<?= $u['utilisateur_id'] ?>">
                                <td>
                                    <a href="profilPublic.php?id=<?= $u['utilisateur_id'] ?>" class="profil-link">
                                        <?= htmlspecialchars($u['utilisateur_nom'] . ' ' . $u['utilisateur_prenom']) ?>
                                    </a>
                                </td>
                                <td><?= htmlspecialchars($u['utilisateur_pseudo']) ?></td>
                                <td><?= htmlspecialchars($u['utilisateur_email']) ?></td>
                                <td><?= htmlspecialchars($u['utilisateur_telephone']) ?></td>
                                <td><?= htmlspecialchars($u['poste_nom'] ?? 'Non défini') ?></td>
                                <td><?= htmlspecialchars($u['utilisateur_lieu'] ?? 'Inconnu') ?></td>
                                <td><?= $u['utilisateur_conducteur'] ? 'Oui' : 'Non' ?></td>
                                <td>
                                    <div class="btn-container">
                                        <button class="btn-modifier" onclick="activerEdition(<?= $u['utilisateur_id'] ?>)"><i class="fa-solid fa-pencil"></i>Modifier</button>
                                        <!-- Bouton qui déclenche la modale -->
                                        <button class="btn-supprimer" onclick="ouvrirModale('<?= $u['utilisateur_id'] ?>', '<?= htmlspecialchars($u['utilisateur_nom'] . ' ' . $u['utilisateur_prenom']) ?>')">
                                            <i class="fa-solid fa-trash-can"></i>Supprimer
                                        </button>

                                        <!-- Modale de confirmation -->
                                        <div id="modale-suppression" class="modale-overlay" style="display:none;">
                                            <div class="modale-contenu">
                                                <p id="texte-modale">Êtes-vous sûr de vouloir supprimer ce profil ?</p>
                                                <div class="modale-boutons">
                                                    <form id="form-suppression" method="POST" action="action/supprimerUtilisateur.php">
                                                        <input type="hidden" name="utilisateur_id" id="utilisateur-id-supprimer">
                                                        <button type="submit" class="btn-modale btn-oui">Oui</button>
                                                        <button type="button" class="btn-modale btn-non" onclick="fermerModale()">Non</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

</body>

</html>