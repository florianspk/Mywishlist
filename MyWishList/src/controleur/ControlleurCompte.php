<?php
namespace mywishlist\controleur;
require_once 'vendor/autoload.php';

use http\Exception;
use Illuminate\Database\QueryException;
use mywishlist\modele\Compte;
use mywishlist\vue\VueCompte;
use mywishlist\vue\VuePrincipale;

class ControlleurCompte{
    /**
     * Methode static qui permet d'établir la connexion
     * @param $bool
     */
    public static function setConnexion($bool){
        if (!isset( $_SESSION['Connection']))
            $_SESSION['Connection'] = $bool;
    }

    /**
     * Methode pour savoir si une personne est connecté
     * @return bool qui retourne si il y a une connexion ou pas
     */
    public  static  function isConnected(){
        if(isset($_SESSION['Connection'])){
            return ($_SESSION['Connection'] == true);
        }
        return false;
    }

    /**
     * Methode static pour recupérer l'id de connexion
     * @return l'id de connexion de la personne connecté
     */
    public  static function getIdConnexion(){
        return $_SESSION['Compte_id'];
    }

    /**
     * Methode d'affichage de la connexion
     */
    public function creerCompte(){
        $vueCompte = new VueCompte(null);
        $vueCompte->render(1);
    }

    /**
     * Methode de traitement d'une inscription une fois le formulaire poste envoyé
     */
    public function traitementInscription() {
        $compte = new Compte();
        //Filtre les entrées de l'utilisateurs
        $cn = filter_var($_POST['Compte_nom'],FILTER_SANITIZE_STRING);
        $cp = filter_var($_POST['Compte_prenom'],FILTER_SANITIZE_STRING);
        $cl = filter_var($_POST['Compte_login'],FILTER_SANITIZE_STRING);
        $cmvdp = filter_var($_POST['Compte_vmdp'], FILTER_SANITIZE_SPECIAL_CHARS) or preg_match('#^.{1,50}$#',$_POST['Compte_vmdp']);
        $cmdp = filter_var($_POST['Compte_mdp'] , FILTER_SANITIZE_SPECIAL_CHARS) or preg_match('#^.{1,50}$#',$_POST['Compte_mdp']);
        $ctok = bin2hex(random_bytes(32));
        if ($cmvdp != $cmdp){
            $tab = array("erreur" => "Les mots de passes ne sont pas identique");
            $vueCompte = new VueCompte($tab);
            $vueCompte->render(1);

        }else {
            $existe = Compte::where("login", "=", $cl);
            if (strlen($cmdp) < 7) {
                $tab = array("erreur" => "Le mot de passe doit faire plus de 7 caractères");
                $vueCompte = new VueCompte($tab);
                $vueCompte->render(1);
            }else{
                if ($existe == null){
                    $tab = array("erreur" => "Login deja existant");
                    $vueCompte = new VueCompte($tab);
                    $vueCompte->render(1);
                }else{
                    $vueCompte = new VueCompte(null);
                    $compte->nom = $cn;
                    $compte->prenom = $cp;
                    $compte->login = $cl;
                    $compte->password = $cmdp;
                    $compte->token = $ctok;
                    $compte->admin = false;
                    try {
                        $compte->save();
                        $vueCompte->render(2);
                    }catch (QueryException $e){
                        $tab = array("erreur" => "Creation du compte échoué");
                        $vueCompte = new  VueCompte($tab);
                        $vueCompte->render(1);
                    }
                    $_SESSION['Compte_id'] = $compte->token;
                }
            }

        }
    }

    /**
     * Affichage de la page d'identification
     */
    public function identification(){
        $vueCompte = new VueCompte(null);
        $vueCompte->render(2);
    }

    /**
     * Methode de traitement de l'inscription une fois le formulaire post envoyé
     */
    public function traitementIdentification(){
        if (isset($_POST['Compte_login']) and isset($_POST['Compte_mdp'])) {
            $lg = filter_var($_POST['Compte_login'], FILTER_SANITIZE_STRING);
            $mdp = filter_var($_POST['Compte_mdp'], FILTER_SANITIZE_SPECIAL_CHARS) or preg_match('#^.{1,50}$#', $_POST['Compte_mdp']);
            if ($lg != false and $mdp != false) {
                $utilisateur = null;
                $utilisateur = Compte::where('login', '=', $lg)->where('password', '=', $mdp)->first();
                if ($utilisateur != null) {
                    $_SESSION['nom'] = $utilisateur->nom;
                    $_SESSION['prenom'] = $utilisateur->prenom;
                    $_SESSION['login'] = $utilisateur->login;
                    self::setConnexion(true);
                    $vuePrincipale = new VuePrincipale(null);
                    $vuePrincipale->render('afficherAccueil');
                    if (!isset($_SESSION['Compte_id'])) {
                        $_SESSION['Compte_id'] = $utilisateur->token;
                    }
                } else {
                    $tab = array("erreur" => "Identifiant ou mot de passe incorrect.");
                    $vueCompte = new  VueCompte($tab);
                    $vueCompte->render(2);
                    self::setConnexion(false);
                }
            } else {
                $tab = array("erreur" => "Identifiant ou mot de passe incorrect.");
                $vueCompte = new  VueCompte($tab);
                $vueCompte->render(2);
                self::setConnexion(false);
            }
        } else {
            $tab = array("erreur" => "Identifiant ou mot de passe incorrect.");
            $vueCompte = new  VueCompte($tab);
            $vueCompte->render(2);
            self::setConnexion(false);
        }
    }

    /**
     * methode de deconnexion pour un compte
     */
    function deconnexion(){
        unset($_SESSION['Connection']);
        unset($_SESSION['nom']);
        unset($_SESSION['prenom']);
        unset($_SESSION['login']);
        unset($_SESSION['Compte_id']);
        $vuePrinciapel = new VuePrincipale(null);
        $vuePrinciapel->render('afficherAccueil');
    }

    /**
     * Méthode pour afficher les informations d'un compte (Nom / Prenom)
     */
    function afficherCompte(){
        $tab = array("nom" => $_SESSION['nom'], "prenom" => $_SESSION['prenom']);
        $vueCompte = new VueCompte($tab);
        $vueCompte->render(3);
    }

    /**
     * Méthode de suppression d'un compte
     */
    function delete() {
        // Suppression du compte
        $compte = Compte::where('login','=',$_SESSION['login'])->first();
        $compte->delete();
        // Suppression des interactions de l'utilisateurs
        unset($_SESSION['Connection']);
        unset($_SESSION['nom']);
        unset($_SESSION['prenom']);
        unset($_SESSION['login']);
        unset($_SESSION['Compte_id']);
        $this->deconnexion();
    }
    /**
     * Connexion faite prealablement avec cookie (Plus utilisé)
     */
/*
    public static function connexionAvecCookie($user, $mdp){
        if (!isset($user) || !isset($mdp)) return;
        $utilisateur = Compte::where('login','=',$user)->first();
        if ($mdp == crypt($utilisateur->login, $utilisateur->password)) {
            ControlleurCompte::setConnexion(true);
            $_SESSION['Compte_login'] = $utilisateur->login;
            $_SESSION['Compte_id'] = $utilisateur->id_Compte;
        }
    }
*/
}