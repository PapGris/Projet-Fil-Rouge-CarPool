<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/init.php';

// modif Photo
if (isset($_POST['save_photo']) && isset($_FILES['photo'])) {
    $photo = $_FILES['photo'];

    if ($photo['error'] == 0 && $photo['size'] < 10 * 1024 * 1024) {
        $ext = pathinfo($photo['name'], PATHINFO_EXTENSION);
        $fileName = 'uploads/profil_' . $utilisateur_id . '_' . time() . '.' . $ext;

        // Crée le dossier s’il n'existe pas
        if (!file_exists('uploads')) {
            mkdir('uploads', 0755, true);
        }

        move_uploaded_file($photo['tmp_name'], $fileName);

        $stmt = $db->prepare("UPDATE utilisateur SET utilisateur_photo = :photo WHERE utilisateur_id = :id");
        $stmt->execute(['photo' => $fileName, 'id' => $utilisateur_id]);

        header("Location: profilUtilisateur.php");
        exit();
    }
}

// Supprimer la photo de profil
if (isset($_POST['delete_photo'])) {
    // Récupère l'ancienne photo
    $stmt = $db->prepare("SELECT utilisateur_photo FROM utilisateur WHERE utilisateur_id = :id");
    $stmt->execute(['id' => $utilisateur_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Supprime l'ancien fichier s'il n'est pas la photo par défaut
    if ($result && $result['utilisateur_photo'] && $result['utilisateur_photo'] !== 'Images/photoProfilParDefaut.png') {
        $oldPhoto = $result['utilisateur_photo'];
        if (file_exists($oldPhoto)) {
            unlink($oldPhoto);
        }
    }

    // Met à jour le champ avec l'image par défaut
    $stmt = $db->prepare("UPDATE utilisateur SET utilisateur_photo = 'Images/photoProfilParDefaut.png' WHERE utilisateur_id = :id");
    $stmt->execute(['id' => $utilisateur_id]);

    header("Location: profilUtilisateur.php");
    exit();
}


// Modif pseudo
if (isset($_POST['save_pseudo'])) {
    $new_pseudo = $_POST['new_pseudo'];
    $stmt = $db->prepare("UPDATE utilisateur SET utilisateur_pseudo = :pseudo WHERE utilisateur_id = :id");
    $stmt->execute(['pseudo' => $new_pseudo, 'id' => $utilisateur_id]);
    header("Location: profilUtilisateur.php");
    exit();
}


// Mettre à jour les informations si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $numero = $_POST['numero'];
    $service_nom = $_POST['service'];
    $lieu = $_POST['lieu'];
    $conducteur = $_POST['conducteur'];
    $fumeur = $_POST['fumeur'];
    $nourriture = $_POST['nourriture'];
    $musique = $_POST['musique'];

    //Récupère l'ID du poste à partir de son nom
    $stmt = $db->prepare("SELECT poste_id FROM poste WHERE poste_nom = :service");
    $stmt->bindValue(':service', $service_nom);
    $stmt->execute();
    $poste = $stmt->fetch(PDO::FETCH_ASSOC);

    $poste_id = null;
    if ($poste) {
        $poste_id = $poste['poste_id'];
    }

    // Mise à jour utilisateur (poste_id optionnel)
    $updateSql = "UPDATE utilisateur SET 
                utilisateur_nom = :nom, 
                utilisateur_prenom = :prenom, 
                utilisateur_email = :email, 
                utilisateur_telephone = :numero,
                utilisateur_conducteur = :conducteur, 
                utilisateur_lieu = :lieu,              
                utilisateur_preference_fumeur = :fumeur, 
                utilisateur_preference_nourriture = :nourriture, 
                utilisateur_preference_musique = :musique" .

        ($poste_id !== null ? ", poste_id = :poste_id" : "") .
        " WHERE utilisateur_id = :id";

    $stmt = $db->prepare($updateSql);
    $stmt->bindValue(':nom', $nom);
    $stmt->bindValue(':prenom', $prenom);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':numero', $numero);
    $stmt->bindValue(':conducteur', $conducteur);
    $stmt->bindValue(':lieu', $lieu);
    $stmt->bindValue(':fumeur', $fumeur);
    $stmt->bindValue(':nourriture', $nourriture);
    $stmt->bindValue(':musique', $musique);

    if ($poste_id !== null) {
        $stmt->bindValue(':poste_id', $poste_id);
    }
    $stmt->bindValue(':id', $utilisateur_id);
    $stmt->execute();





    //Redirection
    header("Location: profilUtilisateur.php");
    exit();
} 

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool - Mon Profil</title>
    <link rel="stylesheet" href="CSS/styleModifProfil.css">
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooterConnecte.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
    <link rel="icon" type="image/png" href="Images/favicon.ico" sizes="96x96" />
    <script src="JS/script.js" defer></script>
    <script src="JS/scriptModifProfil.js" defer></script>
