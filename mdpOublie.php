<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool - MDP Oublié</title>
    <link rel="stylesheet" href="CSS/styleInscription.css">
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooter.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free"/>
    <script src="JS/scriptInscription.js" defer></script>
    <script src="JS/script.js" defer></script>
</head>
<body>

    <div class="burger">            
        <ul>
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="#">Qui sommes nous ?</a></li>
            <li><a href="#">Poposer un trajet</a></li>
            <li><a href="#">Contactez-nous</a></li>
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
                <a href="inscription.php"><button class="btn">Inscription</button></a>
            </div>
        </div>
    </header>
    <main>
        
        <div class="formC-container" >
            <form method="post" id="form">               
                <div>
                    <h3>Nous allons vous renvoyer un lien par Email pour modifier votre mot de passe.</h3>
                    <label for="pseudo">Entrer votre Email :</label>
                    <input type="text" id="pseudoEmail" name="pseudoEmail" required placeholder="John.doe@stagiairesmns.fr">
                </div>
                <div>
                    <!-- <input type="submit" id="btn" value="Se connecter"><br><br> -->
                    <a href="index.php"><button class="boutonMdp" type="button" >Envoyer</button></a><br><br>
                    <a href="index.php"><button class="boutonAccueil" type="button" >Retour à l'accueil</button></a>
                    
                </div>
            </form>
        </div>
    </main>
    <footer>
        <div class="footerContent">
            <div class="footerLinks">
                <ul>
                    <li><a href="#">À propos</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Mentions légales</a></li>
                    <li><a href="#">Conditions d'utilisation</a></li>
                </ul>
            </div>
            <div class="footerLogo">
                <a href="index2.php"><img class="logoCarPool"  src="Images/logoCarPool.png" alt="Logo CarPool"></a>
            </div>
            <div class="footerSocials">
                <ul>
                    <li><a href="#" class="social-link">Facebook</a></li>
                    <li><a href="#" class="social-link">Twitter</a></li>
                    <li><a href="#" class="social-link">Instagram</a></li>
                </ul>
            </div>
        </div>
        <div class="footerBottom">
            <p>&copy; 2025 CarPool. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>