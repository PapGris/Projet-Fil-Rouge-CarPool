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
    <script src="JS/scriptInscription.js" defer></script>
    <script src="JS/script.js" defer></script>
</head>

<body>

    <div class="burger">
        <ul>
            <li><a href="connexion.php">Connexion</a></li>
            <li><a href="rechercheTrajet.php">Trouver/Proposer un trajet</a></li>
        </ul>
    </div>

    <header>
        <div class="headerContainer">
            <i class="material-symbols-outlined" id="logoBurger">
                search_hands_free
            </i>

            <div class="title">
                <a href="index.php"><img class="logoCarPool" src="Images/logoCarPool.png" alt="Logo CarPool"></a>
                <h1>CarPool</h1>
            </div>
            <div class="CoDeco">
                <a href="connexion.php"><button class="btn">Connexion</button></a>
            </div>
        </div>
    </header>
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
                    <input type="password" id="confirmer_mot_de_passe" name="confirme_mot_de_passe" onBlur="checkPass()" autocomplete="new-password" required>

                </div>
                <div id="divcomp"></div><br>
                <div>
                    <!-- <input type="submit" id="btn" value="S'inscrire"><br><br> -->
                    <a href="profilUtilisateur.php"><button class="boutonMdp" type="button">S'inscrire</button></a><br><br>
                    <a href="index.php"><button class="boutonAccueil" type="button">Retour à l'accueil</button></a>
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
    
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>

</body>

</html>