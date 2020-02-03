<?php
namespace mywishlist\vue;
use mywishlist\models\Item;
use mywishlist\models\Liste;

class VueCreation {
    public $tab;

    public function __construct($tableau) {
        $this->tab = $tableau;
    }

    public function render($selecteur) {
        switch ($selecteur){
            case 'nouvelleListe' : {
                $content = $this->creerListe();
                $cd = '';
                break;
            }
            case 'creerListePost' : {
                $content = $this->creerListePost();
                $cd = '';
                break;
            }
            case 2 : {
                $content = $this->afficherListe();
                $cd = '';
                break;
            }
            case 'modifierListe': {
                $content = $this->modifierListe();
                $cd = '../';
                break;
            }
            case 'supprimerListe': {
                $content = $this->supprimerListe();
                $cd = '';
                break;
            }

             case 'supprimerListePost' : {
            $content = $this->supprimerListePost();
            $cd = '../';
            break;
        }
            case 'modifierItem': {
                $content = $this->modifierItem();
                $cd = '../';
                break;
            }
            case 'modifierItemPost': {
                $content = $this->modifierItemPost();
                $cd = '../';
                break;
            }

            case 'ajouterItem': {
                $content = $this->ajouterItem();
                $cd = '../';
                break;
            }
            case 'ajouterItemPost': {
                $content = $this->ajouterItemPost();
                $cd = '../';
                break;
            }
            case 'creerCagnotte': {
                $content = $this->creerCagnotte();
                $cd = '';
                break;
            }
            case 'supprimerItem': {
                $content = $this->supprimerItem();
                $cd = '../';
                break;
            }

            case 'supprimerItemPost': {
                $content = $this->supprimerItemPost();
                $cd = '../';
                break;
            }
            case 'affSuppItem' : {
                $content = $this->affSuppItem();
                $cd = './';
                break;
            }
            case 'modifs' : {
                $content = $this->modifChoix();
                $cd = '';
                break;
            }
            case 'afficherListesModif' : {
                $content = $this->afficherListesModif();
                $cd = '';
                break;
            }
            case 'afficherItemModif' : {
                $content = $this->afficherItemModif();
                $cd = '';
                break;
            }
            case 'afficherItemAjout' : {
                $content = $this->afficherItemAjout();
                $cd = '';
                break;
            }
            case 'modifsliste' : {
                $content = $this->modiferListe();
                $cd = '../';
                break;
            }
            case 'modifierListePost' : {
                $content = $this->modifierListePost();
                $cd = '../';
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


    private function modifChoix(){
        if (isset($_SESSION['Connection']) == false) {
            $res = "<section> <div id=\"shop\"> 
        <p><strong>Que voulez-vous faire ?</strong>
        <br>Vous pouvez créer une liste en appuyant ci-dessous.</p> 
        <a class=\"bouton\" href=\"connexion\">Créer une Liste</a>
        <br>Vous pouvez modifier une liste en appuyant ci-dessous.</p> 
        <a class=\"bouton\" href=\"connexion\">Modifier une Liste</a>
        <br>Vous pouvez supprimer un Item en appuyant ci-dessous.</p> 
        <a class=\"bouton\" href=\"connexion\">Supprimer une Liste</a>
        <br>Vous pouvez rendre une liste publique en appuyant ci-dessous.</p> 
        <a class=\"bouton\" href=\"connexion\">Rendre une Liste publique [non fonctionel]</a>
        <br>Vous pouvez ajouter un item à une liste en appuyant ci-dessous.</p> 
        <a class=\"bouton\" href=\"connexion\">Ajouter un Item</a>
        <br>Vous pouvez modifier un Item en appuyant ci-dessous.</p> 
        <a class=\"bouton\" href=\"connexion\">Modifier un Item</a>
        <br>Vous pouvez supprimer un Item en appuyant ci-dessous.</p> 
        <a class=\"bouton\" href=\"connexion\">Supprimer un Item</a>
        
    </div>";
        }
        else {
            $res = "<section> <div id=\"shop\"> 
        <p><strong>Que voulez-vous faire ?</strong>
        <br>Vous pouvez créer une liste en appuyant ci-dessous.</p> 
        <a class=\"bouton\" href=\"creerliste\">Créer une Liste</a>
        <br>Vous pouvez modifier une liste en appuyant ci-dessous.</p> 
        <a class=\"bouton\" href=\"affmodifsliste\">Modifier une Liste</a>
        <br>Vous pouvez supprimer un Item en appuyant ci-dessous.</p> 
        <a class=\"bouton\" href=\"suppliste\">Supprimer une Liste</a>
        <br>Vous pouvez ajouter un item à une liste en appuyant ci-dessous.</p> 
        <a class=\"bouton\" href=\"affadditem\">Ajouter un Item</a>
        <br>Vous pouvez modifier un Item en appuyant ci-dessous.</p> 
        <a class=\"bouton\" href=\"affmodifsitem\">Modifier un Item</a>
        <br>Vous pouvez supprimer un Item en appuyant ci-dessous.</p> 
        <a class=\"bouton\" href=\"affsuppitem\">Supprimer un Item</a>
        
    </div>";
        }
        return $res."</div> </section>";
    }


    private function afficherListesModif() {
        $res="<section>   <div id=\"shop\"> ";
        foreach ($this->tab as $l) {
            $res = $res . "<div  class='article'>";
            $res = $res . "<a href='modifsliste/" . $l->token . "'>" . $l->titre . "</a> <p>" . $l->description . "</p>";
            $res = $res . "</div>";
        }
        return $res."</div> </section>";
    }

    private function afficherItemModif() {
        $res="<section>   <div id=\"shop\"> ";
        foreach ($this->tab as $l) {
            $res = $res . "<div  class='article'>";
            $res = $res . "<a href='modifitem/" . $l->token . "'>" . $l->nom . "<br>".  "</a> <p>" . $l->descr . "<br>". $l->img . "<br>". $l->url . "<br>". $l->tarif . '€'."</p>";
            $res = $res . "</div>";
        }
        return $res."</div> </section>";
    }

    private function afficherItemAjout() {
        $res="<section>   <div id=\"shop\"> ";
        foreach ($this->tab as $l) {
            $res = $res . "<div  class='article'>";
            $res = $res . "<a href='additem/" . $l->token . "'>" . $l->titre . "</a> <p>" . $l->description . "</p>";
            $res = $res . "</div>";
        }
        return $res."</div> </section>";
    }

    //Liste
    private function creerListe() {
        $res = <<<HTML
<div class="center">
<form class='con1' action ='creerListe' method="POST">
    <fieldset> 
        <legend>Informations liste</legend>
        <label for="titre">Titre : </label><input type="text" name="titre" placeholder="titre"> <br>
        <label for="description">Description : </label><input type="text" name="description" placeholder="description"><br>
        <label for="expiration">Date limite : </label><input type="date" name="expiration" placeholder="expiration"><br>        
        <p>Type de liste :</p>
         <label for="true">Publique</label><input type="radio" id="public" name="public" value="true" checked><br>
         <label for="false">Privée</label><input type="radio" id="public" name="public" value="false">
    </fieldset>
    <button name="btn1" value="Valider">Valider</button>
</form>
</div>
HTML;
        return $res;
    }

    private function creerListePost() {
        if(isset($this->tab['erreur'])) {
            $res="<section> <div id=\"first\">                                              
                   <p><strong><p>".$this->tab['erreur']."</p></strong>                                            
                    <a class=\"bouton\" href=\"creation\">Retour au menu Choix de création</a>  
                    <a class=\"bouton\" href=\".\">Acceuil</a>                                                                                           
                </div>";     }
        else{
            $res="<section> <div id=\"first\">                                              
                   <p><strong>Liste créée </strong>                                            
                    <a class=\"bouton\" href=\"creation\">Retour au menu Choix de création</a>  
                    <a class=\"bouton\" href=\".\">Acceuil</a>                                                                                             
                </div>";
        }
        return $res."</div> </section>";
    }

    private function modifierListe(){
        $res = <<<HTML
<div class="center">
<form action ='' method="POST">
    <fieldset> 
        <legend>Informations liste</legend>
        <label for="titre">Titre : </label><input type="text" name="titre" placeholder="titre"> <br>
        <label for="description">Description : </label><input type="text" name="description" placeholder="description"><br>
        <label for="expiration">Date limite : </label><input type="date" name="expiration" placeholder="expiration"><br>
        <p>Type de liste :</p>
         <label for="true">Publique</label><input type="radio" id="public" name="public" value="true" checked><br>
         <label for="false">Privée</label><input type="radio" id="public" name="public" value="false">
    </fieldset>
    <button name="btn1" value="Valider">Valider</button>
</form>
</div>
HTML;
        return $res;
    }

    private function modifierListePost(){
        $res="<section> <div id=\"first\"> 
        <p><strong>Liste modifiée </strong>
        <a class=\"bouton\" href=\"..\creation\">Retour au Choix de création</a>
        <a class=\"bouton\" href=\"..\">Acceuil</a>

    </div>";
        return $res."</div> </section>";
    }



    private function supprimerListe(){
        $res="<section>   <div id=\"shop\"> ";
        foreach ($this->tab as $l) {
            $res = $res . "<div  class='article'>";
            $res = $res . "<a href='suppliste/" . $l->token . "'>" . $l->titre . "</a> <p>" . $l->description . "</p>";
            $res = $res . "</div>";
        }
        return $res."</div> </section>";
    }

    private function supprimerListePost(){
        $res="<section> <div id=\"first\"> 
        <p><strong>Liste supprimée </strong>
        <a class=\"bouton\" href=\"..\creation\">Retour au Choix de création</a>
        <a class=\"bouton\" href=\"..\">Acceuil</a>

    </div>";
        return $res."</div> </section>";
    }




    private function rendrePublic($liste){

    }

    //Item
    private function ajouterItem(){
        $res = <<<HTML
<div class="center">
<form action ='' method="POST" enctype="multipart/form-data">
    <fieldset> 
        <legend>Informations Item</legend>
        <label for="nom">Titre : </label><input type="text" name="nom" placeholder="nom"> <br>
        <label for="descr">Description : </label><input type="text" name="descr" placeholder="description"><br>
        <label for="img">Image : </label><input type="file" name="img" placeholder="image"><br>
        <label for="tarif">Tarif : </label><input type="text" name="tarif" placeholder="tarif"><br>
         <label for="url">URL : </label><input type="url" name="url" placeholder="url">
    </fieldset>
    <button name="btn1" value="Valider">Valider</button>
</form>
</div>
HTML;

        return $res;
    }

    private function ajouterItemPost(){
        $res="<section> <div id=\"first\"> 
        <p><strong>Liste modifiée </strong>
        <a class=\"bouton\" href=\"..\creation\">Retour au Choix de création</a>
        <a class=\"bouton\" href=\"..\">Acceuil</a>

    </div>";
        return $res."</div> </section>";
    }

    private function modifierItem(){
        $res = <<<HTML
<div class="center">
<form action ='' method="POST">
    <fieldset> 
        <legend>Informations Item</legend>
        <label for="nom">Titre : </label><input type="text" name="nom" placeholder="nom"> <br>
        <label for="descr">Description : </label><input type="text" name="descr" placeholder="description"><br>
        <label for="img">Image : </label><input type="file" name="img" placeholder="image"><br>
        <label for="tarif">Tarif : </label><input type="text" name="tarif" placeholder="tarif"><br>
         <label for="url">URL : </label><input type="url" name="url" placeholder="url">
    </fieldset>
    <button name="btn1" value="Valider">Valider</button>
</form>
</div>
HTML;

        return $res;
    }

    private function modifierItemPost(){
        $res="<section> <div id=\"first\"> 
        <p><strong>Item modifié </strong>
        <a class=\"bouton\" href=\"..\creation\">Retour au Choix de création</a>
        <a class=\"bouton\" href=\"..\">Acceuil</a>

    </div>";
        return $res."</div> </section>";
    }

    private function supprimerItem(){
        $res="<section>   <div id=\"shop\"> ";
        foreach ($this->tab as $l) {
            $res = $res . "<div  class='article'>";
            $res = $res . "<p>" . $l->nom . "<br>" . $l->descr . "<br>". $l->img . "<br>". $l->url . "<br>". $l->tarif . '€'."</p>";
            $res = $res . "<form action ='' method='POST'>
                <button name='supp' value='supp'>Supprimer</button>
                <input hidden name='token' value='". $l->token ."' >
            </form>";
            $res = $res . "</div>";
        }
        return $res."</div> </section>";
    }

    private function supprimerItemPost(){
        $res="<section> <div id=\"first\"> 
        <p><strong>Item supprimé </strong>
        <a class=\"bouton\" href=\"..\creation\">Retour au Choix de création</a>
        <a class=\"bouton\" href=\"..\">Acceuil</a>

    </div>";
        return $res."</div> </section>";
    }

    private function affSuppItem(){
        $res="<section>   <div id=\"shop\"> ";
        foreach ($this->tab as $l) {
            $res = $res . "<div  class='article'>";
            $res = $res . "<a href='suppitem/" . $l->token . "'>" . $l->titre . "</a> <p>" . $l->description . "</p>";
            $res = $res . "</div>";
        }
        return $res."</div> </section>";
    }
}