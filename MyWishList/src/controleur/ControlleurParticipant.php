<?php

namespace mywishlist\controleur;
require_once 'vendor/autoload.php';
use \mywishlist\modele\Item as Item;
use \mywishlist\modele\Liste as Liste;
use \mywishlist\modele\Compte as Compte;
use \mywishlist\modele\Message as Message;

use \mywishlist\vue\VueParticipant as VueParticipant;
use \mywishlist\controleur\ControlleurCompte as ControlleurCompte;

class ControlleurParticipant
{
    public function afficherListe($id){
        $list = liste::where('token', '=', $id)->first()->items()->get();
        $msg = liste::where('token', '=', $id)->first()->messages()->where('parent_type', '=', 'list')->get();

        $tab['id']=$id;
        $tab['list'] = $list;
        $tab['message'] = $msg;
        $v = new VueParticipant($tab);
        $v->render('afficherListe');
    }

    public function afficherAllListe(){
        $list = Liste::where('public','=',"true")->get();
        $v = new VueParticipant($list);
        $v->render('afficherListes');
    }

    public function afficherItem($id){
        $item = Item::where('token','=',$id)->first();
        $log = Compte::where('id_Utilisateur', '=', $item->id_utilisateur)->first();
        $msg = $item->messages()->where('parent_type', '=', 'item')->get();

        $tab['item'] = $item;
        $tab['message'] = $msg;
        $tab['compte'] = $log;

        $v = new VueParticipant($tab);
        $v->render('afficherItem');
    }

    public function reserveItem($id) {
        if(isset($_SESSION['Connection'])){
        $item = Item::where('token',"=",$id)->first();
        $compte = Compte::where('token','=',ControlleurCompte::getIdConnexion())->first()->id_Utilisateur;
        $item->id_utilisateur = $compte;
        $item->save();
        $this->afficherItem($id);
        //$v = new VueParticipant($item);
        //$v->render('afficherItem');
        }
    }

    public function commentaireListe($id){
        if(isset($_SESSION['Connection'])){
            $msg = new Message();
            $msg->id_utilisateur = Compte::where('token','=',ControlleurCompte::getIdConnexion())->first()->id_Utilisateur;
            $msg->id_parent = Liste::where('token','=',$id)->first()->no;
            $msg->parent_type = 'list';
            $msg->message = $_POST['com'];
            $msg->save();

            $this->afficherListe($id);
            //$item = Item::where('id',"=",$id)->first();
            //$v = new VueParticipant($item);
            //$v->render('afficherItem');
        }
    }

    public function commentaireItem($id){
        if(isset($_SESSION['Connection'])){
            $msg = new Message();
            $msg->id_utilisateur = Compte::where('token','=',ControlleurCompte::getIdConnexion())->first()->id_Utilisateur;
            $msg->id_parent = Item::where('token','=',$id)->first()->id;
            $msg->parent_type = 'item';
            $msg->message = $_POST['com'];
            $msg->save();

            $this->afficherItem($id);
        }
    }
}