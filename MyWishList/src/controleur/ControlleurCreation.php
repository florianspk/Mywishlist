<?php
namespace mywishlist\controleur;
require_once 'vendor/autoload.php';

use Illuminate\Database\QueryException;
use mywishlist\controleur\ControlleurCompte as ControlleurCompte;
use mywishlist\modele\Item as Item;
use mywishlist\modele\Liste as Liste;
use mywishlist\modele\Compte as Compte;
use mywishlist\views\VueListe;
use mywishlist\vue\VueCreation;

class ControlleurCreation {

    public function creerListe(){
        $tab = [];
        $v = new \mywishlist\vue\VueCreation($tab);
        $v->render('nouvelleListe');
    }

    public function creerListePost(){
        $v = new VueCreation(null);
        $it = new \mywishlist\modele\Liste();
        $compte = ControlleurCompte::getIdConnexion();
        $it->user_id = Compte::where('token', '=', $compte)->first()->id_Utilisateur;
        if(isset($_POST['titre']) and strlen($_POST['titre'])>0){
            $it->titre = $_POST['titre'];
        }else{
            $it->titre = 'Liste sans nom';
        }
        if(isset($_POST['description'])){
            $it->description = $_POST['description'];
        }
        if(isset($_POST['expiration'])){
            $it->expiration = $_POST['expiration'];
        }
        try {
            $it->token =  bin2hex(random_bytes(32));
        } catch (\Exception $e) {
            $tab = array("erreur" => "Probleme lors de la génération du token");
            $vueCreation = new VueCreation($tab);
            $vueCreation->render('creerListePost');
        }
        try {
            $it->public = $_POST['public'];
            $it->save();
            $v->render('creerListePost');
        }catch (QueryException $e){
            $tab = array("erreur" => "Probleme lors de la creation de la table");
            $vueCreation = new VueCreation($tab);
            $vueCreation->render('creerListePost');
        }

    }

    public function modifierListe($idlist){
        $list = Liste::where('token','=', $idlist);
        $list->get();
        $v = new VueCreation($list);
        $v->render('modifierListe');
    }

    public function modifierListePost($id){
        $v = new VueCreation(null);
        $l = Liste::where('token',  '=' , $id)->first();
        if(isset($_POST['titre']) and strlen($_POST['titre'])>0){
            $l->titre = $_POST['titre'];
        }
        if(isset($_POST['description']) and strlen($_POST['description'])>0){
            $l->description = $_POST['description'];
        }
        if(isset($_POST['expiration']) and strlen($_POST['expiration'])>0){
            $l->expiration = $_POST['expiration'];
        }
        if(isset($_POST['public'])){
            $l->public = $_POST ['public'];
        }
        $l->save();
        $v->render('modifierListePost');

    }

    public function modifierItem($iditem){
        $item = Item::where('token',  '=' , $iditem);
        $v = new VueCreation($item);
        $v->render('modifierItem');
    }

    public function modifierItemPost($token){
        $v = new VueCreation(null);
        $item = Item::where('token','=',$token)->first();
        if(isset($_POST['nom'])and strlen($_POST['nom'])>0){
            $item->nom = $_POST['nom'];
        }
        if(isset($_POST['descr'])and strlen($_POST['descr'])>0){
            $item->descr = $_POST['descr'];
        }
        if(isset($_POST['img'])){
            $item->img = $_POST['img'];
        }
        if(isset($_POST['url'])and strlen($_POST['url'])>0){
            $item->url = $_POST['url'];
        }
        if(isset($_POST['tarif'])and strlen($_POST['tarif'])>0 ){
            $item->tarif = $_POST['tarif'];
        }
        $item->save();
        $v->render('modifierItemPost');
    }

    public function afficherItemAjout(){
        $compte = Compte::where('token', '=', ControlleurCompte::getIdConnexion())->first()->id_Utilisateur;
        $list = Liste::where('user_id', '=', $compte)->get();
        $v = new VueCreation($list);
        $v->render('afficherItemAjout');
    }


    public function afficherItemModif(){
        $item = Item::where('id_utilisateur','=',null)->get();
        $v = new VueCreation($item);
        $v->render('afficherItemModif');
    }

    public function afficherListeModif(){
        $compte = Compte::where('token', '=', ControlleurCompte::getIdConnexion())->first()->id_Utilisateur;
        $list = Liste::where('user_id', '=', $compte)->get();
        $v = new VueCreation($list);
        $v->render('afficherListesModif');
    }
    public function affSuppItem(){

        $compte = Compte::where('token', '=', ControlleurCompte::getIdConnexion())->first()->id_Utilisateur;
        $list = Liste::where('user_id', '=', $compte)->get();
        $v = new VueCreation($list);
        $v->render('affSuppItem');
    }

    public function supprimerListes(){
        $compte = Compte::where('token', '=', ControlleurCompte::getIdConnexion())->first()->id_Utilisateur;
        $list = Liste::where('user_id', '=', $compte)->get();
        $v = new VueCreation($list);
        $v->render('supprimerListe');
    }


    public function supprimerListePost($idlist){
        $v = new VueCreation(null);
        $list = Liste::where('token','=', $idlist);
        $list->get();
        $list->delete();
        $v->render('supprimerListePost');
    }


    public function ajouterItem($idlist){
        $item = Item::get();
        $v = new VueCreation($idlist);
        $v->render('ajouterItem');
    }

    public function ajouterItemPost($idlist){
        $v = new VueCreation(null);
        $item = new item();
        $listid = Liste::where('token', '=', $idlist)->first()->no;
        $item->liste_id = $listid;
        $item->nom = $_POST['nom'];
        $item->descr = $_POST['descr'];
        $item->url = $_POST['url'];
        $item->tarif = $_POST['tarif'];
        $item->token = bin2hex(random_bytes(32));
        $item->save();
        $id = Item::max('id');
        $url=explode(".",$_FILES['img']['name']);
        $item->img=$url[0] . $id . "." . $url[1];
        $item->save();
        copy($_FILES["img"]["tmp_name"], "./img/". $url[0] . $id . "." . $url[1]);
        $v->render('ajouterItemPost');
    }

    public function supprimerItem($token){
        $list = Liste::where('token', '=', $token)->first()->items()->where('id_utilisateur','=', null)->get();
        $v = new VueCreation($list);
        $v->render('supprimerItem');
    }

    public function supprimerItemPost(){
        $item = Item::where('token', '=', $_POST['token'])->first();
        unlink("./img/" . $item->img);
        $item->delete();
        $v = new VueCreation(null);
        $v->render('supprimerItemPost');
    }

//    public function creerCagnotte($item){
//        $v = new VueCreation();
//        $v->render('creerCagnotte');
//    }

    public function modifs(){
        $v = new VueCreation(null);
        $v->render('modifs');
    }





}