<?php
namespace mywishlist\vue;


class VuePrincipale
{
    public $tab;

    public function __construct($tableau) {
        $this->tab = $tableau;
    }

    public function render($selecteur) {
        switch ($selecteur){
            case 'afficherAccueil' : {
                $content = $this->afficherAccueil();
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

    private function afficherAccueil() {
        if (isset($_SESSION['Connection']) == true) {
            $res="
<div id=\"first\"> 
    <p><strong>Bienvenue sur My Wishlist !</strong>
    <br>Vous pouvez créer une liste en appuyant ci-dessous.</p> 
    <a class=\"bouton\" href=\"creerliste\">Créer une liste</a>
</div>";
        } else {
            $res = "
<div id=\"first\"> 
    <p><strong>Bienvenue sur My Wishlist !</strong>
    <br>Pour commencer, rejoignez-nous en cliquant ci-dessous.</p> 
    <a class=\"bouton\" href=\"inscription\">Inscription</a>
</div>";
        }
        return $res. "
<div id=\"second\">
	<p>
	    My Wishlist est une application web développée par quatre étudiants de 2ème de DUT Informatique.			
	    Principe du site-web :
	    Tous les enfants aujourd'hui s'amuse à entourer les jouets qu'ils désirent dans les catalogues de Noël, lorsque cette période arrive.
	    Nous savons aussi que les enfants sont de plus en plus familiers avec les appareils technologiques. Ainsi, nous avons décidé de lier les deux.
	    Plutôt que de feuilleter un livre, cette application permettrais aux enfants de feuilleter un catalogue en ligne, et de faire ses choix.
	    <br>De cette manière, nous rendu la magie de Noël plus écologique, sans pour autant la détruire :)
	    <br><br> S3C - KRELL SPICK PERCIN SASSU
    </p>
</div>";
    }

}