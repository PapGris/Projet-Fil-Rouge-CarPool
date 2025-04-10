<?php
require 'config/db.php';
require_once 'config/session.php';
$utilisateur_id = $_SESSION['id'];

// Récupérer les informations actuelles de l'utilisateur
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

// modif Photo
if (isset($_POST['save_photo']) && isset($_FILES['photo'])) {
    $photo = $_FILES['photo'];

    if ($photo['error'] == 0 && $photo['size'] < 2 * 1024 * 1024) {
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
    } else {
        echo "Erreur lors de l'upload de la photo.";
    }
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

    // 1. Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $numero = $_POST['numero'];
    $service_nom = $_POST['service']; // <-- ce champ est un NOM (ex: "Technicien réseau")
    $lieu = $_POST['lieu'];
    $conducteur = $_POST['conducteur'];
    $fumeur = $_POST['fumeur'];
    $nourriture = $_POST['nourriture'];
    $musique = $_POST['musique'];

    // 2. Récupère l'ID du poste à partir de son nom
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
                utilisateur_lieu = :lieu" .
        ($poste_id !== null ? ", poste_id = :poste_id" : "") .
        " WHERE utilisateur_id = :id";

    $stmt = $db->prepare($updateSql);
    $stmt->bindValue(':nom', $nom);
    $stmt->bindValue(':prenom', $prenom);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':numero', $numero);
    $stmt->bindValue(':conducteur', $conducteur);
    $stmt->bindValue(':lieu', $lieu);

    if ($poste_id !== null) {
        $stmt->bindValue(':poste_id', $poste_id);
    }
    $stmt->bindValue(':id', $utilisateur_id);
    $stmt->execute();

    // 4. Mise à jour des préférences
    $updatePrefSql = "UPDATE preference SET 
                            preference_fumeur = :fumeur, 
                            preference_nourriture = :nourriture, 
                            preference_musique = :musique 
                            WHERE utilisateur_id = :id";

    $stmt = $db->prepare($updatePrefSql);
    $stmt->bindValue(':fumeur', $fumeur);
    $stmt->bindValue(':nourriture', $nourriture);
    $stmt->bindValue(':musique', $musique);
    $stmt->bindValue(':id', $utilisateur_id);
    $stmt->execute();

    // 5. Redirection
    header("Location: profilUtilisateur.php");
    exit();
} else {
    echo "Erreur : poste introuvable.";
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
</head>

<body>

    <?php require_once 'templates/header.php'; ?>

    <main>
        <div class="profileContainer">
            <div class="profileHeader">
                <div class="photoEdit">
                    <form method="POST" id="modifierPhotoForm" enctype="multipart/form-data">
                        <input type="file" id="photoUpload" name="photo" accept="image/*">
                        <button type="submit" name="save_photo" id="submitPhotoBtn">Upload</button>
                        <img src="<?= $user['utilisateur_photo'] ? $user['utilisateur_photo'] : 'Images/person.jpg' ?>" alt="Photo de profil" class="profile-pic">
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
                            <input type="file" name="photo" accept="image/*" required style="margin-top: 10px;">
                            <button type="submit" name="save_photo" style="margin-top: 15px; display: block;">Envoyer</button>
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
                            <input type="text" value="<?= $user['utilisateur_nom'] ?>" id="nom" name="nom"><br><br>

                            <p class="icon">👤</p><strong>Prenom :</strong>
                            <input type="text" value="<?= $user['utilisateur_prenom'] ?>" id="prenom" name="prenom"><br><br>

                            <p class="icon">✉</p><strong>Email :</strong>
                            <input type="email" value="<?= $user['utilisateur_email'] ?>" id="email" name="email"><br><br>

                            <p class="icon">📞</p><strong>Téléphone :</strong>
                            <input type="tel" value="<?= $user['utilisateur_telephone'] ?>" id="numero" name="numero"><br><br>

                            <p class="icon">👔</p><strong>Service :</strong>
                            <select class="service" name="service">
                                <?php
                                $postes = ['Developpeur web', 'Technicien reseau', 'Cyber securite', 'Web designer'];
                                foreach ($postes as $poste) {
                                    $selected = ($user['poste_nom'] == $poste) ? 'selected' : '';
                                    echo "<option value=\"$poste\" $selected>$poste</option>";
                                }
                                ?> 
                            </select>

                            <br><br>

                            <p class="icon">🌍</p><strong>Lieu :</strong>
                            <input type="text" value="<?= $user['utilisateur_lieu'] ?>" id="lieu" name="lieu"><br><br>
                        </div>

                        <div class="profileInfosBtn">
                            <div class="aPropos">
                                <p class="icon">🚗</p>
                                <strong>Conducteur :</strong>
                                <span class="radio-group">
                                    <label>
                                        <input type="radio" name="conducteur" value="1" <?= (isset($user['utilisateur_conducteur']) && $user['utilisateur_conducteur'] == '1') ? 'checked' : '' ?>> Oui
                                    </label>
                                    <label>
                                        <input type="radio" name="conducteur" value="0" <?= (isset($user['utilisateur_conducteur']) && $user['utilisateur_conducteur'] == '0') ? 'checked' : '' ?>> Non
                                    </label>
                                </span>

                                <p class="icon">❤</p><strong>Préférences :</strong><br>

                                <!-- Fumeur -->
                                <p class="icon">🚬</p><strong>Fumeur :</strong>
                                <span class="radio-group">
                                    <label>
                                        <input type="radio" name="fumeur" value="1" <?= $user['preference_fumeur'] == '1' ? 'checked' : '' ?>> Oui
                                    </label>
                                    <label>
                                        <input type="radio" name="fumeur" value="0" <?= $user['preference_fumeur'] == '0' ? 'checked' : '' ?>> Non
                                    </label>
                                </span>

                                <!-- Nourriture -->
                                <p class="icon">🍗</p><strong>Nourriture :</strong>
                                <span class="radio-group">
                                    <label>
                                        <input type="radio" name="nourriture" value="1" <?= $user['preference_nourriture'] == '1' ? 'checked' : '' ?>> Oui
                                    </label>
                                    <label>
                                        <input type="radio" name="nourriture" value="0" <?= $user['preference_nourriture'] == '0' ? 'checked' : '' ?>> Non
                                    </label>
                                </span>

                                <!-- Musique -->
                                <p class="icon">🎵</p><strong>Musique :</strong>
                                <span class="radio-group">
                                    <label>
                                        <input type="radio" name="musique" value="1" <?= $user['preference_musique'] == '1' ? 'checked' : '' ?>> Oui
                                    </label>
                                    <label>
                                        <input type="radio" name="musique" value="0" <?= $user['preference_musique'] == '0' ? 'checked' : '' ?>> Non
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

    <script>
        // Script pour ouvrir et fermer la modale
        document.addEventListener("DOMContentLoaded", () => {
            const openBtn = document.querySelector(".editPhotoBtn"); // Bouton Modifier photo
            const modal = document.getElementById("photoModal");
            const closeBtn = document.getElementById("closeModalBtn");

            // Ouvrir la modale
            openBtn.addEventListener("click", () => {
                modal.style.display = "block";
            });

            // Fermer la modale en cliquant sur la croix
            closeBtn.addEventListener("click", () => {
                modal.style.display = "none";
            });

            // Fermer la modale si on clique en dehors de celle-ci
            window.addEventListener("click", (e) => {
                if (e.target == modal) {
                    modal.style.display = "none";
                }
            });
        });

        // modif Pseudo
        document.addEventListener("DOMContentLoaded", () => {
            const editBtn = document.querySelector(".editPseudoBtn");
            const saveBtn = document.querySelector(".savePseudoBtn");
            const nameText = document.querySelector(".profilePseudo");
            const nameInput = document.querySelector(".profilePseudoInput");

            editBtn.addEventListener("click", () => {
                nameText.style.display = "none";
                nameInput.style.display = "inline-block";
                saveBtn.style.display = "inline-block";
                editBtn.style.display = "none";
                nameInput.focus();
            });
        });
    </script>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

</body>

</html>