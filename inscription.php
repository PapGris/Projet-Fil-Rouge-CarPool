<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';

$erreurs = [];

if (
    isset(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['email'],
        $_POST['numero'],
        $_POST['pseudo'],
        $_POST['mot_de_passe'],
        $_POST['confirmer_mot_de_passe']
    ) &&
    $_POST['nom'] !== '' && $_POST['prenom'] !== '' && $_POST['email'] !== '' &&
    $_POST['numero'] !== '' && $_POST['pseudo'] !== '' &&
    $_POST['mot_de_passe'] !== '' && $_POST['confirmer_mot_de_passe'] !== ''
) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $numero = htmlspecialchars($_POST['numero']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['mot_de_passe']);
    $confirmPassword = htmlspecialchars($_POST['confirmer_mot_de_passe']);
    $conducteur = 0;

    if ($password !== $confirmPassword) {
        $erreurs['mot_de_passe'] = "Les mots de passe ne correspondent pas.";
    }

    if (empty($erreurs)) {
        $query = $db->prepare('SELECT * FROM utilisateur WHERE utilisateur_pseudo = :pseudo OR utilisateur_email = :email OR utilisateur_telephone = :numero');
        $query->bindValue(':pseudo', $pseudo);
        $query->bindValue(':email', $email);
        $query->bindValue(':numero', $numero);
        $query->execute();

        $resultat = $query->fetch();

        if ($resultat) {
            if ($resultat['utilisateur_pseudo'] === $pseudo) {
                $erreurs['pseudo'] = "Ce pseudo est déjà utilisé.";
            }
            if ($resultat['utilisateur_email'] === $email) {
                $erreurs['email'] = "Cet email est déjà utilisé.";
            }
            if ($resultat['utilisateur_telephone'] === $numero) {
                $erreurs['numero'] = "Ce numéro est déjà utilisé.";
            }
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            try {
                $query = $db->prepare("INSERT INTO utilisateur 
                    (utilisateur_nom, utilisateur_prenom, utilisateur_email, utilisateur_telephone, utilisateur_pseudo, utilisateur_mdp, utilisateur_conducteur, utilisateur_preference_fumeur, utilisateur_preference_nourriture, utilisateur_preference_musique, role_id)
                    VALUES (:nom, :prenom, :email, :numero, :pseudo, :password, :conducteur, :preferenceFumeur, :preferenceNourriture, :preferenceMusique, :role_id)");

                $query->bindValue(":nom", $nom);
                $query->bindValue(":prenom", $prenom);
                $query->bindValue(":email", $email);
                $query->bindValue(":numero", $numero);
                $query->bindValue(":pseudo", $pseudo);
                $query->bindValue(":password", $passwordHash);
                $query->bindValue(":conducteur", $conducteur);
                $query->bindValue(":preferenceFumeur", 0);
                $query->bindValue(":preferenceNourriture", 0);
                $query->bindValue(":preferenceMusique", 0);
                $query->bindValue(":role_id", 2);
                $query->execute();

                header("Location: connexion.php");
                exit;
            } catch (PDOException $e) {
                $erreurs['general'] = "Erreur lors de l'inscription. Veuillez réessayer.";
                // log ou debug possible : error_log($e->getMessage());
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool - Inscription</title>
    <link rel="stylesheet" href="CSS/styleInscription.css">
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooter.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
    <link rel="icon" type="image/png" href="Images/favicon.ico" sizes="96x96" />
    <script src="JS/scriptInscription.js" defer></script>
    <script src="JS/script.js" defer></script>
</head>

<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>

    <main>
        <div class="formI-container">
            <form method="post" id="form">
                <?php if (!empty($erreurs['general'])): ?>
                    <div class="error"><?= $erreurs['general'] ?></div>
                <?php endif; ?>
                <div>
                    <label for="nom">Nom <span class="required">*</span>:</label>
                    <input type="text" id="nom" name="nom" required value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>">
                </div>
                <div>
                    <label for="prenom">Prénom <span class="required">*</span>:</label>
                    <input type="text" id="prenom" name="prenom" required value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>">
                </div>
                <div>
                    <label for="email">Email<span class="required">*</span>:</label>
                    <input type="email" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    <span class="exemple">ex: email.vous@gmail.fr</span>
                    <?php if (!empty($erreurs['email'])): ?>
                        <div class="error"><?= $erreurs['email'] ?></div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="numero">Tél <span class="required">*</span>:</label>
                    <input type="tel" id="numero" name="numero" required value="<?= htmlspecialchars($_POST['numero'] ?? '') ?>">
                    <span class="exemple">ex: +33 6 03 30 03 33</span>
                    <?php if (!empty($erreurs['numero'])): ?>
                        <div class="error"><?= $erreurs['numero'] ?></div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="pseudo">Pseudo<span class="required">*</span> :</label>
                    <input type="text" id="pseudo" name="pseudo" required value="<?= htmlspecialchars($_POST['pseudo'] ?? '') ?>">
                    <?php if (!empty($erreurs['pseudo'])): ?>
                        <div class="error"><?= $erreurs['pseudo'] ?></div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="mot_de_passe">Mot de passe<span class="required">*</span> :</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" autocomplete="new-password" required>
                    <button class="butonCond" type="button" id="displayModal">conditions MDP</button>
                    <?php if (!empty($erreurs['mot_de_passe'])): ?>
                        <div class="error"><?= $erreurs['mot_de_passe'] ?></div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="confirmer_mot_de_passe">Confirmer le mot de passe<span class="required">*</span>:</label>
                    <input type="password" id="confirmer_mot_de_passe" name="confirmer_mot_de_passe" autocomplete="new-password" required>
                </div><br>
                <div>
                    <input type="submit" id="btn" value="S'inscrire"><br><br>
                    <a href="index.php"><button class="boutonAccueil" type="button">Retour à l'accueil</button></a><br><br>
                    <span class="champsObligatoires">*Champs obligatoires</span>
                </div>
            </form>
        </div>

        <div id="modal">
            <div tabindex="-1">
                <h2>Le mot de passe doit contenir :</h2>
                <ul>
                    <li id="length" style="color:red;">❌ Au moins 8 caractères</li>
                    <li id="uppercase" style="color:red;">❌ Une lettre majuscule</li>
                    <li id="lowercase" style="color:red;">❌ Une lettre minuscule</li>
                    <li id="number" style="color:red;">❌ Un chiffre</li>
                    <li id="special" style="color:red;">❌ Un caractère spécial (#?!@$%^&*-)</li>
                </ul>
                <button id="closeModal">OK</button>
            </div>
        </div>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

</body>

</html>