</head>

<body>

    <?php require_once 'templates/header.php'; ?>z

    <main>
        <div class="profileContainer">
            <div class="profileHeader">
                <div class="photoEdit">
                    <form method="POST" id="modifierPhotoForm" enctype="multipart/form-data">
                        <input type="file" id="photoUpload" name="photo" accept="image/*">
                        <button type="submit" name="save_photo" id="submitPhotoBtn">Upload</button>
                        <img src="<?= htmlspecialchars($user['utilisateur_photo']) ? htmlspecialchars($user['utilisateur_photo']) : 'Images/photoProfilParDefaut.png' ?>" alt="Photo de profil" class="profile-pic">
                    </form>
                    <button type="button" class="editPhotoBtn">
                        <img src="Images/iconeModifier.png" alt="modifier pseudo" class="iconModif">
                    </button>
                    <button type="submit" name="save_photo" class="savePhotoBtn">💾</button>
                </div>


                <!-- MODALE pour changer la photo -->
                <div id="photoModal" class="modal">
                    <div class="modalContent">
                        <span id="closeModalBtn">&times;</span>
                        <h3>Changer la photo de profil</h3>
                        <form method="POST" enctype="multipart/form-data">
                            <input type="file" id="filePhoto" name="photo" accept="image/*" required >
                            <button type="submit" name="save_photo">Accepter</button>
                        </form>

                        <form method="POST" id="deletePhotoForm">
                            <input type="hidden" name="delete_photo" value="1">
                            <button type="submit" onclick="return confirm('Supprimer la photo de profil ?')">🗑 Supprimer la photo</button>
                        </form>
                    </div>
                </div>
                <div class="modifierPseudo">
                    <form method="POST" id="modifierPseudoForm">
                        <input type="text" name="new_pseudo" value="<?= htmlspecialchars($user['utilisateur_pseudo']) ?>" class="profilePseudoInput">
                        <h2 class="profilePseudo"><?= htmlspecialchars($user['utilisateur_pseudo']) ?></h2>
                        <button type="button" class="editPseudoBtn">
                            <img src="Images/iconeModifier.png" alt="modifier pseudo" class="iconModif">
                        </button>
                        <button type="submit" name="save_pseudo" class="savePseudoBtn">💾</button>
                    </form>
                </div>
            </div>
            <div class="modifProfil">
                <div class="titleModif">
                    <h2>Modifier le Profil</h2>
                </div>
                <form method="POST">
                    <div class="infoButton">
                        <div class="profileInfo">
                            <p class="icon">👤</p><strong>Nom :</strong>
                            <input type="text" value="<?= htmlspecialchars($user['utilisateur_nom']) ?>" id="nom" name="nom"><br><br>

                            <p class="icon">👤</p><strong>Prenom :</strong>
                            <input type="text" value="<?= htmlspecialchars($user['utilisateur_prenom']) ?>" id="prenom" name="prenom"><br><br>

                            <p class="icon">✉</p><strong>Email :</strong>
                            <input type="email" value="<?= htmlspecialchars($user['utilisateur_email']) ?>" id="email" name="email"><br><br>

                            <p class="icon">📞</p><strong>Téléphone :</strong>
                            <input type="tel" value="<?= htmlspecialchars($user['utilisateur_telephone']) ?>" id="numero" name="numero"><br><br>

                            <p class="icon">👔</p><strong>Service :</strong>
                            <select class="service" name="service">
                                <?php
                                $postes = ['Developpeur web', 'Technicien reseau', 'Cyber securite', 'Web designer'];
                                foreach ($postes as $poste) {
                                    $selected = (htmlspecialchars($user['poste_nom']) == $poste) ? 'selected' : '';
                                    echo "<option value=\"$poste\" $selected>$poste</option>";
                                }
                                ?>
                            </select>

                            <br><br>

                            <p class="icon">🌍</p><strong>Lieu :</strong>
                            <input type="text" value="<?= htmlspecialchars($user['utilisateur_lieu']) ?>" id="lieu" name="lieu"><br><br>
                        </div>

                        <div class="profileInfosBtn">
                            <div class="aPropos">
                                <p class="icon">🚗</p>
                                <strong>Conducteur :</strong>
                                <span class="radio-group">
                                    <label>
                                        <input type="radio" name="conducteur" value="1" <?= (isset(htmlspecialchars($user['utilisateur_conducteur'])) && $user['utilisateur_conducteur'] == '1') ? 'checked' : '' ?>> Oui
                                    </label>
                                    <label>
                                        <input type="radio" name="conducteur" value="0" <?= (isset(htmlspecialchars($user['utilisateur_conducteur'])) && $user['utilisateur_conducteur'] == '0') ? 'checked' : '' ?>> Non
                                    </label>
                                </span>

                                <p class="icon">❤</p><strong>Préférences :</strong><br>

                                <!-- Fumeur -->
                                <p class="icon">🚬</p><strong>Fumeur :</strong>
                                <span class="radio-group">
                                    <label>
                                        <input type="radio" name="fumeur" value="1" <?= htmlspecialchars($user['utilisateur_preference_fumeur']) == '1' ? 'checked' : '' ?>> Oui
                                    </label>
                                    <label>
                                        <input type="radio" name="fumeur" value="0" <?= htmlspecialchars($user['utilisateur_preference_fumeur']) == '0' ? 'checked' : '' ?>> Non
                                    </label>
                                </span>
