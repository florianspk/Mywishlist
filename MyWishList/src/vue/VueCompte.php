<?php
namespace mywishlist\vue;

use mywishlist\modele\Item as Item;
use mywishlist\modele\Liste as Liste;

class VueCompte {

    private $tab;

    public function __construct($tab) {
        $this->tab = $tab;
    }

    public function render($selecteur) {
        switch ($selecteur){
            case 1 : {
                //Vue inscription
                $content = $this->inscription();
                $cd = '';
                break;
            }
            case 2 : {
                //Vue connexion
                $content = $this->connexion();
                $cd = '';
                break;
            }
            case 3: {
                //Vue du compte
                $content = $this->monCompte();
                $cd = '';
                break;
            }
        }
        if (isset($_SESSION['Connection']) == false) {
            $html = <<<END
<!doctype html>
<html class="no-js" lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist</title>
    <link rel="stylesheet" href="{$cd}css/style.css">
  </head>
   <header class="menu" role="banner">
		 <div id="logo"><a href="{$cd}./"><img src="{$cd}img/logo.png"></a></div>
         <div id="menu_button">
			 <ul>
				<li><a class="bouton" href="{$cd}./">Accueil</a></li>
                <li><a class="bouton" href="{$cd}leslistes">Participation</a></li>
                <li><a class="bouton" href="{$cd}connexion">Création</a></li>
                <li><a class="bouton" href="{$cd}connexion">Connexion</a></li>
         	 </ul>
	   	</div>
    </header>
    <body>
  
    $content
    
    </body>
</html>
END;
        } else {
            $html = <<<END
<!doctype html>
<html class="no-js" lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
   <header class="menu" role="banner">
		 <div id="logo"><a href="{$cd}./"><img src="{$cd}img/logo.png"></a></div>
         <div id="menu_button">
			 <ul>
				<li><a class="bouton" href="{$cd}./">Accueil</a></li>
                <li><a class="bouton" href="{$cd}leslistes">Participation</a></li>
                <li><a class="bouton" href="{$cd}creation">Création</a></li>
                <li><a class="bouton" href="{$cd}moncompte">Mon Compte</a></li>
         	 </ul>
	   	</div>
    </header>
    <body>
  
    $content
    
    </body>
</html>
END;
        }
        echo $html;
    }

    private function connexion() {
        if(isset($this->tab['erreur'])) {
        $res = '<section><div class="center"><form action =\'connexion\' method="POST" enctype="multipart/form-data">

					<fieldset>
						<legend>Connexion</legend>
						<div>
							<label for="Compte_login">Login : </label><input  type="text" name="Compte_login" placeholder="Login"> <br>
							<label for="Compte_mdp">Mot de passe : </label><input  type="password" name="Compte_mdp" placeholder="password"> <br>
							<div class="Danex"><p> Vous n\'avez pas encore de compte ? <a href="./inscription">créez en un !</a></p></div>
						</div>
					</fieldset>
					<p>'.$this->tab['erreur'].'</p>
					<input type="submit" value="Connexion">
				</form>
	    	</div></section>';
        }
        else{
            $res = '<section><div class="center"><form action =\'connexion\' method="POST" enctype="multipart/form-data">

					<fieldset>
						<legend>Connexion</legend>
						<div>
							<label for="Compte_login">Login : </label><input  type="text" name="Compte_login" placeholder="Login"> <br>
							<label for="Compte_mdp">Mot de passe : </label><input  type="password" name="Compte_mdp" placeholder="password"> <br>
						    <div class="Danex"><p> Vous n\'avez pas encore de compte ? <a href="./inscription">créez en un !</a></p></div>
						</div>
					</fieldset>
					<input type="submit" value="Connexion">
				</form>
	    	</div></section>';
        }
        return $res;

    }

    private function inscription(){
        if(isset($this->tab['erreur'])) {
            $res = '<section><div class="center"><form method="POST" action="inscription" enctype="multipart/form-data">
					<fieldset>
						<legend>Inscription</legend>
						<div>
						    <label for="Compte_nom">Nom : </label><input class="inputForm" type="text" name="Compte_nom" placeholder="nom"> <br>
							<label for="Compte_prenom">Prenom : </label><input class="inputForm" type="text" name="Compte_prenom" placeholder="prenom"><br>
							<label for="Compte_login">Identifiant : </label><input class="inputForm" type="text" name="Compte_login" placeholder="Login"><br>
							<label for="Compte_mdp">Mot de passe : </label><input class="inputForm" type="password" name="Compte_mdp" placeholder="password"><br>
							<label for="Compte_vmdp">Mot de passe : </label><input class="inputForm" type="password" name="Compte_vmdp" placeholder="password"><br>
						</div>	
					</fieldset>
					<p>'.$this->tab['erreur'].'</p>
					<input type="submit" value="Inscription">
				</form></div></section>';
        }else{
            $res = '<section><div class="center"><form method="POST" action="inscription" enctype="multipart/form-data">
					<fieldset>
						<legend>Inscription</legend>
						<div>
						    <label for="Compte_nom">Nom : </label><input class="inputForm" type="text" name="Compte_nom" placeholder="nom"> <br>
							<label for="Compte_prenom">Prenom : </label><input class="inputForm" type="text" name="Compte_prenom" placeholder="prenom"><br>
							<label for="Compte_login">Identifiant : </label><input class="inputForm" type="text" name="Compte_login" placeholder="Login"><br>
							<label for="Compte_mdp">Mot de passe : </label><input class="inputForm" type="password" name="Compte_mdp" placeholder="password"><br>
							<label for="Compte_vmdp">Mot de passe : </label><input class="inputForm" type="password" name="Compte_vmdp" placeholder="password"><br>
						</div>	
					</fieldset>
					<input type="submit" value="Inscription">
				</form></div></section>';
        }
        return $res;
    }

    private function afficherMessage($text,$type)
    {
        switch($type){
            case 0 :
                $this->tab['messageErreur'] = "<p class='exception'> $text </p>";
                break;
            case 1 :
                $this->tab['messageErreur'] = "<p class='msgBon'> $text </p>";
                break;
        }
    }

    private function monCompte(){
        $res ="
<div id=\"first\">
	<p class=\"info\">Nom : ".$this->tab['nom']."</p>
	<p class=\"info\">Prenom : ".$this->tab['prenom']."</p>
    <div id=\"footercompte\">
        <form method=\"POST\" action=\"deconnexion\" enctype=\"multipart/form-data\">
            <input type=\"submit\" value=\"Deconnexion\">
        </form>
        <form method=\"POST\" action=\"suppression\" enctype=\"multipart/form-data\">
            <input type=\"submit\" value=\"Suppression\">
        </form>
    </div>
</div>";
        return $res;
    }
}