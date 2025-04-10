<?php
require 'config/db.php';


if (isset($_POST['nom']) && $_POST['nom'] !== '' && 
    isset($_POST['prenom']) && $_POST['prenom'] !== '' && 
    isset($_POST['email']) && $_POST['email'] !== '' &&  
    isset($_POST['numero']) && $_POST['numero'] !== '' &&
    isset($_POST['pseudo']) && $_POST['pseudo'] !== '' &&
    isset($_POST['mot_de_passe']) && $_POST['mot_de_passe'] !== '' && 
    isset($_POST['confirmer_mot_de_passe']) && $_POST['confirmer_mot_de_passe'] !== '') {


        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $numero = htmlspecialchars($_POST['numero']);
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = htmlspecialchars($_POST['mot_de_passe']);
        $confirmPassword = htmlspecialchars($_POST['confirmer_mot_de_passe']);
        $conducteur = 0;

        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = $db->prepare("INSERT INTO utilisateur (utilisateur_nom, utilisateur_prenom, utilisateur_email, utilisateur_telephone, utilisateur_pseudo, utilisateur_mdp, utilisateur_conducteur) VALUES (:nom, :prenom, :email, :numero, :pseudo, :password, :conducteur)");
        $query->bindValue(":nom", $nom);
        $query->bindValue(":prenom", $prenom);
        $query->bindValue(":email", $email);
        $query->bindValue(":numero", $numero);
        $query->bindValue(":pseudo", $pseudo);
        $query->bindValue(":password", $password);
        $query->bindValue(":conducteur", $conducteur);
        $query->execute();

        $id = $db->lastInsertId();


        $query2 = $db->prepare("INSERT INTO preference (preference_fumeur, preference_nourriture, preference_musique, utilisateur_id) VALUES (:preferenceFumeur, :preferenceNourriture, :preferenceMusique, :id)");
        $query2->bindValue(":preferenceFumeur", 0);
        $query2->bindValue(":preferenceNourriture", 0);
        $query2->bindValue(":preferenceMusique", 0);
        $query2->bindValue(":id", $db->lastInsertId());
        $query2->execute();

        header("Location: connexion.php");
        exit;
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

    <?php
    require_once 'templates/header.php';
    ?>

    <main>

        <div class="formI-container">
            <form method="post" id="form">
                <div>
                    <label for="nom">Nom <span class="required">*</span>:</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div>
                    <label for="prenom">Prénom <span class="required">*</span>:</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>
                <div>
                    <label for="email">Email<span class="required">*</span>:</label>
                    <input type="email" id="email" name="email" required>
                    <span class="exemple">ex: email.vous@gmail.fr</span>
                </div>
                <div>
                    <label for="numbero">Tél <span class="required">*</span>:</label>
                    <input type="tel" id="numero" name="numero" required><br>
                    <span class="exemple">ex: + 33 6 03 30 03 33</span>
                </div>
                <div>
                    <label for="pseudo">Pseudo<span class="required">*</span> :</label>
                    <input type="text" id="pseudo" name="pseudo" required>
                </div>
                <div>
                    <label for="mot_de_passe">Mot de passe<span class="required">*</span> :</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" autocomplete="new-password" required>
                    <button class="butonCond" type="button" id="displayModal">conditions MDP</button>
                </div>
                <div>
                    <label for="confirmer_mot_de_passe">Confirmer le mot de passe<span class="required">*</span>:</label>
                    <input type="password" id="confirmer_mot_de_passe" name="confirmer_mot_de_passe" onBlur="checkPass()" autocomplete="new-password" required>

                </div>
                <div id="divcomp"></div><br>
                <div>
                    <input type="submit" id="btn" value="S'inscrire"><br><br>
                    <!-- <a href="profilUtilisateur.php"><button class="boutonMdp" type="button">S'inscrire</button></a><br><br> -->
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