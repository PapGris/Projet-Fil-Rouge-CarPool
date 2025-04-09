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

    // Mettre à jour les informations si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1. Récupération des données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $numero = $_POST['numero'];
        $service_nom = $_POST['service']; // <-- ce champ est un NOM (ex: "Technicien réseau")
        $lieu = $_POST['lieu'];
        // $conducteur = $_POST['conducteur'];
        $fumeur = $_POST['fumeur'];
        $nourriture = $_POST['nourriture'];
        $musique = $_POST['musique'];

        // 2. Récupère l'ID du poste à partir de son nom
        $stmt = $db->prepare("SELECT poste_id FROM poste WHERE poste_nom = :service");
        $stmt->bindValue(':service', $service_nom);
        $stmt->execute();
        $poste = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($poste) {
            $poste_id = $poste['poste_id'];

            // 3. Mise à jour de la table utilisateur
            $updateSql = "UPDATE utilisateur SET 
                        utilisateur_nom = :nom, 
                        utilisateur_prenom = :prenom, 
                        utilisateur_email = :email, 
                        utilisateur_telephone = :numero,
                        -- utilisateur_conducteur = :conducteur, 
                        utilisateur_lieu = :lieu, 
                        poste_id = :poste_id
                      WHERE utilisateur_id = :id";

            $stmt = $db->prepare($updateSql);
            $stmt->bindValue(':nom', $nom);
            $stmt->bindValue(':prenom', $prenom);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':numero', $numero);
            // $stmt->bindValue(':conducteur', $conducteur);
            $stmt->bindValue(':lieu', $lieu);
            $stmt->bindValue(':poste_id', $poste_id);
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
    <script src="JS/scriptInscription.js" defer></script>
    <script src="JS/script.js" defer></script>
</head>

<body>

    <?php require_once 'templates/header.php'; ?>

    <main>
        <div class="profileContainer">
            <div class="profileHeader">
                <div>
                    <img src="Images/iconeModifier.png" alt="icone de modification" style="width: 30px;" class="iconModif">
                    <img src="Images/person.jpg" alt="Photo de profil" class="profile-pic">
                </div>
                <div class="modifierPseudo">
                    <img src="Images/iconeModifier.png" alt="icone de modification" style="width: 30px;" class="iconModif">
                    <h1 class="profile-name"><?= $user['utilisateur_pseudo'] ?></h1>
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
                                <option value="Développeur web" <?= $user['poste_nom'] == 'Développeur web' ? 'selected' : '' ?>>Développeur web</option>
                                <option value="Technicien réseau" <?= $user['poste_nom'] == 'Technicien réseau' ? 'selected' : '' ?>>Technicien réseau</option>
                                <option value="Cyber sécurité" <?= $user['poste_nom'] == 'Cyber sécurité' ? 'selected' : '' ?>>Cyber sécurité</option>
                                <option value="Web designer" <?= $user['poste_nom'] == 'Web designer' ? 'selected' : '' ?>>Web designer</option>
                            </select><br><br>

                            <p class="icon">🌍</p><strong>Lieu :</strong>
                            <input type="text" value="<?= $user['utilisateur_lieu'] ?>" id="lieu" name="lieu"><br><br>
                        </div>

                        <div class="profileInfosBtn">
                            <div class="aPropos">
                                <p class="icon">🚗</p>
                                <!-- <strong>Conducteur :</strong>
                                <span class="radio-group">
                                    <label>
                                        <input type="radio" name="conducteur" value="1" <?= $user['utilisateur_conducteur'] == '1' ? 'checked' : '' ?>> Oui
                                    </label>
                                    <label>
                                        <input type="radio" name="conducteur" value="0" <?= $user['utilisateur_conducteur'] == '0' ? 'checked' : '' ?>> Non
                                    </label>
                                </span> -->

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

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

</body>

</html>