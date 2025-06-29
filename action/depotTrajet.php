<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['proposer_trajet'])) {

    if (isset($_SESSION['id'])) {
        $utilisateur_id = $_SESSION['id'];

        $depart = !empty($_POST['departProposer']) ? htmlspecialchars($_POST['departProposer']) : null;
        $destination = !empty($_POST['destinationProposer']) ? htmlspecialchars($_POST['destinationProposer']) : null;
        $date = !empty($_POST['dateProposer']) ? $_POST['dateProposer'] : null;
        $heure = !empty($_POST['heureProposer']) ? $_POST['heureProposer'] : null;
        $places = isset($_POST['placesProposer']) ? intval($_POST['placesProposer']) : 1;
        $fumeur = isset($_POST['fumeurProposer']) ? intval($_POST['fumeurProposer']) : 0;
        $nourriture = isset($_POST['nourritureProposer']) ? intval($_POST['nourritureProposer']) : 0;
        $musique = isset($_POST['musiqueProposer']) ? intval($_POST['musiqueProposer']) : 0;
        $voyage = isset($_POST['voyageProposer']) ? intval($_POST['voyageProposer']) : 0;

        if ($depart && $destination && $date) {

            $query = "INSERT INTO trajet (
                        trajet_date_depart, trajet_heure_depart, trajet_lieu_depart, trajet_lieu_arrivee, 
                        trajet_nombre_places_disponibles, trajet_aller_retour, utilisateur_id
                    ) 
                    VALUES (
                        :date_depart, :heure_depart, :lieu_depart, :lieu_arrivee, 
                        :places, :aller_retour, :utilisateur_id
                    )";

            $stmt = $db->prepare($query);

            $stmt->bindValue(':date_depart', $date);
            $stmt->bindValue(':heure_depart', $heure);
            $stmt->bindValue(':lieu_depart', $depart);
            $stmt->bindValue(':lieu_arrivee', $destination);
            $stmt->bindValue(':places', $places);
            $stmt->bindValue(':aller_retour', $voyage);
            $stmt->bindValue(':utilisateur_id', $utilisateur_id);

            $stmt->execute();

            $trajet_id = $db->lastInsertId();

            $query2 = "INSERT INTO utilisateur_trajet (utilisateur_id, trajet_id, date_depot, statut_depot) 
                    VALUES (:utilisateur_id, :trajet_id, NOW(), 1)";

            $stmt2 = $db->prepare($query2);
            $stmt2->bindValue(':utilisateur_id', $utilisateur_id);
            $stmt2->bindValue(':trajet_id', $trajet_id);
            $stmt2->execute();

            header("Location: covoiturage.php");
            exit();
        }
    }
}

?>