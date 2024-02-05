<?php

include_once "Exoplanete.php";

class ExoplaneteDAO
{
    public static function listerExoplanetes()
    {
        require_once "connexion.php";
        
        $requete = $basededonnees->prepare("SELECT * FROM exoplanete");
        $requete -> execute();
        $exoplanetes = $requete->fetchAll(PDO::FETCH_ASSOC);
        //print_r($exoplanetes);

        $exoplanetesFiltres = array();
        foreach($exoplanetes as $exoplanete)
        {
            $exoplanetesFiltres[] = new Exoplanete($exoplanete);
        }

        return $exoplanetesFiltres;
    }

    public static function ajouterExoplanete($exoplanete)
    {
        require_once "connexion.php";

        $SQL_AJOUTER_EXOPLANETE = "INSERT into exoplanete(planete, etoile) VALUES (:planete, :etoile)";
        $requete = $basededonnees->prepare($SQL_AJOUTER_EXOPLANETE);
        $requete->bindParam(":planete", $exoplanete->planete);
        $requete->bindParam(":etoile", $exoplanete->etoile);
        return $requete->execute();
    }
 
    public static function editerExoplanete($exoplanete)
    {
        require_once "connexion.php";

        $SQL_EDITER_EXOPLANETE = "UPDATE exoplanete set planete = :planete, etoile = :etoile WHERE id = :id";
        $requete = $basededonnees->prepare($SQL_EDITER_EXOPLANETE);
        $requete->bindParam(":planete", $exoplanete->planete);
        $requete->bindParam(":etoile", $exoplanete->etoile);
        $requete->bindParam(":id", $exoplanete->id);
        return $requete->execute();


    }

    public static function detaillerExoplanete($exoplaneteRecus)
    {
        require_once "connexion.php";

        $SQL_LIRE_EXOPLANETE = "SELECT * FROM exoplanete WHERE :id";
        $requete = $basededonnees->prepare($SQL_LIRE_EXOPLANETE);
        $requete->bindParam(":id", $exoplaneteRecus->id);
        $requete->execute();

        $exoplanete = $requete->fetch(PDO::FETCH_ASSOC);

        if(is_bool($exoplanete)){
            return $exoplaneteRecus;
        }
        return new Exoplanete($exoplanete);
    }

    public static function effacerExoplanete($exoplanete){
        require_once "connexion.php";

        $SQL_EFFACER_EXOPLANETE = "DELETE FROM exoplanete WHERE id = :id";
        $requete = $basededonnees->prepare($SQL_EFFACER_EXOPLANETE);
        $requete->bindParam(":id", $exoplanete->id);
        return $requete->execute();

    }
}
 
