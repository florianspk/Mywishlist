<?php
namespace mywishlist\vue;

use mywishlist\modele\Item as Item;
use mywishlist\modele\Liste as Liste;
use \mywishlist\modele\Message as Message;


class VueParticipant {
    public $tab;

    public function __construct($tableau) {
        $this->tab = $tableau;
    }

    public function render($selecteur) {
        switch ($selecteur){
            case 'afficherListe' : {
                $content = $this->afficherListe();
                $cd = "../";
                break;
            }
            case 'afficherListes' : {
                $content = $this->afficherListes();
                $cd = "";
                break;
            }
            case 'afficherItem': {
                $content = $this->afficherItem();
                $cd = "../";
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
    <link rel="stylesheet" href="{$cd}css/style.css">
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

    private function afficherListes() {
        $res="<section>   <div id=\"shop\"> ";
        foreach ($this->tab as $l) {
            $res = $res . "<div  class='article'>";
            $res = $res . "<a href='liste/" . $l->token . "'>" . $l->titre . "</a> <p>" . $l->description . "</p>";
            $res = $res . "</div>";
        }
        return $res."</div> </section>";
    }



    private function afficherListe() {
        $res="<section>   <div id=\"shop\"> ";
        foreach ($this->tab['list'] as $l) {
            $res = $res . "<div  class='article'>";
            $res = $res . "<a href='../item/" . $l->token . "'> <img src='../img/" . $l->img . "'></a>";
            if(is_null($l->id_utilisateur)) $etat='Pas réservé';
            else $etat="Reservé";
            $res = $res . "<a href='../item/" . $l->token . "'> ". $l->nom ."</a><p>" . $etat . "</p>";
            $res = $res . "</div>";
        }
        $res = $res . "<div  class='article'>";
        $res = $res . "<p>Commentaire(s)</p>";
        $res = $res . "<div  class='commentDiv'>";
        if(sizeof($this->tab['message'])==0){
            $res = $res . "<div  class='comment'>";
            $res = $res . "<p>Aucun Commentaires</p>";
            $res = $res . "</div>";
        }
        foreach ($this->tab['message'] as $msg) {
            $res = $res . "<div  class='comment'>";
            $res = $res . "<p>" . $msg->compte()->first()->login . "</p><textarea cols='80' rows='2' readonly='yes'> {$msg->message} </textarea>";
            $res = $res . "</div>";
        }
        if(isset($_SESSION['Connection'])) {
            $res = $res . "<form id='textCom' action='../liste/{$this->tab['id']}' method='post'> <input type='textarea' placeholder='Laisser un commentaire' name='com' cols='80' rows='3'> <button type='submit'>Publier</button> </form>";
        }
        $res = $res . "</div>";
        return $res."</div> </section>";
    }

    private function afficherItem() {
        $res="<section>   <div id=\"shop\"> ";
        $l = $this->tab['item'];
            $res = $res . "<div  class='article'>";
            $res = $res . "<img class='imgItem' src='../img/" . $l->img . "'>";
            $res = $res . "<p> ". $l->nom . "<br>". $l->descr . "<br>" . $l->tarif ."€</p>";
            if(is_null($l->id_utilisateur)){
                if(isset($_SESSION['Connection'])) {
                    $res = $res . "<form id='reserve' action='../resitem/{$l->token}' method='post'>" .
                        "<button class='etat' type='submit'>Reserver</button> </form>";
                } else {
                    $res = $res . "<form id='reserve' action='../connexion' method='get'>" .
                        "<button class='etat' type='submit'>Reserver</button> </form>";
                }
                $res = $res . "</div>";
            } else {
               $res = $res . "<p class='etat'>Déja Réservé(s) par {$this->tab['compte']->nom}</p>";
            }
        $res = $res . "<div  class='article'>";
        $res = $res . "<p>Commentaire(s)</p>";
        $res = $res . "<div  class='commentDiv'>";
        if(sizeof($this->tab['message'])==0){
            $res = $res . "<div  class='comment'>";
            $res = $res . "<p>Aucun Commentaires</p>";
            $res = $res . "</div>";
        }
        foreach ($this->tab['message'] as $msg) {
            $res = $res . "<div  class='comment'>";
            $res = $res . "<p>" . $msg->compte()->first()->login . "</p><textarea cols='80' rows='2' readonly='yes'> {$msg->message} </textarea>";
            $res = $res . "</div>";
        }
        if(isset($_SESSION['Connection'])) {
            $res = $res . "<form id='textCom' action='../item/{$l->token}' method='post'> <input type='textarea' placeholder='Laisser un commentaire' name='com' cols='80' rows='3'> <button type='submit'>Publier</button> </form>";
        }
        return $res."</div> </section>";
    }
}