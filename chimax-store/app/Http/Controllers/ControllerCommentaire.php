<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Accesseur\CommentaireDAO;

class ControllerCommentaire extends Controller
{
    public function ajoutCommentaire(Request $request){
        //header("Access-Control-Allow-Origin: *");
        $received = file_get_contents('php://input');
        $data = json_decode($received,true);
        $contenueCommentaire = $data["commentaire"];
        $membre = $data["idMembre"];
        $produit = $data["idProduit"];
        $date = date("Y-m-d H:i:s");
        $date = strval($date);
        CommentaireDAO::AjoutCommentaire($date,$produit,$membre,$contenueCommentaire);
        $Nom = CommentaireDAO::recupererAuteur($membre);
        echo $Nom[0]["name"];
        exit();
    }
}
