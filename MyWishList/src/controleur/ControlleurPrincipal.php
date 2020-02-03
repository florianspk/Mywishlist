<?php
namespace mywishlist\controleur;


class ControlleurPrincipal
{

    public function afficherAccueil() {
        $tab = [];
        $v = new \mywishlist\vue\VuePrincipale($tab);
        $v->render('afficherAccueil');
    }

}