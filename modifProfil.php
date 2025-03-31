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
    <script src="JS/scriptInscription.js" defer></script>
    <script src="JS/script.js" defer></script>
</head>

<body>
    <div class="burger">
        <div class="profilePicContainer">
            <a href="profilUtilisateur.php"><img src="Images/person.jpg" alt="Photo de profil" class="profile-picMini-burger"></a>
        </div>
        <ul>
            <li><a href="indexConnecte.php">Accueil</a></li>
            <li><a href="rechercheTrajet.php">Trouver/Proposer un trajet</a></li>
            <li><a href="notificationUtilisateur.php">Notifications</a></li>
            <li><a href="historiqueUtilisateur.php">Historique</a></li>
            <li><a href="index.php">Déconnexion</a></li>
        </ul>
    </div>

    <header>
        <div class="headerContainer">
            <i class="material-symbols-outlined" id="logoBurger">
                search_hands_free
            </i>

            <div class="title">
                <a href="indexConnecte.php"><img class="logoCarPool" src="Images/logoCarPool.png" alt="Logo CarPool"></a>
                <h1>CarPool</h1>
            </div>
            <div class="CoDeco">
                <a href="profilUtilisateur.php"><img src="Images/person.jpg" alt="Photo de profil" class="profile-picMini"></a>
                <a href="profilUtilisateur.php"><button class="btn">Mon Profil</button></a>
                <a href="index.php" class="btn">Déconnexion</a>
            </div>
        </div>
    </header>

    <main>
        <div class="profileContainer">
            <div class="profileHeader">
                <img src="Images/person.jpg" alt="Photo de profil" class="profile-pic">
                <h1 class="profile-name">Papillon-Gris</h1>
            </div>
            <div class="modifProfil">
                <div class="titleModif">
                    <h2>Modifier le Profil</h2>
                </div>
                <form method="">
                    <div class="infoButton">
                        <div class="profileInfo">
                            <p class="icon">👤</p><strong>Nom :</strong>
                            <input type="text" placeholder="John" id="nom" name="nom"><br><br>

                            <p class="icon">✉</p><strong>Email :</strong>
                            <input type="text" placeholder="John.doe@stagiairesmns.fr" id="email" name="email"><br><br>

                            <p class="icon">📞</p><strong>Téléphone :</strong>
                            <input type="tel" placeholder="00 00 00 00 00" id="numero" name="numero"><br><br>

                            <p class="icon">👔</p><strong>Service :</strong>
                            <select class="service">
                                <option>Développement web</option>
                                <option>Technicien résaux </option>
                                <option>Cyber sécurité</option>
                                <option>Web design</option>
                            </select><br><br>

                            <p class="icon">🌍</p><strong>Lieu :</strong>
                            <input type="text" placeholder="Paris" id="lieu" name="lieu "><br><br>

                        </div>

                        <div class="profileInfosBtn">
                            <div class="aPropos">
                                <p class="icon">🚗</p>
                                <strong>Conducteur :</strong>
                                <span class="radio-group">
                                    <label>
                                        <input type="radio" name="conducteur" value="oui" checked> Oui
                                    </label>
                                    <label>
                                        <input type="radio" name="conducteur" value="non"> Non
                                    </label>
                                </span>
                                <p class="icon">❤</p><strong>Préférences :</strong>
                                <textarea class="inputPref" name="Texte" placeholder="Non Fumeur, Animaux, Pas de nourriture"></textarea><br><br>

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


    <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
    
</body>

</html>