(
                                <!-- Nourriture -->
                                <p class="icon">🍗</p><strong>Nourriture :</strong>
                                <span class="radio-group">
                                    <label>
                                        <input type="radio" name="nourriture" value="1" <?= htmlspecialchars($user['utilisateur_preference_nourriture']) == '1' ? 'checked' : '' ?>> Oui
                                    </label>
                                    <label>
                                        <input type="radio" name="nourriture" value="0" <?= htmlspecialchars($user['utilisateur_preference_nourriture']) == '0' ? 'checked' : '' ?>> Non
                                    </label>
                                </span>

                                <!-- Musique -->
                                <p class="icon">🎵</p><strong>Musique :</strong>
                                <span class="radio-group">
                                    <label>
                                        <input type="radio" name="musique" value="1" <?= htmlspecialchars($user['utilisateur_preference_musique']) == '1' ? 'checked' : '' ?>> Oui
                                    </label>
                                    <label>
                                        <input type="radio" name="musique" value="0" <?= htmlspecialchars($user['utilisateur_preference_musique']) == '0' ? 'checked' : '' ?>> Non
                                    </label>
                                </span>
                            </div>
                            <div class="profileActions">
                                <button type="submit" class="sumbit">Enregistrer les modifications</button>
                                <a href="profilUtilisateur.php">
                                    <button type="button" class="annuler">Annuler</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

</body>

</html>