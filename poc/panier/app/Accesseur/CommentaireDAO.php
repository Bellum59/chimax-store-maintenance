<?php
namespace App\Accesseur;
use PDO;
use App\Models\Commentaire;

class CommentaireDAO
{
    public static function RecupererCommentaires($id) {
        require_once "connexion.php";
        $bdd = new BaseDeDonnees();
        $basededonnees = $bdd->pdo;
        $requete = $basededonnees->prepare("SELECT * FROM commentaire WHERE idProduit=:id ORDER BY date DESC");
        $requete->bindParam(":id", $id);
        $requete->execute();
        $commentaires = $requete->fetchAll(PDO::FETCH_ASSOC);
        $commentairesFiltres = array();
        foreach($commentaires as $commentaire)
        {
            $commentairesFiltres[] = new commentaire($commentaire);
        }

        return $commentairesFiltres;
    }

    public static function AjoutCommentaire($date,$idProduit,$idMembre,$contenue){
        require_once "connexion.php";
        $bdd = new BaseDeDonnees();
        $basededonnees = $bdd->pdo;
        $requete = $basededonnees->prepare("INSERT INTO commentaire(date,idProduit,idMembre,contenue) VALUES (:date,:idProduit,:idMembre,:contenue)");
        $requete->bindParam(":date", $date);
        $requete->bindParam(":idProduit", $idProduit);
        $requete->bindParam(":idMembre", $idMembre);
        $requete->bindParam(":contenue", $contenue);
        return $requete->execute();
    }


    //Recuperer le nom et prenom de l'auteur d'un commentaire
    public static function recupererAuteur($id){
        require_once "connexion.php";
        $bdd = new BaseDeDonnees();
        $basededonnees = $bdd->pdo;
        $requete = $basededonnees->prepare("SELECT name FROM users
        INNER JOIN commentaire ON users.id = commentaire.idMembre
        WHERE users.id=:id");
        $requete->bindParam(":id", $id);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
}
 